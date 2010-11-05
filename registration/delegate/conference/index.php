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

mysql_select_db($database_CMS, $CMS);
$query_rsConferences = "SELECT conference.conference_id, conference.conference_name, conference.conference_theme, conference.location, conference.start_date, conference.end_date, conference.registration_begins, conference.registration_late, conference.registration_deadline, conference.registration_begins, conference.accept_registrations FROM conference WHERE conference.deleted = 0 AND conference.viewable = 1 AND conference.event_type = 'Conference'";
$rsConferences = mysql_query($query_rsConferences, $CMS) or die(mysql_error());
$row_rsConferences = mysql_fetch_assoc($rsConferences);
$totalRows_rsConferences = mysql_num_rows($rsConferences);

mysql_select_db($database_CMS, $CMS);
$query_rsConferenceFull = "SELECT conference.conference_id, conference.conference_name, conference.conference_theme, conference.location, conference.start_date, conference.end_date, conference.registration_begins, conference.registration_late, conference.registration_deadline, conference.registration_begins, conference.accept_registrations, conference_reg_info.live_message FROM conference INNER JOIN conference_reg_info ON conference.conference_id = conference_reg_info.conference_id WHERE conference.deleted = 0 AND conference.viewable = 1 AND conference.event_type = 'Conference'";
$rsConferenceFull = mysql_query($query_rsConferenceFull, $CMS) or die(mysql_error());
$row_rsConferenceFull = mysql_fetch_assoc($rsConferenceFull);
$totalRows_rsConferenceFull = mysql_num_rows($rsConferenceFull);
?>
<?php require_once('../../includefiles/initDelegates.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Current Conference</title>
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
      <h3><strong>Current Conference(s)</strong></h3>
      

      
      <?php if ($totalRows_rsConferenceFull == 0) { // Show if recordset empty ?>
        <p>There are no conferences available at this time.</p>
        <?php } // Show if recordset empty ?>
      <?php if ($totalRows_rsConferenceFull > 0) { // Show if recordset not empty ?>
  <?php do { ?>
          <div>
            <p><strong><?php echo $row_rsConferenceFull['conference_name']; ?></strong><br />
                <?php echo $row_rsConferenceFull['location']; ?><br />
                <?php echo $row_rsConferenceFull['conference_theme']; ?><br />
                <?php echo basicDate($row_rsConferenceFull['start_date']); ?> - <?php echo basicDate($row_rsConferenceFull['end_date']); ?> <br />
              </p>
            <?php if($row_rsConferenceFull['accept_registrations']=='Yes'){?>
            <p>To submit a registration for this conference,  go to the <a href="registration.php?conferenceID=<?php echo $row_rsConferenceFull['conference_id']; ?>"> Registration page</a> .</p>
            <?php } else {?>
            <p><?php echo $row_rsConferenceFull['live_message']; ?></p>
            <?php }?>
                    </div>
    <?php } while ($row_rsConferenceFull = mysql_fetch_assoc($rsConferenceFull)); ?>
  <?php } // Show if recordset not empty ?>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConferences);

mysql_free_result($rsConferenceFull);
?>
