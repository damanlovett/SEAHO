<?php
ob_start();
session_start();
$systemDate = date ("Y-m-d G:i:s");
$currentDate = date('Y-m-d');
$invoiceNumber = date('ym-d-Gis');
$conferenceDate = date('Ymd');

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
#$hostname_CMS = "db1025.perfora.net";
#$database_CMS = "db210095539";
#$username_CMS = "dbo210095539";
#$password_CMS = "cromag65";
$hostname_CMS = "db44.perfora.net";
$database_CMS = "db251380839";
$username_CMS = "dbo251380839";
$password_CMS = "Pyh5phqj";
$CMS = mysql_pconnect($hostname_CMS, $username_CMS, $password_CMS) or trigger_error(mysql_error(),E_USER_ERROR); 


// Magic Quotes - This is the normal magic quotes that Dreamweaver adds to pages with recordsets
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// Check for Access Point
if($_SESSION['accesspoint']!="CMSdelegate") {
		session_destroy();
		header ("Location: /registration/delegate/index.php");
		exit;
}

if(!isset($_SESSION['sitename'])){

if (isset($_SESSION['accesspoint'])) {
  $colname_rsSystemConfiguration = "Seaho Conference Management System";
}
mysql_select_db($database_CMS, $CMS);
$query_rsSystemConfiguration = sprintf("SELECT * FROM sys_configuration WHERE sitename = %s", GetSQLValueString($colname_rsSystemConfiguration, "text"));
$rsSystemConfiguration = mysql_query($query_rsSystemConfiguration, $CMS) or die(mysql_error());
$row_rsSystemConfiguration = mysql_fetch_assoc($rsSystemConfiguration);
$totalRows_rsSystemConfiguration = mysql_num_rows($rsSystemConfiguration);

$_SESSION['systemStatus'] = $row_rsSystemConfiguration['status'];
$_SESSION['systemSitename'] = $row_rsSystemConfiguration['sitename'];
$_SESSION['systemSupportEmail'] = $row_rsSystemConfiguration['supportemail'];
$_SESSION['systemVersion'] = $row_rsSystemConfiguration['sysVersion'];
$_SESSION['systemCreation'] = $row_rsSystemConfiguration['sysCreation'];
$_SESSION['systemContract'] = $row_rsSystemConfiguration['sysContract'];
$_SESSION['systemOperator'] = $row_rsSystemConfiguration['sysOperator'];
$_SESSION['systemLiaison'] = $row_rsSystemConfiguration['sysLiaison'];
$_SESSION['systemRoot'] = $row_rsSystemConfiguration['sysRoot'];
$_SESSION['systemFileRoot'] = $row_rsSystemConfiguration['sysFileRoot'];
$_SESSION['systemDescription'] = $row_rsSystemConfiguration['sysDescription'];

} 

// Inactive System
if($_SESSION['systemStatus'] == "Inactive") {
		header ("Location: /registration/delegate/index.php?error=11");
		exit;
}


