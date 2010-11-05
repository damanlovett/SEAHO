<?php require_once('../Connections/Directory.php'); ?>
<?php require_once('includefiles/initEmails.php'); ?>

<?php

ob_start();
session_start();

// Error Messages
switch($_GET['error']){
 case "1":
 $errorMessage = "Your have successfully logged out!";
 break;
 case "2":
 $errorMessage = "ERROR: Access Denied, you are not logged in";
 break;
 case "3":
 $errorMessage = "ERROR: Your account is currently inactive";
 break;
 case "4":
 $errorMessage = "ERROR: You are not currently in the system";
 break;
 }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><title>SEAHO LCCM</title>

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
              
                <?php if(isset($_POST['Submit'])) { echo "<div align='center'><p><br /><span class='denied'>$errorMessage</span></p></div>";}?>
              
            <form id="login" name="login" method="post" action="/admin/forgot.php">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>
                <td colspan="2" nowrap="nowrap"><label>
                  <div align="center" class="title">PASSWORD RETRIEVE FORM</div>
                  </label></td>
                </tr>
              <tr>
              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="forgot" type="text" class="smallbox" id="forgot" value="<?php echo $_GET['user'];?>" size="40"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="Submit" class="smalltextbox" value="Retrieve Password" type="submit"></td>
            </tr>
          </tbody></table>
          </form>
        </div>
    </div></td>
  </tr>
  <tr>
    <td><div class="footer">Copyright © 2006 - 2007 <a href="http://lovettcreations.org/">Lovett Creations</a>, All Rights Reserved.</div></td>
  </tr>
</tbody></table>

</body></html>
<?php
mysql_free_result($Recordset1);
?>