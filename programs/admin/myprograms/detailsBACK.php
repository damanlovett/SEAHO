<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

if (isset($_GET['review'])) {
	$read = 1;
	$_POST['reviewID'] = create_guid();
	$insertSQL = sprintf("INSERT INTO reviewers (id, reviewID, userID, `read`, programID) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['reviewID'], "text"),
                       GetSQLValueString($_SESSION['userID'], "text"),
                       GetSQLValueString($read, "int"),
                       GetSQLValueString($_GET['review'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}

// Sets the read switch to 1

  $updateSQL = sprintf("UPDATE reviewers SET `read`=1 WHERE reviewID=%s",
                       GetSQLValueString($_REQUEST['recordID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE reviewers SET vote=%s, notes=%s WHERE reviewID=%s",
                       GetSQLValueString($_POST['vote'], "text"),
                       GetSQLValueString($_POST['notes'], "text"),
                       GetSQLValueString($_POST['reviewID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}
?>
<?php

$colname_rsProgramDetails = "-1";
if (isset($_GET['programID'])) {
  $colname_rsProgramDetails = (get_magic_quotes_gpc()) ? $_GET['programID'] : addslashes($_GET['programID']);
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
$colname2_rsReviewers = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsReviewers = (get_magic_quotes_gpc()) ? $_SESSION['userID'] : addslashes($_SESSION['userID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsReviewers = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, reviewers.programID, reviewers.`read`, reviewers.vote, users.first_name, users.last_name, users.userID, reviewers.notes FROM reviewers, users WHERE reviewers.reviewID = %s AND users.userID = %s", GetSQLValueString($colname_rsReviewers, "text"),GetSQLValueString($colname2_rsReviewers, "text"));
$rsReviewers = mysql_query($query_rsReviewers, $Programming) or die(mysql_error());
$row_rsReviewers = mysql_fetch_assoc($rsReviewers);
$totalRows_rsReviewers = mysql_num_rows($rsReviewers);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
.style2 {
	color: #CC0000;
	font-size: 12px;
	font-weight: normal;
}
.style3 {
	color: #CC0000;
	font-weight: bold;
	font-size: 14px;
}
.style4 {color: #000099}
-->
</style>
<link href="../../styles/printdetails.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body>
<div class="detailspopup">
	<p>&nbsp;<?php if(isset($_POST['Submit'])) { ?>
	  <span class="style3">
 Your vote has been recorded as <?php echo $_POST['vote'];?></span><?php }?></p>
<form>
      <input name="Print" onclick="window.print();return false" type="button" value="Print Program" />
      <span class="style3">
      <input type=button value="Close Window" onclick="javascript:window.close();" />
      </span>
</form>
    <p><span class="CommitteeSectionTitle style1"><strong><?php echo $row_rsProgramDetails['ProgramTitle']; ?></strong></span> <br />
    <span class="style2"><?php echo $row_rsProgramDetails['FirstName']; ?> <?php echo $row_rsProgramDetails['LastName']; ?>, <?php echo $row_rsProgramDetails['Title']; ?></span></p>
  <table border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td nowrap="nowrap"><div align="right"><strong>Program #:</strong></div></td>
      <td><span class="style4"><?php echo $row_rsProgramDetails['ProgramNumber']; ?></span></td>
      <td>&nbsp;</td>
      <td><div align="right"></div></td>
      <td nowrap="nowrap"><span class="style4"></span></td>
    </tr>
    <tr>
      <td><div align="right"><strong>Session:</strong></div></td>
      <td><span class="style4"><?php echo $row_rsProgramDetails['session']; ?></span></td>
      <td>&nbsp;</td>
      <td><div align="right"><strong>Status: </strong></div></td>
      <td><span class="style4"><?php echo $row_rsProgramDetails['Status']; ?></span></td>
    </tr>
    <tr>
      <td><div align="right"><strong>Topic Area: </strong></div></td>
      <td colspan="4"><span class="style4"><?php echo $row_rsProgramDetails['TopicArea']; ?>        </span>        <div align="right" class="style4"></div></td>
    </tr>
  </table>
    <p><strong>Description</strong><br />
  <?php echo $row_rsProgramDetails['ProgramDescription']; ?> </p>
  <p><strong>Outline</strong><br />
    <?php echo $row_rsProgramDetails['OutlineOfPresentation']; ?></p>
  <p><strong>Objective 1:</strong> <?php echo $row_rsProgramDetails['LearningObj1']; ?></p>
  <p><strong>Objective 2:</strong> <?php echo $row_rsProgramDetails['LearningObj2']; ?></p>
  <p><strong>Objective 3:</strong> <?php echo $row_rsProgramDetails['LearningOjb3']; ?></p>
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="left" cellpadding="3" cellspacing="0" bordercolor="0">
    <tr valign="baseline">
      <td nowrap align="right">Vote:</td>
      <td><select name="vote">
	  	<option> -------- </option>
        <option value="Yes" <?php if (!(strcmp("Yes", $row_rsReviewers['vote']))) {echo "SELECTED";} ?>>Yes</option>
        <option value="No" <?php if (!(strcmp("No", $row_rsReviewers['vote']))) {echo "SELECTED";} ?>>No</option>
        <option value="Maybe" <?php if (!(strcmp("Maybe", $row_rsReviewers['vote']))) {echo "SELECTED";} ?>>Maybe</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Notes:</td>
      <td><textarea name="notes" cols="50" rows="10"><?php echo $row_rsReviewers['notes']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input name="Submit" type="submit" id="Submit" value="Vote On Program"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="reviewID" value="<?php echo $row_rsReviewers['reviewID']; ?>">
</form>
<p class="cleartable">&nbsp;</p>
<p align="center"><input type=button value="Close Window" onClick="javascript:window.close();">&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($rsProgramDetails);

mysql_free_result($rsReviewers);
?>
