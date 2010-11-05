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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "fees")) {
  $insertSQL = sprintf("INSERT INTO associate_transactions (transaction_id, registration_id, associate_id, label, transaction_type, transaction_amount, date_entered, entered_by) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['transaction_id'], "text"),
                       GetSQLValueString($_POST['registration_id'], "text"),
                       GetSQLValueString($_POST['associate_id'], "text"),
                       GetSQLValueString($_POST['label'], "text"),
                       GetSQLValueString($_POST['transaction_type'], "text"),
                       GetSQLValueString($_POST['transaction_amount'], "double"),
                       GetSQLValueString($_POST['date_entered'], "text"),
                       GetSQLValueString($_POST['entered_by'], "text"));
  sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());
}

if ((isset($_GET['transaction_id'])) && ($_GET['transaction_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM associate_transactions WHERE transaction_id=%s",
                       GetSQLValueString($_GET['transaction_id'], "text"));
  sqlQueryLog($deleteSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($deleteSQL, $CMS) or die(mysql_error());
}
?>
<?php

$colname_rsConferenceInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConferenceInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConferenceInfo = sprintf("SELECT conference_id, conference_name, conference_theme, location, start_date, end_date, registration_begins, registration_late, registration_deadline, event_type, accept_registrations, post_conference, confirmation_email_id, admin_email, support_email, custom_invoice_notes, checks_payable_to, send_payment_to, payment_terms_check, payment_terms_credit, representatives_included FROM conference WHERE conference_id = %s", GetSQLValueString($colname_rsConferenceInfo, "text"));
$rsConferenceInfo = mysql_query($query_rsConferenceInfo, $CMS) or die(mysql_error());
$row_rsConferenceInfo = mysql_fetch_assoc($rsConferenceInfo);
$totalRows_rsConferenceInfo = mysql_num_rows($rsConferenceInfo);

$colname_rsFees = "-1";
if (isset($_SESSION['conferenceID'])) {
  $colname_rsFees = $_SESSION['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsFees = sprintf("SELECT fee_id, conference_id, label, `description`, type, amount FROM associate_fees WHERE conference_id = %s", GetSQLValueString($colname_rsFees, "text"));
$rsFees = mysql_query($query_rsFees, $CMS) or die(mysql_error());
$row_rsFees = mysql_fetch_assoc($rsFees);
$totalRows_rsFees = mysql_num_rows($rsFees);

$colname_rsRegInfo = "-1";
if (isset($_SESSION['conferenceID'])) {
  $colname_rsRegInfo = $_SESSION['conferenceID'];
}
$colname2_rsRegInfo = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsRegInfo = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT registration_id, conference_id, associate_id, associate_registrations.invoice_no FROM associate_registrations WHERE conference_id = %s AND associate_id = %s", GetSQLValueString($colname_rsRegInfo, "text"),GetSQLValueString($colname2_rsRegInfo, "text"));
$rsRegInfo = mysql_query($query_rsRegInfo, $CMS) or die(mysql_error());
$row_rsRegInfo = mysql_fetch_assoc($rsRegInfo);
$totalRows_rsRegInfo = mysql_num_rows($rsRegInfo);

// Set Local Sessions
$_SESSION['registration_id'] = $row_rsRegInfo['registration_id'];
$_SESSION['conferenceID'] = $row_rsRegInfo['conference_id'];

$colname_rsItems = "-1";
if (isset($_SESSION['conferenceID'])) {
  $colname_rsItems = $_SESSION['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsItems = sprintf("SELECT fee_id, conference_id, label, `description`, type, amount FROM associate_items WHERE conference_id = %s", GetSQLValueString($colname_rsItems, "text"));
$rsItems = mysql_query($query_rsItems, $CMS) or die(mysql_error());
$row_rsItems = mysql_fetch_assoc($rsItems);
$totalRows_rsItems = mysql_num_rows($rsItems);

$colname_rsTransactions = "-1";
if (isset($_SESSION['registration_id'])) {
  $colname_rsTransactions = $_SESSION['registration_id'];
}
$colname2_rsTransactions = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsTransactions = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransactions = sprintf("SELECT transaction_id, registration_id, associate_id, label, transaction_type, transaction_description, transaction_amount, date_entered, entered_by FROM associate_transactions WHERE registration_id = %s AND associate_id = %s", GetSQLValueString($colname_rsTransactions, "text"),GetSQLValueString($colname2_rsTransactions, "text"));
$rsTransactions = mysql_query($query_rsTransactions, $CMS) or die(mysql_error());
$row_rsTransactions = mysql_fetch_assoc($rsTransactions);
$totalRows_rsTransactions = mysql_num_rows($rsTransactions);

$colname_rsTransSum = "-1";
if (isset($_SESSION['registration_id'])) {
  $colname_rsTransSum = $_SESSION['registration_id'];
}
$colname2_rsTransSum = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsTransSum = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransSum = sprintf("SELECT transaction_id, registration_id, associate_id, label, transaction_type, transaction_description, transaction_amount, SUM(transaction_amount) AS transaction_sume, date_entered, entered_by FROM associate_transactions WHERE registration_id = %s AND associate_id = %s GROUP BY registration_id", GetSQLValueString($colname_rsTransSum, "text"),GetSQLValueString($colname2_rsTransSum, "text"));
$rsTransSum = mysql_query($query_rsTransSum, $CMS) or die(mysql_error());
$row_rsTransSum = mysql_fetch_assoc($rsTransSum);
$totalRows_rsTransSum = mysql_num_rows($rsTransSum);

$colname_rsUser = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUser = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsUser = sprintf("SELECT org_name, first_name, last_name FROM associate WHERE associate_id = %s", GetSQLValueString($colname_rsUser, "text"));
$rsUser = mysql_query($query_rsUser, $CMS) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);


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
      <h1>Registration Fees</h1>
      <fieldset class="basicInfoFieldSet">
      <?php echo $row_rsConferenceInfo['conference_name']; ?><br />
      <?php echo $row_rsConferenceInfo['conference_theme']; ?><br />
      <?php echo $row_rsConferenceInfo['location']; ?><br />
      <?php echo basicDate($row_rsConferenceInfo['start_date']); ?> - <?php echo basicDate($row_rsConferenceInfo['end_date']); ?></fieldset>
      <br />
      <br />
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
            <tr>
              <th colspan="5" nowrap="nowrap">Registration Fees</th>
              </tr>
            <?php do { ?>
              <tr>
                  <td width="6%" nowrap="nowrap" class="labels"><?php echo $row_rsFees['label']; ?></td>
                  <td width="1%" nowrap="nowrap" class="labelsDetails">&nbsp;</td>
                  <td width="13%" nowrap="nowrap" class="labelsDetails"><div align="right"><?php echo DoFormatCurrency($row_rsFees['amount'], 2, '.', ',', '$'); ?></div></td>
                  <td width="4%" class="labelsDetails">&nbsp;</td>
                <td width="76%" class="labelsDetails"><form id="registrationFees" name="fees" method="POST" action="<?php echo $editFormAction; ?>">
                      <input type="submit" name="regFees" id="regFees" value="Add" />
                      <input name="transaction_id" type="hidden" id="transaction_id" value="<?php echo create_guid();?>" />
                                                <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
                                                <input name="associate_id" type="hidden" id="associate_id" value="<?php echo $row_rsRegInfo['associate_id']; ?>" />
                                                <input name="label" type="hidden" id="label" value="<?php echo $row_rsFees['label']; ?>" />
                                                <input name="transaction_type" type="hidden" id="transaction_type" value="<?php echo $row_rsFees['type']; ?>" />
                                                <input name="transaction_amount" type="hidden" id="transaction_amount" value="<?php echo $row_rsFees['amount']; ?>" />
                                                <input name="date_entered" type="hidden" id="date_entered" value="<?php echo $systemDate;?>" />
                                                <input name="entered_by" type="hidden" id="entered_by" value="<?php echo $_SESSION['display_name'];?>" />
                                                <input type="hidden" name="MM_insert" value="fees" />
                </form></td>
              </tr>
                            <?php } while ($row_rsFees = mysql_fetch_assoc($rsFees)); ?>

              <tr>
                <th colspan="5" nowrap="nowrap">Registration Items</th>
              </tr>
              <?php do { ?>
                <tr>
                  <td class="labels"><?php echo $row_rsItems['label']; ?></td>
                  <td nowrap="nowrap" class="labelsDetails">&nbsp;</td>
                  <td nowrap="nowrap" class="labelsDetails"><div align="right"><?php echo DoFormatCurrency($row_rsItems['amount'], 2, '.', ',', '$'); ?></div></td>
                  <td class="labelsDetails">&nbsp;</td>
                  <td class="labelsDetails"><form id="registrationFees2" name="fees" method="post" action="<?php echo $editFormAction; ?>">
                    <input type="submit" name="regFees" id="regFees" value="Add" />
                    <input name="transaction_id" type="hidden" id="transaction_id" value="<?php echo create_guid();?>" />
                    <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
                    <input name="associate_id" type="hidden" id="associate_id" value="<?php echo $row_rsRegInfo['associate_id']; ?>" />
                    <input name="label" type="hidden" id="label" value="<?php echo $row_rsItems['label']; ?>" />
                    <input name="transaction_type" type="hidden" id="transaction_type" value="<?php echo $row_rsItems['type']; ?>" />
                    <input name="transaction_amount" type="hidden" id="transaction_amount" value="<?php echo $row_rsItems['amount']; ?>" />
                    <input name="date_entered" type="hidden" id="date_entered" value="<?php echo $systemDate;?>" />
                    <input name="entered_by" type="hidden" id="entered_by" value="<?php echo $_SESSION['display_name'];?>" />
                    <input type="hidden" name="MM_insert" value="fees" />
                  </form></td>
                </tr>
                <?php } while ($row_rsItems = mysql_fetch_assoc($rsItems)); ?>
          </table></td>
        </tr>
      </table>
<br />
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">Invoice Items</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><div align="right">
          <input name="button" type="button" id="button" onclick="MM_goToURL('parent','invoice.php?registrationID=<?php echo $row_rsTransactions['registration_id']; ?>&amp;infoID=<?php echo $row_rsFees['conference_id']; ?>');return document.MM_returnValue" value="Pay By Check" />
        </div></td>
      </tr>
      <tr>
        <th>Item</th>
        <th>&nbsp;</th>
        <th>Type</th>
        <th>&nbsp;</th>
        <th><div align="right">Amount</div></th>
      </tr>
      <?php do { ?>
        <tr>
          <td nowrap="nowrap" class="tablerows"><a href="newinvoice.php?transaction_id=<?php echo $row_rsTransSum['transaction_id']; ?>&amp;conferenceID=<?php echo $row_rsRegInfo['conference_id']; ?>"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></a>&nbsp;&nbsp;<?php echo $row_rsTransactions['label']; ?></td>
          <td class="tablerows">&nbsp;</td>
          <td class="tablerows"><?php echo $row_rsTransactions['transaction_type']; ?>&nbsp;</td>
          <td class="tablerows">&nbsp;</td>
          <td class="tablerows"><div align="right"><?php echo DoFormatCurrency($row_rsTransactions['transaction_amount'], 2, '.', ',', '$'); ?></div></td>
        </tr>
        <?php } while ($row_rsTransactions = mysql_fetch_assoc($rsTransactions)); ?>
      <tr>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom">&nbsp;</td>
        <td class="tableBottom"><div align="right"><span class="tableTop"><?php if($row_rsTransSum['transaction_sume']>0){?><form action="https://www.paypal.com/cgi-bin/webscr" method="post">

            <div align="right">
              <input type="hidden" name="cmd" value="_xclick">
              
                <input type="hidden" name="bn" value="webassist.dreamweaver.4_0_3">
              
                <input type="hidden" name="business" value="rbrown@regent.edu">
              
                <input type="hidden" name="item_name" value="<?php echo $row_rsUser['org_name']."'s Registration"; ?>" />
              
                <input type="hidden" name="item_number" value="<?php echo $row_rsRegInfo['invoice_no']; ?>" />
              
                <input type="hidden" name="amount" value="<?php echo $row_rsTransSum['transaction_sume']; ?>" />
              
                <input type="hidden" name="currency_code" value="USD">
              
                <input type="hidden" name="undefined_quantity" value="0">
              
                <input type="hidden" name="receiver_email" value="rbrown@regent.edu">
              
                <input type="hidden" name="mrb" value="R-3WH47588B4505740X">
              
                <input type="hidden" name="pal" value="ANNSXSLJLYR2A">
              
                <input type="hidden" name="no_shipping" value="0">
              
                <input type="hidden" name="no_note" value="0">
              
                <input type="image" name="submit" src="http://images.paypal.com/images/x-click-but03.gif" border="0" alt="Make payments with PayPal, it's fast, free, and secure!">
            </div>
          </form><?php }?>Total: <?php echo $row_rsTransSum['transaction_sume']; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="5" class="denied">&nbsp;</td>
        </tr>
    </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConferenceInfo);

mysql_free_result($rsFees);

mysql_free_result($rsRegInfo);

mysql_free_result($rsItems);

mysql_free_result($rsTransactions);

mysql_free_result($rsTransSum);

mysql_free_result($rsUser);
?>
