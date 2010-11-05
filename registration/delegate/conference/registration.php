<?php require_once('../../../Connections/CMS.php'); ?><?php
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
<?php require_once('../../includefiles/initEmails.php'); ?>

<?php

$colname_rsConference = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConference = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsConference = sprintf("SELECT conference_id, conference_name, conference_theme, location, start_date, end_date, conference.send_payment_to, conference.checks_payable_to, conference.support_email FROM conference WHERE conference_id = %s", GetSQLValueString($colname_rsConference, "text"));
$rsConference = mysql_query($query_rsConference, $CMS) or die(mysql_error());
$row_rsConference = mysql_fetch_assoc($rsConference);
$totalRows_rsConference = mysql_num_rows($rsConference);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newregistration")) {
registrationConfirmationNEW($_SESSION['display_name'],$_SESSION['email'],$row_rsConference['conference_name'],$row_rsConference['location'],$row_rsConference['send_payment_to'],$row_rsConference['checks_payable_to'],$row_rsConference['support_email']);
//registrationConfirmation($_SESSION['display_name'],$_SESSION['email'],$_SESSION['conference_name']);
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newregistration")) {
  $insertSQL = sprintf("INSERT INTO delegate_registrations (registration_id, conference_id, delegate_id, invoice_no, career_status, primary_area, involvement, moderator, volunteer, volunteer_area, pro_am, ppp, case_study, pre_conf, special_diet, placement, date_submitted) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['registration_id'], "text"),
                       GetSQLValueString($_POST['conference_id'], "text"),
                       GetSQLValueString($_POST['delegate_id'], "text"),
                       GetSQLValueString($_POST['invoice_no'], "text"),
                       GetSQLValueString($_POST['career_status'], "text"),
					   GetSQLValueString(join(", ",$_POST['primary_area']), "text"),
					   GetSQLValueString(join(", ",$_POST['involvement']), "text"),
                       GetSQLValueString($_POST['moderator'], "text"),
                       GetSQLValueString($_POST['volunteer'], "text"),
                       GetSQLValueString($_POST['volunteer_area'], "text"),
                       GetSQLValueString($_POST['pro_am'], "text"),
                       GetSQLValueString($_POST['ppp'], "text"),
                       GetSQLValueString($_POST['case_study'], "text"),
                       GetSQLValueString($_POST['pre_conf'], "text"),
                       GetSQLValueString($_POST['special_diet'], "text"),
                       GetSQLValueString($_POST['placement'], "text"),
                       GetSQLValueString($_POST['date_submitted'], "date"));
sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());

  $insertGoTo = "invoice.php?conferenceID=" . $row_rsConfInfo['conference_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_rsConfInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConfInfo = $_GET['conferenceID'];
}
$colname_rsConfInfo = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsConfInfo = (get_magic_quotes_gpc()) ? $_GET['conferenceID'] : addslashes($_GET['conferenceID']);
}
mysql_select_db($database_CMS, $CMS);
$query_rsConfInfo = sprintf("SELECT * FROM conference_reg_info WHERE conference_id = %s", GetSQLValueString($colname_rsConfInfo, "text"));
$rsConfInfo = mysql_query($query_rsConfInfo, $CMS) or die(mysql_error());
$row_rsConfInfo = mysql_fetch_assoc($rsConfInfo);
$totalRows_rsConfInfo = mysql_num_rows($rsConfInfo);

$colname_rsStatus = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsStatus = $_GET['conferenceID'];
}
$colname_rsStatus = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsStatus = (get_magic_quotes_gpc()) ? $_GET['conferenceID'] : addslashes($_GET['conferenceID']);
}
mysql_select_db($database_CMS, $CMS);
$query_rsStatus = sprintf("SELECT * FROM delegate_reg_items WHERE type = 'status' AND delegate_reg_items.conference_id = %s", GetSQLValueString($colname_rsStatus, "text"));
$rsStatus = mysql_query($query_rsStatus, $CMS) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);

