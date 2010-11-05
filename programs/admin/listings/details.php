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

$colname_rsProgramDetails = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsProgramDetails = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramDetails = sprintf("SELECT * FROM callforprograms WHERE callforprograms.id = %s", GetSQLValueString($colname_rsProgramDetails, "int"));
$rsProgramDetails = mysql_query($query_rsProgramDetails, $Programming) or die(mysql_error());
$row_rsProgramDetails = mysql_fetch_assoc($rsProgramDetails);
$totalRows_rsProgramDetails = mysql_num_rows($rsProgramDetails);

$colname_rsReviewers = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsReviewers = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsReviewers = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, reviewers.programID, reviewers.`read`, reviewers.vote, users.first_name, users.last_name, users.userID FROM reviewers, users WHERE reviewers.programID = %s AND reviewers.userID = users.userID", GetSQLValueString($colname_rsReviewers, "int"));
$rsReviewers = mysql_query($query_rsReviewers, $Programming) or die(mysql_error());
$row_rsReviewers = mysql_fetch_assoc($rsReviewers);
$totalRows_rsReviewers = mysql_num_rows($rsReviewers);

$colname_rsRooms = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsRooms = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsRooms = sprintf("SELECT rooms.id, rooms.roomID, rooms.programID, rooms.location, rooms.start_time, rooms.end_time FROM rooms WHERE rooms.programID = %s", GetSQLValueString($colname_rsRooms, "text"));
$rsRooms = mysql_query($query_rsRooms, $Programming) or die(mysql_error());
$row_rsRooms = mysql_fetch_assoc($rsRooms);
$totalRows_rsRooms = mysql_num_rows($rsRooms);
?>
<?php  $lastTFM_nest = "";?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Program Details</title>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
td {
	font-size: 11px;
}
.style1 {font-size: 14px}
.style2 {color: #CC0000; font-size: 12px;}
.style3 {color: #000099}
-->
</style>
<link href="../../styles/printdetails.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body>
<div class="detailspopup">
  <form>
    <input name="Print" onclick="window.print();return false" type="button" value="Print Program" />
  </form>
  <p><span class="CommitteeSectionTitle style1"><strong><?php echo $row_rsProgramDetails['ProgramTitle']; ?></strong></span> <br />
    <span class="style2"><?php echo $row_rsProgramDetails['FirstName']; ?> <?php echo $row_rsProgramDetails['LastName']; ?>, <?php echo $row_rsProgramDetails['Title']; ?></span></p>
  <table border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td valign="top" nowrap="nowrap"><div align="right"><strong>Program #:</strong></div></td>
      <td valign="top"><span class="style3"><?php echo $row_rsProgramDetails['ProgramNumber']; ?></span></td>
      <td>&nbsp;</td>
      <td valign="top"><div align="right"><strong>Status: </strong></div></td>
      <td nowrap="nowrap"><span class="style3"><?php echo $row_rsProgramDetails['Status']; ?></span></td>
    </tr>
    <tr>
      <td valign="top"><div align="right"><strong>Session:</strong></div></td>
      <td valign="top"><span class="style3"><?php echo $row_rsProgramDetails['session']; ?></span></td>
      <td>&nbsp;</td>
      <td valign="top"><div align="right"><strong>Topic:</strong></div></td>
      <td><span class="style3"><?php echo $row_rsProgramDetails['TopicArea']; ?></span></td>
    </tr>
    <tr>
      <td valign="top"><div align="right"></div></td>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="top"><div align="right"></div>
      <strong>Rooms:</strong></td>
      <td valign="top" nowrap="nowrap" class="style3"><?php do { ?>
          <?php echo $row_rsRooms['location']; ?><br /> 
          <?php echo $row_rsRooms['start_time']; ?>- <?php echo $row_rsRooms['end_time']; ?><br />
      <?php } while ($row_rsRooms = mysql_fetch_assoc($rsRooms)); ?></td>
    </tr>
  </table>
  <p><strong>Description:</strong><br />
  <?php echo $row_rsProgramDetails['ProgramDescription']; ?> </p>
  <p><strong>Outline:</strong><br />
    <?php echo $row_rsProgramDetails['OutlineOfPresentation']; ?></p>
  <p><strong>Objective 1:</strong> <?php echo $row_rsProgramDetails['LearningObj1']; ?></p>
  <p><strong>Objective 2:</strong> <?php echo $row_rsProgramDetails['LearningObj2']; ?></p>
  <p><strong>Objective 3:</strong> <?php echo $row_rsProgramDetails['LearningOjb3']; ?></p>
  <ul>
    <?php do { ?>
    
    <?php if($row_rsReviewers['vote']=='Yes'){?>
      <?php $TFM_nest = $row_rsReviewers['first_name'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?><li><?php echo $row_rsReviewers['first_name']; ?> <?php echo $row_rsReviewers['last_name']; ?>- <strong><?php echo $row_rsReviewers['vote']; ?></strong></li>
      <?php } //End of Basic-UltraDev Simulated Nested Repeat?>
      <?php }?>
      
  <?php } while ($row_rsReviewers = mysql_fetch_assoc($rsReviewers)); ?>  </ul>
  <p align="center"><input type=button value="Close Window" onClick="javascript:window.close();">
  </p>
</div>
</body>
</html>
<?php
mysql_free_result($rsProgramDetails);

mysql_free_result($rsReviewers);

mysql_free_result($rsRooms);
?>
