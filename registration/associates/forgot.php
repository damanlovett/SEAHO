<?php require_once('../../Connections/CMS.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>

<?php

ob_start();
session_start();

// Set access point for system
$_SESSION['accesspoint'] = "CMS";


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
$colname_rsErrorMessage = "-1";
if (isset($_GET['error'])) {
  $colname_rsErrorMessage = $_GET['error'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsErrorMessage = sprintf("SELECT * FROM sys_errors WHERE error_id = %s", GetSQLValueString($colname_rsErrorMessage, "int"));
$rsErrorMessage = mysql_query($query_rsErrorMessage, $CMS) or die(mysql_error());
$row_rsErrorMessage = mysql_fetch_assoc($rsErrorMessage);
$totalRows_rsErrorMessage = mysql_num_rows($rsErrorMessage);

if (isset($_POST['emailrequest'])) {
$colname_rsEmailRetrieve = "-1";
if (isset($_POST['emailrequest'])) {
  $colname_rsEmailRetrieve = $_POST['emailrequest'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsEmailRetrieve = sprintf("SELECT associate_id, org_name, seaho_years, first_name, last_name, email, alt_email, password FROM associate WHERE email = %s", GetSQLValueString($colname_rsEmailRetrieve, "text"));
$rsEmailRetrieve = mysql_query($query_rsEmailRetrieve, $CMS) or die(mysql_error());
$row_rsEmailRetrieve = mysql_fetch_assoc($rsEmailRetrieve);
$totalRows_rsEmailRetrieve = mysql_num_rows($rsEmailRetrieve);

$colname_rsCompanyInfo = "-1";
if (isset($_POST['email'])) {
  $colname_rsCompanyInfo = $_POST['email'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsCompanyInfo = sprintf("SELECT associate_id, org_name, seaho_years, first_name, last_name, email, alt_email, password, address1, city, `state`, zip FROM associate WHERE email = %s", GetSQLValueString($colname_rsCompanyInfo, "text"));
$rsCompanyInfo = mysql_query($query_rsCompanyInfo, $CMS) or die(mysql_error());
$row_rsCompanyInfo = mysql_fetch_assoc($rsCompanyInfo);
$totalRows_rsCompanyInfo = mysql_num_rows($rsCompanyInfo);


passwordUpdate($row_rsEmailRetrieve['first_name'],$row_rsEmailRetrieve['email'],$row_rsEmailRetrieve['email'],$row_rsEmailRetrieve['password']);
passwordUpdate($row_rsEmailRetrieve['first_name'],$row_rsEmailRetrieve['alt_email'],$row_rsEmailRetrieve['email'],$row_rsEmailRetrieve['password']);

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.companyINFO {
	color: #003399;
	font-weight: lighter;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <?php require_once('../includefiles/headerAssociateHome.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../../includefiles/importantlinks.inc.php'); ?>

      <!-- InstanceEndEditable --><img src="../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong>Associate Password Retrieval</strong></h3>
<?php if(isset($_POST['email'])) {?>

</p>
      <p><strong>Is this your company?<br />
        <span class="companyINFO"><?php echo $row_rsCompanyInfo['org_name']; ?><br />
          <?php echo $row_rsCompanyInfo['first_name']; ?> <?php echo $row_rsCompanyInfo['last_name']; ?><br />
          <?php echo $row_rsCompanyInfo['address1']; ?><br />
      <?php echo $row_rsCompanyInfo['city']; ?>, <?php echo $row_rsCompanyInfo['state']; ?> <?php echo $row_rsCompanyInfo['zip']; ?></span></strong></p>
      <p>If this is not your company, please create a <a href="account/new.php">New Account</a>.</p>
<?php }?>
      <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>

  <tr>
    <td>
    
      <div id="loginbox">
        <div align="center">
          <?php if(isset($_GET['error'])) { echo "<p><span class='denied'>".$row_rsErrorMessage['error_title']."</span></p>";}?>
        </div>
        <form id="login" name="login" method="post" action="/registration/associates/forgot.php?error=10">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
                
                <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
                  <td><input name="emailrequest" type="text" class="smallbox" id="emailrequest" value="<?php echo $_REQUEST['email'];?>" size="40"></td>
                </tr>
              <tr>
                
                <td>&nbsp;</td>
                  <td><input name="Submit" class="smalltextbox" value="Get Password &raquo;&raquo;" type="submit"></td>
                </tr>
              </tbody></table>
                </form>
      </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</tbody></table>

    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEmailRetrieve);

mysql_free_result($rsCompanyInfo);

mysql_free_result($rsErrorMessage);
?>