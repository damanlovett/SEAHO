<?php require_once('../../../Connections/Programming.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "AddReviewer")) {
  $insertSQL = sprintf("INSERT INTO reviewers (reviewID, userID, programID) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['reviewID'], "text"),
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['programID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$colname_rsProgram = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsProgram = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgram = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.FirstName, callforprograms.LastName, callforprograms.ProgramDescription, callforprograms.TopicArea FROM callforprograms WHERE callforprograms.id = %s", GetSQLValueString($colname_rsProgram, "text"));
$rsProgram = mysql_query($query_rsProgram, $Programming) or die(mysql_error());
$row_rsProgram = mysql_fetch_assoc($rsProgram);
$totalRows_rsProgram = mysql_num_rows($rsProgram);

$colname_rsReviews = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsReviews = $_GET['recordID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsReviews = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, reviewers.programID, reviewers.vote, users.id, users.userID, users.first_name, users.last_name FROM reviewers, users WHERE reviewers.programID = %s AND reviewers.userID =  users.userID ORDER BY reviewers.reviewID", GetSQLValueString($colname_rsReviews, "text"));
$rsReviews = mysql_query($query_rsReviews, $Programming) or die(mysql_error());
$row_rsReviews = mysql_fetch_assoc($rsReviews);
$totalRows_rsReviews = mysql_num_rows($rsReviews);

mysql_select_db($database_Programming, $Programming);
$query_rsUserList = "SELECT users.id, users.userID, users.first_name, users.last_name FROM users ORDER BY users.last_name";
$rsUserList = mysql_query($query_rsUserList, $Programming) or die(mysql_error());
$row_rsUserList = mysql_fetch_assoc($rsUserList);
$totalRows_rsUserList = mysql_num_rows($rsUserList);
?>
<?php  $lastTFM_nest = "";?>
<?php require_once('../../includefiles/init.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Program Reviewers</title>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #000099;
}
.style2 {color: #000099}
-->
</style>
</head>

<body>
<div class="detailspopup2">
  <p><span class="style1"><?php echo $row_rsProgram['ProgramTitle']; ?></span></p>
  <p class="style2"><?php echo $row_rsProgram['FirstName']; ?> <?php echo $row_rsProgram['LastName']; ?><br />
  <?php echo $row_rsProgram['TopicArea']; ?></p>
  <p><?php echo $row_rsProgram['ProgramDescription']; ?>
  </p>
  <?php if ($totalRows_rsReviews > 0) { // Show if recordset not empty ?>
      <table border="0" cellspacing="0" cellpadding="3">
      <?php do { ?>
          <tr>
          <?php if($row_rsReviews['vote']=='Yes'){?>
		  <?php $TFM_nest = $row_rsReviews['first_name'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?><td nowrap="nowrap"><?php echo $row_rsReviews['first_name']; ?> <?php echo $row_rsReviews['last_name']; ?></td>
          <td>-</td>
          <td><strong><?php echo $row_rsReviews['vote']; ?></strong></td>
          <?php }?>
          <?php } //End of Basic-UltraDev Simulated Nested Repeat?>
        </tr>
<?php } while ($row_rsReviews = mysql_fetch_assoc($rsReviews)); ?>
    </table>
    <?php } // Show if recordset not empty ?><br />
  <p>&nbsp;</p>
  <p>
    <input type=button value="Close Window" onClick="javascript:window.close();">
  </p>
  <p><br />
  </p>
</div>
</body>
</html>
<?php
mysql_free_result($rsProgram);

mysql_free_result($rsReviews);

mysql_free_result($rsUserList);
?>
