<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO conference_dates (id, conference_id, title, start_date, end_date, location, notes, website) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['conference_id'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['start_date'], "date"),
                       GetSQLValueString($_POST['end_date'], "date"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['notes'], "text"),
                       GetSQLValueString($_POST['website'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="/admin/includefiles/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Conference Date Form <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->

    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table border="0" align="left" cellpadding="5" cellspacing="0" bgcolor="#ECECF1" class="tableborder">
        <tr valign="baseline" class="tableTop">
          <td colspan="2" align="right" nowrap>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><strong>Conference Title:</strong></td>
          <td><input type="text" name="title" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><strong>Start date:</strong></td>
          <td><script language="">
DateInput('start_date', true, 'YYYY-MM-DD')
</script></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><strong>End date:</strong></td>
          <td><script language="">
DateInput('end_date', true, 'YYYY-MM-DD')
</script></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><strong>Location:</strong></td>
          <td><input type="text" name="location" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top"><strong>Notes:</strong></td>
          <td><textarea name="notes" cols="50" rows="8"></textarea>            </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><strong>Website:</strong></td>
          <td><input type="text" name="website" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" class="submitButton" value="Add Conference"></td>
        </tr>
        <tr valign="baseline" class="tableBottom">
          <td colspan="2" align="right" nowrap>&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="id" value="">
      <input type="hidden" name="conference_id" value="<?php echo create_guid();?>">
      <input type="hidden" name="MM_insert" value="form1">
                                          </form>
    <p>&nbsp;</p>
      <p class="cleartable">&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
