<?php require_once('../../Connections/MessageBoard.php'); ?>
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
<?php require_once('../includefiles/initDelegates.php'); ?>
<?php require_once('../../Connections/MessageBoard.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$currentPage = $_SERVER["PHP_SELF"];
?>
<?php

$maxRows_rsMessage = 50;
$pageNum_rsMessage = 0;
if (isset($_GET['pageNum_rsMessage'])) {
  $pageNum_rsMessage = $_GET['pageNum_rsMessage'];
}
$startRow_rsMessage = $pageNum_rsMessage * $maxRows_rsMessage;

$colname_rsMessage = "-1";
if (isset($_GET['messageID'])) {
  $colname_rsMessage = $_GET['messageID'];
}
mysql_select_db($database_MessageBoard, $MessageBoard);
$query_rsMessage = sprintf("SELECT messageboard.id, messageboard.message_id, messageboard.posted_by, DATE_FORMAT(messageboard.posted_on,'%%M %%d %%Y - %%r') AS posted_on, messageboard.title, messageboard.message, messageboard.topic, messageboard.archive FROM messageboard WHERE messageboard.message_id=%s ORDER BY messageboard.posted_on DESC", GetSQLValueString($colname_rsMessage, "text"));
$query_limit_rsMessage = sprintf("%s LIMIT %d, %d", $query_rsMessage, $startRow_rsMessage, $maxRows_rsMessage);
$rsMessage = mysql_query($query_limit_rsMessage, $MessageBoard) or die(mysql_error());
$row_rsMessage = mysql_fetch_assoc($rsMessage);

if (isset($_GET['totalRows_rsMessage'])) {
  $totalRows_rsMessage = $_GET['totalRows_rsMessage'];
} else {
  $all_rsMessage = mysql_query($query_rsMessage);
  $totalRows_rsMessage = mysql_num_rows($all_rsMessage);
}
$totalPages_rsMessage = ceil($totalRows_rsMessage/$maxRows_rsMessage)-1;

$queryString_rsMessage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMessage") == false && 
        stristr($param, "totalRows_rsMessage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMessage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMessage = sprintf("&totalRows_rsMessage=%d%s", $totalRows_rsMessage, $queryString_rsMessage);

$queryString_rsMessage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMessage") == false && 
        stristr($param, "totalRows_rsMessage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMessage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMessage = sprintf("&totalRows_rsMessage=%d%s", $totalRows_rsMessage, $queryString_rsMessage);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conference Message Board</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {color: #000099}
-->
</style>
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<div class="adanavigation">Skip to <a href="#content">Content</a> or <a href="#pageNav">Page Navigation</a> or <a href="#siteNav">Site Navigation</a></div>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <div align="center"><img src="../../images/banner/bannerassociateCMS.jpg" alt="" width="764" height="95" /></div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><a name="pageNav" id="pageNav"></a><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../includefiles/leftNavDelegates.php'); ?>

      <!-- InstanceEndEditable --><img src="../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><a name="content" id="content"></a><!-- InstanceBeginEditable name="mainContent" -->
<h3 align="left"><strong> Conference Message Board</strong></h3>
<p><strong>Title:</strong> <strong><?php echo $row_rsMessage['title']; ?></strong><br />
  <br />
      Posted By:&nbsp;<?php echo $row_rsMessage['posted_by']; ?><br />
  Posted On:&nbsp;<?php echo $row_rsMessage['posted_on']; ?></p>
<p>Message:<br />
  <?php echo $row_rsMessage['message']; ?></p>
<p><a href="index.php">Back to Messages</a></p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMessage);

mysql_free_result($rsMessage);
?>
