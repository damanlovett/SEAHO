<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php

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
.labels {
	background-color: #DEDFEA;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
	border-right-width: 1px;
	border-right-style: solid;
	text-align: right;
	font-size: 11px;
}
-->
</style>
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
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
<?php require_once('../../includefiles/headerAssociateHome.php'); ?>
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
      <h1>Update Associate Profile <?php if(isset($_POST['MM_update'])){?><span class="updated">updated</span><?php }?></h1>
      <p>Fields marked <span class="required">*</span> are required      </p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="tableDetails">
    <tr valign="baseline">
      <td colspan="2" align="right" valign="middle" nowrap="nowrap" class="labels">        <div align="left"><strong>Contact Information</strong></div></td>
      </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Company Name:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="org_name" value="<?php echo htmlentities($row_rsAccountInfo['org_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Years with SEAHO:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="seaho_years" value="<?php echo htmlentities($row_rsAccountInfo['seaho_years'], ENT_COMPAT, 'iso-8859-1'); ?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>First Name:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="first_name" value="<?php echo htmlentities($row_rsAccountInfo['first_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Last Name:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="last_name" value="<?php echo htmlentities($row_rsAccountInfo['last_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Name for nametag:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="preferred_name" value="<?php echo htmlentities($row_rsAccountInfo['preferred_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Job Title:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="job_title" value="<?php echo htmlentities($row_rsAccountInfo['job_title'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Email:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="email" value="<?php echo htmlentities($row_rsAccountInfo['email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Alternate Email:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="alt_email" value="<?php echo htmlentities($row_rsAccountInfo['alt_email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Password:</td>
      <td valign="middle" class="labelsDetails"><input type="password" name="password" value="<?php echo $row_rsAccountInfo['password']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap">&nbsp;</td>
      <td align="right" valign="top" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap" class="labels"><div align="left">
        <strong>Company Information</strong></div></td>
      </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap" class="labels">Address:</td>
      <td valign="middle" class="labelsDetails"><textarea name="address1" cols="50" rows="5"><?php echo htmlentities($row_rsAccountInfo['address1'], ENT_COMPAT, 'iso-8859-1'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">City:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="city" value="<?php echo htmlentities($row_rsAccountInfo['city'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">State:</td>
      <td valign="middle" class="labelsDetails"><select name="state" id="state">
        <option value="" selected="selected" <?php if (!(strcmp("", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Choose a State</option>
        <option value="Alabama" <?php if (!(strcmp("Alabama", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Alabama</option>
        <option value="Alaska" <?php if (!(strcmp("Alaska", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Alaska</option>
        <option value="Arizona" <?php if (!(strcmp("Arizona", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Arizona</option>
        <option value="Arkansas" <?php if (!(strcmp("Arkansas", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Arkansas</option>
        <option value="California" <?php if (!(strcmp("California", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>California</option>
        <option value="Colorado" <?php if (!(strcmp("Colorado", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Colorado</option>
        <option value="Connecticut" <?php if (!(strcmp("Connecticut", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Connecticut</option>
        <option value="Delaware" <?php if (!(strcmp("Delaware", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Delaware</option>
        <option value="District Of Columbia" <?php if (!(strcmp("District Of Columbia", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>District Of Columbia</option>
        <option value="Florida" <?php if (!(strcmp("Florida", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Florida</option>
        <option value="Georgia" <?php if (!(strcmp("Georgia", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
        <option value="Hawaii" <?php if (!(strcmp("Hawaii", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Hawaii</option>
        <option value="Idaho" <?php if (!(strcmp("Idaho", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Idaho</option>
        <option value="Illinois" <?php if (!(strcmp("Illinois", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Illinois</option>
        <option value="Indiana" <?php if (!(strcmp("Indiana", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Indiana</option>
        <option value="Iowa" <?php if (!(strcmp("Iowa", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Iowa</option>
        <option value="Kansas" <?php if (!(strcmp("Kansas", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Kansas</option>
        <option value="Kentucky" <?php if (!(strcmp("Kentucky", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Kentucky</option>
        <option value="Louisiana" <?php if (!(strcmp("Louisiana", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Louisiana</option>
        <option value="Maine" <?php if (!(strcmp("Maine", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Maine</option>
        <option value="Maryland" <?php if (!(strcmp("Maryland", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Maryland</option>
        <option value="Massachusetts" <?php if (!(strcmp("Massachusetts", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Massachusetts</option>
        <option value="Michigan" <?php if (!(strcmp("Michigan", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Michigan</option>
        <option value="Minnesota" <?php if (!(strcmp("Minnesota", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Minnesota</option>
        <option value="Mississippi" <?php if (!(strcmp("Mississippi", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Mississippi</option>
        <option value="Missouri" <?php if (!(strcmp("Missouri", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Missouri</option>
        <option value="Montana" <?php if (!(strcmp("Montana", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Montana</option>
        <option value="Nebraska" <?php if (!(strcmp("Nebraska", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Nebraska</option>
        <option value="Nevada" <?php if (!(strcmp("Nevada", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Nevada</option>
        <option value="New Hampshire" <?php if (!(strcmp("New Hampshire", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>New Hampshire</option>
        <option value="New Jersey" <?php if (!(strcmp("New Jersey", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>New Jersey</option>
        <option value="New York" <?php if (!(strcmp("New York", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>New York</option>
        <option value="North Carolina" <?php if (!(strcmp("North Carolina", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>North Carolina</option>
        <option value="North Dakota" <?php if (!(strcmp("North Dakota", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>North Dakota</option>
        <option value="Ohio" <?php if (!(strcmp("Ohio", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Ohio</option>
        <option value="Oklahoma" <?php if (!(strcmp("Oklahoma", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Oklahoma</option>
        <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="Pennsylvania" <?php if (!(strcmp("Pennsylvania", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Pennsylvania</option>
        <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="Rhode Island" <?php if (!(strcmp("Rhode Island", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Rhode Island</option>
        <option value="South Carolina" <?php if (!(strcmp("South Carolina", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>South Carolina</option>
        <option value="South Dakota" <?php if (!(strcmp("South Dakota", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>South Dakota</option>
        <option value="Tennessee" <?php if (!(strcmp("Tennessee", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Tennessee</option>
        <option value="Texas" <?php if (!(strcmp("Texas", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Texas</option>
        <option value="Utah" <?php if (!(strcmp("Utah", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Utah</option>
        <option value="Vermont" <?php if (!(strcmp("Vermont", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Vermont</option>
        <option value="Virginia" <?php if (!(strcmp("Virginia", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Virginia</option>
        <option value="Washington" <?php if (!(strcmp("Washington", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Washington</option>
        <option value="West Virginia" <?php if (!(strcmp("West Virginia", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>West Virginia</option>
        <option value="Wisconsin" <?php if (!(strcmp("Wisconsin", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Wisconsin</option>
        <option value="Wyoming" <?php if (!(strcmp("Wyoming", $row_rsAccountInfo['state']))) {echo "selected=\"selected\"";} ?>>Wyoming</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Zip:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="zip" value="<?php echo htmlentities($row_rsAccountInfo['zip'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels"><span class="required">*</span>Office Phone:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="office_phone" value="<?php echo htmlentities($row_rsAccountInfo['office_phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Cell Phone:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="cell_phone" value="<?php echo htmlentities($row_rsAccountInfo['cell_phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Fax:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="fax" value="<?php echo htmlentities($row_rsAccountInfo['fax'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="labels">Website:</td>
      <td valign="middle" class="labelsDetails"><input type="text" name="website" value="<?php echo htmlentities($row_rsAccountInfo['website'], ENT_COMPAT, 'iso-8859-1'); ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" class="labels"><div align="center">
        <input type="submit" value="Update Account" />
      </div></td>
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
