<?php require_once('../../Connections/Programming.php'); ?>
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
mysql_select_db($database_Programming, $Programming);
$query_rsErrorMessage = sprintf("SELECT sys_errors.error_id, sys_errors.error_title, sys_errors.error_description FROM sys_errors WHERE error_id = %s", GetSQLValueString($colname_rsErrorMessage, "text"));
$rsErrorMessage = mysql_query($query_rsErrorMessage, $Programming) or die(mysql_error());
$row_rsErrorMessage = mysql_fetch_assoc($rsErrorMessage);
$totalRows_rsErrorMessage = mysql_num_rows($rsErrorMessage);


ob_start();
session_start();

// Set access point for system
$_SESSION['accesspoint'] = "Seaho Programming";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>SEAHO LCCM Login</title>

<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
#loginbox {
	width: 350px;
	background-color: #E0DFE3;
	border: 3px double #333333;
	margin-right: auto;
	margin-left: auto;
	padding-top: 5px;
	padding-right: 5px;
	padding-left: 5px;
	margin-top: 15px;
}
.smalltextbox {
	margin-right: 10px;
	font-size: 10px;
}
.smallbox {
	font-size: 10px;
}
.footer {
	padding: 8px;
	text-align: center;
}
label {
	text-align: right;
	display: block;
	font-weight: bold;
	color: #000099;
}
.title {
	display: block;
	padding: 12px;
	font-size: 15px;
	color: #000099;
	font-weight: bold;
	text-align: center;
}
.denied {
	font-weight: bold;
	color: #990000;
	font-size: 11px;
	text-align: center;
}
-->
</style>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td><div align="center"><img src="images/LCCMlogo.jpg" alt="" height="65" width="350"></div></td>
  </tr>
  <tr>
    <td><div id="loginbox">
      <div>
              <div align="center">
                <?php if(isset($_GET['error'])) { echo "<p><span class='denied'>".$row_rsErrorMessage['error_title']."</span></p>";}?>
              </div>
            <form id="login" name="login" method="post" action="/programs/admin/index.php">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="user" type="text" class="smallbox" id="user" value="<?php echo $_GET['user'];?>" size="40"></td>
            </tr>
            <tr>
              <td nowrap="nowrap"><label for="label">Password:</label></td>
              <td><input name="password" class="smallbox" id="label" size="40" type="password"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Submit" class="smalltextbox" value="Login &raquo;" type="submit">
                <a href="forgotpassword.php">Forgot Password?</a> </td>
            </tr>
          </tbody></table>
          </form>
          <script language="JavaScript">
<!--

document.login.user.focus();

//-->
</script>
        </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="footer">Copyright © <?php echo "2007 - "; echo date('Y');?> <a href="http://lovettcreations.org/">Lovett Creations</a>, All Rights Reserved.</div></td>
  </tr>
</tbody></table>

</body></html>
<?php
mysql_free_result($rsErrorMessage);
?>