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
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php

//Capture State ID
$_SESSION['staccess'] = $_REQUEST['state_id'];

DeleteRecord(team_pages,page_id);
if ((isset($_GET['delete'])) && ($_GET['delete'] != "")){
header('Location: /admin/state/index.php');
}
$maxRows_rsStatePages = 10;
$pageNum_rsStatePages = 0;
if (isset($_GET['pageNum_rsStatePages'])) {
  $pageNum_rsStatePages = $_GET['pageNum_rsStatePages'];
}
$startRow_rsStatePages = $pageNum_rsStatePages * $maxRows_rsStatePages;

$colname_rsStatePages = "-1";
if (isset($_SESSION['staccess'])) {
  $colname_rsStatePages = (get_magic_quotes_gpc()) ? $_SESSION['staccess'] : addslashes($_SESSION['staccess']);
}

$colname_rsStatePages = "-1";
if (isset($_REQUEST['state_id'])) {
  $colname_rsStatePages = $_REQUEST['state_id'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsStatePages = sprintf("SELECT id, page_id, state_id, title, type, content, submitted_by, DATE_FORMAT(mondified_on,'%%A, %%M %%d %%Y') AS mod_date, DATE_FORMAT(created_on, '%%a, %%M, %%d %%Y at %%r') AS create_date, `delete` FROM team_pages WHERE state_id = %s AND team_pages.`delete` != 1", GetSQLValueString($colname_rsStatePages, "text"));
$rsStatePages = mysql_query($query_rsStatePages, $Directory) or die(mysql_error());
$row_rsStatePages = mysql_fetch_assoc($rsStatePages);
$totalRows_rsStatePages = mysql_num_rows($rsStatePages);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>State Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">State Report Manager  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="search" id="search">
        <table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td><strong>Reports: <?php echo $totalRows_rsStatePages ?> </strong></td>
            <td><label></label>              <label></label></td>
            <td><input name="button" type="button" class="submitButton" id="button" onclick="MM_goToURL('parent','newreport.php');return document.MM_returnValue" value="Add New Report" /></td>
          </tr>
        </table>
      </form>
    </div>
    <br />
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td colspan="3" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Report </th>
        <th>&nbsp;</th>
        <th>Submitted by </th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Submitted on </th>
        <th>&nbsp;</th>
        <th><div align="center"></div></th>
      </tr>
      <?php do { ?>
        <tr  class="tableRowColor">
          <td nowrap="nowrap"><a href="statereviewdetails.php?recordID=<?php echo $row_rsStatePages['page_id']; ?>"><?php echo $row_rsStatePages['title']; ?></a></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsStatePages['submitted_by']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsStatePages['create_date']; ?> </td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap"><div align="center"><a href="edit.php?recordID=<?php echo $row_rsStatePages['page_id']; ?>"><img src="../images/imgUpdate.gif" alt="Update" width="14" height="14" border="0" /></a><a href="mystate.php?delete=<?php echo $row_rsStatePages['page_id']; ?>"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
        </tr>
        <?php } while ($row_rsStatePages = mysql_fetch_assoc($rsStatePages)); ?>
<tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
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
mysql_free_result($rsStatePages);
?>
