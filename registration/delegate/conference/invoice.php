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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['transaction_id'])) && ($_GET['transaction_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM delegate_transactions WHERE transaction_id=%s",
                       GetSQLValueString($_GET['transaction_id'], "text"));
  sqlQueryLog($deleteSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($deleteSQL, $CMS) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add")) {
  $insertSQL = sprintf("INSERT INTO delegate_transactions (transaction_id, registration_id, conference_id, delegate_id, label, transaction_type, transaction_amount, date_entered, entered_by) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['transaction_id'], "text"),
                       GetSQLValueString($_POST['registration_id'], "text"),
                       GetSQLValueString($_POST['conference_id'], "text"),
                       GetSQLValueString($_POST['delegate_id'], "text"),
                       GetSQLValueString($_POST['label'], "text"),
                       GetSQLValueString($_POST['transaction_type'], "text"),
                       GetSQLValueString($_POST['transaction_amount'], "double"),
                       GetSQLValueString($_POST['date_entered'], "text"),
                       GetSQLValueString($_POST['entered_by'], "text"));
  sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());
}

$colname_rsConference = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConference = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConference = sprintf("SELECT * FROM conference WHERE conference_id = %s", GetSQLValueString($colname_rsConference, "text"));
$rsConference = mysql_query($query_rsConference, $CMS) or die(mysql_error());
$row_rsConference = mysql_fetch_assoc($rsConference);
$totalRows_rsConference = mysql_num_rows($rsConference);

$colname_rsFees = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsFees = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsFees = sprintf("SELECT * FROM delegate_invoice WHERE conference_id = %s AND delegate_invoice.type ='registration' ORDER BY amount ASC", GetSQLValueString($colname_rsFees, "text"));
$rsFees = mysql_query($query_rsFees, $CMS) or die(mysql_error());
$row_rsFees = mysql_fetch_assoc($rsFees);
$totalRows_rsFees = mysql_num_rows($rsFees);

$colname_rsItems = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsItems = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsItems = sprintf("SELECT * FROM delegate_invoice WHERE conference_id = %s AND delegate_invoice.type !='registration' AND delegate_invoice.type!='Included Meal' AND delegate_invoice.type!='Meals'  ORDER BY delegate_invoice.type, delegate_invoice.amount", GetSQLValueString($colname_rsItems, "text"));
$rsItems = mysql_query($query_rsItems, $CMS) or die(mysql_error());
$row_rsItems = mysql_fetch_assoc($rsItems);
$totalRows_rsItems = mysql_num_rows($rsItems);

$colname_rsRegInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsRegInfo = $_GET['conferenceID'];
}
$colname2_rsRegInfo = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsRegInfo = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT * FROM delegate_registrations WHERE conference_id = %s AND delegate_id = %s", GetSQLValueString($colname_rsRegInfo, "text"),GetSQLValueString($colname2_rsRegInfo, "text"));
$rsRegInfo = mysql_query($query_rsRegInfo, $CMS) or die(mysql_error());
$row_rsRegInfo = mysql_fetch_assoc($rsRegInfo);
$totalRows_rsRegInfo = mysql_num_rows($rsRegInfo);

$colname_rsTransactions = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsTransactions = $_GET['conferenceID'];
}
$colname2_rsTransactions = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsTransactions = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransactions = sprintf("SELECT * FROM delegate_transactions WHERE conference_id = %s AND delegate_transactions.delegate_id = %s AND personal=0 ORDER BY date_entered ASC", GetSQLValueString($colname_rsTransactions, "text"),GetSQLValueString($colname2_rsTransactions, "text"));
$rsTransactions = mysql_query($query_rsTransactions, $CMS) or die(mysql_error());
$row_rsTransactions = mysql_fetch_assoc($rsTransactions);
$totalRows_rsTransactions = mysql_num_rows($rsTransactions);

