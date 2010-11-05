<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initDelegates.php'); ?>

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
  $updateSQL = sprintf("UPDATE delegate SET first_name=%s, last_name=%s, preferred_name=%s, title=%s, institution=%s, email=%s, alt_email=%s, password=%s, phone=%s, alt_phone=%s, fax=%s, address=%s, city=%s, `state`=%s, zip=%s, created=%s, `access`=%s, active=%s, deleted=%s WHERE delegate_id=%s",
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['preferred_name'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['institution'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alt_email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['alt_phone'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['created'], "date"),
                       GetSQLValueString($_POST['access'], "int"),
                       GetSQLValueString($_POST['active'], "int"),
                       GetSQLValueString($_POST['deleted'], "int"),
                       GetSQLValueString($_POST['delegate_id'], "text"));

  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($updateSQL, $CMS) or die(mysql_error());
}

$colname_rsUpdate = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUpdate = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsUpdate = sprintf("SELECT delegate_id, first_name, last_name, preferred_name, title, institution, email, alt_email, password, phone, alt_phone, fax, address, city, `state`, zip FROM delegate WHERE delegate_id = %s", GetSQLValueString($colname_rsUpdate, "text"));
$rsUpdate = mysql_query($query_rsUpdate, $CMS) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Account Information</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../../includefiles/gen_validatorv2.js"></script>
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../../../programs/styles/table.css" rel="stylesheet" type="text/css" />
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
<?php require_once('../../includefiles/leftNavDelegates.php'); ?>
    <!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong><?php echo $_SESSION['display_name'];?>'s Account</strong></h3>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table border="0" align="left" cellpadding="4" cellspacing="0">
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>First Name:</label></td>
            <td><input type="text" name="first_name" value="<?php echo htmlentities($row_rsUpdate['first_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>Last Name:</label></td>
            <td><input type="text" name="last_name" value="<?php echo htmlentities($row_rsUpdate['last_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>Preferred Name:</label></td>
            <td><input type="text" name="preferred_name" value="<?php echo htmlentities($row_rsUpdate['preferred_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label for="title">Title:</label></td>
            <td><input type="text" name="title" value="<?php echo htmlentities($row_rsUpdate['title'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>Institution:</label></td>
            <td><input type="text" name="institution" value="<?php echo htmlentities($row_rsUpdate['institution'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>Email:</label></td>
            <td><input type="text" name="email" value="<?php echo htmlentities($row_rsUpdate['email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>Alternate email:</label></td>
            <td><input type="text" name="alt_email" value="<?php echo htmlentities($row_rsUpdate['alt_email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label id="password"><span class="required">*</span>Password:</label></td>
            <td><input type="text" name="password" value="<?php echo htmlentities($row_rsUpdate['password'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label><span class="required">*</span>Phone:</label></td>
            <td><input type="text" name="phone" value="<?php echo htmlentities($row_rsUpdate['phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>Alternate phone:</label></td>
            <td><input type="text" name="alt_phone" value="<?php echo htmlentities($row_rsUpdate['alt_phone'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>Fax:</label></td>
            <td><input type="text" name="fax" value="<?php echo htmlentities($row_rsUpdate['fax'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>Address:</label></td>
            <td><input type="text" name="address" value="<?php echo htmlentities($row_rsUpdate['address'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>City:</label></td>
            <td><input type="text" name="city" value="<?php echo htmlentities($row_rsUpdate['city'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>State:</label></td>
            <td><select name="state">
              <option value="" selected="selected" <?php if (!(strcmp("", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Choose a State</option>
              <option value="Alabama" <?php if (!(strcmp("Alabama", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Alabama</option>
              <option value="Alaska" <?php if (!(strcmp("Alaska", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Alaska</option>
              <option value="Arizona" <?php if (!(strcmp("Arizona", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Arizona</option>
              <option value="Arkansas" <?php if (!(strcmp("Arkansas", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Arkansas</option>
              <option value="California" <?php if (!(strcmp("California", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>California</option>
              <option value="Colorado" <?php if (!(strcmp("Colorado", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Colorado</option>
              <option value="Connecticut" <?php if (!(strcmp("Connecticut", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Connecticut</option>
              <option value="Delaware" <?php if (!(strcmp("Delaware", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Delaware</option>
              <option value="District Of Columbia" <?php if (!(strcmp("District Of Columbia", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>District Of Columbia</option>
              <option value="Florida" <?php if (!(strcmp("Florida", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Florida</option>
              <option value="Georgia" <?php if (!(strcmp("Georgia", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
              <option value="Hawaii" <?php if (!(strcmp("Hawaii", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Hawaii</option>
              <option value="Idaho" <?php if (!(strcmp("Idaho", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Idaho</option>
              <option value="Illinois" <?php if (!(strcmp("Illinois", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Illinois</option>
              <option value="Indiana" <?php if (!(strcmp("Indiana", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Indiana</option>
              <option value="Iowa" <?php if (!(strcmp("Iowa", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Iowa</option>
              <option value="Kansas" <?php if (!(strcmp("Kansas", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Kansas</option>
              <option value="Kentucky" <?php if (!(strcmp("Kentucky", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Kentucky</option>
              <option value="Louisiana" <?php if (!(strcmp("Louisiana", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Louisiana</option>
              <option value="Maine" <?php if (!(strcmp("Maine", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Maine</option>
              <option value="Maryland" <?php if (!(strcmp("Maryland", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Maryland</option>
              <option value="Massachusetts" <?php if (!(strcmp("Massachusetts", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Massachusetts</option>
              <option value="Michigan" <?php if (!(strcmp("Michigan", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Michigan</option>
              <option value="Minnesota" <?php if (!(strcmp("Minnesota", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Minnesota</option>
              <option value="Mississippi" <?php if (!(strcmp("Mississippi", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Mississippi</option>
              <option value="Missouri" <?php if (!(strcmp("Missouri", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Missouri</option>
              <option value="Montana" <?php if (!(strcmp("Montana", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Montana</option>
              <option value="Nebraska" <?php if (!(strcmp("Nebraska", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Nebraska</option>
              <option value="Nevada" <?php if (!(strcmp("Nevada", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Nevada</option>
              <option value="New Hampshire" <?php if (!(strcmp("New Hampshire", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New Hampshire</option>
              <option value="New Jersey" <?php if (!(strcmp("New Jersey", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New Jersey</option>
              <option value="New York" <?php if (!(strcmp("New York", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New York</option>
              <option value="North Carolina" <?php if (!(strcmp("North Carolina", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>North Carolina</option>
              <option value="North Dakota" <?php if (!(strcmp("North Dakota", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>North Dakota</option>
              <option value="Ohio" <?php if (!(strcmp("Ohio", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Ohio</option>
              <option value="Oklahoma" <?php if (!(strcmp("Oklahoma", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oklahoma</option>
              <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
              <option value="Pennsylvania" <?php if (!(strcmp("Pennsylvania", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Pennsylvania</option>
              <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
              <option value="Rhode Island" <?php if (!(strcmp("Rhode Island", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Rhode Island</option>
              <option value="South Carolina" <?php if (!(strcmp("South Carolina", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>South Carolina</option>
              <option value="South Dakota" <?php if (!(strcmp("South Dakota", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>South Dakota</option>
              <option value="Tennessee" <?php if (!(strcmp("Tennessee", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Tennessee</option>
              <option value="Texas" <?php if (!(strcmp("Texas", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Texas</option>
              <option value="Utah" <?php if (!(strcmp("Utah", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Utah</option>
              <option value="Vermont" <?php if (!(strcmp("Vermont", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Vermont</option>
              <option value="Virginia" <?php if (!(strcmp("Virginia", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Virginia</option>
              <option value="Washington" <?php if (!(strcmp("Washington", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Washington</option>
              <option value="West Virginia" <?php if (!(strcmp("West Virginia", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>West Virginia</option>
              <option value="Wisconsin" <?php if (!(strcmp("Wisconsin", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Wisconsin</option>
              <option value="Wyoming" <?php if (!(strcmp("Wyoming", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Wyoming</option>
            </select>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><label>Zip:</label></td>
            <td><input type="text" name="zip" value="<?php echo htmlentities($row_rsUpdate['zip'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>

          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>&nbsp;</h2></td>
            <td><input type="submit" value="Update Account" /></td>
          </tr>
        </table>
        <p>&nbsp;        </p>
        <p>
          <input type="hidden" name="delegate_id" value="<?php echo $row_rsUpdate['delegate_id']; ?>" />
          <input type="hidden" name="MM_update" value="form1" />
          <input type="hidden" name="delegate_id" value="<?php echo $row_rsUpdate['delegate_id']; ?>" />
          </p>
      </form>
      <p class="cleartable">
        <script language="JavaScript" type="text/javascript">
		var frmvalidator  = new Validator("form1");
		
		frmvalidator.addValidation("first_name","req","Please enter your First Name");
		frmvalidator.addValidation("last_name","req","Please enter your Last Name");
		frmvalidator.addValidation("preferred_name","req","Please enter your Name Tag Name");
		frmvalidator.addValidation("email","req","Please enter your email");
		frmvalidator.addValidation("email","email","Please enter a valid email address");
		frmvalidator.addValidation("alt_email","req","Please enter your alternative email");
		frmvalidator.addValidation("alt_email","email","Please enter a valid email address");
		frmvalidator.addValidation("password","req","Please enter your password");
		frmvalidator.addValidation("phone","req","Please enter your Phone Number");
	
			
	    </script>
      </p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUpdate);
?>
