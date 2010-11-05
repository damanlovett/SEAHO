<?php require_once('../Connections/Programming.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

mysql_select_db($database_Programming, $Programming);
$query_rsPreConf = "SELECT *, CONCAT_WS(', ',callforprograms.addName1,callforprograms.addInstitution1) AS AddPro1, CONCAT_WS(', ',callforprograms.addName2,callforprograms.addInstitution2) AS AddPro2, CONCAT_WS(', ',callforprograms.addName3,callforprograms.addInstitution3) AS AddPro3 FROM callforprograms WHERE SessionType = 'Pre-Confer' AND callforprograms.Status = 'Accepted' AND callforprograms.deleted=0";
$rsPreConf = mysql_query($query_rsPreConf, $Programming) or die(mysql_error());
$row_rsPreConf = mysql_fetch_assoc($rsPreConf);
$totalRows_rsPreConf = mysql_num_rows($rsPreConf);mysql_select_db($database_Programming, $Programming);
$query_rsPreConf = "SELECT *, CONCAT_WS(', ',callforprograms.addName1,callforprograms.addInstitution1) AS AddPro1, CONCAT_WS(', ',callforprograms.addName2,callforprograms.addInstitution2) AS AddPro2, CONCAT_WS(', ',callforprograms.addName3,callforprograms.addInstitution3) AS AddPro3 FROM callforprograms WHERE SessionType = 'Pre-Conference Workshop' AND callforprograms.Status = 'Accepted' AND callforprograms.deleted=0";
$rsPreConf = mysql_query($query_rsPreConf, $Programming) or die(mysql_error());
$row_rsPreConf = mysql_fetch_assoc($rsPreConf);
$totalRows_rsPreConf = mysql_num_rows($rsPreConf);
?>
<?php require_once('includefiles/initEmails.php'); ?>
<?php

$systemDate = date ("Y-m-d G:i:s");

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

submissionEmail($_POST['FirstName'],"Program Submission Confirmation",$_POST['EmailAddress'],$_POST['ProgramTitle']);

}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pre-Program</title>
<link href="styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="styles/table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includefiles/gen_validatorv2.js"></script>
<style type="text/css">
<!--
form {
	background-color: #2E679C;
}
body {
	margin-top: 10px;
	margin-right: 10px;
	margin-left: 10px;
	background-color: #1467AD;
}
h1 {
	color: #1467AD;
}
h2 {
	color: #000099;
}
.programBody {
	border: 5px double #CCCCCC;
}
.noBullets {
	list-style: none;
}
h3 {
	color: #000099;
}
-->
</style>
</head>

<body>
<table width="760" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="programBody">
    <tr>
      <td><div align="center"></div></td>
    </tr>
    <tr>
      <td><h1><img src="../images/logo2009.jpg" alt="Conference Logo" width="118" height="117" hspace="15" align="middle" />Pre-Conference Programs</h1></td>
    </tr>
    <tr>
      <td bgcolor="#1467AD">&nbsp;</td>
    </tr>
  <?php do { ?>
    
  <tr>
    <td><h2><?php echo $row_rsPreConf['ProgramTitle']; ?></h2>
      <h3><?php echo $row_rsPreConf['FirstName']; ?> <?php echo $row_rsPreConf['LastName']; ?>, 
        <?php echo $row_rsPreConf['Institution']; ?></h3>
      <ul class="noBullets">
        <?php if (isset($row_rsPreConf['addName1'])) { // Show if recordset empty ?>
          <li><strong>Additional Presenter(s)</strong></li>
          <li><?php echo $row_rsPreConf['AddPro1']; ?></li>
          <li><?php echo $row_rsPreConf['AddPro2']; ?></li>
          <li><?php echo $row_rsPreConf['AddPro3']; ?></li>
          <?php } // Show if recordset empty ?>
</ul>      
      <?php echo $row_rsPreConf['ProgramDescription']; ?></td>
    </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php } while ($row_rsPreConf = mysql_fetch_assoc($rsPreConf)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsPreConf);
?>