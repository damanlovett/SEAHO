<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#F5F5F5";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?>
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
<?php require_once('../../includefiles/init.php'); ?>
<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsEmailList = 20;
$pageNum_rsEmailList = 0;
if (isset($_GET['pageNum_rsEmailList'])) {
  $pageNum_rsEmailList = $_GET['pageNum_rsEmailList'];
}
$startRow_rsEmailList = $pageNum_rsEmailList * $maxRows_rsEmailList;

mysql_select_db($database_Programming, $Programming);
$query_rsEmailList = "SELECT email_records.id, email_records.title, email_records.emailmessage, email_records.sent_to, email_records.sent_by, DATE_FORMAT(email_records.sent_date,'%M %d %Y - %r') AS sent_date, email_records.emailID FROM email_records ORDER BY email_records.sent_date DESC";
$query_limit_rsEmailList = sprintf("%s LIMIT %d, %d", $query_rsEmailList, $startRow_rsEmailList, $maxRows_rsEmailList);
$rsEmailList = mysql_query($query_limit_rsEmailList, $Programming) or die(mysql_error());
$row_rsEmailList = mysql_fetch_assoc($rsEmailList);

if (isset($_GET['totalRows_rsEmailList'])) {
  $totalRows_rsEmailList = $_GET['totalRows_rsEmailList'];
} else {
  $all_rsEmailList = mysql_query($query_rsEmailList);
  $totalRows_rsEmailList = mysql_num_rows($all_rsEmailList);
}
$totalPages_rsEmailList = ceil($totalRows_rsEmailList/$maxRows_rsEmailList)-1;

$queryString_rsEmailList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsEmailList") == false && 
        stristr($param, "totalRows_rsEmailList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsEmailList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsEmailList = sprintf("&totalRows_rsEmailList=%d%s", $totalRows_rsEmailList, $queryString_rsEmailList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>System Emails</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/LCCMPHemails.jpg" alt="email" width="65" height="51" />System Emails <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --> <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation"><br />
  <ul>
	  <li>&raquo;&nbsp;<a href="committee.php">Send Committee email</a></li>
	  <li>&raquo;&nbsp;<a href="presenters.php">Send Presenter email</a></li>
	  <li>&raquo;&nbsp;<a href="anyone.php">Send General emails</a></li>
	</ul>

</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
    <?php if ($totalRows_rsEmailList > 0) { // Show if recordset not empty ?>
      <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
        <tr>
          <td colspan="7" class="tableTop"><?php echo ($startRow_rsEmailList + 1) ?> to <?php echo min($startRow_rsEmailList + $maxRows_rsEmailList, $totalRows_rsEmailList) ?> of <?php echo $totalRows_rsEmailList ?></td>
          <td class="tableTop">&nbsp;
              <?php if ($pageNum_rsEmailList > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, 0, $queryString_rsEmailList); ?>">First</a>
                <?php } // Show if not first page ?>
            &nbsp;
            <?php if ($pageNum_rsEmailList > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, max(0, $pageNum_rsEmailList - 1), $queryString_rsEmailList); ?>">Previous</a>
              <?php } // Show if not first page ?>
            &nbsp;
            <?php if ($pageNum_rsEmailList < $totalPages_rsEmailList) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, min($totalPages_rsEmailList, $pageNum_rsEmailList + 1), $queryString_rsEmailList); ?>">Next</a>
              <?php } // Show if not last page ?>
            &nbsp;
            <?php if ($pageNum_rsEmailList < $totalPages_rsEmailList) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, $totalPages_rsEmailList, $queryString_rsEmailList); ?>">Last</a>
              <?php } // Show if not last page ?></td>
        </tr>
        <tr>
          <th>Title</th>
          <th nowrap="nowrap">&nbsp;</th>
          <th nowrap="nowrap"> Sent to/group </th>
          <th>&nbsp;</th>
          <th>From</th>
          <th>&nbsp;</th>
          <th colspan="2">Date</th>
        </tr>
        <?php do { ?>
          <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
            <td nowrap="nowrap"><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsEmailList['id']; ?>','emaildetails','scrollbars=yes,width=400')"><?php echo $row_rsEmailList['title']; ?></a></td>
            <td>&nbsp;</td>
            <td nowrap="nowrap"><?php echo $row_rsEmailList['sent_to']; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsEmailList['sent_by']; ?></td>
            <td>&nbsp;</td>
            <td colspan="2"><?php echo $row_rsEmailList['sent_date']; ?></td>
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
          <?php } while ($row_rsEmailList = mysql_fetch_assoc($rsEmailList)); ?>
        <tr>
          <td colspan="8" nowrap="nowrap" class="tableBottom">&nbsp;</td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rsEmailList == 0) { // Show if recordset empty ?>
  <p class="homepageBlocks">No emails are in the system! </p>
  <?php } // Show if recordset empty ?>
<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEmailList);

mysql_free_result($rsPrograms);
?>
