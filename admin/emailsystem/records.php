<?php require_once('../../Connections/Directory.php'); ?>
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
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>
<?php


emailRecord($_POST['title'],$_POST['group'],$_POST['emailmessage']);

$colname_rsEmails = "-1";
if (isset($_POST['group'])) {
  $colname_rsEmails = $_POST['group'];
}
$colname_rsEmails = "-1";
if (isset($_POST['group'])) {
  $colname_rsEmails = (get_magic_quotes_gpc()) ? $_POST['group'] : addslashes($_POST['group']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsEmails = sprintf("SELECT team_positions.position_id, team_positions.user_id, team_positions.`position`, team_positions.`group`, team_positions.`delete`, users.user_id, users.first_name, users.last_name, users.email FROM team_positions, users WHERE team_positions.`group` = %s AND team_positions.user_id = users.user_id GROUP BY team_positions.user_id", GetSQLValueString($colname_rsEmails, "text"));
$rsEmails = mysql_query($query_rsEmails, $Directory) or die(mysql_error());
$row_rsEmails = mysql_fetch_assoc($rsEmails);
$totalRows_rsEmails = mysql_num_rows($rsEmails);

mysql_select_db($database_Directory, $Directory);
$query_rsAllEmails = "SELECT team_positions.position_id, team_positions.user_id, team_positions.`position`, team_positions.`group`, team_positions.`delete`, users.user_id, users.first_name, users.last_name, users.email FROM team_positions, users WHERE team_positions.user_id = users.user_id GROUP BY team_positions.user_id";
$rsAllEmails = mysql_query($query_rsAllEmails, $Directory) or die(mysql_error());
$row_rsAllEmails = mysql_fetch_assoc($rsAllEmails);
$totalRows_rsAllEmails = mysql_num_rows($rsAllEmails);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Email System Confirmation</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadSystemAdmin">Email System Confirmation</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div class="pageInformation">
  <?php if($_POST['group']!="Leadership Team"){?>
  <div class="homepageBlocks"> <?php echo $_POST['group'];?> </div>
  <div>
    <?php do { ?>
      <?php systemEmail($_REQUEST['title'],$_REQUEST['emailmessage'],$row_rsEmails['email'],$row_rsEmails['first_name'],$row_rsEmails['last_name']);?>
      <?php } while ($row_rsEmails = mysql_fetch_assoc($rsEmails)); ?>
  </div>
  <?php } else { ?>
  <div class="homepageBlocks"> <?php echo $_POST['group'];?> </div>
  <div>
    <?php do { ?>
      <?php systemEmail($_REQUEST['title'],$_REQUEST['emailmessage'],$row_rsAllEmails['email'],$row_rsAllEmails['first_name'],$row_rsAllEmails['last_name']);?>
      <?php } while ($row_rsAllEmails = mysql_fetch_assoc($rsAllEmails)); ?>
  </div>
  <?php }?>
    </div>    
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEmails);

mysql_free_result($rsAllEmails);
?>