$colname_rsPrimary = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsPrimary = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsPrimary = sprintf("SELECT * FROM delegate_reg_items WHERE type = 'responsibility' AND delegate_reg_items.conference_id = %s", GetSQLValueString($colname_rsPrimary, "text"));
$rsPrimary = mysql_query($query_rsPrimary, $CMS) or die(mysql_error());
$row_rsPrimary = mysql_fetch_assoc($rsPrimary);
$totalRows_rsPrimary = mysql_num_rows($rsPrimary);

$colname_rsInvolvement = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsInvolvement = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsInvolvement = sprintf("SELECT * FROM delegate_reg_items WHERE type = 'involvement' AND delegate_reg_items.conference_id = %s", GetSQLValueString($colname_rsInvolvement, "text"));
$rsInvolvement = mysql_query($query_rsInvolvement, $CMS) or die(mysql_error());
$row_rsInvolvement = mysql_fetch_assoc($rsInvolvement);
$totalRows_rsInvolvement = mysql_num_rows($rsInvolvement);

$colname_rsVolunteers = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsVolunteers = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsVolunteers = sprintf("SELECT * FROM delegate_reg_items WHERE type = 'volunteer' AND delegate_reg_items.conference_id = %s", GetSQLValueString($colname_rsVolunteers, "text"));
$rsVolunteers = mysql_query($query_rsVolunteers, $CMS) or die(mysql_error());
$row_rsVolunteers = mysql_fetch_assoc($rsVolunteers);
$totalRows_rsVolunteers = mysql_num_rows($rsVolunteers);

