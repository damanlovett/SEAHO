<?php require_once('../../Connections/Directory.php'); ?>
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
<?php require_once('../includefiles/init.php'); ?>
<?php

if(isset($_GET['delete'])){

$timeoutseconds  = 20;   // How long till it will remove the user from the database(In seconds)

// -------------------------------------

$timestamp=time();
//$timeout=$timestamp-$timeoutseconds;
$timeout=$systemDate-$timeoutseconds;

mysql_select_db($database_Directory, $Directory);

// Dlete users that have been online for more then "$timeoutseconds" seconds
mysql_query("delete from online_report where time_stamp<=$timeout") or die("<b>MySQL Error:</b> ".mysql_error());
// Select users online
mysql_close();


//$timeoutseconds  = 300;   // How long till it will remove the user from the database(In seconds)
//$timestamp=time();
//$timeout=$systemDate-$timeoutseconds;
//
////$delete = strtotime($systemDate)-300;
//mysql_select_db($database_Directory, $Directory);
//// Delete users that have been online for more then "$timeoutseconds" seconds
//$query_rsLogindelete = "delete from online_report where online_report.time_stamp<$timeout"; //or die(mysql_error());
//
////$query_rsLogindelete = "DELETE FROM online_report WHERE time_stamp < $delete";
//$rsdelete = mysql_query($query_rsLogindelete, $Directory) or die(mysql_error());
}

$maxRows_rsLoginInfo = 30;
$pageNum_rsLoginInfo = 0;
if (isset($_GET['pageNum_rsLoginInfo'])) {
  $pageNum_rsLoginInfo = $_GET['pageNum_rsLoginInfo'];
}
$startRow_rsLoginInfo = $pageNum_rsLoginInfo * $maxRows_rsLoginInfo;

mysql_select_db($database_Directory, $Directory);
$query_rsLoginInfo = "SELECT online_report.id, online_report.user_id, online_report.ip_address, online_report.time_stamp FROM online_report ORDER BY online_report.time_stamp DESC";
$query_limit_rsLoginInfo = sprintf("%s LIMIT %d, %d", $query_rsLoginInfo, $startRow_rsLoginInfo, $maxRows_rsLoginInfo);
$rsLoginInfo = mysql_query($query_limit_rsLoginInfo, $Directory) or die(mysql_error());
$row_rsLoginInfo = mysql_fetch_assoc($rsLoginInfo);

if (isset($_GET['totalRows_rsLoginInfo'])) {
  $totalRows_rsLoginInfo = $_GET['totalRows_rsLoginInfo'];
} else {
  $all_rsLoginInfo = mysql_query($query_rsLoginInfo);
  $totalRows_rsLoginInfo = mysql_num_rows($all_rsLoginInfo);
}
$totalPages_rsLoginInfo = ceil($totalRows_rsLoginInfo/$maxRows_rsLoginInfo)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>My Profile</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadUserAdmin">Login Information</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <p>
        <?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) { echo "<div class='homepageBlocks'>Your Profile has been updated</div>";}?>
      <a href="index.php?delete=Yes">delete</a></p>
      <p><?php echo "    $systemDate     ";?> System date<br />
      <?php echo strtotime($systemDate);?> System Strip<br /> 
        <?php $delete = strtotime($systemDate) - 10; echo $delete?>
      Delete minus 10 secs</p>
    </div>
    
    
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Current Positions</li>
        <li class="TabbedPanelsTab" tabindex="0">Current Committees</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent"> <?php echo $totalRows_rsLoginInfo ?> <br />
&nbsp;
<table border="0" cellpadding="5" cellspacing="0" class="tableborder">
  <tr>
    <th>name</th>
    <th>ip_address</th>
    <th>page</th>
    <th>DATE</th>
    <th>string</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsLoginInfo['user_id']; ?></td>
      <td><?php echo $row_rsLoginInfo['ip_address']; ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_rsLoginInfo['time_stamp']; ?></td>
      <td>&nbsp;</td>
    </tr>
    <?php } while ($row_rsLoginInfo = mysql_fetch_assoc($rsLoginInfo)); ?>
</table>
        </div>
        <div class="TabbedPanelsContent">&nbsp;        </div>
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
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsLoginInfo);
?>