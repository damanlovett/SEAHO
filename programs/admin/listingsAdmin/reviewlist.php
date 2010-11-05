<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?>
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

if (isset($_GET['updateID'])) {
  $updateSQL = sprintf("UPDATE callforprograms SET Status=%s WHERE id=%s",
                       GetSQLValueString($_GET['status'], "text"),
                       GetSQLValueString($_GET['updateID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_Programming, $Programming);
$query_rsTopics = "SELECT id, TopicArea FROM callforprograms GROUP by TopicArea ORDER by TopicArea";
$rsTopics = mysql_query($query_rsTopics, $Programming) or die(mysql_error());
$row_rsTopics = mysql_fetch_assoc($rsTopics);
$totalRows_rsTopics = mysql_num_rows($rsTopics);

mysql_select_db($database_Programming, $Programming);
$query_rsTotalPrograms = "SELECT Count(id) AS total, Status FROM callforprograms GROUP by Status";
$rsTotalPrograms = mysql_query($query_rsTotalPrograms, $Programming) or die(mysql_error());
$row_rsTotalPrograms = mysql_fetch_assoc($rsTotalPrograms);
$totalRows_rsTotalPrograms = mysql_num_rows($rsTotalPrograms);

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = "SELECT reviewers.id, reviewers.reviewID, COUNT(reviewers.reviewID) AS num_yes, reviewers.userID, reviewers.programID, COUNT(reviewers.vote) AS nums_yes, callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.FirstName, callforprograms.LastName, callforprograms.Status, callforprograms.TopicArea FROM reviewers, callforprograms WHERE reviewers.programID = callforprograms.id AND callforprograms.deleted = '0' AND reviewers.vote = 'Yes' GROUP BY reviewers.programID ORDER BY callforprograms.Status";
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);

$maxRows_rsPrograms = 30;
$pageNum_rsPrograms = 0;
if (isset($_GET['pageNum_rsPrograms'])) {
  $pageNum_rsPrograms = $_GET['pageNum_rsPrograms'];
}
$startRow_rsPrograms = $pageNum_rsPrograms * $maxRows_rsPrograms;

$colname_rsPrograms = "-1";
if (isset($_POST['session'])) {
  $colname_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['session'] : addslashes($_POST['session']);
}
$colname2_rsPrograms = "-1";
if (isset($_POST['ProgramTitle'])) {
  $colname2_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['ProgramTitle'] : addslashes($_POST['ProgramTitle']);
}
$colname3_rsPrograms = "-1";
if (isset($_POST['FirstName'])) {
  $colname3_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['FirstName'] : addslashes($_POST['FirstName']);
}
$colname4_rsPrograms = "-1";
if (isset($_POST['LastName'])) {
  $colname4_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['LastName'] : addslashes($_POST['LastName']);
}
$colname5_rsPrograms = "-1";
if (isset($_POST['TopicArea'])) {
  $colname5_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['TopicArea'] : addslashes($_POST['TopicArea']);
}
//$_POST['sortby'] = "ORDER BY ProgramTitle ASC";
if (isset($_POST['sortby'])) {
  $_POST['sortby'] = "ORDER BY ".$_POST['sortby'];
}


// Default recordset, start with regular recordset, if form submitted create complex sql
//if(isset($_POST['Submit'])) {
//mysql_select_db($database_Programming, $Programming);
//$query_rsPrograms = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.location, callforprograms.FirstName, callforprograms.LastName, callforprograms.EmailAddress, callforprograms.TopicArea, callforprograms.Status FROM callforprograms WHERE `session` = %s OR ProgramTitle LIKE CONCAT('%%', %s, '%%') OR FirstName LIKE CONCAT('%%', %s, '%%') OR LastName LIKE CONCAT('%%', %s, '%%') OR TopicArea = %s ".$_POST['sortby']."", 
//	GetSQLValueString($colname_rsPrograms, "text"),
//	GetSQLValueString($colname2_rsPrograms, "text"),
//	GetSQLValueString($colname3_rsPrograms, "text"),
//	GetSQLValueString($colname4_rsPrograms, "text"),
//	GetSQLValueString($colname5_rsPrograms, "text"));
//$query_limit_rsPrograms = sprintf("%s LIMIT %d, %d", $query_rsPrograms, $startRow_rsPrograms, $maxRows_rsPrograms);
//$rsPrograms = mysql_query($query_limit_rsPrograms, $Programming) or die(mysql_error());
//$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
//
//} else {
//
//mysql_select_db($database_Programming, $Programming);
//$query_rsPrograms = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.location, callforprograms.FirstName, callforprograms.LastName, callforprograms.EmailAddress, callforprograms.TopicArea, callforprograms.Status, COUNT(reviewers.programID) AS num_reviewers, reviewers.programID, reviewers.reviewID FROM callforprograms LEFT JOIN reviewers ON callforprograms.id = reviewers.programID GROUP by callforprograms.id");
//$query_limit_rsPrograms = sprintf("%s LIMIT %d, %d", $query_rsPrograms, $startRow_rsPrograms, $maxRows_rsPrograms);
//$rsPrograms = mysql_query($query_limit_rsPrograms, $Programming) or die(mysql_error());
//$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
//}

if (isset($_GET['totalRows_rsPrograms'])) {
  $totalRows_rsPrograms = $_GET['totalRows_rsPrograms'];
} else {
  $all_rsPrograms = mysql_query($query_rsPrograms);
  $totalRows_rsPrograms = mysql_num_rows($all_rsPrograms);
}
$totalPages_rsPrograms = ceil($totalRows_rsPrograms/$maxRows_rsPrograms)-1;

$queryString_rsPrograms = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsPrograms") == false && 
        stristr($param, "totalRows_rsPrograms") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsPrograms = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsPrograms = sprintf("&totalRows_rsPrograms=%d%s", $totalRows_rsPrograms, $queryString_rsPrograms);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Program Listings</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
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
</script>
<!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/PHprograms.jpg" alt="programs" width="65" height="51" />Program Listings <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --> <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
	<br />
	  <ul>
	    <?php do { ?>
	      <li><?php echo $row_rsTotalPrograms['Status']; ?>:  <strong><?php echo $row_rsTotalPrograms['total']; ?></strong></li>
              <?php } while ($row_rsTotalPrograms = mysql_fetch_assoc($rsTotalPrograms)); ?></ul>
	  <hr/>
</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="6" class="tableTop"><input name="Submit2" type="button" onclick="MM_goToURL('parent','<?php echo $_SERVER['PHP_SELF'];?>');return document.MM_returnValue" value="Refresh List" />
            <MM_HIDDENREGION></MM_HIDDENREGION>
          <MM_HIDDENREGION></MM_HIDDENREGION></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><label> </label></td>
        <td colspan="2" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th nowrap="nowrap">&nbsp;</th>
        <th nowrap="nowrap">Presenter</th>
        <th><?php /*?>Yes Votes<?php */?></th>
        <th>&nbsp;</th>
        <th>Topic</th>
        <th>&nbsp;</th>
        <th><div align="center">Reviewers</div></th>
        <th colspan="2">Status</th>
      </tr>
      <?php $number==0;?>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor" >
<?php $number = $number + 1;?>
          <td nowrap="nowrap"><div align="center"><?php echo $row_rsPrograms['ProgramNumber']; ?></div></td>
          <td><a href="#" onclick="MM_openBrWindow('../listings/details.php?recordID=<?php echo $row_rsPrograms['id']; ?>','ProgramsDetails','location=yes,scrollbars=yes,width=500')"><?php echo substr($row_rsPrograms['ProgramTitle'],0,35)."..."; ?></a></td>
          <td><div align="center"></div></td>
          <td><?php echo $row_rsPrograms['FirstName']; ?> <?php echo $row_rsPrograms['LastName']; ?> </td>
          <td><?php //echo $row_rsPrograms['num_yes']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo substr($row_rsPrograms['TopicArea'],0,20)."..."; ?></td>
          <td>&nbsp;</td>
          <td><a href="#" title="Update User"><img src="../../images/imgSmallUser.gif" alt="reviewers" border="0" onclick="MM_openBrWindow('reviewers.php?recordID=<?php echo $row_rsPrograms['id']; ?>','Reviewers','scrollbars=yes,width=400')" /></a></td>
          <td nowrap="nowrap"><?php echo $row_rsPrograms['Status']; ?> </td>
          <td><strong><a href="#" onclick="MM_openBrWindow('statusupdate.php?status=Accepted&amp;updateID=<?php echo $row_rsPrograms['id']; ?>','statusupdate','width=350,height=150')"><span title="Accepted">&radic;</span></a></strong>&nbsp;<a href="#" onclick="MM_openBrWindow('statusupdate.php?status=Denied&amp;updateID=<?php echo $row_rsPrograms['id']; ?>','statusupdate','width=350,height=150')"><span title="Denied">X</span></a>&nbsp;<a href="#" onclick="MM_openBrWindow('statusupdate.php?status=Cancel&amp;updateID=<?php echo $row_rsPrograms['id']; ?>','statusupdate','width=350,height=150')"><span title="Cancel">&Theta;</span></a>&nbsp;<a href="#" onclick="MM_openBrWindow('statusupdate.php?status=Alternate&amp;updateID=<?php echo $row_rsPrograms['id']; ?>','statusupdate','width=350,height=150')"><span title="Alternate">A</span></a></td>
        </tr>
        <?php } while ($row_rsPrograms = mysql_fetch_assoc($rsPrograms)); ?>
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
        <td colspan="11" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    
        <p class="homepageTitles">&nbsp;</p>
	<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsTopics);

mysql_free_result($rsTotalPrograms);

mysql_free_result($rsPrograms);
?>