$colname_rsPreConference = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsPreConference = $_GET['conferenceID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsPreConference = sprintf("SELECT * FROM delegate_reg_items WHERE type = 'preconference' AND delegate_reg_items.conference_id = %s", GetSQLValueString($colname_rsPreConference, "text"));
$rsPreConference = mysql_query($query_rsPreConference, $CMS) or die(mysql_error());
$row_rsPreConference = mysql_fetch_assoc($rsPreConference);
$totalRows_rsPreConference = mysql_num_rows($rsPreConference);

$colname_rsCheckReg = "-1";
if (isset($_GET['conferenceID'])) {
  $colname_rsCheckReg = $_GET['conferenceID'];
}
$colname2_rsCheckReg = "-1";
if (isset($_SESSION['userID'])) {
  $colname2_rsCheckReg = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsCheckReg = sprintf("SELECT conference_id, delegate_id FROM delegate_registrations WHERE conference_id = %s AND delegate_id = %s AND delegate_registrations.deleted = 0", GetSQLValueString($colname_rsCheckReg, "text"),GetSQLValueString($colname2_rsCheckReg, "text"));
$rsCheckReg = mysql_query($query_rsCheckReg, $CMS) or die(mysql_error());
$row_rsCheckReg = mysql_fetch_assoc($rsCheckReg);
$totalRows_rsCheckReg = mysql_num_rows($rsCheckReg);

// Check for prior registration
if($totalRows_rsCheckReg>0){

$registrationMessage="You have completed a registration for this conference.  You may go to \" My Registrations \" to edit your registration during the open registration period.";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conference Registration</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../../styles/formsDelegates.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#volunteer { <?php if ($row_rsConfInfo['volunteer_on']==0){ echo "display: none;";}?> }
#moderator { <?php if ($row_rsConfInfo['moderator_on']==0){ echo "display: none;";}?> }
#proam { <?php if ($row_rsConfInfo['pro_am_on']==0){ echo "display: none;";}?> }
#ppp { <?php if ($row_rsConfInfo['ppp_on']==0){ echo "display: none;";}?> }
#casestudy { <?php if ($row_rsConfInfo['case_on']==0){ echo "display: none;";}?> }
#preconference { <?php if ($row_rsConfInfo['pre_conf_on']==0){ echo "display: none;";}?> }
#placement { <?php if ($row_rsConfInfo['placement_on']==0){ echo "display: none;";}?> }
form div {
	padding-bottom: 8px;
	padding-top: 8px;
	border: 3px none #000099;
}
#newregistration hr {
	clear: both;
	color: #FFFFFF;
	width: 0px;
	text-align: left;
}
label {
	font-weight: normal;
	margin-bottom: 10px;
	clear: both;
}
#newregistration div {
	clear: both;
	padding-bottom: 20px;
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
      <h3><strong><?php echo $row_rsConference['conference_name']; ?><?php $_SESSION['conference_name']=$row_rsConference['conference_name']?></strong></h3>
      <p class="steps"> Registration: Step 1 of 2 </p>
      <?php echo "<p><span class='required'>$registrationMessage</span></p>";?>
      <p><?php echo $row_rsConference['conference_theme']; ?><br />
        <?php echo $row_rsConference['location']; ?><br />
        <?php echo formatDate($row_rsConference['start_date'],'M. d, Y'); ?> - <?php echo formatDate($row_rsConference['end_date'],'M. d, Y'); ?>
        <br />
        <hr />
      </p>
      <form method="POST" action="<?php echo $editFormAction; ?>" name="newregistration" id="newregistration">
<p>      <div id="general"><label for="career_status"><?php echo $row_rsConfInfo['career_status']; ?></label>
        <select name="career_status" id="career_status">
        <option value="--">Select Status</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsStatus['label']?>"><?php echo $row_rsStatus['label']?></option>
          <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
        </select>
        <br />
        <br />
      <label for="primary_area[]"><?php echo $row_rsConfInfo['primary_area']; ?></label>
      <select name="primary_area[]" size="5" multiple="multiple" id="primary_area[]">
        <?php
do {  
?>
        <option value="<?php echo $row_rsPrimary['label']?>"><?php echo $row_rsPrimary['label']?></option>
        <?php
} while ($row_rsPrimary = mysql_fetch_assoc($rsPrimary));
  $rows = mysql_num_rows($rsPrimary);
  if($rows > 0) {
      mysql_data_seek($rsPrimary, 0);
	  $row_rsPrimary = mysql_fetch_assoc($rsPrimary);
  }
?>
      </select>
</p>      <br />
      <br />
<p>      <label for="involvement[]"><?php echo $row_rsConfInfo['involvement']; ?></label>
      <select name="involvement[]" size="5" multiple="multiple" id="involvement[]">
        <?php
do {  
?>
        <option value="<?php echo $row_rsInvolvement['label']?>"><?php echo $row_rsInvolvement['label']?></option>
        <?php
} while ($row_rsInvolvement = mysql_fetch_assoc($rsInvolvement));
  $rows = mysql_num_rows($rsInvolvement);
  if($rows > 0) {
      mysql_data_seek($rsInvolvement, 0);
	  $row_rsInvolvement = mysql_fetch_assoc($rsInvolvement);
  }
?>
      </select>
</p> 
      </div>
      <div id="volunteer"><label for="volunteer"><?php echo $row_rsConfInfo['volunteer']; ?></label>
        
<p>        <select name="volunteer" id="volunteer">
          <option value="Yes">Yes</option>
          <option value="No" selected="selected">No</option>
        </select>
</p>        <hr />

        <br />
<br />
<p><label for="volunteer_area"><?php echo $row_rsConfInfo['volunteer_area']; ?></label>

<select name="volunteer_area" id="volunteer_area">
  <?php
do {  
?>
  <option value="<?php echo $row_rsVolunteers['label']?>"><?php echo $row_rsVolunteers['label']?></option>
  <?php
} while ($row_rsVolunteers = mysql_fetch_assoc($rsVolunteers));
  $rows = mysql_num_rows($rsVolunteers);
  if($rows > 0) {
      mysql_data_seek($rsVolunteers, 0);
	  $row_rsVolunteers = mysql_fetch_assoc($rsVolunteers);
  }
?>
</select>
</p><hr />
      </div>
      <div id="moderator"><p><label for="moderator"><?php echo $row_rsConfInfo['moderator']; ?></label>
        
        <select name="moderator" id="moderator">
          <option value="Yes">Yes</option>
          <option value="No" selected="selected">No</option>
        </select></p>
        <hr />
        </div>
      <div id="proam">
<p>        <label for="pro_am"><?php echo $row_rsConfInfo['pro_am']; ?></label>        
        
        <select name="pro_am" id="pro_am">
          <option value="Yes, I want to be a Mentor">Yes, I want to be a Mentor (Pro)</option>
          <option value="Yes, I want to be a Mentee">Yes, I want to be a Mentee (AM)</option>
          <option value="No" selected="selected">No, I do not want to participate</option>
        </select>
</p>        <hr />
      </div>
      <div id="ppp">
<p>        <label for="ppp"><?php echo $row_rsConfInfo['ppp']; ?></label>
        
        <select name="ppp" id="ppp">
          <option value="Yes">Yes</option>
          <option value="No" selected="selected">No</option>
        </select>
</p>        <hr />
      </div>
      <div id="casestudy"><p><label for="case_study"><?php echo $row_rsConfInfo['case_study']; ?></label>
        
        <select name="case_study" id="case_study">
          <option value="Yes - Graduate">Yes - Graduate</option>
          <option value="Yes - New Professional">Yes - New Professional</option>
          <option value="No" selected="selected">No</option>
        </select></p>
        <hr />
        </div>
      <div id="preconference"><p><label for="pre_conf"><?php echo $row_rsConfInfo['pre_conf']; ?></label>
        
        <select name="pre_conf" id="pre_conf">
        <option value="No">No, thank you</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsPreConference['label']?>"><?php echo $row_rsPreConference['label']?></option>
          <?php
} while ($row_rsPreConference = mysql_fetch_assoc($rsPreConference));
  $rows = mysql_num_rows($rsPreConference);
  if($rows > 0) {
      mysql_data_seek($rsPreConference, 0);
	  $row_rsPreConference = mysql_fetch_assoc($rsPreConference);
  }
?>
        </select></p>
        <hr />
        </div>
      <div id="specialneeds"><p><label for="special_diet"><?php echo $row_rsConfInfo['special_diet']; ?></label>      
        
        <textarea name="special_diet" id="special_diet" cols="45" rows="5"></textarea></p>
        <hr />
      </div>
      <div id="placement"><p><label for="placement"><?php echo $row_rsConfInfo['placement']; ?></label>
        
        <select name="placement" id="placement">
          <option value="Yes, Employer">Yes, as an Employer</option>
          <option value="Yes, Candidate">Yes, as a Candidate</option>
          <option value="No" selected="selected">No</option>
        </select></p>
        <input name="date_submitted" type="hidden" id="date_submitted" value="<?php echo $systemDate;?>" />
        <input name="delegate_id" type="hidden" id="delegate_id" value="<?php echo $_SESSION['userID']; ?>" />
        <input name="registration_id" type="hidden" id="registration_id" value="<?php echo create_guid(); ?>" />
        <input name="conference_id" type="hidden" id="conference_id" value="<?php echo $row_rsConfInfo['conference_id']; ?>" />
        <input name="invoice_no" type="hidden" id="invoice_no" value="<?php echo $invoiceNumber; ?>" />
      </div>
      
      <div>
  <p>
    <?php if ($row_rsConfInfo['volunteer_on']==0){?>
    <input type="hidden" name="volunteer" id="volunteer" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['moderator_on']==0){ ?>
    <input type="hidden" name="moderator" id="moderator" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['pro_am_on']==0){?>
    <input type="hidden" name="pro_am" id="pro_am" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['ppp_on']==0){ ?>
    <input type="hidden" name="ppp" id="ppp" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['case_on']==0){?>
    <input type="hidden" name="case_study" id="case_study" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['pre_conf_on']==0){?>
    <input type="hidden" name="pre_conf" id="pre_conf" />
    <?php }?>
    
    <?php if ($row_rsConfInfo['placement_on']==0){ ?>
    <input type="hidden" name="placement" id="placement" />
    <?php }?>
  </p>
  <p>&nbsp;</p>
      </div>
      <?php if($totalRows_rsCheckReg==0){?><p align="left">
        <input type="submit" name="button" id="button" value="Submit Registration" />
</p><?php }?>
      <input type="hidden" name="MM_insert" value="newregistration" />
      </form>    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsConfInfo);

mysql_free_result($rsStatus);

mysql_free_result($rsPrimary);

mysql_free_result($rsInvolvement);

mysql_free_result($rsConference);

mysql_free_result($rsVolunteers);

mysql_free_result($rsPreConference);

mysql_free_result($rsCheckReg);
?>
