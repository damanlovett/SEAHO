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
$query_rsCurrentConferences = "SELECT conference.conference_id, conference.conference_name, conference.conference_theme, conference.location, DATE_FORMAT(conference.start_date,'%M %d, %Y') AS startdate, DATE_FORMAT(conference.end_date,'%M %d %Y') AS enddate, DATE_FORMAT(conference.registration_deadline,'%M %d, %Y') AS registration_deadline, associate_reg_info.conference_id, associate_reg_info.accepting_registrations, DATE_FORMAT(associate_reg_info.registration_begins,'%M %d, %Y') AS regBeg, DATE_FORMAT(associate_reg_info.registration_ends, '%M %d, %Y') AS regEnd, associate_reg_info.registration_begins, associate_reg_info.registration_ends FROM conference, associate_reg_info WHERE (conference.conference_id = associate_reg_info.conference_id) AND associate_reg_info.accepting_registrations = 1 AND conference.event_type ='Conference'";
$rsCurrentConferences = mysql_query($query_rsCurrentConferences, $CMS) or die(mysql_error());
$row_rsCurrentConferences = mysql_fetch_assoc($rsCurrentConferences);
$totalRows_rsCurrentConferences = mysql_num_rows($rsCurrentConferences);
?>
<?php require_once('../../includefiles/initAssociates.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Current Conferences</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
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
      <h1><strong>Current Conference Information</strong></h1>
      
      <?php if ($totalRows_rsCurrentConferences == 0) { // Show if recordset empty ?>
        <p> There are no conferences accepting registrations at this time.</p>
        <?php } // Show if recordset empty ?>
        <?php if ($totalRows_rsCurrentConferences > 0) { // Show if recordset not empty ?>
  <p>Below is a list of the conferences that are currently accepting registration. </p>
  <p></p>
  <p>
    <?php do { ?>
      <span class="lineHeight">
        <strong><?php echo $row_rsCurrentConferences['conference_name']; ?>&nbsp;
          <?php if(isset($row_rsCurrentConferences['conference_theme'])) { // Show if there is a theme ?>
          - &quot;<?php echo $row_rsCurrentConferences['conference_theme']; ?>&quot;
          <?php }?>
          </strong><br />
        <?php echo $row_rsCurrentConferences['location']; ?><br />
        <?php echo $row_rsCurrentConferences['startdate']; ?> - <?php echo $row_rsCurrentConferences['enddate']; ?><br />
        Registration Begins: <?php echo $row_rsCurrentConferences['regBeg']; ?><br />
        Registration Ends: <?php echo $row_rsCurrentConferences['regEnd']; ?><br />
        [ <a href="moreinfo.php?recordID=<?php echo $row_rsCurrentConferences['conference_id']; ?>">More Information</a> ] 
		<?php if($row_rsCurrentConferences['accepting_registrations']==1){?>[ <a href="../registration/new.php?conferenceID=<?php echo $row_rsCurrentConferences['conference_id']; ?>">Submit Registration</a> ]</span><?php }?><br />
		</MM:DECORATION></MM_REPEATEDREGION>
  </p>
  <hr />
        <p>
          <MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1>
            <?php } while ($row_rsCurrentConferences = mysql_fetch_assoc($rsCurrentConferences)); ?>
        </p>
          <?php } // Show if recordset not empty ?>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCurrentConferences);
?>
