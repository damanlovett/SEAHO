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

if(isset($_GET['delete'])) {

DeleteRecordNEW("messageboard","message_id");

}

?>
<?php

$maxRows_rsMessage = 50;
$pageNum_rsMessage = 0;
if (isset($_GET['pageNum_rsMessage'])) {
  $pageNum_rsMessage = $_GET['pageNum_rsMessage'];
}
$startRow_rsMessage = $pageNum_rsMessage * $maxRows_rsMessage;

mysql_select_db($database_MessageBoard, $MessageBoard);
$query_rsMessage = "SELECT messageboard.id, messageboard.message_id, messageboard.posted_by, DATE_FORMAT(messageboard.posted_on,'%M %d %Y - %r') AS posted_on, messageboard.title, messageboard.message, messageboard.topic, messageboard.archive, messageboard.user_id FROM messageboard WHERE messageboard.approved = 1 AND messageboard.topic ='cms' AND messageboard.deleted=0 ORDER BY messageboard.posted_on DESC";
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

$colname_rsMessagesMy = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsMessagesMy = $_SESSION['userID'];
}
mysql_select_db($database_MessageBoard, $MessageBoard);
$query_rsMessagesMy = sprintf("SELECT messageboard.id, messageboard.message_id, messageboard.posted_by, DATE_FORMAT(messageboard.posted_on,'%%M %%d %%Y - %%r') AS posted_on, messageboard.title, messageboard.message, messageboard.topic, messageboard.archive, messageboard.user_id FROM messageboard WHERE messageboard.approved = 1 AND messageboard.topic ='cms' AND messageboard.deleted=0 AND messageboard.user_id =%s ORDER BY messageboard.posted_on DESC", GetSQLValueString($colname_rsMessagesMy, "text"));
$rsMessagesMy = mysql_query($query_rsMessagesMy, $MessageBoard) or die(mysql_error());
$row_rsMessagesMy = mysql_fetch_assoc($rsMessagesMy);
$totalRows_rsMessagesMy = mysql_num_rows($rsMessagesMy);

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
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
<p>This area is designed to help you communicate with other conference members. Please use this area to find roommates or rides to the conference. There are currently <?php echo $totalRows_rsMessage ?> messages.<br /> 
  [ <a href="create.php">Message Form</a> ]</p>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">All Messages</li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $_SESSION['display_name']."'s Messages";?></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table border="0">
        <tr>
          <td><?php if ($pageNum_rsMessage > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, 0, $queryString_rsMessage); ?>">First page</a>
              <?php } // Show if not first page ?>
          </td>
          <td><?php if ($pageNum_rsMessage > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, max(0, $pageNum_rsMessage - 1), $queryString_rsMessage); ?>">Previous Page</a>
              <?php } // Show if not first page ?>
          </td>
          <td><?php if ($pageNum_rsMessage < $totalPages_rsMessage) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, min($totalPages_rsMessage, $pageNum_rsMessage + 1), $queryString_rsMessage); ?>">Next Page</a>
              <?php } // Show if not last page ?>
          </td>
          <td><?php if ($pageNum_rsMessage < $totalPages_rsMessage) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, $totalPages_rsMessage, $queryString_rsMessage); ?>">Last Page</a>
              <?php } // Show if not last page ?>
          </td>
        </tr>
      </table>
      </p>
      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableborder">
        <tr>
          <td class="tableTop"><strong>Title</strong></td>
          <td class="tableTop"><strong>Submitted By</strong></td>
          <td class="tableTop"><strong>Submitted On</strong></td>
          <td class="tableTop">&nbsp;</td>
        </tr>
        <?php do { ?>
        <tr>
          <td class="tablerows"><a href="details.php?messageID=<?php echo $row_rsMessage['message_id']; ?>"><img src="../images/imgAdminView.gif" alt="View" width="14" height="14" />&nbsp;<?php echo $row_rsMessage['title']; ?></a></td>
          <td class="tablerows"><?php echo $row_rsMessage['posted_by']; ?></td>
          <td class="tablerows"><?php echo $row_rsMessage['posted_on']; ?></td>
          <td class="tablerows"><?php if($row_rsMessage['user_id']==$_SESSION['userID']){ // Let's User Delete Message?>
              <a href="index.php?delete=<?php echo $row_rsMessage['message_id']; ?>"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></a>
              <?php }?>
            &nbsp;</td>
        </tr>
        <?php } while ($row_rsMessage = mysql_fetch_assoc($rsMessage)); ?>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableborder">
        <tr>
          <td class="tableTop"><strong>Title</strong></td>
          <td class="tableTop"><strong>Submitted By</strong></td>
          <td class="tableTop"><strong>Submitted On</strong></td>
          <td class="tableTop">&nbsp;</td>
        </tr>
        <?php do { ?>
          <tr>
            <td class="tablerows"><a href="details.php?messageID=<?php echo $row_rsMessagesMy['message_id']; ?>"><img src="../images/imgAdminView.gif" alt="View" width="14" height="14" />&nbsp;<?php echo $row_rsMessagesMy['title']; ?></a></td>
            <td class="tablerows"><?php echo $row_rsMessagesMy['posted_by']; ?></td>
            <td class="tablerows"><?php echo $row_rsMessagesMy['posted_on']; ?></td>
            <td class="tablerows"><a href="index.php?delete=<?php echo $row_rsMessagesMy['message_id']; ?>"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></a>&nbsp;</td>
          </tr>
          <?php } while ($row_rsMessagesMy = mysql_fetch_assoc($rsMessagesMy)); ?>
</table>
    </div>
  </div>
</div>
<p>&nbsp;</p>
<p><br />
    </p>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMessage);

mysql_free_result($rsMessagesMy);
?>
