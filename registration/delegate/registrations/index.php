<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initDelegates.php'); ?>

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

$colname_rsRegistrations = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsRegistrations = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistrations = sprintf("SELECT delegate_registrations.status, conference.conference_name, conference.conference_theme, delegate_registrations.registration_id, conference.location, conference.start_date, conference.end_date, delegate_registrations.conference_id FROM delegate_registrations, conference WHERE delegate_registrations.delegate_id = %s AND delegate_registrations.conference_id = conference.conference_id AND delegate_registrations.deleted=0", GetSQLValueString($colname_rsRegistrations, "text"));
$rsRegistrations = mysql_query($query_rsRegistrations, $CMS) or die(mysql_error());
$row_rsRegistrations = mysql_fetch_assoc($rsRegistrations);
$totalRows_rsRegistrations = mysql_num_rows($rsRegistrations);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>My Registration</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
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
        <?php require_once('../../includefiles/header.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../../includefiles/leftNavDelegates.php'); ?>
<!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong><?php echo $_SESSION['display_name'];?>'s Registrations</strong></h3>
      
      <?php if ($totalRows_rsRegistrations > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop"><strong>Conference</strong></td>
            <td class="tableTop"><strong>Location</strong></td>
            <td class="tableTop"><strong>Dates</strong></td>
          </tr>
          <?php do { ?>
            <tr>
              <td align="left" valign="top"><a href="../conference/invoice.php?conferenceID=<?php echo $row_rsRegistrations['conference_id']; ?>"><img src="../../images/imgAdminView.gif" alt="View" width="14" height="14" /><?php echo $row_rsRegistrations['conference_name']; ?></a><br /></td>
              <td align="left" valign="top"><?php echo $row_rsRegistrations['location']; ?></td>
              <td align="left" valign="top"><?php echo formatDate($row_rsRegistrations['start_date'],'M. d, Y'); ?> - <?php echo formatDate($row_rsRegistrations['end_date'],'M. d, Y'); ?></td>
            </tr>
            <?php } while ($row_rsRegistrations = mysql_fetch_assoc($rsRegistrations)); ?>
            <tr>
              <td colspan="3" class="tableTop">&nbsp;</td>
            </tr>
        </table>
        <?php } // Show if recordset not empty ?>
        <p>
          </p>
          <?php if ($totalRows_rsRegistrations == 0) { // Show if recordset empty ?>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop"><strong>Conference</strong></td>
            <td class="tableTop"><strong>Location</strong></td>
            <td class="tableTop"><strong>Dates</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top">You have no conference registrations<br /></td>
          </tr>
          <tr>
            <td colspan="3" class="tableTop">&nbsp;</td>
          </tr>
        </table>
        <?php } // Show if recordset empty ?>
        <p>         
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsRegistrations);
?>
