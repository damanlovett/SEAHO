<?php require_once('../../Connections/CMS.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>

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
if (isset($_POST['Submit']) && isset($_POST['email'])){

$colname_rsForgot = "-1";
if (isset($_POST['email'])) {
  $colname_rsForgot = $_POST['email'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsForgot = sprintf("SELECT delegate_id, first_name, last_name, email, alt_email, password FROM delegate WHERE email = %s", GetSQLValueString($colname_rsForgot, "text"));
$rsForgot = mysql_query($query_rsForgot, $CMS) or die(mysql_error());
$row_rsForgot = mysql_fetch_assoc($rsForgot);
$totalRows_rsForgot = mysql_num_rows($rsForgot);

if ($totalRows_rsForgot>0) {
$error = "Your Password has been sent to your primary and alternate email";
}else{
$error = "Your email is not in our system.";
}

passwordUpdate($row_rsForgot['first_name'],$row_rsForgot['email'],$row_rsForgot['email'],$row_rsForgot['password']);
passwordUpdate($row_rsForgot['first_name'],$row_rsForgot['alt_email'],$row_rsForgot['email'],$row_rsForgot['password']);
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Forgot Login</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#loginbox {
	width: 450px;
	background-color: #E0DFE3;
	border: 3px double #333333;
	margin-right: auto;
	margin-left: auto;
	padding-top: 5px;
	padding-right: 5px;
	padding-left: 5px;
	margin-top: 15px;
}
-->
</style>
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
      <h3><strong> Forgot Login</strong></h3>
      <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>

  <tr>
    <td><div id="loginbox">
      <div>
              <div align="center">
                <?php if(isset($_POST['Submit'])) { echo "<p><span class='denied'>".$error."</span></p>";}?>
               </div>
            <form id="login" name="login" method="post" action="/registration/delegate/forgot.php">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>

              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="email" type="text" class="smallbox" id="email" value="<?php echo $_POST['forgetemail'];?>" size="50"></td>
            </tr>
            
            <tr>

              <td>&nbsp;</td>
              <td><input name="Submit" class="smalltextbox" value="Get Password &raquo;&raquo;" type="submit">
                <input name="button" type="button" class="smalltextbox" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Login &raquo;&raquo;" /></td>
            </tr>
          </tbody></table>
          </form>
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
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsForgot);
?>
