<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?php

mysql_select_db($database_Directory, $Directory);
$query_rsConferences = "SELECT conference_dates.conference_id, conference_dates.title, conference_dates.start_date, conference_dates.end_date, conference_dates.location, conference_dates.website, conference_dates.notes FROM conference_dates WHERE conference_dates.deleted = 0";
$rsConferences = mysql_query($query_rsConferences, $Directory) or die(mysql_error());
$row_rsConferences = mysql_fetch_assoc($rsConferences);
$totalRows_rsConferences = mysql_num_rows($rsConferences);

if ((isset($_GET['delete'])) && ($_GET['delete'] !="")) {

  $deleteSQL = sprintf("UPDATE conference_dates SET `deleted`=1 WHERE conference_id=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($deleteSQL, $Directory) or die(mysql_error());
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Conference Dates</title>
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
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Conference Dates <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <table width="400" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="7" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Conference</th>
        <th>&nbsp;</th>
        <th>Dates</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Location</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr  class="tableRowColor">
          <td nowrap="nowrap"><a href="#"></a><?php echo $row_rsConferences['title']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo formatDate($row_rsConferences['start_date'],"F j"); ?> - <?php echo formatDate($row_rsConferences['end_date'],"F j, Y"); ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsConferences['location']; ?></td>
          <td nowrap="nowrap"><img src="../images/imgUpdate.gif" alt="Edit" width="14" height="14" /></td>
          <td nowrap="nowrap"><a href="index.php?delete=<?php echo $row_rsConferences['conference_id']; ?>"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></td>
        </tr>
        <?php } while ($row_rsConferences = mysql_fetch_assoc($rsConferences)); ?>
<tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsConferences);
?>
