<?php
// technocurve arc 3 php mv block1/3 start
$mocolor1 = "#FFFFFF";
$mocolor2 = "#DEDEDE";
$mocolor3 = "#F2F2F2";
$mocolor = $mocolor1;
// technocurve arc 3 php mv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?>
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
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "create_user")) {
  $insertSQL = sprintf("INSERT INTO users (userID, first_name, last_name, email, password, `access`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['access'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}

$maxRows_rsUserInfo = 100;
$pageNum_rsUserInfo = 0;
if (isset($_GET['pageNum_rsUserInfo'])) {
  $pageNum_rsUserInfo = $_GET['pageNum_rsUserInfo'];
}
$startRow_rsUserInfo = $pageNum_rsUserInfo * $maxRows_rsUserInfo;

mysql_select_db($database_Programming, $Programming);
$query_rsUserInfo = "SELECT loginrecord.id, loginrecord.username, DATE_FORMAT(loginrecord.Timelog,'%m/%d/%Y  %r') AS Timelog, users.userID, users.first_name, users.last_name FROM loginrecord, users WHERE loginrecord.username = users.userID AND users.userID !='198a829b-b93c-a24b-2dd0-461d394346a4' GROUP BY loginrecord.id ORDER BY loginrecord.Timelog DESC";
$query_limit_rsUserInfo = sprintf("%s LIMIT %d, %d", $query_rsUserInfo, $startRow_rsUserInfo, $maxRows_rsUserInfo);
$rsUserInfo = mysql_query($query_limit_rsUserInfo, $Programming) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);

if (isset($_GET['totalRows_rsUserInfo'])) {
  $totalRows_rsUserInfo = $_GET['totalRows_rsUserInfo'];
} else {
  $all_rsUserInfo = mysql_query($query_rsUserInfo);
  $totalRows_rsUserInfo = mysql_num_rows($all_rsUserInfo);
}
$totalPages_rsUserInfo = ceil($totalRows_rsUserInfo/$maxRows_rsUserInfo)-1;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "create_user")) {
NewMemberEmail($_POST['firstname'],$_POST['email'],$_POST['password']);
}
?>
<?php  $lastTFM_nest = "";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login Information</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #990000;
	font-size: 12px;
}
-->
</style><!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" -->
<img src="../../images/LCCMPHadminUser.jpg" alt="Admin User" width="65" height="51" />User Login Information <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation"><br />
  <form id="create_user" name="create_user" method="POST" action="<?php echo $editFormAction; ?>">
    <table border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td><strong>
          <label for="label">First Name</label>
        </strong></td>
        <td><input name="firstname" type="text" id="firstname" size="35" /></td>
        <td>&nbsp;</td>
        <td><strong>
          <label for="label2">Last Name</label>
        </strong></td>
        <td><input name="lastname" type="text" id="label" size="35" /></td>
      </tr>
      <tr>
        <td><strong>
          <label for="label2">Email</label>
        </strong></td>
        <td><input name="email" type="text" id="label2" size="35" /></td>
        <td>&nbsp;</td>
        <td><strong>
          <label for="select">Access</label>
        </strong></td>
        <td><select name="access" id="access">
          <option value="2">Administrator</option>
          <option value="3" selected="selected">Reviewer</option>
        </select></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="Submit2" value="Create Account" /></td>
        <td>&nbsp;</td>
        <td><input name="userID" type="hidden" id="userID" value="<?php echo create_guid();?>" />
          <input name="password" type="hidden" id="password" value="<?php echo createPassword();?>" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="create_user">
  </form>
<?php  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "create_user")) {?>
    <span class="style1">Account for <?php echo $_POST['firstname']." ( ".$_POST['email']." )";?> has been created, and a password email has been sent. </span>
    <?php }?>
</div>
	

	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
    <p>&nbsp;</p>
    <table width="500" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" class="tableTop">Last 100 Logins </td>
      </tr>
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>Last Login </th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?> class="tableRowColor">
          <td nowrap="nowrap"><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsUserInfo['username']; ?>','logindetails','scrollbars=yes,width=240,height=275')">
            <?php $TFM_nest = $row_rsUserInfo['first_name'];
if ($lastTFM_nest != $TFM_nest) { 
	$lastTFM_nest = $TFM_nest; ?>
          </a><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsUserInfo['username']; ?>','logindetails','scrollbars=yes,width=240,height=275')"><?php echo strtoupper($row_rsUserInfo['last_name']); ?>, </a><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsUserInfo['username']; ?>','logindetails','scrollbars=yes,width=240,height=275')"><?php echo strtoupper($row_rsUserInfo['first_name']); ?><?php } //End of Basic-UltraDev Simulated Nested Repeat?>
          </a></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsUserInfo['Timelog']; ?>            <div align="center"></div></td>
        </tr>
        <?php 
// technocurve arc 3 php mv block3/3 start
if ($mocolor == $mocolor1) {
	$mocolor = $mocolor2;
} else {
	$mocolor = $mocolor1;
}
// technocurve arc 3 php mv block3/3 end
?>
        <?php } while ($row_rsUserInfo = mysql_fetch_assoc($rsUserInfo)); ?>
      <tr>
        <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsUserInfo);
?>