$colname_rsTransSum = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsTransSum = $_GET['conferenceID'];
}
$colname2_rsTransSum = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsTransSum = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransSum = sprintf("SELECT SUM(delegate_transactions.transaction_amount) AS Trans_sum, delegate_transactions.transaction_id, delegate_transactions.conference_id FROM delegate_transactions WHERE conference_id = %s AND delegate_transactions.delegate_id = %s AND personal=0 GROUP BY delegate_transactions.conference_id", GetSQLValueString($colname_rsTransSum, "text"),GetSQLValueString($colname2_rsTransSum, "text"));
$rsTransSum = mysql_query($query_rsTransSum, $CMS) or die(mysql_error());
$row_rsTransSum = mysql_fetch_assoc($rsTransSum);
$totalRows_rsTransSum = mysql_num_rows($rsTransSum);

$colname_rsConReg = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConReg = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConReg = sprintf("SELECT conference_reg_info.update_reg FROM conference_reg_info WHERE conference_id = %s", GetSQLValueString($colname_rsConReg, "text"));
$rsConReg = mysql_query($query_rsConReg, $CMS) or die(mysql_error());
$row_rsConReg = mysql_fetch_assoc($rsConReg);
$totalRows_rsConReg = mysql_num_rows($rsConReg);

$colname_rsIncludedMeals = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsIncludedMeals = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsIncludedMeals = sprintf("SELECT * FROM delegate_invoice WHERE conference_id = %s AND delegate_invoice.type='Included Meal' OR delegate_invoice.type='Meals' ORDER BY delegate_invoice.id DESC", GetSQLValueString($colname_rsIncludedMeals, "text"));
$rsIncludedMeals = mysql_query($query_rsIncludedMeals, $CMS) or die(mysql_error());
$row_rsIncludedMeals = mysql_fetch_assoc($rsIncludedMeals);
$totalRows_rsIncludedMeals = mysql_num_rows($rsIncludedMeals);

