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

$colname_rsRegistration = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsRegistration = $_GET['recordID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistration = sprintf("SELECT associate_registrations.booths, associate_registrations.booth_signage, associate_registrations.`1_preference`, associate_registrations.`2_preference`, associate_registrations.`3_preference`, associate_registrations.`4_preference`, associate_registrations.`5_preference`, associate_registrations.no_preference, associate_registrations.drawing, associate_registrations.status, associate_registrations.date_submitted, associate_registrations.conference_id, conference.conference_name, conference.start_date, conference.end_date, associate_registrations.invoice_no FROM associate_registrations, conference WHERE registration_id = %s AND conference.conference_id = associate_registrations.conference_id", GetSQLValueString($colname_rsRegistration, "text"));
$rsRegistration = mysql_query($query_rsRegistration, $CMS) or die(mysql_error());
$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
$totalRows_rsRegistration = mysql_num_rows($rsRegistration);

$colname_rsTransactions = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsTransactions = $_GET['recordID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransactions = sprintf("SELECT * FROM associate_transactions WHERE registration_id = %s", GetSQLValueString($colname_rsTransactions, "text"));
$rsTransactions = mysql_query($query_rsTransactions, $CMS) or die(mysql_error());
$row_rsTransactions = mysql_fetch_assoc($rsTransactions);
$totalRows_rsTransactions = mysql_num_rows($rsTransactions);

$colname_rsUser = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUser = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsUser = sprintf("SELECT * FROM associate WHERE associate_id = %s", GetSQLValueString($colname_rsUser, "text"));
$rsUser = mysql_query($query_rsUser, $CMS) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);

$colname_rsTransSum = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsTransSum = $_GET['recordID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransSum = sprintf("SELECT associate_transactions.transaction_id, associate_transactions.registration_id, SUM(associate_transactions.transaction_amount) AS trans_sum FROM associate_transactions WHERE registration_id = %s GROUP BY associate_transactions.registration_id", GetSQLValueString($colname_rsTransSum, "text"));
$rsTransSum = mysql_query($query_rsTransSum, $CMS) or die(mysql_error());
$row_rsTransSum = mysql_fetch_assoc($rsTransSum);
$totalRows_rsTransSum = mysql_num_rows($rsTransSum);

$colname2_rsBooths = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsBooths = $_SESSION['userID'];
}
$colname1_rsBooths = "-1";
if (isset($_GET['conferenceID'])) {
  $colname1_rsBooths = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsBooths = sprintf("SELECT associate_booth.registration_id, associate_booth.associate_id, CONCAT_WS(',',associate_booth.`number`, associate_booth.info) AS booth FROM associate_booth WHERE associate_booth.conference_id = %s AND associate_booth.associate_id = %s", GetSQLValueString($colname1_rsBooths, "text"),GetSQLValueString($colname2_rsBooths, "text"));
$rsBooths = mysql_query($query_rsBooths, $CMS) or die(mysql_error());
$row_rsBooths = mysql_fetch_assoc($rsBooths);
$totalRows_rsBooths = mysql_num_rows($rsBooths);

$colname_rsRegInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsRegInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT * FROM associate_reg_info WHERE associate_reg_info.conference_id = %s", GetSQLValueString($colname_rsRegInfo, "text"));
$rsRegInfo = mysql_query($query_rsRegInfo, $CMS) or die(mysql_error());
$row_rsRegInfo = mysql_fetch_assoc($rsRegInfo);
$totalRows_rsRegInfo = mysql_num_rows($rsRegInfo);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<style type="text/css">
<!--
.centerbutton {
	text-align: center;
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

      <h1><?php echo $row_rsRegistration['conference_name']; ?></h1>
      <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
        
        <tr>
          <td colspan="4" class="labels"><div align="left"><strong><?php echo $row_rsUser['org_name']; ?> Information</strong></div></td>
        </tr>
        <tr>
          <td class="labels">Status:</td>
          <td class="labelsDetails"><?php echo $row_rsRegistration['status']; ?></td>
          <td class="labels">Contact:</td>
          <td class="labelsDetails"><?php echo $_SESSION['display_name'];?></td>
        </tr>
        <tr>
          <td class="labels">Provides:</td>
          <td nowrap="nowrap" class="labelsDetails"><?php echo $row_rsUser['provides']; ?></td>
          <td class="labels">Email:</td>
          <td class="labelsDetails"><?php echo $row_rsUser['email']; ?></td>
        </tr>
        <tr>
          <td class="labels">Seaho Years:</td>
          <td class="labelsDetails"><?php echo $row_rsUser['seaho_years']; ?></td>
          <td class="labels">Alt Email:</td>
          <td class="labelsDetails"><?php echo $row_rsUser['alt_email']; ?></td>
        </tr>
        
        <tr>
          <td colspan="4" class="labels"><div align="left"><strong>Registration Information</strong></div></td>
        </tr>
        <tr>
          <td valign="top" nowrap="nowrap" class="labels">Drawing:</td>
          <td class="labelsDetails"><?php if($row_rsRegistration['drawing']==1){ echo "Yes";} else { echo "No";}; ?></td>
          <td valign="top" nowrap="nowrap" class="labels">Booth Preferences:</td>
          <td class="labelsDetails">
            <?php echo $row_rsRegistration['1_preference']; ?>&nbsp; <?php echo $row_rsRegistration['2_preference']; ?>&nbsp;
			<?php echo $row_rsRegistration['3_preference']; ?>&nbsp; <?php echo $row_rsRegistration['4_preference']; ?>&nbsp; <?php echo $row_rsRegistration['5_preference']; ?>&nbsp; <?php echo $row_rsRegistration['no_preference']; ?></td>
        </tr>
        <tr>
          <td valign="top" nowrap="nowrap" class="labels">Booth Signage:</td>
          <td colspan="3" class="labelsDetails"><?php echo $row_rsRegistration['booth_signage']; ?></td>
        </tr>
        <tr>
          <td valign="top" class="labels">Status:</td>
          <td class="labelsDetails"><?php echo $row_rsRegistration['status']; ?></td>
          <td valign="top" class="labels">Date Submitted:</td>
          <td class="labelsDetails"><?php echo formatDate($row_rsRegistration['date_submitted'],'m/d/y h:i:s A'); ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap" class="labels">Assigned Booth(s):</td>
          <td class="labelsDetails"><?php do { ?>
              <?php echo $row_rsBooths['booth']; ?>&nbsp;
              <?php } while ($row_rsBooths = mysql_fetch_assoc($rsBooths)); ?></td>
          <td valign="top" class="labels">&nbsp;</td>
          <td class="labelsDetails">&nbsp;</td>
        </tr>
        <tr>
          <td class="labelsDetails">&nbsp;</td>
          <td class="labelsDetails">&nbsp;</td>
          <td valign="top" class="labelsDetails">&nbsp;</td>
          <td class="labelsDetails">&nbsp;</td>
        </tr>
      </table>
<br />
<br />
      <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
        <tr>
          <td class="labels"><div align="left"><strong>Registration Transactions</strong></div></td>
          <td class="labels">&nbsp;</td>
          <td class="labels">&nbsp;</td>
          <td bgcolor="#FFFFFF"><span class="centerbutton">
            <input name="button" type="button" id="button" onclick="MM_goToURL('parent','invoice.php?registrationID=<?php echo $row_rsTransactions['registration_id']; ?>&amp;infoID=<?php echo $row_rsRegistration['conference_id']; ?>');return document.MM_returnValue" value="Pay By Check" />
          </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php do { ?>
        <tr>
          <td><?php echo $row_rsTransactions['label']; ?>&nbsp;</td>
          <td><?php echo $row_rsTransactions['transaction_type']; ?>&nbsp;</td>
          <td><?php echo formatDate($row_rsTransactions['date_entered'],'m/d/Y h:i:s A'); ?>&nbsp;</td>
          <td><div align="right"><?php echo DoFormatCurrency($row_rsTransactions['transaction_amount'], 2, '.', ',', '$'); ?>&nbsp;</div></td>
        </tr>
        <?php } while ($row_rsTransactions = mysql_fetch_assoc($rsTransactions)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;
            <?php if($row_rsTransSum['trans_sum']==11111111){?><form action="https://www.paypal.com/cgi-bin/webscr" method="post">

            <div align="right">
              <input type="hidden" name="cmd" value="_xclick">
              
                <input type="hidden" name="bn" value="webassist.dreamweaver.4_0_3">
              
                <input type="hidden" name="business" value="rbrown@regent.edu">
              
                <input type="hidden" name="item_name" value="<?php echo $row_rsUser['org_name']."'s Registraion"; ?>" />
              
                <input type="hidden" name="item_number" value="<?php echo $row_rsRegistration['invoice_no']; ?>" />
              
                <input type="hidden" name="amount" value="<?php echo $row_rsTransSum['trans_sum'];?>">
              
                <input type="hidden" name="currency_code" value="USD">
              
                <input type="hidden" name="undefined_quantity" value="0">
              
                <input type="hidden" name="receiver_email" value="rbrown@regent.edu">
              
                <input type="hidden" name="mrb" value="R-3WH47588B4505740X">
              
                <input type="hidden" name="pal" value="ANNSXSLJLYR2A">
              
                <input type="hidden" name="no_shipping" value="0">
              
                <input type="hidden" name="no_note" value="0">
              
                <input type="image" name="submit" src="http://images.paypal.com/images/x-click-but03.gif" border="0" alt="Make payments with PayPal, it's fast, free, and secure!">
            </div>
          </form><?php }?></td>
          <td><div align="right">Total:&nbsp;&nbsp;<?php echo DoFormatCurrency($row_rsTransSum['trans_sum'], 2, '.', ',', '$'); ?></div></td>
        </tr>
        <tr>
          <td colspan="4"><strong>To adjust invoice contact:</strong><br />
          <?php echo $row_rsRegInfo['committee_contacts']; ?></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsRegistration);

mysql_free_result($rsTransactions);

mysql_free_result($rsUser);

mysql_free_result($rsTransSum);

mysql_free_result($rsBooths);

mysql_free_result($rsRegInfo);
?>