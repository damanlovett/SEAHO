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
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$colname_rsVoting = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsVoting = $_GET['recordID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsVoting = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, reviewers.programID, reviewers.`read`, reviewers.vote, reviewers.notes, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.id FROM reviewers, callforprograms WHERE reviewers.userID = %s AND reviewers.programID = callforprograms.id ORDER BY callforprograms.ProgramTitle", GetSQLValueString($colname_rsVoting, "text"));
$rsVoting = mysql_query($query_rsVoting, $Programming) or die(mysql_error());
$row_rsVoting = mysql_fetch_assoc($rsVoting);
$totalRows_rsVoting = mysql_num_rows($rsVoting);

$colname_rsUserInfo = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUserInfo = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsUserInfo = sprintf("SELECT users.userID, users.first_name, users.last_name FROM users WHERE users.userID = %s", GetSQLValueString($colname_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $Programming) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);
?>
<?php  $lastTFM_nest = "";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reviewers</title>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
	color: #000099;
}
.style2 {font-size: 12px}
-->
</style>
<link href="../../styles/printsimple.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body>
<div class="detailspopup">
  <form>
    <input name="Print" type="button" class="noprint" onclick="window.print();return false" value="Print Reviews" />
  </form>
  <p class="style1"><?php echo $row_rsUserInfo['first_name']; ?> <?php echo $row_rsUserInfo['last_name']; ?></p>
  <p><strong>Voting Record</strong></p>
  <div align="left">
    <?php do { ?>
    <?php If($row_rsVoting['vote']=='Yes' || $row_rsVoting['vote']=='No' || $row_rsVoting['vote']=='Maybe'){?>
                    <?php $TFM_nest = $row_rsVoting['ProgramTitle'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?>
<table border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td colspan="3" nowrap="nowrap"><span class="style2"><strong><?php echo $row_rsVoting['vote']; ?>&nbsp;&nbsp;</strong>
              
              <?php echo substr($row_rsVoting['ProgramTitle'],0,40)."..."; ?>
          (<?php echo $row_rsVoting['ProgramNumber']; ?>)</span> </td>
        </tr>
        <tr>
          <td><?php echo $row_rsVoting['notes']; ?>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><hr /></td>
        </tr>
      </table>              
	  <?php } //End of Basic-UltraDev Simulated Nested Repeat?>

      <?php }?>
<?php } while ($row_rsVoting = mysql_fetch_assoc($rsVoting)); ?>
    
  </div>
  
  <p align="center"><input type=button class="noprint" onClick="javascript:window.close();" value="Close Window">
  </p>
	 <div class="cleartable"></div>
</div>
</body>
</html>
<?php
mysql_free_result($rsVoting);

mysql_free_result($rsUserInfo);
?>