// Assign User Information
if ((isset($_POST['delegateemail'])) && (isset($_POST['password']))) {
$colname_rsUserInfo = "-1";
if (isset($_POST['delegateemail'])) {
  $colname_rsUserInfo = $_POST['delegateemail'];
}
$colname2_rsUserInfo = "-1";
if (isset($_POST['password'])) {
  $colname2_rsUserInfo = $_POST['password'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsUserInfo = sprintf("SELECT * FROM delegate WHERE delegate.email = %s AND delegate.password = %s AND deleted = 0", GetSQLValueString($colname_rsUserInfo, "text"),GetSQLValueString($colname2_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $CMS) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);

//User is not in the system
if($totalRows_rsUserInfo == '0') {
		header ("Location: /registration/delegate/index.php?error=4");
		exit;
}

//User is not active
//if($row_rsUserInfo['active'] != '1') {
//		header ("Location: /registration/delegate/index.php?error=3");
//		exit;
//}

//User is in the system 
if($totalRows_rsUserInfo == '1') {

$_SESSION['userID'] = $row_rsUserInfo['delegate_id'];
$_SESSION['first_name'] = $row_rsUserInfo['first_name'];
$_SESSION['last_name'] = $row_rsUserInfo['last_name'];
$_SESSION['display_name'] = $row_rsUserInfo['first_name']." ".$row_rsUserInfo['last_name'];
$_SESSION['email'] = $row_rsUserInfo['email'];
$_SESSION['access'] = $row_rsUserInfo['access'];
$_SESSION['seaho_years'] = $row_rsUserInfo['seaho_years'];
$_SESSION['org_name'] = $row_rsUserInfo['org_name'];
}
}


//// Redirect if not logged in
if (empty($_SESSION['userID'])) {
	header ("Location: /registration/delegate/index.php");
	exit;
	}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){

  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  session_destroy();
  

  $logoutGoTo = "/registration/delegate/index.php?error=1";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

// Delete record - sets the delete field to 1
function DeleteRecord($table,$tableID){

		global $database_CMS;
		global $CMS;

if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {

  $deleteSQL = sprintf("UPDATE $table SET `delete`= 1 WHERE $tableID=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($deleteSQL, $CMS) or die(mysql_error());
}
}

// Delete record - sets the delete field to 1
function DeleteRecordNEW($table,$tableID){

		global $database_MessageBoard;
		global $MessageBoard;
if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {
  $deleteSQL = sprintf("UPDATE $table SET deleted= 1 WHERE $tableID=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_MessageBoard, $MessageBoard);
  $Result1 = mysql_query($deleteSQL, $MessageBoard) or die(mysql_error());
}
}


// unDelete record - sets the delete field to 0
function unDeleteRecord($table,$tableID){

		global $database_CMS;
		global $CMS;

if ((isset($_GET['undelete'])) && ($_GET['undelete'] != "")) {

  $deleteSQL = sprintf("UPDATE $table SET `delete`= 0 WHERE $tableID=%s",
                       GetSQLValueString($_GET['undelete'], "text"));

  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($deleteSQL, $CMS) or die(mysql_error());
}
}

// Audit report

  $insertAudit = sprintf("INSERT INTO audit_report_members (id, name, user_id, ip_address, page, access_date) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_SESSION['display_name'], "text"),
                       GetSQLValueString($_SESSION['userID'], "text"),
                       GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
                       GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                       GetSQLValueString($systemDate, "text"));

  mysql_select_db($database_CMS, $CMS);
  $ResultAudit = mysql_query($insertAudit, $CMS) or die(mysql_error());


// Make Page Active 
function activePage(){

  	  global $database_CMS;
  	  global $CMS;

	//if X is upload set it to 1 and all others to 0
	if(isset($_GET['upload'])){
	  $updateSQL = sprintf("UPDATE team_pages SET active=1 WHERE page_id=%s",
                       GetSQLValueString($_GET['upload'], "int"));
					   
  	  mysql_select_db($database_CMS, $CMS);
  	  $Result1 = mysql_query($updateSQL, $CMS) or die(mysql_error());
  
  	  $updateSQL2 = sprintf("UPDATE team_pages SET active=0 WHERE page_id!=%s AND state_id=%s",
                       GetSQLValueString($_GET['upload'], "int"),
                       GetSQLValueString($_SESSION['staccess'], "int"));
   	  mysql_select_db($database_CMS, $CMS);
  	  $Result = mysql_query($updateSQL2, $CMS) or die(mysql_error());
}
	//if X is download set it to 0
	if(isset($_GET['download'])){
  	  $updateSQL = sprintf("UPDATE team_pages SET active=0 WHERE page_id=%s",
                       GetSQLValueString($_GET['download'], "int"));
  	  mysql_select_db($database_CMS, $CMS);
  	  $Result1 = mysql_query($updateSQL, $CMS) or die(mysql_error());
	}

}

// Basic Date

function basicDate($datestring){
$convertDate = date("M d, Y",strtotime($datestring));
echo $convertDate;
}

// Format Date

function formatDate($datestring,$format){
$convertDate = date("".$format."",strtotime($datestring));
echo $convertDate;
}

// On off Switch - displays text depending on the switch
function OnOffSwitch($record,$item0,$item1,$item2,$item3){

  switch ($record) {
    case 0:
      echo $item0;
      break;     
    case 1:
      echo $item1;
      break;     
    case 2:
      echo $item2;
      break;
    case 3:
      echo $item3;
      break;
	default:
	echo "N/A";
	  break;
	  
	  }     
	  }
 
// Image On off Switch - displays an image depending on the switch
function ImageOnOffSwitch($record,$item1,$item2,$item3){

  switch ($record) {
    case 0:
      echo "<img src='/admin/images/$item1' width='16' height='16' />";
      break;     
    case 1:
      echo "<img src='/admin/images/$item2' width='16' height='16' />";
      break;     
    case 2:
      echo "<img src='/admin/images/$item3' width='16' height='16' />";
      break;
	default:
	echo "N/A";
	  break;
	  
	  }     
	  }
 
//  Administrator Description     
if ($_SESSION['access'] == "1") { $accessDisplay = "Level 1 - Super Administrator"; }
if ($_SESSION['access'] == "2") { $accessDisplay = "Level 2 - Administrator"; }
if ($_SESSION['access'] == "3") { $accessDisplay = "Level 3 - Member"; }
if ($_SESSION['access'] == "4") { $accessDisplay = "Level 4 - Special Member"; }

////  Administrator replacement 
function login($access) {
    if ($access == "1") { echo "Level 1 - Super Administrator"; }
elseif ($access == "2") { echo "Level 2 - Administrator"; }
elseif ($access == "3") { echo "Level 3 - Member"; }
elseif ($access == "4") { echo "Level 4 - Special Member"; }
else { echo "Inactive - None"; }
}


//  Voting Graphics - produces a graph to display the results         
function voteGraph ($resultcount,$result,$total){
 
 $width = $resultcount * 10;
 $graphNumber = round(($resultcount/$total) * 100);
 switch($result){
 case "Yes":
 $color = "#009900";
 break;
 case "No":
 $color = "#990000";
 break;
 default:
 $color = "gray";
 break;
 }
 echo "<p><div class ='float'><hr size=8 align='left' color='".$color."' width=".$width."/></div><strong>".$resultcount."</strong> ".$result." votes - ".$graphNumber."%</p>"; 
 }


//  Create Password - creates a random password
function createPassword() {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}


function stopSign($record,$Yes,$No) {
	if($record == $Yes) {
	echo "<img src='/admin/images/Approved.gif' width='12' height='12' />";
  } elseif ($record == $No) { 
	echo "<img src='/admin/images/Denied.gif' width='12' height='12' />";
  } else { echo "<img src='/admin/images/Pending.gif' width='12' height='12' />";}                        
} 

// Email System
function systemEmail($subject,$htmlBody,$mail_to,$mailto_first,$mailto_last){

$mailto_name = $mailto_first." ".$mailto_last;

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/phpmailer/MailClass.inc');

$mailer = new FreakMailer();
$mailer->Subject = $subject;
$mailer->Body = $htmlBody;
$mailer->isHTML(true);
$mailer->FromName = $_SESSION['display_name'];
$mailer->AddAddress($mail_to, $mailto_name);
$mailer->Send(); 
if(!$mailer->Send())
{
  echo 'There was a problem sending this mail!';
}
else
{
  echo 'Mail sent to '.$mailto_name.'!<br />';
}
$mailer->ClearAddresses();
$mailer->ClearAttachments();

}

// Function to Convert Currency
function DoFormatCurrency($theObject,$NumDigitsAfterDecimal,$DecimalSeparator,$GroupDigits,$CurrencySymbol) { 
	$currencyFormat=$CurrencySymbol.number_format($theObject,$NumDigitsAfterDecimal,$DecimalSeparator,$GroupDigits);
	return ($currencyFormat);
}

#Records all sqlQueries for Debugging
function sqlQueryLog($query) {
global $CMS;
global $database_CMS;
$urlstring = addslashes($_SERVER['PHP_SELF']);
if (!empty($_SERVER['QUERY_STRING'])) {
$urlstring .= "?".addslashes($_SERVER['QUERY_STRING']);
}

#ipAddress tracking
$systemDate = date ("Y-m-d G:i:s");
$ipaddress = addslashes($_SERVER['REMOTE_ADDR']);
$trackingSQL = sprintf("INSERT INTO sys_queries (userid, username, ipaddress, urlstring, mysqlquery, accesstime) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['userID'], "text"),
                       GetSQLValueString($_SESSION['display_name'], "text"),
                       GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
                       GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                       GetSQLValueString($query, "text"),
                       GetSQLValueString($systemDate, "text"));

mysql_select_db($database_CMS, $CMS);
$Result6 = mysql_query($trackingSQL, $CMS) or die(mysql_error());
}

//     Create guid function - this is used to create a unigue id       
function create_guid()

{

    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);

    $dec_hex = sprintf("%x", $a_dec* 1000000);
    $sec_hex = sprintf("%x", $a_sec);

    ensure_length($dec_hex, 5);
    ensure_length($sec_hex, 6);

    $guid = "";
    $guid .= $dec_hex;
    $guid .= create_guid_section(3);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= $sec_hex;
    $guid .= create_guid_section(6);

    return $guid;
}

 

function create_guid_section($characters)

{

    $return = "";
    for($i=0; $i<$characters; $i++)
    {
    $return .= sprintf("%x", mt_rand(0,15));
    }

    return $return;
}

 

function ensure_length(&$string, $length)

{
    $strlen = strlen($string);
    if($strlen < $length)

    {

    $string = str_pad($string,$length,"0");

    }

    else if($strlen > $length)

    {

    $string = substr($string, 0, $length);

    }

}

 

function microtime_diff($a, $b) {

   list($a_dec, $a_sec) = explode(" ", $a);
   list($b_dec, $b_sec) = explode(" ", $b);
   return $b_sec - $a_sec + $b_dec - $a_dec;

}
?>
