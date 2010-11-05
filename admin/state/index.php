<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
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

mysql_select_db($database_Directory, $Directory);
$query_rsState = "SELECT team_positions.id, team_positions.position_id, team_positions.user_id AS team_userid, team_positions.`position`, team_positions.`group`, users.first_name, users.last_name, users.user_id, users.title, users.school FROM team_positions LEFT JOIN users ON team_positions.user_id = users.user_id WHERE `group` = 'State Rep.' ORDER BY `position` ASC";
$rsState = mysql_query($query_rsState, $Directory) or die(mysql_error());
$row_rsState = mysql_fetch_assoc($rsState);
$totalRows_rsState = mysql_num_rows($rsState);

$colname_rsReports = "-1";
if (isset($_POST['search'])) {
  $colname_rsReports = (get_magic_quotes_gpc()) ? $_POST['search'] : addslashes($_POST['search']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsReports = sprintf("SELECT id, page_id, state_id, title, type, content, submitted_by, DATE_FORMAT(mondified_on,'%%a, %%M %%d %%Y at %%r') AS mod_id, created_on, `delete` FROM team_pages WHERE 'delete'!=1 AND title LIKE CONCAT('%%', %s, '%%') ORDER BY created_on ASC", GetSQLValueString($colname_rsReports, "text"));
$rsReports = mysql_query($query_rsReports, $Directory) or die(mysql_error());
$row_rsReports = mysql_fetch_assoc($rsReports);
$totalRows_rsReports = mysql_num_rows($rsReports);
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">State Page Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form action="index.php" method="post" name="search" id="search">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>Search By</strong></td>
            <td nowrap="nowrap"><input name="search" type="text" id="search" onFocus="if(this.value=='----- Report -----')this.value='';" value="----- Report -----" size="40"/>            </td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" class="submitButton" value="Search" /></td>
            <td><input name="button" type="button" class="submitButton" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Main Page" /></td>
          </tr>
        </table>
      </form>
    </div>
	<?php if(!isset($_POST['submit'])) { ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>States</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Representative</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Title</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>School</strong></td>
        <td nowrap="nowrap" class="tableTop"><strong>CHO List </strong></td>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><a href="mystate.php?state_id=<?php echo $row_rsState['position_id']; ?>"><img src="../images/imgUpdate.gif" alt="Edit" width="14" height="14" border="0" /></a></td>
          <td nowrap="nowrap"><a href="statereviewindex.php?recordID=<?php echo $row_rsState['position_id']; ?>"><?php echo substr($row_rsState['position'],0,-10); ?></a></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsState['first_name']; ?> <?php echo $row_rsState['last_name']; ?> </td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsState['title']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsState['school']; ?></td>
          <td><div align="center"><a href="choreviewindex.php?recordID=<?php echo $row_rsState['position_id']; ?>"><img src="../images/imgAdminView.gif" alt="View" width="14" height="14" border="0" /></a></div></td>
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
        <?php } while ($row_rsState = mysql_fetch_assoc($rsState)); ?>
<tr>
        <td colspan="9" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
	<br />
	<?php }?>
	<?php if(isset($_POST['submit'])) { ?>
        <?php if ($totalRows_rsReports > 0) { // Show if recordset not empty ?>
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
          <tr>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Title</th>
            <th>&nbsp;</th>
            <th>Submitted By </th>
            <th>&nbsp;</th>
            <th>Modified On </th>
            </tr>
          <?php do { ?>
            <tr>
              <td><a href="statereviewdetails.php?recordID=<?php echo $row_rsReports['page_id']; ?>"><?php echo $row_rsReports['title']; ?></a></td>
              <td>&nbsp;</td>
              <td><?php echo $row_rsReports['submitted_by']; ?></td>
              <td>&nbsp;</td>
              <td><?php echo $row_rsReports['mod_id']; ?></td>
            </tr>
            <?php } while ($row_rsReports = mysql_fetch_assoc($rsReports)); ?>
            <tr class="tableBottom">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
        </table>
          <?php } // Show if recordset not empty ?>
        <?php if ($totalRows_rsReports == 0) { // Show if recordset empty ?>
        <p class="commenttext">No Report was found!</p>
	      <?php } // Show if recordset empty ?><?php }?>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsState);

mysql_free_result($rsReports);
?>
