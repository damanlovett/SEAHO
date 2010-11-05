<?php require_once('../../../Connections/Programming.php'); ?>
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
<?php require_once('../../includefiles/initEmails.php'); ?>
<?php


//  PROGRAM RECORDSET (Emails) //
$colname_rsEmails = "-1";
if (isset($_POST['status'])) {
  $colname_rsEmails = $_POST['status'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsEmails = sprintf("SELECT ProgramTitle, FirstName, EmailAddress, Status FROM callforprograms WHERE Status = %s", GetSQLValueString($colname_rsEmails, "text"));
$rsEmails = mysql_query($query_rsEmails, $Programming) or die(mysql_error());
$row_rsEmails = mysql_fetch_assoc($rsEmails);
$totalRows_rsEmails = mysql_num_rows($rsEmails);



//  COMMITTEE RECORDSET (EmailCommittee) //
mysql_select_db($database_Programming, $Programming);
$query_rsEmailCommittee = "SELECT users.id, users.userID, users.first_name, users.last_name, users.email FROM users WHERE users.`delete`=0 AND users.active = 1";
$rsEmailCommittee = mysql_query($query_rsEmailCommittee, $Programming) or die(mysql_error());
$row_rsEmailCommittee = mysql_fetch_assoc($rsEmailCommittee);
$totalRows_rsEmailCommittee = mysql_num_rows($rsEmailCommittee);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Email Confirmation</title>
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
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/LCCMPHemails.jpg" alt="email" width="65" height="51" />System Comfirmation <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" -->
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
<div class="pageInformation">
  <p>
    <?php if($_REQUEST['emailgroup'] == "presenters") {  ?>
    <?php do { ?>
      <?php presenterEmail($row_rsEmails['FirstName'],$_REQUEST['subject'],$row_rsEmails['EmailAddress'],$row_rsEmails['ProgramTitle'],$_REQUEST['emailmessage']);?>
      <?php echo "Email sent to ".$row_rsEmails['FirstName']." - <strong>".$row_rsEmails['EmailAddress']."</strong><br />";?>
      <?php } while ($row_rsEmails = mysql_fetch_assoc($rsEmails)); ?>
    <?php }?>
    
    
    <?php if(($_REQUEST['emailgroup'] == "committee") && ($_REQUEST['status'] == "All")) {  ?>
    <?php do { ?>
      <?php generalEmail($_REQUEST['subject'],$row_rsEmailCommittee['email'],$_REQUEST['emailmessage'])?>
      <?php echo "Email sent to ".$row_rsEmailCommittee['first_name']." - <strong>".$row_rsEmailCommittee['email']."</strong><br />";?>
      <?php } while ($row_rsEmailCommittee = mysql_fetch_assoc($rsEmailCommittee)); ?>
    <?php }?>
    
    
    <?php if(($_REQUEST['emailgroup'] == "committee") && ($_REQUEST['status'] != "All")) {  ?>
    <?php generalEmail($_REQUEST['subject'],$_REQUEST['status'],$_REQUEST['emailmessage'])?>
    <?php echo "Email sent to ".$row_rsEmailCommittee['first_name']." - <strong>".$_REQUEST['status']."</strong><br />";?>
    <?php }?>
    
    
    <?php if($_REQUEST['emailgroup'] == "anyone") {  ?>
    <?php generalEmail($_REQUEST['subject'],$_REQUEST['status'],$_REQUEST['emailmessage'])?>
    <?php echo "Email sent to - <strong>".$_REQUEST['status']."</strong><br />";?>
    <?php }?>
    
    
    <?php emailRecord($_REQUEST['subject'],$_REQUEST['status'],$_REQUEST['emailmessage']);?>
  </p>
  <p> All emails have been sent</p>
    </div>
	<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>

<?php
mysql_free_result($rsEmails);

mysql_free_result($rsEmailCommittee);
?>
