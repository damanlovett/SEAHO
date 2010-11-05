<?php require_once('../../Connections/Programming.php'); ?>
<?php
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

$colname_rsEmails = "-1";
if (isset($_POST['status'])) {
  $colname_rsEmails = (get_magic_quotes_gpc()) ? $_POST['status'] : addslashes($_POST['status']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsEmails = sprintf("SELECT ProgramTitle, FirstName, EmailAddress, Status FROM emailtest WHERE Status = %s", GetSQLValueString($colname_rsEmails, "text"));
$rsEmails = mysql_query($query_rsEmails, $Programming) or die(mysql_error());
$row_rsEmails = mysql_fetch_assoc($rsEmails);
$totalRows_rsEmails = mysql_num_rows($rsEmails);
?><?

function emailRecord($Title,$mailto,$emailmessage){
		global $database_programming;
		global $Programming;

  $insertSQL = sprintf("INSERT INTO email_records (title, emailmessage, sent_to) VALUES (%s, %s, %s)",
                       GetSQLValueString($Title, "text"),
                       GetSQLValueString($emailmessage, "text"),
                       GetSQLValueString($mailto, "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());


}

function myEmail($firstName,$subject,$mailto,$Title,$emailmessage)
{

// Header for return address
$headers = 'From: programming@seaho.org' . "\r\n" .
   'Reply-To: programming@seaho.org' . "\r\n" .
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

<h3>Programming Committee Proposal Info</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>Thank you for submitting your program titled <strong>".$Title."</strong> for presentation at SEAHO 2007 in Lexington Kentucky. Your program has not been selected for presentation at the conference.</p>

".$emailmessage." 
</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php do { ?>
  <?php myEmail($row_rsEmails['FirstName'],$_REQUEST['subject'],$row_rsEmails['EmailAddress'],$row_rsEmails['ProgramTitle'],$_REQUEST['emailmessage']);?>
  <?php } while ($row_rsEmails = mysql_fetch_assoc($rsEmails)); ?>
  
<?php emailRecord($_REQUEST['subject'],$_REQUEST['status'],$_REQUEST['emailmessage']);?>

</body>

</html>

<?php
mysql_free_result($rsEmails);
?>
