<?php
ob_start();
session_start();
$systemDate = date ("Y-m-d G:i:s");
$currentDate = date('Y-m-d');

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Programming = "db101.perfora.net";
$database_Programming = "db251380847";
$username_Programming = "dbo251380847";
$password_Programming = "fwu8mPPV";
$Programming = mysql_pconnect($hostname_Programming, $username_Programming, $password_Programming) or trigger_error(mysql_error(),E_USER_ERROR); 

////// TESTING SESSIONS /////////
//$_SESSION['userID'] = "c2fa9886-f81d-5d31-9ace-461d39b39d4e";
//$_SESSION['first_name'] = "Eddie";
//$_SESSION['last_name'] = "Lovett";
//$_SESSION['access'] = 1;
//$_SESSION['group'] = "Academic Initiatives and Partnerships";


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
if($_SESSION['accesspoint']!="Seaho Programming") {
		session_destroy();
		header ("Location: /programs/admin/login.php");
		exit;
}

if(!isset($_SESSION['sitename'])){

if (isset($_SESSION['accesspoint'])) {
  $colname_rsSystemConfiguration = (get_magic_quotes_gpc()) ? $_SESSION['accesspoint'] : addslashes($_SESSION['accesspoint']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsSystemConfiguration = sprintf("SELECT * FROM sys_configuration WHERE sitename = %s", GetSQLValueString($colname_rsSystemConfiguration, "text"));
$rsSystemConfiguration = mysql_query($query_rsSystemConfiguration, $Programming) or die(mysql_error());
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

// Assign User Information
if ((isset($_POST['user'])) && (isset($_POST['password']))) {
$colname_rsUserInfo = "-1";
if (isset($_POST['user'])) {
  $colname_rsUserInfo = $_POST['user'];
}
$colname2_rsUserInfo = "-1";
if (isset($_POST['password'])) {
  $colname2_rsUserInfo = $_POST['password'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsUserInfo = sprintf("SELECT * FROM users WHERE email = %s AND users.password = %s AND 'delete' = 0", GetSQLValueString($colname_rsUserInfo, "text"),GetSQLValueString($colname2_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $Programming) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);

//User is not in the system
if($totalRows_rsUserInfo == '0') {
		header ("Location: /programs/admin/login.php?error=4");
		exit;
}

//User is not active
if($row_rsUserInfo['active'] != '1') {
		header ("Location: /programs/admin/login.php?error=3");
		exit;
}

//User is in the system 
if($totalRows_rsUserInfo == '1') {

$_SESSION['userID'] = $row_rsUserInfo['userID'];
$_SESSION['first_name'] = $row_rsUserInfo['first_name'];
$_SESSION['last_name'] = $row_rsUserInfo['last_name'];
$_SESSION['display_name'] = $row_rsUserInfo['first_name']." ".$row_rsUserInfo['last_name'];
$_SESSION['email'] = $row_rsUserInfo['email'];
$_SESSION['access'] = $row_rsUserInfo['access'];
$_SESSION['group'] = $row_rsUserInfo['group'];

// recordset for voting
//$colname_rsVotes = "-1";
//if (isset($_SESSION['userID'])) {
//  $colname_rsVotes = $_SESSION['userID'];
//}
//mysql_select_db($database_Directory, $Directory);
//$query_rsVotes = sprintf("SELECT id, position_id, user_id, votes FROM team_positions WHERE user_id = %s AND votes = 1", GetSQLValueString($colname_rsVotes, "text"));
//$rsVotes = mysql_query($query_rsVotes, $Directory) or die(mysql_error());
//$row_rsVotes = mysql_fetch_assoc($rsVotes);
//$totalRows_rsVotes = mysql_num_rows($rsVotes);
//
//$_SESSION['votes'] = $row_rsVotes['votes'];

// Check for session still live
if(!isset($_SESSION['access'])) {
		header ("Location: /programs/admin/login.php");
		exit;
}

// Members - login record
  $insertOnline = sprintf("INSERT INTO loginrecord (id, username, ip_address) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_SESSION['userID'], "text"),
                       GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"));

mysql_select_db($database_Programming, $Programming);
  $ResultOnline = mysql_query($insertOnline, $Programming) or die(mysql_error());
}
}


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //Delete them from online database
   //$deleteSQL = sprintf("DELETE FROM online_report WHERE user_id=%s",
   //                    GetSQLValueString($_SESSION['userID'], "text"));

 // mysql_select_db($database_Directory, $Directory);
 // $Resultdelete = mysql_query($deleteSQL, $Directory) or die(mysql_error());

  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  session_destroy();
  

  $logoutGoTo = "/programs/admin/login.php?error=1";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}


// Delete record - sets the delete field to 1
function DeleteRecord($table,$tableID){

		global $database_Programming;
		global $Programming;

if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {

  $deleteSQL = sprintf("UPDATE $table SET `delete`= 1 WHERE $tableID=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($deleteSQL, $Programming) or die(mysql_error());
}
}

// unDelete record - sets the delete field to 0
function unDeleteRecord($table,$tableID){

		global $database_Programming;
		global $Programming;

if ((isset($_GET['undelete'])) && ($_GET['undelete'] != "")) {

  $deleteSQL = sprintf("UPDATE $table SET `delete`= 0 WHERE $tableID=%s",
                       GetSQLValueString($_GET['undelete'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($deleteSQL, $Programming) or die(mysql_error());
}
}

///// On off Switch //////////

function OnOffSwitch($record,$item1,$item2,$item3){

  switch ($record) {
    case 0:
      echo $item1;
      break;     
    case 1:
      echo $item2;
      break;     
    case 2:
      echo $item3;
      break;
	default:
	echo "N/A";
	  break;
	  
	  }     
	  }
 
 ///// Image On off Switch //////////

function ImageOnOffSwitch($record,$item1,$item2,$item3){

  switch ($record) {
    case 0:
      echo "<img src='../../images/$item1' width='16' height='16' />";
      break;     
    case 1:
      echo "<img src='../../images/$item2' width='16' height='16' />";
      break;     
    case 2:
      echo "<img src='../../images/$item3' width='16' height='16' />";
      break;
	default:
	echo "N/A";
	  break;
	  
	  }     
	  }
	  
	  
// Format Date

function formatDate($datestring,$format){
$convertDate = date("".$format."",strtotime($datestring));
echo $convertDate;
}

 
 ///////////////////////////////////////////
////     Administrator replacement     /////
function login($access) {
if ($access == "2") { echo "Level 2 - Administrator"; }
elseif ($access == "1") { echo "Level 1 - Super Administrator"; }
elseif ($access == "3") { echo "Level 3 - Staff"; }
else { echo "Inactive - None"; }
}

/////////////////////////////////////////////
////           Create Password          ////

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
/////////////////////////////////////////////////
///////////     Password Update    /////////////

function passwordRequest2($firstName,$mailto,$password)
{
// Variables
$subject = "Password Request";

// Header for return address
$headers = 'From: webmaster@seaho.org' . "\r\n" .
   'Reply-To: webmaster@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

<h3>Password Update</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>This email is being sent to you because your password has requested.  If you did not request for your password to be sent to you please contact the webmaster at webmaster@seaho.org ASAP.  Below is the information, that was requested. </p>

<p>
<strong>user/email: ".$mailto."<br />
password: ".$password."</strong>

</p>
</body>
</html>
";

mail($mailto, $subject, $message,$headers);


}
/////////////////////////////////////////////
////  Email New Member Information      ////

function NewMemberEmail($firstName,$mailto,$password)
{
// Variables
$subject = "Welcome to SEAHO Program LCCM";

// Header for return address
$headers = 'From: webmaster@seaho.org' . "\r\n" .
   'Reply-To: webmaster@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

<h3>Welcome to LCCM</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>Welcome to the SEAHO Program LCCM.  The Lovett Creations Content Manager is your member portal that will allow you access to vital information pertaining to the SEAHO programming.</p>

<p>Your new account has been created, and is ready for you to access.  Below you will find your login information, your next step is to login at <a href='http://seaho.org/programs/admin'>SEAHO Programs LCCM</a>.  If you have any question please let us know.  Thanks and enjoy.
<hr />
<strong>user/email: </strong>".$mailto."<br />
<strong>password: </strong>".$password."</p>
<hr />

</body>
</html>
";

mail($mailto, $subject, $message,$headers);


}
/////////////////////////////////////////////
////  Simple Email Notification Form    ////

function emailNotification($name,$title,$mailto)
{
// Variables
$subject = $title;

// Header for return address
$headers = 'From: webmaster@seaho.org' . "\r\n" .
   'Reply-To: webmaster@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<body>
<p>".$name.",<br />
<strong>".$title."</strong> has been submitted to the Database.  The information has been entered into the database.  You can login to review the information</p>

</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}

//////////////////////////////////////////
///     Create guid function       //////

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