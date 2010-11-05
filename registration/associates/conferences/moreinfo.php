<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php $_SESSION['conference_id'] = $_GET['recordID'];?>
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

$colname_rsConferenceInformation = "-1";
if (isset($_SESSION['conference_id'])) {
  $colname_rsConferenceInformation = $_SESSION['conference_id'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConferenceInformation = sprintf("SELECT * FROM associate_reg_info, conference WHERE associate_reg_info.conference_id = %s AND associate_reg_info.conference_id = conference.conference_id", GetSQLValueString($colname_rsConferenceInformation, "text"));
$rsConferenceInformation = mysql_query($query_rsConferenceInformation, $CMS) or die(mysql_error());
$row_rsConferenceInformation = mysql_fetch_assoc($rsConferenceInformation);
$totalRows_rsConferenceInformation = mysql_num_rows($rsConferenceInformation);

$colname_rsConferenceFees = "-1";
if (isset($_SESSION['conference_id'])) {
  $colname_rsConferenceFees = $_SESSION['conference_id'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConferenceFees = sprintf("SELECT label, amount FROM associate_fees WHERE conference_id = %s", GetSQLValueString($colname_rsConferenceFees, "text"));
$rsConferenceFees = mysql_query($query_rsConferenceFees, $CMS) or die(mysql_error());
$row_rsConferenceFees = mysql_fetch_assoc($rsConferenceFees);
$totalRows_rsConferenceFees = mysql_num_rows($rsConferenceFees);
?>
<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php $_SESSION['conference_id'] = $_GET['recordID'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
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
      <?php require_once('../../includefiles/headerAssociateHome.php'); ?>

    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
<?php require_once('../../includefiles/leftNavAssociates.php'); ?>
      <!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h1><?php echo $row_rsConferenceInformation['conference_name']; ?></h1>
      <table border="0" cellpadding="0" cellspacing="0" class="tableBasic">
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Conference:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo $row_rsConferenceInformation['conference_name']; ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Theme:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo $row_rsConferenceInformation['conference_theme']; ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Location:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo $row_rsConferenceInformation['location']; ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Dates:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo formatDate($row_rsConferenceInformation['start_date'],'M d, Y'); ?> - <?php echo formatDate($row_rsConferenceInformation['end_date'],'M d, Y'); ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Registration begins:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo basicDate($row_rsConferenceInformation['registration_begins']); ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Late Registration:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo basicDate($row_rsConferenceInformation['late_registration']); ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Registration Ends:</h2>
          </div></td>
          <td nowrap="nowrap"><?php echo basicDate($row_rsConferenceInformation['registration_ends']); ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap"><div align="right">
            <h2>Accepting Registrations:</h2>
          </div></td>
          <td nowrap="nowrap"><?php if($row_rsConferenceInformation['accepting_registrations']==1) {echo "Yes";} else {echo "No";}; ?></td>
        </tr>
        <?php do { ?>
          <tr>
            <td nowrap="nowrap"><h2><?php echo $row_rsConferenceFees['label']; ?>:</h2></td>
            <td nowrap="nowrap">$<?php echo $row_rsConferenceFees['amount']; ?></td>
          </tr>
          <?php } while ($row_rsConferenceFees = mysql_fetch_assoc($rsConferenceFees)); ?>
      </table>
      <p>&nbsp;</p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConferenceInformation);

mysql_free_result($rsConferenceFees);
?>
