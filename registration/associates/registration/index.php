<?php require_once('../../../Connections/CMS.php'); ?>
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
<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php
$colname_rsRegistrations = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsRegistrations = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistrations = sprintf("SELECT associate_registrations.registration_id, associate_registrations.conference_id, associate_registrations.associate_id, conference.conference_name, associate_transactions.transaction_amount, associate_transactions.registration_id, conference.start_date, conference.end_date, SUM(associate_transactions.transaction_amount) AS trans_sum, associate_registrations.status FROM associate_registrations, conference, associate_transactions WHERE associate_registrations.associate_id = %s AND associate_transactions.registration_id = associate_registrations.registration_id AND associate_registrations.conference_id = conference.conference_id AND associate_registrations.deleted=0 GROUP BY associate_transactions.registration_id", GetSQLValueString($colname_rsRegistrations, "text"));
$rsRegistrations = mysql_query($query_rsRegistrations, $CMS) or die(mysql_error());
$row_rsRegistrations = mysql_fetch_assoc($rsRegistrations);
$totalRows_rsRegistrations = mysql_num_rows($rsRegistrations);

$colname_rsRegNoTrans = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsRegNoTrans = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegNoTrans = sprintf("SELECT associate_registrations.registration_id, associate_registrations.conference_id, associate_registrations.associate_id, conference.conference_name, conference.start_date, conference.end_date, associate_registrations.status FROM associate_registrations, conference WHERE ( associate_registrations.associate_id = %s ) AND associate_registrations.conference_id = conference.conference_id AND associate_registrations.deleted=0", GetSQLValueString($colname_rsRegNoTrans, "text"));
$rsRegNoTrans = mysql_query($query_rsRegNoTrans, $CMS) or die(mysql_error());
$row_rsRegNoTrans = mysql_fetch_assoc($rsRegNoTrans);
$totalRows_rsRegNoTrans = mysql_num_rows($rsRegNoTrans);

$colname_rsRegistrationsNew = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsRegistrationsNew = (get_magic_quotes_gpc()) ? $_SESSION['userID'] : addslashes($_SESSION['userID']);
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistrationsNew = sprintf("SELECT associate_registrations.registration_id, associate_registrations.conference_id, conference.conference_id, conference.conference_name, associate.associate_id, associate_registrations.status FROM associate_registrations, conference, associate WHERE associate.associate_id=%s AND associate_registrations.conference_id = conference.conference_id AND associate_registrations.deleted=0 GROUP BY associate.associate_id", GetSQLValueString($colname_rsRegistrationsNew, "text"));
$rsRegistrationsNew = mysql_query($query_rsRegistrationsNew, $CMS) or die(mysql_error());
$row_rsRegistrationsNew = mysql_fetch_assoc($rsRegistrationsNew);
$totalRows_rsRegistrationsNew = mysql_num_rows($rsRegistrationsNew);



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
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
      <div align="center"><?php require_once('../../includefiles/headerAssociateHome.php'); ?>
</div>
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

      <h1><?php echo $_SESSION['display_name'];?>'s Registrations</h1>
      
      <?php if ($totalRows_rsRegistrations > 0) { // Show if recordset not empty ?>
      <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
        <tr>
          <td class="tableTop"><?php echo $totalRows_rsRegistrations ?> Registration(s)</td>
          <td class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;</td>
        </tr>
        <tr>
          <th>Conference</th>
          <th>&nbsp;</th>
          <th>Dates</th>
          <th>&nbsp;</th>
          <th>Status</th>
          <th>Reps</th>
          <th>Balance</th>
        </tr>
        <?php do { ?>
        <tr>
          <td class="tablerows"><a href="regdetails.php?recordID=<?php echo $row_rsRegistrations['registration_id']; ?>&amp;conferenceID=<?php echo $row_rsRegistrations['conference_id']; ?>"><?php echo $row_rsRegistrations['conference_name']; ?></a></td>
          <td class="tablerows">&nbsp;</td>
          <td class="tablerows"><?php echo basicDate($row_rsRegistrations['start_date']); ?> - <?php echo basicDate($row_rsRegistrations['end_date']); ?></td>
          <td class="tablerows">&nbsp;</td>
          <td class="tablerows"><?php echo $row_rsRegistrations['status']; ?></td>
          <td class="tablerows"><div align="center"><a href="reps.php?recordID=<?php echo $row_rsRegistrations['registration_id']; ?>"><img src="../../images/imgAdminView.gif" alt="View" width="14" height="14" /></a></div></td>
          <td class="tablerows"><?php echo DoFormatCurrency($row_rsRegistrations['trans_sum'], 2, '.', ',', '$'); ?></td>
        </tr>
        <?php } while ($row_rsRegistrations = mysql_fetch_assoc($rsRegistrations)); ?>
        <tr>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
          <td class="tableBottom">&nbsp;</td>
        </tr>
      </table>
        <br />
        <br />
        <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsRegistrations == 0) { // Show if recordset empty ?>
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Conference</th>
            <th>&nbsp;</th>
            <th>Dates</th>
            <th>&nbsp;</th>
            <th>Status</th>
            <th>&nbsp;</th>
          </tr>
            <?php do { ?><tr>
              <td colspan="6" class="tablerows">You have not registered for any conferences.</td>
              </tr>
            <?php } while ($row_rsRegNoTrans = mysql_fetch_assoc($rsRegNoTrans)); ?>
          <tr>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
          </tr>
        </table>
        <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsRegistrations);

mysql_free_result($rsRegNoTrans);

mysql_free_result($rsRegistrationsNew);
?>
