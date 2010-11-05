<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_GET['updateID'])) {
  $updateSQL = sprintf("UPDATE callforprograms SET Status=%s WHERE id=%s",
                       GetSQLValueString($_GET['status'], "text"),
                       GetSQLValueString($_GET['updateID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

$colname_rs = "-1";
if (isset($_GET['updateID'])) {
  $colname_rs = (get_magic_quotes_gpc()) ? $_GET['updateID'] : addslashes($_GET['updateID']);

mysql_select_db($database_Programming, $Programming);
$query_rs = sprintf("SELECT id, ProgramTitle, ProgramNumber, Status FROM callforprograms WHERE id = %s", GetSQLValueString($colname_rs, "int"));
$rs = mysql_query($query_rs, $Programming) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);

}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Status Update</title>
<style type="text/css">
<!--
.style1 {
	color: #990000;
	font-weight: bold;
}
p {
	padding: 10px;
}
-->
</style>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>&quot; <strong><?php echo $row_rs['ProgramTitle']; ?></strong> &quot; has been updated to<br />
  status of <span class="style1"><?php echo $_GET['status']; ?></span> the status will display when<br />
  you refresh the page.  </p>
<p><input type=button value="Close Window" onClick="javascript:window.close();">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs);
?>
