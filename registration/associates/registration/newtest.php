 <?php 
 $cryptinstall="../../../crypt/cryptographp.fct.php";
 include $cryptinstall;  
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
<?php require_once('../../includefiles/initEmails.php'); ?>
<?php require_once('../../includefiles/initAssociates.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newregistration")) {

registrationConfirmation($_SESSION['display_name'],$_SESSION['email'],"SEAHO 2007 Conference");

}

?>
<?php

//Set Local Sessions
if(!isset($_SESSION['conferenceID'])){$_SESSION['conferenceID']=$_GET['conferenceID'];}


$colname_rsRegInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsRegInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT conference_id, booth_registration, booth_signage, location_preferences, frieght_info, drawing, meal_tickets, delegate_roster, sponsorships, sponsorships_payment, terms_participantion, committee_contacts, invoice_header, invoice_footer FROM associate_reg_info WHERE conference_id = %s", GetSQLValueString($colname_rsRegInfo, "text"));
$rsRegInfo = mysql_query($query_rsRegInfo, $CMS) or die(mysql_error());
$row_rsRegInfo = mysql_fetch_assoc($rsRegInfo);
$totalRows_rsRegInfo = mysql_num_rows($rsRegInfo);

$colname_rsConferenceInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConferenceInfo = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConferenceInfo = sprintf("SELECT conference_id, conference_name, conference_theme, location, start_date, end_date, registration_begins, registration_late, registration_deadline, event_type, accept_registrations, post_conference, confirmation_email_id, admin_email, support_email, custom_invoice_notes, checks_payable_to, send_payment_to, payment_terms_check, payment_terms_credit, representatives_included FROM conference WHERE conference_id = %s", GetSQLValueString($colname_rsConferenceInfo, "text"));
$rsConferenceInfo = mysql_query($query_rsConferenceInfo, $CMS) or die(mysql_error());
$row_rsConferenceInfo = mysql_fetch_assoc($rsConferenceInfo);
$totalRows_rsConferenceInfo = mysql_num_rows($rsConferenceInfo);

$colname_rsSponsorships = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsSponsorships = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsSponsorships = sprintf("SELECT conference_id, label, `description` FROM associate_sponsorships WHERE conference_id = %s AND deleted=0", GetSQLValueString($colname_rsSponsorships, "text"));
$rsSponsorships = mysql_query($query_rsSponsorships, $CMS) or die(mysql_error());
$row_rsSponsorships = mysql_fetch_assoc($rsSponsorships);
$totalRows_rsSponsorships = mysql_num_rows($rsSponsorships);

$colname_rsCheckReg = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsCheckReg = $_GET['conferenceID'];
}
$colname2_rsCheckReg = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsCheckReg = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsCheckReg = sprintf("SELECT conference_id, associate_id FROM associate_registrations WHERE conference_id = %s AND associate_id = %s", GetSQLValueString($colname_rsCheckReg, "text"),GetSQLValueString($colname2_rsCheckReg, "text"));
$rsCheckReg = mysql_query($query_rsCheckReg, $CMS) or die(mysql_error());
$row_rsCheckReg = mysql_fetch_assoc($rsCheckReg);
$totalRows_rsCheckReg = mysql_num_rows($rsCheckReg);

