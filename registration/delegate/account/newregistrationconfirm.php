<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initFunctions.php'); ?>
<?php require_once('../../includefiles/initEmails.php'); ?>

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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$colname_rsNewAccount = "-1";
if (isset($_POST['email'])) {
  $colname_rsNewAccount = $_POST['email'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsNewAccount = sprintf("SELECT delegate_id, first_name, last_name, preferred_name, title, institution, email, alt_email, password, phone, alt_phone, fax, address, city, `state`, zip, created FROM delegate WHERE delegate.email=%s", GetSQLValueString($colname_rsNewAccount, "text"));
$rsNewAccount = mysql_query($query_rsNewAccount, $CMS) or die(mysql_error());
$row_rsNewAccount = mysql_fetch_assoc($rsNewAccount);
$totalRows_rsNewAccount = mysql_num_rows($rsNewAccount);

$_SESSION['first']=$_POST['first_name'];
$_SESSION['last']=$_POST['last_name'];
$_SESSION['email']=$_POST['email'];


if($totalRows_rsNewAccount>0){
  header("Location: duplicateaccount.php");
  }else{
  header("Location: newregistration.php");
  }
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>New Delegate Account</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../includefiles/gen_validatorv2.js"></script>
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
        <?php require_once('../../../includefiles/importantlinks.inc.php'); ?>
<!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong> Delegate Account Form</strong></h3>
      <p class="steps">Step 1 of 2: Account Confirmation</p>
      <form action="newregistrationconfirm.php" method="post" name="form1" id="form1">
        <table border="0" align="center" cellpadding="0" cellspacing="0" class="tableBasicForm">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>First Name:</h2></td>
            <td><input name="first_name" type="text" size="20" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Last Name:</h2></td>
            <td><input name="last_name" type="text" size="20" /></td>
          </tr>
          
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Email:</h2></td>
            <td><input name="email" type="text" id="email" size="45" /></td>
          </tr>
          
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>&nbsp;</h2></td>
            <td><input type="submit" value="Submit New Account" />
            <input name="MM_insert" type="hidden" id="MM_insert" value="form1" /></td>
          </tr>
        </table>
        </form>
<p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsNewAccount);
?>