mysql_select_db($database_CMS, $CMS);
$query_rsAnnoucements = "SELECT * FROM annoucements WHERE page = 'Create Invoice'";
$rsAnnoucements = mysql_query($query_rsAnnoucements, $CMS) or die(mysql_error());
$row_rsAnnoucements = mysql_fetch_assoc($rsAnnoucements);
$totalRows_rsAnnoucements = mysql_num_rows($rsAnnoucements);
?>
<?php  $lastTFM_nest = "";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conference Registration Invoice</title>
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
<style type="text/css">
<!--
#updateReg {<?php if ($row_rsConReg['update_reg']==0){ echo "display: none;";}?>}
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
      <h3><strong>Institution Invoice </strong><span class="invoiceSubheader">[ <?php echo $row_rsConference['conference_name']; ?> ]</span></h3>
      <p>
        <input name="button2" type="button" id="button2" onclick="MM_goToURL('parent','invoicePersonal.php?conferenceID=<?php echo $row_rsConference['conference_id']; ?>');return document.MM_returnValue" value="Switch to Personal Invoice" />
      </p>
      <p class="steps"> Registration: Step 2 of 2</p>
      <div id="updateReg">
      <p><?php echo $row_rsAnnoucements['content']; ?></p>
      <table width="100%" border="0" cellpadding="1" cellspacing="0" class="tableDetails">
        <tr>
          <th colspan="2">Registration Fees</th>
        </tr>
        <?php do { ?>
          <tr>
            <td align="left" nowrap="nowrap">&nbsp;<?php echo $row_rsFees['label']; ?></td>
            <td width="42%"><form id="add" name="add" method="POST" action="<?php echo $editFormAction; ?>">
              <div align="right">
                <input name="conference_id" type="hidden" id="conference_id" value="<?php echo $row_rsConference['conference_id']; ?>" />
                <input name="transaction_id" type="hidden" id="transaction_id" value="<?php echo create_guid();?>" />
                <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
                <input name="delegate_id" type="hidden" id="delegate_id" value="<?php echo $_SESSION['userID']; ?>" />
                <input name="label" type="hidden" id="label" value="<?php echo $row_rsFees['label']; ?>" />
                <input name="transaction_type" type="hidden" id="transaction_type" value="<?php echo $row_rsFees['type']; ?>" />
                <input name="transaction_amount" type="hidden" id="transaction_amount" value="<?php echo $row_rsFees['amount']; ?>" />
                <input name="date_entered" type="hidden" id="date_entered" value="<?php echo $systemDate;?>" />
                <input name="entered_by" type="hidden" id="entered_by" value="<?php echo $_SESSION['display_name'];?>" />
                <?php echo DoFormatCurrency($row_rsFees['amount'], 2, '.', ',', '$'); ?>
                <input type="submit" name="add" id="add" value="Add" />
              </div>
              <input type="hidden" name="MM_insert" value="add" />
            </form></td>
          </tr>
          <?php } while ($row_rsFees = mysql_fetch_assoc($rsFees)); ?>
        <tr>
          <th colspan="2">Registration Items</th>
        </tr>
        <?php do { ?>
          <tr>
            <td nowrap="nowrap"><?php echo $row_rsItems['label']; ?>&nbsp;</td>
            <td><form id="form3" name="form3" method="post" action="">
                <div align="right">
                  <input name="conference_id" type="hidden" id="conference_id" value="<?php echo $row_rsConference['conference_id']; ?>" />
                  <input name="transaction_id" type="hidden" id="transaction_id" value="<?php echo create_guid();?>" />
                  <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
                  <input name="delegate_id" type="hidden" id="delegate_id" value="<?php echo $_SESSION['userID']; ?>" />
                  <input name="label" type="hidden" id="label" value="<?php echo $row_rsItems['label']; ?>" />
                  <input name="transaction_type" type="hidden" id="transaction_type" value="<?php echo $row_rsItems['type']; ?>" />
                  <input name="transaction_amount" type="hidden" id="transaction_amount" value="<?php echo $row_rsItems['amount']; ?>" />
                  <input name="date_entered" type="hidden" id="date_entered" value="<?php echo $systemDate;?>" />
                  <input name="entered_by" type="hidden" id="entered_by" value="<?php echo $_SESSION['display_name'];?>" />
                  <input type="hidden" name="MM_insert" value="add" />
                  <?php echo DoFormatCurrency($row_rsItems['amount'], 2, '.', ',', '$'); ?>
                  <input type="submit" name="add" id="add" value="Add" />
                </div>
            </form></td>
          </tr>
          <?php } while ($row_rsItems = mysql_fetch_assoc($rsItems)); ?>
        <tr>
          <th colspan="2" nowrap="nowrap">Delegate Meals Attending</th>
        </tr>
        <tr>
        <td colspan="2" bgcolor="#F0F0F0"><p>These items are included on this invoice for you to inform the Host  Committee about your attendance at two meals.&nbsp;  There is no additional charge for delegate meals during the  conference.&nbsp; These meals are included in  the conference registration for all delegates.&nbsp;  If you wish to purchase extra meals for a guest, please do so by  selecting the preferred meal below.&nbsp;  Click once for each extra ticket you wish to purchase.</p></td>
        </tr>
        <?php do { ?>
          <tr>
            <td nowrap="nowrap"><?php echo $row_rsIncludedMeals['label']; ?></td>
            <td><form id="form2" name="form3" method="post" action="">
                <div align="right">
                  <input name="conference_id" type="hidden" id="conference_id" value="<?php echo $row_rsConference['conference_id']; ?>" />
                  <input name="transaction_id" type="hidden" id="transaction_id" value="<?php echo create_guid();?>" />
                  <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
                  <input name="delegate_id" type="hidden" id="delegate_id" value="<?php echo $_SESSION['userID']; ?>" />
                  <input name="label" type="hidden" id="label" value="<?php echo $row_rsIncludedMeals['label']; ?>" />
                  <input name="transaction_type" type="hidden" id="transaction_type" value="<?php echo $row_rsIncludedMeals['type']; ?>" />
                  <input name="transaction_amount" type="hidden" id="transaction_amount" value="<?php echo $row_rsIncludedMeals['amount']; ?>" />
                  <input name="date_entered" type="hidden" id="date_entered" value="<?php echo $systemDate;?>" />
                  <input name="entered_by" type="hidden" id="entered_by" value="<?php echo $_SESSION['display_name'];?>" />
                  <input type="hidden" name="MM_insert" value="add" />
                  <?php echo DoFormatCurrency($row_rsIncludedMeals['amount'], 2, '.', ',', '$'); ?>
                  <input type="submit" name="add" id="add" value="Add" />
                </div>
            </form></td>
          </tr>
          <?php } while ($row_rsIncludedMeals = mysql_fetch_assoc($rsIncludedMeals)); ?>
