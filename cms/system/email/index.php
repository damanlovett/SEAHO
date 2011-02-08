<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>

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

$maxRows_rsSQL = 30;
$pageNum_rsSQL = 0;
if (isset($_GET['pageNum_rsSQL'])) {
  $pageNum_rsSQL = $_GET['pageNum_rsSQL'];
}
$startRow_rsSQL = $pageNum_rsSQL * $maxRows_rsSQL;

mysql_select_db($database_CMS, $CMS);
$query_rsSQL = "SELECT *, DATE_FORMAT(email_records.sent_date,'%m/%d/%Y %r') AS new_date FROM email_records ORDER BY email_records.id DESC";
$query_limit_rsSQL = sprintf("%s LIMIT %d, %d", $query_rsSQL, $startRow_rsSQL, $maxRows_rsSQL);
$rsSQL = mysql_query($query_limit_rsSQL, $CMS) or die(mysql_error());
$row_rsSQL = mysql_fetch_assoc($rsSQL);

if (isset($_GET['totalRows_rsSQL'])) {
  $totalRows_rsSQL = $_GET['totalRows_rsSQL'];
} else {
  $all_rsSQL = mysql_query($query_rsSQL);
  $totalRows_rsSQL = mysql_num_rows($all_rsSQL);
}
$totalPages_rsSQL = ceil($totalRows_rsSQL/$maxRows_rsSQL)-1;

$queryString_rsSQL = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsSQL") == false && 
        stristr($param, "totalRows_rsSQL") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsSQL = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsSQL = sprintf("&totalRows_rsSQL=%d%s", $totalRows_rsSQL, $queryString_rsSQL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link href="../../favicon.ico" rel="shortcut icon" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SEAHO CMS</title>
<script type="text/javascript" src="/cms/includefiles/sdmenu.js">

/***********************************************
* Slashdot Menu script- By DimX
* Submitted to Dynamic Drive DHTML code library: http://www.dynamicdrive.com
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/sdmenu.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../../styles/printAdmin.css" rel="stylesheet" type="text/css" media="print" />
<style type="text/css">
<!--
#mainText h3 {
	font-size: 13px;
	color: #000000;
	font-weight: bold;
	border-width: 1px;
	border-style: none;
	background: #FFFFFF;
}
-->
</style>
</head>
<body>
<div id="header">
  <?php require_once('../../includefiles/userInfo.php'); ?>
</div>
<div id="sidebar">
  <style type="text/css">
<!--
.copyrightNAV {
	font-size: 8.5px;
	color: #666666;
}
-->
</style>
  <?php require_once('../../includefiles/navPage.php'); ?>

  <br />
  <div class="copyright"> <img src="../../images/LCtag.jpg" alt="Lovett Creations" width="130" height="30" /> <br />
    <br />
    Copyright &copy; <?php date('Y');?><br />
    Lovett Creations<br />
    All Rights Reserved</div>
</div>
<div id="mainContent">
  <h2>System Emails</h2>
  <div id="mainText">
    <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">&nbsp;<?php echo $totalRows_rsSQL ?> Query(s)</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;
          <?php if ($pageNum_rsSQL > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsSQL=%d%s", $currentPage, 0, $queryString_rsSQL); ?>"><img src="../../../images/First.gif" border="0" /></a>
          <?php } // Show if not first page ?>
          &nbsp;
          <?php if ($pageNum_rsSQL > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsSQL=%d%s", $currentPage, max(0, $pageNum_rsSQL - 1), $queryString_rsSQL); ?>"><img src="../../../images/Previous.gif" border="0" /></a>
          <?php } // Show if not first page ?>
          &nbsp;
          <?php if ($pageNum_rsSQL < $totalPages_rsSQL) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsSQL=%d%s", $currentPage, min($totalPages_rsSQL, $pageNum_rsSQL + 1), $queryString_rsSQL); ?>"><img src="../../../images/Next.gif" border="0" /></a>
          <?php } // Show if not last page ?>
          &nbsp;
          <?php if ($pageNum_rsSQL < $totalPages_rsSQL) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsSQL=%d%s", $currentPage, $totalPages_rsSQL, $queryString_rsSQL); ?>"><img src="../../../images/Last.gif" border="0" /></a>
        <?php } // Show if not last page ?></td>
      </tr>
      <tr>
        <th nowrap="nowrap">Title</th>
        <th>&nbsp;</th>
        <th>Message</th>
        <th nowrap="nowrap">&nbsp;</th>
        <th nowrap="nowrap">Sent To</th>
        <th nowrap="nowrap">&nbsp;</th>
        <th nowrap="nowrap">Date Sent</th>
      </tr>
      <?php do { ?>
        <tr>
          <td align="left" valign="top" nowrap="nowrap" class="tablerows"><?php echo $row_rsSQL['title']; ?>&nbsp;</td>
          <td class="tablerows">&nbsp;</td>
          <td align="left" valign="top" class="tablerows"><?php echo $row_rsSQL['emailmessage']; ?>&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap" class="tablerows">&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap" class="tablerows"><?php echo $row_rsSQL['sent_to']; ?>&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap" class="tablerows">&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap" class="tablerows"><?php echo $row_rsSQL['new_date']; ?>&nbsp;</td>
        </tr>
        <?php } while ($row_rsSQL = mysql_fetch_assoc($rsSQL)); ?>
      <tr>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <div class="cleartable"></div>
  </div>
</div>
<div id="footer"></div>
</body>
</html>
<?php
mysql_free_result($rsSQL);
?>
