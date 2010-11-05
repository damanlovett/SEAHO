<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#E4E2E7";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php
$maxRows_rsVisitors = 50;
$pageNum_rsVisitors = 0;
if (isset($_GET['pageNum_rsVisitors'])) {
  $pageNum_rsVisitors = $_GET['pageNum_rsVisitors'];
}
$startRow_rsVisitors = $pageNum_rsVisitors * $maxRows_rsVisitors;

mysql_select_db($database_Directory, $Directory);
$query_rsVisitors = "SELECT name, user_id, DATE_FORMAT(time_stamp,'%m/%d/%Y  %r') AS time_stamp, audit_report.page FROM audit_report WHERE name !='Eddie Lovett' ORDER BY audit_report.time_stamp DESC";
$query_limit_rsVisitors = sprintf("%s LIMIT %d, %d", $query_rsVisitors, $startRow_rsVisitors, $maxRows_rsVisitors);
$rsVisitors = mysql_query($query_limit_rsVisitors, $Directory) or die(mysql_error());
$row_rsVisitors = mysql_fetch_assoc($rsVisitors);

if (isset($_GET['totalRows_rsVisitors'])) {
  $totalRows_rsVisitors = $_GET['totalRows_rsVisitors'];
} else {
  $all_rsVisitors = mysql_query($query_rsVisitors);
  $totalRows_rsVisitors = mysql_num_rows($all_rsVisitors);
}
$totalPages_rsVisitors = ceil($totalRows_rsVisitors/$maxRows_rsVisitors)-1;
?>
<?php  $lastTFM_nest = "";?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>System Audit Files</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadSystemAdmin">System Audit Files</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop"><strong>Last 50 Page Views</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>Page</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Date/Time</th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><?php $TFM_nest = $row_rsVisitors['name'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?><?php echo $row_rsVisitors['name']; ?>
            <?php } //End of Basic-UltraDev Simulated Nested Repeat?></td>
          <td>&nbsp;</td>
          <td><?php echo substr($row_rsVisitors['page'],7); ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsVisitors['time_stamp']; ?></td>
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
        <?php } while ($row_rsVisitors = mysql_fetch_assoc($rsVisitors)); ?>
<tr>
        <td colspan="5" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsVisitors);
?>
