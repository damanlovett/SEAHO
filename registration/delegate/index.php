<?php require_once('../../Connections/CMS.php'); ?>
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

$colname_rsErrorMessage = "-1";
if (isset($_GET['error'])) {
  $colname_rsErrorMessage = $_GET['error'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsErrorMessage = sprintf("SELECT * FROM sys_errors WHERE error_id = %s", GetSQLValueString($colname_rsErrorMessage, "int"));
$rsErrorMessage = mysql_query($query_rsErrorMessage, $CMS) or die(mysql_error());
$row_rsErrorMessage = mysql_fetch_assoc($rsErrorMessage);
$totalRows_rsErrorMessage = mysql_num_rows($rsErrorMessage);

mysql_select_db($database_CMS, $CMS);
$query_rsDelegate = "SELECT CONCAT(delegate.last_name,', ', delegate.first_name, ' - ' ,delegate.institution) AS delegate_name, delegate.institution, delegate.email FROM delegate WHERE delegate.deleted = 0 AND delegate.last_name IS NOT NULL AND delegate.`access` != 1 ORDER BY delegate.last_name";
$rsDelegate = mysql_query($query_rsDelegate, $CMS) or die(mysql_error());
$row_rsDelegate = mysql_fetch_assoc($rsDelegate);
$totalRows_rsDelegate = mysql_num_rows($rsDelegate);
 

ob_start();
session_start();
$_SESSION['accesspoint']="CMSdelegate";?>

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
#accountcheck label {
	text-align: right;
	width: 100px;
	float: left;
}
#loginbox {
	background: #FFFFFF;
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
        <?php require_once('../includefiles/header.php'); ?>
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
      <h3><strong>SEAHO Delegate Registration</strong></h3>
      <p> Welcome to SEAHO's Conference Manager.  To begin the registration process, please visit our <a href="account/newregistrationconfirm.php">New Registration Account</a> page.  If you have questions about whether or not you created an account, check the <a href="#check">Account List</a>. Create only one account per individual.  If you create multiple accounts for your e-mail address, your registration will not be processed.<?php /*?>Welcome to the SEAHO's Conference Manager. Please log into the system to view your account. Make sure you have an account first by checking the <a href="#check">account list</a>, if you know for sure you do not have an account please visit our <a href="account/newregistration.php">New Registration Account</a> page.<?php */?></p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>

  <tr>
    <td><div id="loginbox">
      <div>
              <div align="center">
                <?php if(isset($_GET['error'])) { echo "<p><span class='denied'>".$row_rsErrorMessage['error_title']."</span></p>";}?>
               </div>
            <form id="login" name="login" method="post" action="/registration/delegate/home.php">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2" nowrap="nowrap"> Once your account is created, please log in below:</td>
                </tr>
              <tr>

              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="delegateemail" type="text" class="smallbox" id="delegateemail" value="" size="40" /></td>
              </tr>
            <tr>
              <td nowrap="nowrap"><label for="label">Password:</label></td>
              <td><input name="password" class="smallbox" id="label" size="40" type="password"></td>
            </tr>
            <tr>

              <td>&nbsp;</td>
              <td><input name="Submit" class="smalltextbox" value="Login »»" type="submit">
                <a href="forgot.php">Forgot Password? </a></td>
            </tr>
          </tbody></table>
          </form>
          <script language="JavaScript">
<!--

document.login.delegateemail.focus();

//-->
</script>
        </div>

    </div></td>
  </tr>
  <tr>
    <td><div>
      <div align="center"><br />
      </div>
    </div></td>
  </tr>
</tbody></table>
      <p><strong><a name="check" id="check"></a>Already have a delegate Account?<br />
      </strong>If your name is listed below,   please select the name of the organization to retrieve your password.</p>
      <form id="accountcheck" name="accountcheck" method="post" action="forgot.php">
        <label for="forgetemail">Account:&nbsp; </label>
        <select name="forgetemail" id="forgetemail">
          <option value="---">Select Account Information</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsDelegate['email']?>"><?php echo substr($row_rsDelegate['delegate_name'],0,35)." . . ." ?></option>
          <?php
} while ($row_rsDelegate = mysql_fetch_assoc($rsDelegate));
  $rows = mysql_num_rows($rsDelegate);
  if($rows > 0) {
      mysql_data_seek($rsDelegate, 0);
	  $row_rsDelegate = mysql_fetch_assoc($rsDelegate);
  }
?>
        </select>
        <label for="button"></label>
        <input type="submit" name="button" id="button" value="Forgot Password" />
      </form>
      <p><br />
      </p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsErrorMessage);

mysql_free_result($rsDelegate);
?>
