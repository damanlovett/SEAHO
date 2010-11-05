<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end

// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../../Connections/SEAHOdocuments.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
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
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "vote")) {
  $insertSQL = sprintf("INSERT INTO vote (vote_id, user_id, ballot_id, voter, vote) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['vote_id'], "text"),
                       GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString($_POST['ballot_id'], "text"),
                       GetSQLValueString($_POST['voter'], "text"),
                       GetSQLValueString($_POST['vote'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());

  $insertGoTo = "details.php?recordID=" . $row_rsBallot['ballot_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addcomment")) {
  $insertSQL = sprintf("INSERT INTO vote_comment (comment_id, ballot_id, user_id, `user`, `comment`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['comment_id'], "text"),
                       GetSQLValueString($_POST['ballot_id'], "text"),
                       GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['comment'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}

$maxRows_rsBallot = 10;
$pageNum_rsBallot = 0;
if (isset($_GET['pageNum_rsBallot'])) {
  $pageNum_rsBallot = $_GET['pageNum_rsBallot'];
}
$startRow_rsBallot = $pageNum_rsBallot * $maxRows_rsBallot;

$colname_rsBallot = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsBallot = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT id, `description`, attachment, ballot_id, title, DATE_FORMAT(due_date,'%%a, %%M %%d, %%Y') AS due_date, modified_on, created_on, `delete`, vote_ballot.`close` FROM vote_ballot WHERE ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$query_limit_rsBallot = sprintf("%s LIMIT %d, %d", $query_rsBallot, $startRow_rsBallot, $maxRows_rsBallot);
$rsBallot = mysql_query($query_limit_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);

if (isset($_GET['totalRows_rsBallot'])) {
  $totalRows_rsBallot = $_GET['totalRows_rsBallot'];
} else {
  $all_rsBallot = mysql_query($query_rsBallot);
  $totalRows_rsBallot = mysql_num_rows($all_rsBallot);
}
$totalPages_rsBallot = ceil($totalRows_rsBallot/$maxRows_rsBallot)-1;

$colname_rsAttachments = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsAttachments = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
$query_rsAttachments = sprintf("SELECT id, doc_id, categories, cat_id, title, `file` FROM attachments WHERE cat_id = %s", GetSQLValueString($colname_rsAttachments, "text"));
$rsAttachments = mysql_query($query_rsAttachments, $SEAHOdocuments) or die(mysql_error());
$row_rsAttachments = mysql_fetch_assoc($rsAttachments);
$totalRows_rsAttachments = mysql_num_rows($rsAttachments);

$colname_rsVoters = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsVoters = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsVoters = sprintf("SELECT id, vote_id, user_id, ballot_id, voter, vote, date_format(vote.submitted_on,'%%M %%d %%Y   %%r') AS sub_date FROM vote WHERE ballot_id = %s ORDER BY vote.submitted_on DESC", GetSQLValueString($colname_rsVoters, "text"));
$rsVoters = mysql_query($query_rsVoters, $Directory) or die(mysql_error());
$row_rsVoters = mysql_fetch_assoc($rsVoters);
$totalRows_rsVoters = mysql_num_rows($rsVoters);

$colname_rsVoteResults = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsVoteResults = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsVoteResults = sprintf("SELECT id, COUNT(vote_id) AS vote_num, user_id, ballot_id, voter, vote FROM vote WHERE ballot_id = %s GROUP BY vote ORDER BY vote_num DESC", GetSQLValueString($colname_rsVoteResults, "text"));
$rsVoteResults = mysql_query($query_rsVoteResults, $Directory) or die(mysql_error());
$row_rsVoteResults = mysql_fetch_assoc($rsVoteResults);
$totalRows_rsVoteResults = mysql_num_rows($rsVoteResults);

$maxRows_rsComments = 10;
$pageNum_rsComments = 0;
if (isset($_GET['pageNum_rsComments'])) {
  $pageNum_rsComments = $_GET['pageNum_rsComments'];
}
$startRow_rsComments = $pageNum_rsComments * $maxRows_rsComments;

$colname2_rsComments = "-1";
if (isset($_GET['recordID'])) {
  $colname2_rsComments = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsComments = sprintf("SELECT vote_comment.comment_id, vote_comment.ballot_id, vote_comment.`user`, vote_comment.`comment`, DATE_FORMAT(vote_comment.submitted_on,'%%a %%M %%d %%Y at %%r') AS submit_date FROM vote_comment WHERE vote_comment.ballot_id = %s ORDER BY vote_comment.submitted_on DESC", GetSQLValueString($colname2_rsComments, "text"));
$query_limit_rsComments = sprintf("%s LIMIT %d, %d", $query_rsComments, $startRow_rsComments, $maxRows_rsComments);
$rsComments = mysql_query($query_limit_rsComments, $Directory) or die(mysql_error());
$row_rsComments = mysql_fetch_assoc($rsComments);

if (isset($_GET['totalRows_rsComments'])) {
  $totalRows_rsComments = $_GET['totalRows_rsComments'];
} else {
  $all_rsComments = mysql_query($query_rsComments);
  $totalRows_rsComments = mysql_num_rows($all_rsComments);
}
$totalPages_rsComments = ceil($totalRows_rsComments/$maxRows_rsComments)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Voting Center</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.commenttext {
	color: #000099;
	font-weight: bold;
}
-->
</style>
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadVoting"><?php echo $row_rsBallot['title']; ?></span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td width="33%" align="left" valign="top">
		  <p><strong>BALLOT INFORMATION</strong><br />
		  </p>
		  <p><strong>Description</strong><br />
              <?php echo $row_rsBallot['description']; ?></p>
            <p><strong>Due Date&nbsp;&nbsp;</strong><br />
              <?php echo $row_rsBallot['due_date']; ?></p>
            <p><strong>Attachement(s)</strong><br />
              <?php do { ?>
                <a href="/documents/<?php echo $row_rsAttachments['file']; ?>"><?php echo $row_rsAttachments['file']; ?></a><br />
          <?php } while ($row_rsAttachments = mysql_fetch_assoc($rsAttachments)); ?></p></td>
          <td width="33%" align="left" valign="top">
		  <p><strong>VOTING INFORMATION</strong><br />
		  </p>
		  <?php do { ?>
              <?php 
		// This has to be a repeat of the recordset that counts then results
		voteGraph ($row_rsVoteResults['vote_num'],$row_rsVoteResults['vote'],$totalRows_rsVoters);
				?>
              <?php } while ($row_rsVoteResults = mysql_fetch_assoc($rsVoteResults)); ?>
              <hr width="75%"/>
		  <label>
            <?php if(($_SESSION['votes']==1) && (strtotime($currentDate) <= strtotime($row_rsBallot['due_date']))){?>
            </label>
            <form id="vote" name="vote" method="post" action="<?php echo $editFormAction; ?>">
              <label>
              Vote 
              <select name="vote" id="vote">
                <option value="Yes" selected="selected">Yes</option>
                <option value="No">No</option>
                <option value="Abstain">Abstain</option>
              </select>
              </label>
              <label>
              <input type="submit" name="Submit3" value="Submit" />
              </label>
              <input name="ballot_id" type="hidden" id="ballot_id" value="<?php echo $row_rsBallot['ballot_id']; ?>" />
              <input name="voter" type="hidden" id="voter" value="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?>" />
              <input name="vote_id" type="hidden" id="vote_id" value="<?php echo create_guid(); ?>" />
              <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['userID']; ?>" />
              <input name="MM_insert" type="hidden" id="MM_insert" value="vote" />
            </form>
            <label>            </label>
            <?php }?></p>
          <div><?php if(strtotime($currentDate) >= strtotime($row_rsBallot['due_date'])){ echo "<span class='homepageBlocks'>  ( Voting Closed ) </span>";}?></div></td>
          <td width="33%" align="left" valign="top" nowrap="nowrap">
		  <p>&nbsp;</p>
          </td>
        </tr>
      </table>
    </div>
    
      <div id="TabbedPanels1" class="TabbedPanels">
        <ul class="TabbedPanelsTabGroup">
          <li class="TabbedPanelsTab" tabindex="0">Comments</li>
          <li class="TabbedPanelsTab" tabindex="0">Add Comment</li>
          <li class="TabbedPanelsTab" tabindex="0">Voting Results</li>
        </ul>
        <div class="TabbedPanelsContentGroup">
          <div class="TabbedPanelsContent">
            <?php if ($totalRows_rsComments > 0) { // Show if recordset not empty ?>
            <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
              <tr>
                <th>Comments          </th>
            </tr>
              <?php do { ?>
                <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
                  <td><p><?php echo $row_rsComments['comment']; ?></p>                    <span class="commenttext">by <?php echo $row_rsComments['user']; ?><br />
                  posted on <?php echo $row_rsComments['submit_date']; ?></span></td>
                </tr>
                <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
                <?php } while ($row_rsComments = mysql_fetch_assoc($rsComments)); ?>
              <tr>
                <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
            </table>
              <?php } // Show if recordset not empty ?>
              <?php if ($totalRows_rsComments == 0) { // Show if recordset empty ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
                  <tr>
                    <th>Comments</th>
                  </tr>
                  <tr>
                    <td><strong>There are no comments at this time</strong></td>
                  </tr>
                  <tr>
                    <td class="tableBottom">&nbsp;</td>
                  </tr>
                </table>
                <?php } // Show if recordset empty ?>
</div>
          <div class="TabbedPanelsContent">
            <form id="addcomment" name="addcomment" method="POST" action="<?php echo $editFormAction; ?>">
              <label>
              <textarea name="comment" cols="50" rows="8" id="comment"></textarea>
              </label>
              <p>
                <input type="submit" name="Submit" value="Submit Comment" />
                <input name="comment_id" type="hidden" id="comment_id" value="<?php echo create_guid();?>" />
                <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['userID'];?>" />
                <input name="user" type="hidden" id="user" value="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" />
                <input name="ballot_id" type="hidden" id="ballot_id" value="<?php echo $row_rsBallot['ballot_id']; ?>" />
              </p>
              <input type="hidden" name="MM_insert" value="addcomment" />
            </form>
            <p></p>
          </div>
          <div class="TabbedPanelsContent"><div>
                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <th>Voter</th>
              <th>&nbsp;</th>
              <th>Vote</th>
              <th>&nbsp;</th>
              <th>Submit Date</th>
            </tr>
            <?php do { ?>
              <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
                <td><?php echo $row_rsVoters['voter']; ?></td>
                <td>&nbsp;</td>
                <td><?php echo $row_rsVoters['vote']; ?></td>
                <td nowrap="nowrap">&nbsp;</td>
                <td nowrap="nowrap"><?php echo $row_rsVoters['sub_date']; ?></td>
              </tr>
              <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
              <?php } while ($row_rsVoters = mysql_fetch_assoc($rsVoters)); ?>
</table>
          <br />
</div>
          </div>
        </div>
    </div>
      <p class="cleartable">&nbsp;</p>

      
    <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
      </script>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsVoteResults);

mysql_free_result($rsComments);

mysql_free_result($rsBallot);

mysql_free_result($rsAttachments);

mysql_free_result($rsVoters);

mysql_free_result($rsVoteResults);
?>
