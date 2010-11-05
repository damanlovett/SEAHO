<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#EEEEEE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?>
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
<?php require_once('../../includefiles/initDelegates.php'); ?>
<?php

$colname_rsUserInfo = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUserInfo = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsUserInfo = sprintf("SELECT * FROM delegate WHERE delegate_id = %s", GetSQLValueString($colname_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $CMS) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);

$colname_rsRegistration = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsRegistration = $_GET['conferenceID'];
}
$colname2_rsRegistration = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsRegistration = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistration = sprintf("SELECT * FROM delegate_registrations WHERE conference_id = %s AND delegate_registrations.delegate_id = %s", GetSQLValueString($colname_rsRegistration, "text"),GetSQLValueString($colname2_rsRegistration, "text"));
$rsRegistration = mysql_query($query_rsRegistration, $CMS) or die(mysql_error());
$row_rsRegistration = mysql_fetch_assoc($rsRegistration);
$totalRows_rsRegistration = mysql_num_rows($rsRegistration);

$colname_rsConferenceInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConferenceInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConferenceInfo = sprintf("SELECT * FROM conference WHERE conference.conference_id = %s", GetSQLValueString($colname_rsConferenceInfo, "text"));
$rsConferenceInfo = mysql_query($query_rsConferenceInfo, $CMS) or die(mysql_error());
$row_rsConferenceInfo = mysql_fetch_assoc($rsConferenceInfo);
$totalRows_rsConferenceInfo = mysql_num_rows($rsConferenceInfo);

$colname_rsTransSum = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsTransSum = $_GET['conferenceID'];
}
$colname2_rsTransSum = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsTransSum = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsTransSum = sprintf("SELECT SUM(delegate_transactions.transaction_amount) AS Trans_sum, delegate_transactions.transaction_id, delegate_transactions.conference_id FROM delegate_transactions WHERE conference_id = %s AND delegate_transactions.delegate_id = %s AND personal=1 GROUP BY delegate_transactions.conference_id", GetSQLValueString($colname_rsTransSum, "text"),GetSQLValueString($colname2_rsTransSum, "text"));
$rsTransSum = mysql_query($query_rsTransSum, $CMS) or die(mysql_error());
$row_rsTransSum = mysql_fetch_assoc($rsTransSum);
$totalRows_rsTransSum = mysql_num_rows($rsTransSum);

$colname_rsRegInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsRegInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT * FROM conference WHERE conference.conference_id = %s", GetSQLValueString($colname_rsRegInfo, "text"));
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
$query_rsTransactions = sprintf("SELECT * FROM delegate_transactions WHERE conference_id = %s AND delegate_transactions.delegate_id = %s AND personal=1", GetSQLValueString($colname_rsTransactions, "text"),GetSQLValueString($colname2_rsTransactions, "text"));
$rsTransactions = mysql_query($query_rsTransactions, $CMS) or die(mysql_error());
$row_rsTransactions = mysql_fetch_assoc($rsTransactions);
$totalRows_rsTransactions = mysql_num_rows($rsTransactions);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>

<link href="../../styles/invoice.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../styles/invoiceScreen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<table width="100%" align="center" cellpadding="3">
  <tr class="hidePrint">
    <td valign="top"><form>
        <input name="Print" onclick="window.print();return false" type="button" value="Print Invoice" />
      </form></td>
    <td valign="top"><input name="button" type="submit" id="button" onclick="MM_goToURL('parent','invoicePersonal.php?conferenceID=<?php echo $row_rsRegistration['conference_id']; ?>');return document.MM_returnValue" value="Return To Menu" /></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="60%" colspan="2" valign="top"><h2><?php echo $row_rsConferenceInfo['conference_name']; ?></h2>
    <p><?php echo $row_rsConferenceInfo['conference_theme']; ?><br />
      <?php echo $row_rsConferenceInfo['location']; ?><br />
    <?php echo basicDate($row_rsConferenceInfo['start_date']); ?> - <?php echo basicDate($row_rsConferenceInfo['end_date']); ?></p></td>
    <td valign="top"><h1>CONFERENCE INVOICE</h1>
      <p>Date: <?php echo basicDate($row_rsRegistration['date_submitted']); ?><br />
    Invoice #: <?php echo $row_rsRegistration['invoice_no']; ?><br />
      Type: Personal</p></td>
  </tr>
  <tr>
    <td width="60%" colspan="2">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="60%" colspan="2" class="boxes"><div class="labelsSmall">Bill To:</div></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="60%" colspan="2" class="boxes"><?php echo $row_rsUserInfo['institution']; ?><br />
      <?php echo $row_rsUserInfo['first_name']; ?> <?php echo $row_rsUserInfo['last_name']; ?><br />
      <?php echo $row_rsUserInfo['title']; ?><br />
      <?php echo $row_rsUserInfo['address1']; ?><br />
    <?php echo $row_rsUserInfo['city']; ?>, <?php echo $row_rsUserInfo['state']; ?> <?php echo $row_rsUserInfo['zip']; ?></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr class="labels">
    <td width="60%" colspan="2" class="labels">Description</td>
    <td valign="top" class="labels"><div align="right">Amount</div></td>
  </tr>
  <?php do { ?>
  <tr class="boxes" <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
    <td width="60%" colspan="2"><?php echo $row_rsTransactions['label']; ?></td>
    <td valign="top"><div align="right"><?php echo DoFormatCurrency($row_rsTransactions['transaction_amount'], 2, '.', ',', '$'); ?></div></td>
  </tr>
  <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
  <?php } while ($row_rsTransactions = mysql_fetch_assoc($rsTransactions)); ?>
  <tr>
    <td width="60%" colspan="2">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><div align="right"><span class="topLine"><strong>Total:&nbsp;&nbsp;<strong><?php echo DoFormatCurrency($row_rsTransSum['Trans_sum'], 2, '.', ',', '$'); ?></strong></strong></span></div></td>
  </tr>
  <tr>
    <td align="left" valign="top"><?php echo $row_rsRegInfo['custom_invoice_notes']; ?></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo $row_rsRegInfo['payment_terms_check']; ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsUserInfo);

mysql_free_result($rsRegistration);

mysql_free_result($rsConferenceInfo);

mysql_free_result($rsTransSum);

mysql_free_result($rsRegInfo);

mysql_free_result($rsTransactions);
?>
