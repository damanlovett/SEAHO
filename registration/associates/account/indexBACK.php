<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initAssociates.php'); ?>

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE associate SET org_name=%s, seaho_years=%s, first_name=%s, last_name=%s, preferred_name=%s, job_title=%s, email=%s, alt_email=%s, password=%s, address1=%s, city=%s, `state`=%s, zip=%s, office_phone=%s, cell_phone=%s, fax=%s, website=%s WHERE associate_id=%s",
                       GetSQLValueString($_POST['org_name'], "text"),
                       GetSQLValueString($_POST['seaho_years'], "int"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['preferred_name'], "text"),
                       GetSQLValueString($_POST['job_title'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alt_email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['address1'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['office_phone'], "text"),
                       GetSQLValueString($_POST['cell_phone'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['website'], "text"),
                       GetSQLValueString($_POST['associate_id'], "text"));

  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($updateSQL, $CMS) or die(mysql_error());
}

$colname_rsAccountInfo = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsAccountInfo = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsAccountInfo = sprintf("SELECT * FROM associate WHERE associate_id = %s", GetSQLValueString($colname_rsAccountInfo, "text"));
$rsAccountInfo = mysql_query($query_rsAccountInfo, $CMS) or die(mysql_error());
$row_rsAccountInfo = mysql_fetch_assoc($rsAccountInfo);
$totalRows_rsAccountInfo = mysql_num_rows($rsAccountInfo);
?>
<?php require_once('../../includefiles/initAssociates.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <?php require_once('../../includefiles/header.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
<?php require_once('../../includefiles/leftNavAssociates.php'); ?>
      <!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h1>Update Associate Profile</h1>
      <p><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table border="0" align="center" cellpadding="5" cellspacing="0">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left">
        <h2>Contact Information</h2>
      </div></td>
      <td align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Company Name:</td>
      <td><input type="text" name="org_name" value="<?php echo htmlentities($row_rsAccountInfo['org_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Years with SEAHO:</td>
      <td><input type="text" name="seaho_years" value="<?php echo htmlentities($row_rsAccountInfo['seaho_years'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">First Name:</td>
      <td><input type="text" name="first_name" value="<?php echo htmlentities($row_rsAccountInfo['first_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Last Name:</td>
      <td><input type="text" name="last_name" value="<?php echo htmlentities($row_rsAccountInfo['last_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name for nametag:</td>
      <td><input type="text" name="preferred_name" value="<?php echo htmlentities($row_rsAccountInfo['preferred_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Job Title:</td>
      <td><input type="text" name="job_title" value="<?php echo htmlentities($row_rsAccountInfo['job_title'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rsAccountInfo['email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Alternate Email:</td>
      <td><input type="text" name="alt_email" value="<?php echo htmlentities($row_rsAccountInfo['alt_email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="password" value="<?php echo $row_rsAccountInfo['password']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">
        <h2>Company Information</h2>
      </div></td>
      <td align="right" valign="top" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Address:</td>
      <td><textarea name="address1" cols="50" rows="5"><?php echo htmlentities($row_rsAccountInfo['address1'], ENT_COMPAT, 'iso-8859-1'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">City:</td>
      <td><input type="text" name="city" value="<?php echo htmlentities($row_rsAccountInfo['city'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">State:</td>
      <td><input type="text" name="state" value="<?php echo htmlentities($row_rsAccountInfo['state'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Zip:</td>
      <td><input type="text" name="zip" value="<?php echo htmlentities($row_rsAccountInfo['zip'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Office Phone:</td>
      <td><input type="text" name="office_phone" value="<?php echo htmlentities($row_rsAccountInfo['office_phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cell Phone:</td>
      <td><input type="text" name="cell_phone" value="<?php echo htmlentities($row_rsAccountInfo['cell_phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fax:</td>
      <td><input type="text" name="fax" value="<?php echo htmlentities($row_rsAccountInfo['fax'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Website:</td>
      <td><input type="text" name="website" value="<?php echo htmlentities($row_rsAccountInfo['website'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="associate_id" value="<?php echo $row_rsAccountInfo['associate_id']; ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="associate_id" value="<?php echo $row_rsAccountInfo['associate_id']; ?>" />
</form></p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd -->

<p>&nbsp;</p>
</html>
<?php
mysql_free_result($rsAccountInfo);
?>
