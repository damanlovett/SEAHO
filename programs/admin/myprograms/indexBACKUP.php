<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?><?php
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

	$_POST['reviewID'] = create_guid();


if (isset($_GET['review'])) {
	$insertSQL = sprintf("INSERT INTO reviewers (id, reviewID, userID, programID) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['reviewID'], "text"),
                       GetSQLValueString($_SESSION['userID'], "text"),
                       GetSQLValueString($_GET['review'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}


$colname_rsReviews = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsReviews = (get_magic_quotes_gpc()) ? $_SESSION['userID'] : addslashes($_SESSION['userID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsReviews = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, reviewers.programID, reviewers.`read`, reviewers.vote, callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.FirstName, callforprograms.LastName FROM reviewers, callforprograms WHERE reviewers.userID = %s AND reviewers.programID = callforprograms.id ORDER BY callforprograms.ProgramTitle", GetSQLValueString($colname_rsReviews, "text"));
$rsReviews = mysql_query($query_rsReviews, $Programming) or die(mysql_error());
$row_rsReviews = mysql_fetch_assoc($rsReviews);
$totalRows_rsReviews = mysql_num_rows($rsReviews);

$colname_rsProgramsTotals = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsProgramsTotals = (get_magic_quotes_gpc()) ? $_SESSION['userID'] : addslashes($_SESSION['userID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramsTotals = sprintf("SELECT reviewers.id, reviewers.reviewID, reviewers.userID, COUNT(reviewers.`read`) AS t_read FROM reviewers WHERE reviewers.userID = %s GROUP by reviewers.userID", GetSQLValueString($colname_rsProgramsTotals, "text"));
$rsProgramsTotals = mysql_query($query_rsProgramsTotals, $Programming) or die(mysql_error());
$row_rsProgramsTotals = mysql_fetch_assoc($rsProgramsTotals);
$totalRows_rsProgramsTotals = mysql_num_rows($rsProgramsTotals);

$colname_rsReviewerList = "-1";
if (isset($_SESSION['group'])) {
  $colname_rsReviewerList = (get_magic_quotes_gpc()) ? $_SESSION['group'] : addslashes($_SESSION['group']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsReviewerList = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.FirstName, callforprograms.LastName, callforprograms.TopicArea FROM callforprograms WHERE callforprograms.TopicArea = %s ORDER BY callforprograms.ProgramTitle", GetSQLValueString($colname_rsReviewerList, "text"));
$rsReviewerList = mysql_query($query_rsReviewerList, $Programming) or die(mysql_error());
$row_rsReviewerList = mysql_fetch_assoc($rsReviewerList);
$totalRows_rsReviewerList = mysql_num_rows($rsReviewerList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>My Programs</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script><!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/PHuserReviews.jpg" alt="User Reviewer" width="65" height="51" /><?php echo $_SESSION['first_name'];?>'s Programs<!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --> <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
	<br />
	  <ul>
	    <li>Programs to Review: <strong><?php echo $totalRows_rsReviews ?> </strong></li>
	    <li><img src="../../images/book_open.gif" alt="read" width="16" height="16" />Read: <strong><?php echo $row_rsProgramsTotals['t_read']; ?></strong></li>
	    <li><img src="../../images/book.gif" alt="unread" width="16" height="16" />Unread: <strong><?php echo ($totalRows_rsReviews - $row_rsProgramsTotals['t_read']);?></strong></li>
	  </ul>
    <li></li>
</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" --> 
	<?php if ($totalRows_rsReviewerList == 0) { // Show if recordset empty ?>
	  <p class="homepageBlocks">The administrator has not added you programs to the system</p>
	  <?php } // Show if recordset empty ?>
	<?php if ($totalRows_rsReviewerList > 0) { // Show if recordset not empty ?>
	  <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
	    <tr>
	      <td colspan="6" class="tableTop"><strong><?php echo $row_rsReviewerList['TopicArea']; ?></strong></td>
        </tr>
	    <tr>
	      <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Program </th>
          <th>&nbsp;</th>
          <th nowrap="nowrap">Presenter</th>
          <th>&nbsp;</th>
        </tr>
	    <?php do { ?>
	      <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
            <td nowrap="nowrap"><a href="indexBACKUP.php?review=<?php echo $row_rsReviewerList['id']; ?>">Add to Review </a>
              <div align="center"></div></td>
	        <td nowrap="nowrap">&nbsp;</td>
	        <td nowrap="nowrap"><?php echo substr($row_rsReviewerList['ProgramTitle'],0,35); ?></td>
	        <td nowrap="nowrap">&nbsp;</td>
	        <td><?php echo $row_rsReviewerList['FirstName']; ?> <?php echo $row_rsReviewerList['LastName']; ?></td>
	        <td>&nbsp;</td>
          </tr>
	      <?php } while ($row_rsReviewerList = mysql_fetch_assoc($rsReviewerList)); ?>
	    <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
	    <tr>
	      <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
        </tr>
      </table>
    <?php } // Show if recordset not empty ?>
	<?php if ($totalRows_rsReviews == 0) { // Show if recordset empty ?>
	  <p class="homepageBlocks">You need to add a program to your review list </p>
	  <?php } // Show if recordset empty ?>
	<?php if ($totalRows_rsReviews > 0) { // Show if recordset not empty ?>
	  <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
	    <tr>
	      <td colspan="8" class="tableTop"><input type="button" value="Refresh List" onclick="MM_goToURL('parent','indexBACKUP.php');return document.MM_returnValue">&nbsp;&nbsp;<?php echo "<strong>".$_SESSION['first_name']."'s Review List</strong>";?></td>
        </tr>
	    <tr>
	      <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Program  </th>
          <th>&nbsp;</th>
          <th nowrap="nowrap">Presenter</th>
          <th>&nbsp;</th>
          <th>Vote</th>
          <th>&nbsp;</th>
        </tr>
	    <?php do { ?>
	      <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
	        <td nowrap="nowrap"><?php ImageOnOffSwitch($row_rsReviews['read'],"book.gif","book_open.gif")?>
              <div align="center"></div></td>
	        <td nowrap="nowrap">&nbsp;</td>
	        <td nowrap="nowrap"><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsReviews['reviewID']; ?>&amp;programID=<?php echo $row_rsReviews['programID']; ?>','myprograms','scrollbars=yes,width=450')"><?php echo substr($row_rsReviews['ProgramTitle'],0,40)."..."; ?></a></td>
	        <td nowrap="nowrap">&nbsp;</td>
	        <td><?php echo $row_rsReviews['FirstName']; ?> <?php echo $row_rsReviews['LastName']; ?> </td>
	        <td>&nbsp;</td>
	        <td><?php echo $row_rsReviews['vote']; ?></td>
	        <td>&nbsp;</td>
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
	      <?php } while ($row_rsReviews = mysql_fetch_assoc($rsReviews)); ?>
	    <tr>
	      <td colspan="8" nowrap="nowrap" class="tableBottom">&nbsp;</td>
        </tr>
      </table>
	  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReviews);

mysql_free_result($rsReviews);

mysql_free_result($rsProgramsTotals);

mysql_free_result($rsReviewerList);
?>
