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

$colname_rsConference = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConference = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConference = sprintf("SELECT * FROM conference WHERE conference.deleted = 0 AND conference.conference_id = %s", GetSQLValueString($colname_rsConference, "text"));
$rsConference = mysql_query($query_rsConference, $CMS) or die(mysql_error());
$row_rsConference = mysql_fetch_assoc($rsConference);
$totalRows_rsConference = mysql_num_rows($rsConference);

$colname_rsItems = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsItems = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsItems = sprintf("SELECT * FROM delegate_invoice WHERE delegate_invoice.conference_id=%s AND delegate_invoice.deleted = 0 AND delegate_invoice.type != 'registration' ORDER BY delegate_invoice.label", GetSQLValueString($colname_rsItems, "text"));
$rsItems = mysql_query($query_rsItems, $CMS) or die(mysql_error());
$row_rsItems = mysql_fetch_assoc($rsItems);
$totalRows_rsItems = mysql_num_rows($rsItems);

$colname_rsFees = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsFees = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsFees = sprintf("SELECT * FROM delegate_invoice WHERE delegate_invoice.conference_id=%s AND delegate_invoice.deleted = 0 AND delegate_invoice.type = 'registration' ORDER BY delegate_invoice.amount", GetSQLValueString($colname_rsFees, "text"));
$rsFees = mysql_query($query_rsFees, $CMS) or die(mysql_error());
$row_rsFees = mysql_fetch_assoc($rsFees);
$totalRows_rsFees = mysql_num_rows($rsFees);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Current Conference More Info</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.textheader #contentmain strong {
	font-weight: bold;
	font-size: 11px;
}
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
      <h3><strong><?php echo $row_rsConference['conference_name']; ?></strong></h3>
      <p><?php echo $row_rsConference['conference_theme']; ?><br />
      <?php echo $row_rsConference['location']; ?>, <?php echo $row_rsConference['start_date']; ?> - <?php echo $row_rsConference['end_date']; ?></p>
      <p>Registration begins <strong><?php echo formatDate($row_rsConference['start_date'],'M. d, Y'); ?></strong> and ends <strong><?php echo formatDate($row_rsConference['registration_deadline'],'M. d, Y'); ?></strong>. Late registration begins on <strong><?php echo $row_rsConference['registration_late']; ?></strong>.</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" align="left" valign="top"><p><strong>Registration</strong></p>
              <ul>
                <?php do { ?>
                <li><?php echo $row_rsFees['label']; ?> - <?php echo DoFormatCurrency($row_rsFees['amount'], 2, '.', ',', '$'); ?></li>
                <?php } while ($row_rsFees = mysql_fetch_assoc($rsFees)); ?></ul></td>
          <td align="left" valign="top"><p><strong>Items</strong></p>
            <ol>
              <?php do { ?>
              <li><?php echo $row_rsItems['label']; ?> - <?php echo DoFormatCurrency($row_rsItems['amount'], 2, '.', ',', '$'); ?></li>
              <?php } while ($row_rsItems = mysql_fetch_assoc($rsItems)); ?></ol></td>
        </tr>
      </table></td>
        </tr>
      </table>
      <p><br />
      </p>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConference);

mysql_free_result($rsItems);

mysql_free_result($rsFees);
?>