// Check for prior registration
if($totalRows_rsCheckReg>0){

$registrationMessage="You have completed a registration for this conference";

}
//?>
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
<script type="text/javascript" src="../../includefiles/acceptterms.js"></script>
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

      <h1>New Registration Form</h1>
      <p><?php echo "<span class='required'>$registrationMessage</span>";?>
      <fieldset class="basicInfoFieldSet"><?php echo $row_rsConferenceInfo['conference_name']; ?><br />
        <?php echo $row_rsConferenceInfo['conference_theme']; ?><br />
        <?php echo $row_rsConferenceInfo['location']; ?><br />
      <?php echo basicDate($row_rsConferenceInfo['start_date']); ?> - <?php echo basicDate($row_rsConferenceInfo['end_date']); ?></fieldset><br />
      </p>
      <form id="newregistration" name="newregistration" method="POST" action="../../../crypt/verifierAssociates.php?conferenceID=<?php echo $row_rsRegInfo['conference_id']; ?>" onSubmit="return defaultagree(this)">
        <table width="95%" border="0" cellpadding="3" cellspacing="0">

          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['booth_signage']; ?></p></td>
          </tr>
          <tr>
            <td colspan="13" valign="top">Sign Text:
              <label for="booth_signage"></label>
              <textarea name="booth_signage" cols="50" rows="6" id="booth_signage"></textarea>
            <div align="left"></div></td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['location_preferences']; ?></p>                </td>
          </tr>
          <tr>
            <td colspan="2" valign="top"><p align="right" style='text-align:right'>Booth location:</p></td>
            <td colspan="6" valign="top" nowrap="nowrap"><p>&nbsp;&nbsp;1<sup>st</sup> preference 
              <input name="1_preference" type="text" id="1_preference" value="<?php $_POST['1_preference'];?>" size="3" />
            </p></td>
            <td colspan="5" valign="top"><p>2<sup>nd</sup> preference
              <input name="2_preference" type="text" id="2_preference" size="3" />
            </p></td>
          </tr>
          <tr>
            <td colspan="2" valign="top">&nbsp;</td>
            <td colspan="6" valign="top"><p>&nbsp;&nbsp;3<sup>rd</sup> preference
              <input name="3_preference" type="text" id="3_preference" value="<?php $_POST['3_preference'];?>" size="3" />
            </p></td>
            <td colspan="5" valign="top"><p>4<sup>th</sup> preference
              <input name="4_preference" type="text" id="4_preference" size="3" />
            </p></td>
          </tr>
          <tr>
            <td colspan="2" valign="top">&nbsp;</td>
            <td colspan="6" valign="top"><p>&nbsp;&nbsp;5<sup>th</sup> preference
              <input name="5_preference" type="text" id="5_preference" size="3" />
            </p></td>
            <td colspan="5" valign="top"><p>No preference
                <input name="no_preference" type="radio" id="no_preference" value="No" />
                <label for="no_preference"></label>
            </p></td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['frieght_info']; ?></p></td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['drawing']; ?></p>
              Participate in drawing: 
              <select name="drawing" id="drawing">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </p></td>
          </tr>
          
          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['delegate_roster']; ?></p>                </td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><p><?php echo $row_rsRegInfo['sponsorships']; ?><b></b></p>
              <ol>
                <?php do { ?>
                  <li><?php echo $row_rsSponsorships['label']; ?></li>
                  <?php } while ($row_rsSponsorships = mysql_fetch_assoc($rsSponsorships)); ?></ol>
              <p><?php echo $row_rsRegInfo['sponsorships_payment']; ?></p>
              <p><?php echo $row_rsRegInfo['terms_participantion']; ?></p>              </td>
          </tr>
          <?php if($totalRows_rsCheckReg==0){?>
          <tr>
            <td colspan="13" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><div align="center"><strong>Enter Verification Code:</strong><br />
                <input name="code" type="text" value="<?php $_POST['code'];?>">
                <br /> 
                <?php dsp_crypt(0,0); ?>
            ( Can't read code, refresh )</div></td>
          </tr>
          <tr>
            <td colspan="13" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="13" valign="top"><p><input name="agreecheck" type="checkbox" onClick="agreesubmit(this)">
              <b>I agree to the &quot;Terms of Participation&quot;</b><br>
<input type="Submit" value="Continue &raquo; &raquo;" disabled>&nbsp;
<input name="registration_id" type="hidden" id="registration_id" value="<?php echo create_guid(); ?>" />
<input name="associate_id" type="hidden" id="associate_id" value="<?php echo $_SESSION['userID']; ?>" />
            <input name="conferenceID" type="hidden" id="conferenceID" value="<?php echo $_SESSION['conferenceID']; ?>" />
            <input name="invoice_no" type="hidden" id="invoice_no" value="<?php echo $invoiceNumber; ?>" />
            <input name="date_submitted" type="hidden" id="date_submitted" value="<?php echo $systemDate; ?>" />
            </p>            </td>
          </tr><?php }?>
          <tr>
            <td colspan="13" valign="top"><br />
            <?php echo $row_rsRegInfo['committee_contacts']; ?></td>
          </tr>
          <tr height="0">
            <td width="40"></td>
            <td width="60"></td>
            <td width="12"></td>
            <td width="23"></td>
            <td width="23"></td>
            <td width="4"></td>
            <td width="31"></td>
            <td width="24"></td>
            <td width="13"></td>
            <td width="26"></td>
            <td width="26"></td>
            <td width="26"></td>
            <td width="26"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="newregistration" />
      </form>
      <script>
//change two names below to your form's names
document.forms.newregistration.agreecheck.checked=false
</script>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsRegInfo);

mysql_free_result($rsConferenceInfo);

mysql_free_result($rsSponsorships);

mysql_free_result($rsCheckReg);
?>
