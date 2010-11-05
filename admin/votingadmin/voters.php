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

if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {
  $deleteSQL = sprintf("DELETE FROM vote WHERE id=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($deleteSQL, $Directory) or die(mysql_error());
}
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?php

$colname_rsBallot = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsBallot = (get_magic_quotes_gpc()) ? $_REQUEST['recordID'] : addslashes($_REQUEST['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT vote_ballot.id, vote_ballot.`description`, vote_ballot.attachment, vote_ballot.ballot_id, vote_ballot.title, DATE_FORMAT(vote_ballot.modified_on,'%%M %%d, %%Y %%r') as mod_date, DATE_FORMAT(vote_ballot.created_on,'%%M %%d, %%Y %%r') as create_date, DATE_FORMAT(vote_ballot.due_date,'%%a, %%M %%d, %%Y') as due_date FROM vote_ballot WHERE vote_ballot.`delete`!= 1 AND vote_ballot.ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$rsBallot = mysql_query($query_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);
$totalRows_rsBallot = mysql_num_rows($rsBallot);

$colname_rsVoters = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsVoters = (get_magic_quotes_gpc()) ? $_REQUEST['recordID'] : addslashes($_REQUEST['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsVoters = sprintf("SELECT vote.id, vote.vote_id, vote.user_id, vote.ballot_id, vote.voter, vote.vote, DATE_FORMAT(vote.submitted_on,'%%a, %%M %%d, %%Y at %%r') AS submit_date FROM vote WHERE vote.ballot_id = %s ORDER BY vote.submitted_on", GetSQLValueString($colname_rsVoters, "text"));
$rsVoters = mysql_query($query_rsVoters, $Directory) or die(mysql_error());
$row_rsVoters = mysql_fetch_assoc($rsVoters);
$totalRows_rsVoters = mysql_num_rows($rsVoters);

$colname_rsVotersCount = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsVotersCount = (get_magic_quotes_gpc()) ? $_REQUEST['recordID'] : addslashes($_REQUEST['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsVotersCount = sprintf("SELECT COUNT(vote.id) AS count_num, vote.vote_id, vote.user_id, vote.ballot_id, vote.voter, vote.vote FROM vote WHERE vote.ballot_id = %s GROUP BY vote.vote ORDER BY count_num DESC", GetSQLValueString($colname_rsVotersCount, "text"));
$rsVotersCount = mysql_query($query_rsVotersCount, $Directory) or die(mysql_error());
$row_rsVotersCount = mysql_fetch_assoc($rsVotersCount);
$totalRows_rsVotersCount = mysql_num_rows($rsVotersCount);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Voting Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadVoting">Voter Manager  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
	<p class="commenttext style1"><?php echo $row_rsBallot['title']; ?> 
	<label></label>
	</p>
	<p><strong>Description</strong><br />
      <?php echo $row_rsBallot['description']; ?></p>
      <hr />
	<p><strong>Due</strong><br /> 
	  <?php echo $row_rsBallot['due_date']; ?></p>
	  <ul>
	    <?php do { ?>
          <li><strong> <?php echo $row_rsVotersCount['vote']; ?> - <?php echo $row_rsVotersCount['count_num']; ?></strong></li>
      <?php } while ($row_rsVotersCount = mysql_fetch_assoc($rsVotersCount)); ?></ul>
    </div>
    
    <?php if ($totalRows_rsVoters > 0) { // Show if recordset not empty ?>
      <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
        <tr>
          <td class="tableTop"><div align="center"><strong>Voting Results </strong></div></td>
            </tr>
        <tr >
          <td nowrap="nowrap"><ol>
            <?php do { ?>
              <li><?php echo $row_rsVoters['voter']; ?><strong>&nbsp;&nbsp;<?php echo $row_rsVoters['vote']; ?></strong>&nbsp;&nbsp;<?php echo $row_rsVoters['submit_date']; ?>&nbsp;<a href="edit.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"></a><a href="voters.php?delete=<?php echo $row_rsVoters['id']; ?>&amp;recordID=<?php echo $row_rsVoters['ballot_id']; ?>">&nbsp;&nbsp;<img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a><a href="upload.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"></a></li>
              <br />
                <?php } while ($row_rsVoters = mysql_fetch_assoc($rsVoters)); ?>
          </ol></td>
        </tr>
        <tr>
          <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
      </table>
      <?php } // Show if recordset not empty ?>
    <br />
    <?php if ($totalRows_rsVoters == 0) { // Show if recordset empty ?>
  <table width="300" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop"><div align="center"><strong>Voting Results </strong></div></td>
            </tr>
    <tr >
      <td nowrap="nowrap"><div align="center">No votes have been submitted.</div></td>
    </tr>
        <tr>
          <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
  </table>
  <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsBallot);

mysql_free_result($rsVoters);

mysql_free_result($rsVotersCount);
?>
