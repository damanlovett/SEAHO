<?php require_once('Connections/connSeahoAdmin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SEAHO LCCM Login</title>
<style type="text/css">
<!--
#loginbox {
	width: 350px;
	background-color: #E0DFE3;
	border: 3px double #333333;
	margin-right: auto;
	margin-left: auto;
	padding-top: 5px;
	padding-right: 5px;
	padding-left: 5px;
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
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
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
	color: #FF0000;
	font-size: 12px;
	padding-top: 4px;
	padding-right: 4px;
	padding-bottom: 8px;
	padding-left: 4px;
	text-align: center;
}
-->
</style>
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><img src="images/lccmLaptopsAdmin.jpg" alt="" width="235" height="107" /></div>
    <div class="title">SEAHO Program  Portal </div></td>
  </tr>
  <tr>
    <td><div id="loginbox">
      <div>
	  <?php if (isset($_GET['message'])){ ?>
<div class="denied"> You have been denied access </div>
<?php } ?>
        <form ACTION="<?php echo $loginFormAction; ?>" id="login" name="login" method="POST">
          <table border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="user" type="text" class="smallbox" id="user" size="40" /></td>
            </tr>
            <tr>
              <td nowrap="nowrap"><label for="label">Password:</label></td>
              <td><input name="password" type="password" class="smallbox" id="label" size="40" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Submit" type="submit" class="smalltextbox" value="Login &raquo;&raquo;" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="forgotpassword.php">Forgot Password? </a></td>
            </tr>
          </table>
          </form>
        </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="footer">Copyright &copy; <?php echo date("Y"), " - "; echo date('Y') +1;?> <a href="http://lovettcreations.org">Lovett Creations</a>, All Rights Reserved.</div></td>
  </tr>
</table>
</body>
</html>
