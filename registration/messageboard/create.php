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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO messageboard (message_id, user_id, posted_by, title, message, topic) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['message_id'], "text"),
                       GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString($_POST['posted_by'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['topic'], "text"));

  mysql_select_db($database_MessageBoard, $MessageBoard);
  $Result1 = mysql_query($insertSQL, $MessageBoard) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$currentPage = $_SERVER["PHP_SELF"];
?>
<?php

$maxRows_rsMessage = 10;
$pageNum_rsMessage = 0;
if (isset($_GET['pageNum_rsMessage'])) {
  $pageNum_rsMessage = $_GET['pageNum_rsMessage'];
}
$startRow_rsMessage = $pageNum_rsMessage * $maxRows_rsMessage;

mysql_select_db($database_MessageBoard, $MessageBoard);
$query_rsMessage = "SELECT messageboard.id, messageboard.message_id, messageboard.posted_by, DATE_FORMAT(messageboard.posted_on,'%M %d %Y %r') AS posted_on, messageboard.title, messageboard.message, messageboard.topic, messageboard.archive FROM messageboard";
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conference Message Board</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style><!-- InstanceEndEditable -->
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
<h3 align="left"><strong>Conference Message Board</strong></h3>
<div class="journal"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
        
        <tr valign="baseline">
          <td nowrap align="right"><strong>Title:</strong></td>
          <td><input name="title" type="text" class="smallform" value="" size="40">
            <input name="posted_by" type="hidden" id="posted_by" value="<?php echo $_SESSION['display_name']; ?>" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top"><strong>Message:</strong></td>
          <td><textarea name="message" cols="60" rows="10"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" class="smallform" value="Enter Message"></td>
        </tr>
      </table>
      <input type="hidden" name="message_id" value="<?php echo create_guid();?>">
      <input type="hidden" name="topic" value="cms" />
      <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['userID']; ?>" />
<input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMessage);
?>