</table>
      <hr />
      </div>
      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableDetails">
        <tr>
        <td class="tableTop"><strong>Invoice</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><div align="right">
          <input name="button" type="button" id="button" onclick="MM_goToURL('parent','printableinvoice.php?conferenceID=<?php echo $row_rsConference['conference_id']; ?>');return document.MM_returnValue" value="Pay By Check" />
        </div></td>
        </tr>
        <?php if ($totalRows_rsTransactions > 0) { // Show if recordset not empty ?>
          <?php do { ?>
            <tr>
              <td colspan="2" nowrap="nowrap">
              <?php if($row_rsTransactions['transaction_description'] ==''){?>
              <a href="invoice.php?transaction_id=<?php echo $row_rsTransactions['transaction_id']; ?>&amp;conferenceID=<?php echo $row_rsTransactions['conference_id']; ?>"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></a>
              <?php }?>
			  <?php echo $row_rsTransactions['label']; ?>&nbsp;-&nbsp;<?php echo $row_rsTransactions['transaction_type']; ?></td>
              <td><div align="right"><?php echo DoFormatCurrency($row_rsTransactions['transaction_amount'], 2, '.', ',', '$'); ?></div></td>
            </tr>
            <?php } while ($row_rsTransactions = mysql_fetch_assoc($rsTransactions)); ?>
          <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsTransactions == 0) { // Show if recordset empty ?>
            <tr>
              <td colspan="3">Please add items to invoice</td>
            </tr>
            <?php } // Show if recordset empty ?>

<tr bgcolor="#E1E3E8">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right"><strong>Total:&nbsp;&nbsp;&nbsp;</strong><?php echo DoFormatCurrency($row_rsTransSum['Trans_sum'], 2, '.', ',', '$'); ?></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            
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
              
              
              <input type="hidden" name="cmd" value="_xclick" />
              <input type="hidden" name="bn" value="webassist.dreamweaver.4_0_3" />
              <input type="hidden" name="business" value="rbrown@regent.edu" />
              <input type="hidden" name="item_name" value="<?php echo $_SESSION['display_name']."'s Registration for ".$row_rsConference['conference_name']; ?>" />
              <input type="hidden" name="item_number" value="<?php echo $row_rsRegInfo['invoice_no']; ?>" />
              <input type="hidden" name="amount" value="<?php echo $row_rsTransSum['Trans_sum']; ?>" />
              <input type="hidden" name="currency_code" value="USD" />
<input type="hidden" name="return" value="http://seaho.org/registration/delegate/registrations/index.php" />              <input type="hidden" name="undefined_quantity" value="0" />
              <input type="hidden" name="receiver_email" value="rbrown@regent.edu" />
              <input type="hidden" name="mrb" value="R-3WH47588B4505740X" />
              <input type="hidden" name="pal" value="ANNSXSLJLYR2A" />
              <input type="hidden" name="no_shipping" value="0" />
              <input type="hidden" name="no_note" value="0" />
              <input type="image" name="submit" src="http://images.paypal.com/images/x-click-but03.gif" border="0" alt="Make payments with PayPal, it's fast, free, and secure!" />
              </div>
          </form></td>
        </tr>
      </table>
      <p><?php echo $row_rsConference['payment_terms_check']; ?></p>
      <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConference);

mysql_free_result($rsFees);

mysql_free_result($rsItems);

mysql_free_result($rsRegInfo);

mysql_free_result($rsTransactions);

mysql_free_result($rsTransSum);

mysql_free_result($rsConReg);

mysql_free_result($rsIncludedMeals);

mysql_free_result($rsAnnoucements);
?>
