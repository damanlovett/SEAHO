<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE users SET first_name=%s, last_name=%s, email=%s, password=%s WHERE userID=%s",
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['userID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}
?>

<?php

$colname_rsMyAccount = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsMyAccount = $_SESSION['userID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsMyAccount = sprintf("SELECT users.first_name, users.last_name, users.email, users.password, users.id, users.userID FROM users WHERE userID = %s", GetSQLValueString($colname_rsMyAccount, "text"));
$rsMyAccount = mysql_query($query_rsMyAccount, $Programming) or die(mysql_error());
$row_rsMyAccount = mysql_fetch_assoc($rsMyAccount);
$totalRows_rsMyAccount = mysql_num_rows($rsMyAccount);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $_SESSION['first_name'];?>'s Account Information</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><span><img src="../../images/LCCMPHadminUser.jpg" alt="Users" width="65" height="51" /><?php echo $_SESSION['display_name']; ?> Account</span><!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
  <form id="update" name="update" method="POST" action="<?php echo $editFormAction; ?>">
    <table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td><label for="first_name">First name</label></td>
        <td><input name="first_name" type="text" id="first_name" value="<?php echo $row_rsMyAccount['first_name']; ?>" size="35" /></td>
        <td>&nbsp;</td>
        <td><label for="label">Last Name</label></td>
        <td><input name="last_name" type="text" id="last_name" value="<?php echo $row_rsMyAccount['last_name']; ?>" size="35" /></td>
      </tr>
      <tr>
        <td><label for="email">Email/Login</label></td>
        <td><input name="email" type="text" id="email" value="<?php echo $row_rsMyAccount['email']; ?>" size="35" /></td>
        <td>&nbsp;</td>
        <td><label for="password">password</label></td>
        <td><input name="password" type="password" id="password" value="<?php echo $row_rsMyAccount['password']; ?>" size="35" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><label for="button"></label>
            <input type="submit" name="button" id="button" value="Update" /></td>
        <td><input name="userID" type="hidden" id="userID" value="<?php echo $row_rsMyAccount['userID']; ?>" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="update" />
  </form>
</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMyAccount);
?>
