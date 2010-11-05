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
$query_rsState = "SELECT committee_pages.id, committee_pages.position_id, committee_pages.`position`,committee_pages.page_title, DATE_FORMAT(committee_pages.modified_on,'%m/%d/%Y  %r') AS mod_date, committee_pages.user_id, team_positions.position_id, team_positions.user_id, team_positions.position_id FROM committee_pages LEFT JOIN team_positions ON committee_pages.position_id = team_positions.position_id ORDER BY committee_pages.`position` ASC ";
$rsState = mysql_query($query_rsState, $Directory) or die(mysql_error());
$row_rsState = mysql_fetch_assoc($rsState);
$totalRows_rsState = mysql_num_rows($rsState);

$colname_rsReports = "-1";
if (isset($_POST['search'])) {
  $colname_rsReports = $_POST['search'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsReports = sprintf("SELECT id, page_id, state_id, title, type, content, submitted_by, DATE_FORMAT(mondified_on,'%%a, %%M %%d %%Y at %%r') AS mod_id, created_on, `delete` FROM team_pages WHERE 'delete'!=1 AND type = 'Committee' AND title LIKE CONCAT('%%', %s, '%%') ORDER BY created_on ASC", GetSQLValueString($colname_rsReports, "text"));
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadcommittee">Committee Page Manager  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="2" class="tableTop">Committee</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">Page Title</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">Modified on</td>
        <td class="tableTop">&nbsp;</td>
      </tr>
        <?php do { ?>
          <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>   class="tableRowColor">
            <td nowrap="nowrap"><a href="edit.php?recordID=<?php echo $row_rsState['position_id'];?>"><img src="../images/imgUpdate.gif" alt="Edit" width="14" height="14" border="0" /></a><?php if($row_rsState['user_id'] == $_SESSION['userID'] || $_SESSION['access'] < 4) { ?> 
                            <?php } ?></td>
            <td><a href="committeereviewdetails.php?recordID=<?php echo $row_rsState['position_id']; ?>"><?php echo $row_rsState['position']; ?></a></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsState['page_title']; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsState['mod_date']; ?></td>
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
        <?php } while ($row_rsState = mysql_fetch_assoc($rsState)); ?>
<tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
	<br />
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsState);

mysql_free_result($rsState);

mysql_free_result($rsReports);
?>
