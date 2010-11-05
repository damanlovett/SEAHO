<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#ECEBED";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>

<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsEmailList = 50;
$pageNum_rsEmailList = 0;
if (isset($_GET['pageNum_rsEmailList'])) {
  $pageNum_rsEmailList = $_GET['pageNum_rsEmailList'];
}
$startRow_rsEmailList = $pageNum_rsEmailList * $maxRows_rsEmailList;

mysql_select_db($database_Directory, $Directory);
$query_rsEmailList = "SELECT email_records.id, email_records.emailID, email_records.title, email_records.emailmessage, email_records.sent_to, email_records.sent_by, DATE_FORMAT(email_records.sent_date,'%m/%d/%y  %r') AS sent_date, email_records.deleted FROM email_records WHERE email_records.deleted = 0";
$query_limit_rsEmailList = sprintf("%s LIMIT %d, %d", $query_rsEmailList, $startRow_rsEmailList, $maxRows_rsEmailList);
$rsEmailList = mysql_query($query_limit_rsEmailList, $Directory) or die(mysql_error());
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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>System Emails</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
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
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadSystemAdmin">System Emails</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">

      <tr class="tableTop">
        <td>&nbsp;
Emails <?php echo ($startRow_rsEmailList + 1) ?> to <?php echo min($startRow_rsEmailList + $maxRows_rsEmailList, $totalRows_rsEmailList) ?> of <?php echo $totalRows_rsEmailList ?> </td>
        <td>&nbsp;</td>
        <td><label for="send_email"></label>
        <input name="send_email" type="submit" id="send_email" onclick="MM_goToURL('parent','emailform.php');return document.MM_returnValue" value="Send New Email" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><?php if ($pageNum_rsEmailList > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, 0, $queryString_rsEmailList); ?>"><img src="../../images/First.gif" border="0" /></a>
                    <?php } // Show if not first page ?>              </td>
              <td><?php if ($pageNum_rsEmailList > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, max(0, $pageNum_rsEmailList - 1), $queryString_rsEmailList); ?>"><img src="../../images/Previous.gif" border="0" /></a>
                    <?php } // Show if not first page ?>              </td>
              <td><?php if ($pageNum_rsEmailList < $totalPages_rsEmailList) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, min($totalPages_rsEmailList, $pageNum_rsEmailList + 1), $queryString_rsEmailList); ?>"><img src="../../images/Next.gif" border="0" /></a>
                    <?php } // Show if not last page ?>              </td>
              <td><?php if ($pageNum_rsEmailList < $totalPages_rsEmailList) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsEmailList=%d%s", $currentPage, $totalPages_rsEmailList, $queryString_rsEmailList); ?>"><img src="../../images/Last.gif" border="0" /></a>
                    <?php } // Show if not last page ?>              </td>
            </tr>
          </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th><strong>Subject</strong></th>
        <th>&nbsp;</th>
        <th><strong>To</strong></th>
        <th>&nbsp;</th>
        <th><strong>From</strong></th>
        <th>&nbsp;</th>
        <th><strong>Date</strong></th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> >
          <td><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsEmailList['id']; ?>','details','width=400')"><?php echo $row_rsEmailList['title']; ?></a></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsEmailList['sent_to']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsEmailList['sent_by']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsEmailList['sent_date']; ?></td>
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
<?php } while ($row_rsEmailList = mysql_fetch_assoc($rsEmailList)); ?>
      <tr class="tableBottom">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEmailList);

mysql_free_result($rsCat);
?>
