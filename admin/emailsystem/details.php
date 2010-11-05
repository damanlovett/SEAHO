<?php require_once('../../Connections/Directory.php'); ?>
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
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$colname_rsEmails = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsEmails = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsEmails = sprintf("SELECT email_records.id, email_records.title, email_records.emailmessage, email_records.sent_to, email_records.sent_by, DATE_FORMAT(email_records.sent_date,'%%M %%d %%Y at %%r') AS sent_on FROM email_records WHERE email_records.id = %s", GetSQLValueString($colname_rsEmails, "text"));
$rsEmails = mysql_query($query_rsEmails, $Directory) or die(mysql_error());
$row_rsEmails = mysql_fetch_assoc($rsEmails);
$totalRows_rsEmails = mysql_num_rows($rsEmails);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Email Details</title>

<style type="text/css">
<!--
td {
	font-size: 11px;
}
.detailspopup {
	width: 370px;
}
-->
</style>
<link href="../../styles/printdetails.css" rel="stylesheet" type="text/css" media="print" />
<style type="text/css">
<!--
.style3 {
	font-size: 14px;
	font-weight: bold;
}
.style4 {color: #000099}
-->
</style>
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="detailspopup"> <span class="CommitteeSectionTitle style3"><?php echo $row_rsEmails['title']; ?>
  </span>
  <p>To: <span class="style4"><?php echo $row_rsEmails['sent_to']; ?></span><br />
    From: <strong><?php echo $row_rsEmails['sent_by']; ?></strong><br />
    Sent on: <span class="style4"><?php echo $row_rsEmails['sent_on']; ?></span><br />
    <br />
    <?php echo $row_rsEmails['emailmessage']; ?></p>
  <p>&nbsp;</p><input type=button value="Close Window" onClick="javascript:window.close();">
</div>
</body>
</html>
<?php
mysql_free_result($rsEmails);
?>