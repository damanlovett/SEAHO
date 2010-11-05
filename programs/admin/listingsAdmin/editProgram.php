<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>

<?php

$systemDate = date ("Y-m-d G:i:s");

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE callforprograms SET ProgramTitle=%s, FirstName=%s, LastName=%s, MiddleInitial=%s, Title=%s, Institution=%s, Address=%s, City=%s, `State`=%s, Zip=%s, PhoneNumber=%s, EmailAddress=%s, ExperienceLevel=%s, addName1=%s, addTitle1=%s, addInstitution1=%s, addName2=%s, addTitle2=%s, addInstitution2=%s, addName3=%s, addTitle3=%s, addInstitution3=%s, SessionType=%s, target_audience=%s, EquipmentNeeds=%s, EquipmentNeeds2=%s, EquipmentNeedsO=%s, SchRequests=%s, SchRequestsTitle1=%s, SchRequestsPresenter1=%s, SchRequestsTitle2=%s, SchRequestsPresenter2=%s, SchRequestsTitle3=%s, SchRequestsPresenter3=%s, BestSeaho=%s, TopicArea=%s, LearningObj1=%s, LearningObj2=%s, LearningOjb3=%s, ProgramDescription=%s, OutlineOfPresentation=%s WHERE id=%s",
                       GetSQLValueString($_POST['ProgramTitle'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['MiddleInitial'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Institution'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Zip'], "text"),
                       GetSQLValueString($_POST['PhoneNumber'], "text"),
                       GetSQLValueString($_POST['EmailAddress'], "text"),
                       GetSQLValueString($_POST['ExperienceLevel'], "text"),
                       GetSQLValueString($_POST['addName1'], "text"),
                       GetSQLValueString($_POST['addTitle1'], "text"),
                       GetSQLValueString($_POST['addInstitution1'], "text"),
                       GetSQLValueString($_POST['addName2'], "text"),
                       GetSQLValueString($_POST['addTitle2'], "text"),
                       GetSQLValueString($_POST['addInstitution2'], "text"),
                       GetSQLValueString($_POST['addName3'], "text"),
                       GetSQLValueString($_POST['addTitle3'], "text"),
                       GetSQLValueString($_POST['addInstitution3'], "text"),
                       GetSQLValueString($_POST['SessionType'], "text"),
                       GetSQLValueString($_POST['target_audience'], "text"),
                       GetSQLValueString(isset($_POST['EquipmentNeeds']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['EquipmentNeeds2']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['EquipmentNeedsO'], "text"),
                       GetSQLValueString($_POST['SchRequests'], "text"),
                       GetSQLValueString($_POST['SchRequestsTitle1'], "text"),
                       GetSQLValueString($_POST['SchRequestsPresenter1'], "text"),
                       GetSQLValueString($_POST['SchRequestsTitle2'], "text"),
                       GetSQLValueString($_POST['SchRequestsPresenter2'], "text"),
                       GetSQLValueString($_POST['SchRequestsTitle3'], "text"),
                       GetSQLValueString($_POST['SchRequestsPresenter3'], "text"),
                       GetSQLValueString($_POST['BestSeaho'], "text"),
                       GetSQLValueString($_POST['TopicArea'], "text"),
                       GetSQLValueString($_POST['LearningObj1'], "text"),
                       GetSQLValueString($_POST['LearningObj2'], "text"),
                       GetSQLValueString($_POST['LearningOjb3'], "text"),
                       GetSQLValueString($_POST['ProgramDescription'], "text"),
                       GetSQLValueString($_POST['OutlineOfPresentation'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

mysql_select_db($database_Programming, $Programming);
$query_rsSession = "SELECT session_type.id, session_type.session_type, session_type.deleted FROM session_type WHERE session_type.deleted ='0'";
$rsSession = mysql_query($query_rsSession, $Programming) or die(mysql_error());
$row_rsSession = mysql_fetch_assoc($rsSession);
$totalRows_rsSession = mysql_num_rows($rsSession);

mysql_select_db($database_Programming, $Programming);
$query_rsTarget = "SELECT experience_level.id, experience_level.experience_level, experience_level.deleted FROM experience_level WHERE experience_level.deleted ='0' ORDER BY experience_level.experience_level";
$rsTarget = mysql_query($query_rsTarget, $Programming) or die(mysql_error());
$row_rsTarget = mysql_fetch_assoc($rsTarget);
$totalRows_rsTarget = mysql_num_rows($rsTarget);

mysql_select_db($database_Programming, $Programming);
$query_rsTopics = "SELECT topic_area.id, topic_area.topic_area, topic_area.deleted FROM topic_area WHERE topic_area.deleted='0' ORDER BY topic_area.topic_area";
$rsTopics = mysql_query($query_rsTopics, $Programming) or die(mysql_error());
$row_rsTopics = mysql_fetch_assoc($rsTopics);
$totalRows_rsTopics = mysql_num_rows($rsTopics);

mysql_select_db($database_Programming, $Programming);
$query_rsExperience = "SELECT * FROM experience_level WHERE deleted = 0 ORDER BY experience_level ASC";
$rsExperience = mysql_query($query_rsExperience, $Programming) or die(mysql_error());
$row_rsExperience = mysql_fetch_assoc($rsExperience);
$totalRows_rsExperience = mysql_num_rows($rsExperience);

$colname_rsUpdateRecord = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUpdateRecord = $_GET['recordID'];
}
$colname_rsUpdateRecord = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUpdateRecord = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsUpdateRecord = sprintf("SELECT * FROM callforprograms WHERE id = %s", GetSQLValueString($colname_rsUpdateRecord, "int"));
$rsUpdateRecord = mysql_query($query_rsUpdateRecord, $Programming) or die(mysql_error());
$row_rsUpdateRecord = mysql_fetch_assoc($rsUpdateRecord);
$totalRows_rsUpdateRecord = mysql_num_rows($rsUpdateRecord);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Update Record</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->


<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../includefiles/gen_validatorv2.js"></script>
<!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><span><?php echo $row_rsUpdateRecord['ProgramTitle']; ?></span><!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" -->
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
    <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
    <?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) { ?>
    
<p align="center" class="homepageBlocks">Program Updated</p>
 <?php }?>
 
  <table border="0" align="center" cellpadding="5" cellspacing="0" class="tableborder">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>
      <input name="id" type="hidden" id="id" value="<?php echo $row_rsUpdateRecord['id']; ?>" />
      *Program Title:</strong></td>
      <td><input type="text" name="ProgramTitle" value="<?php echo $row_rsUpdateRecord['ProgramTitle']; ?>" size="55" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" class="tableTop"><div align="left">Conference Presenter </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*First Name:</strong></td>
      <td><input type="text" name="FirstName" value="<?php echo $row_rsUpdateRecord['FirstName']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*Last Name:</strong></td>
      <td><input type="text" name="LastName" value="<?php echo $row_rsUpdateRecord['LastName']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Middle Initial:</strong></td>
      <td><input type="text" name="MiddleInitial" value="<?php echo $row_rsUpdateRecord['MiddleInitial']; ?>" size="7" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="Title" value="<?php echo $row_rsUpdateRecord['Title']; ?>" size="55" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="Institution" value="<?php echo $row_rsUpdateRecord['Institution']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Address:</strong></td>
      <td><textarea name="Address" cols="32" rows="5"><?php echo $row_rsUpdateRecord['Address']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>City:</strong></td>
      <td><input type="text" name="City" value="<?php echo $row_rsUpdateRecord['City']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>State:</strong></td>
      <td><select name="State" id="State" title="<?php echo $row_rsUpdateRecord['State']; ?>">
        <option value="" selected="selected" <?php if (!(strcmp("", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Choose a State</option>
        <option value="Alabama" <?php if (!(strcmp("Alabama", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Alabama</option>
        <option value="Alaska" <?php if (!(strcmp("Alaska", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Alaska</option>
        <option value="Arizona" <?php if (!(strcmp("Arizona", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Arizona</option>
        <option value="Arkansas" <?php if (!(strcmp("Arkansas", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Arkansas</option>
        <option value="California" <?php if (!(strcmp("California", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>California</option>
        <option value="Colorado" <?php if (!(strcmp("Colorado", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Colorado</option>
        <option value="Connecticut" <?php if (!(strcmp("Connecticut", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Connecticut</option>
        <option value="Delaware" <?php if (!(strcmp("Delaware", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Delaware</option>
        <option value="District Of Columbia" <?php if (!(strcmp("District Of Columbia", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>District Of Columbia</option>
        <option value="Florida" <?php if (!(strcmp("Florida", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Florida</option>
        <option value="Georgia" <?php if (!(strcmp("Georgia", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
        <option value="Hawaii" <?php if (!(strcmp("Hawaii", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Hawaii</option>
        <option value="Idaho" <?php if (!(strcmp("Idaho", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Idaho</option>
        <option value="Illinois" <?php if (!(strcmp("Illinois", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Illinois</option>
        <option value="Indiana" <?php if (!(strcmp("Indiana", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Indiana</option>
        <option value="Iowa" <?php if (!(strcmp("Iowa", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Iowa</option>
        <option value="Kansas" <?php if (!(strcmp("Kansas", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Kansas</option>
        <option value="Kentucky" <?php if (!(strcmp("Kentucky", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Kentucky</option>
        <option value="Louisiana" <?php if (!(strcmp("Louisiana", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Louisiana</option>
        <option value="Maine" <?php if (!(strcmp("Maine", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Maine</option>
        <option value="Maryland" <?php if (!(strcmp("Maryland", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Maryland</option>
        <option value="Massachusetts" <?php if (!(strcmp("Massachusetts", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Massachusetts</option>
        <option value="Michigan" <?php if (!(strcmp("Michigan", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Michigan</option>
        <option value="Minnesota" <?php if (!(strcmp("Minnesota", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Minnesota</option>
        <option value="Mississippi" <?php if (!(strcmp("Mississippi", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Mississippi</option>
        <option value="Missouri" <?php if (!(strcmp("Missouri", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Missouri</option>
        <option value="Montana" <?php if (!(strcmp("Montana", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Montana</option>
        <option value="Nebraska" <?php if (!(strcmp("Nebraska", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Nebraska</option>
        <option value="Nevada" <?php if (!(strcmp("Nevada", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Nevada</option>
        <option value="New Hampshire" <?php if (!(strcmp("New Hampshire", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>New Hampshire</option>
        <option value="New Jersey" <?php if (!(strcmp("New Jersey", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>New Jersey</option>
        <option value="New York" <?php if (!(strcmp("New York", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>New York</option>
        <option value="North Carolina" <?php if (!(strcmp("North Carolina", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>North Carolina</option>
        <option value="North Dakota" <?php if (!(strcmp("North Dakota", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>North Dakota</option>
        <option value="Ohio" <?php if (!(strcmp("Ohio", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Ohio</option>
        <option value="Oklahoma" <?php if (!(strcmp("Oklahoma", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Oklahoma</option>
        <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="Pennsylvania" <?php if (!(strcmp("Pennsylvania", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Pennsylvania</option>
        <option value="Oregon" <?php if (!(strcmp("Oregon", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="Rhode Island" <?php if (!(strcmp("Rhode Island", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Rhode Island</option>
        <option value="South Carolina" <?php if (!(strcmp("South Carolina", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>South Carolina</option>
        <option value="South Dakota" <?php if (!(strcmp("South Dakota", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>South Dakota</option>
        <option value="Tennessee" <?php if (!(strcmp("Tennessee", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Tennessee</option>
        <option value="Texas" <?php if (!(strcmp("Texas", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Texas</option>
        <option value="Utah" <?php if (!(strcmp("Utah", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Utah</option>
        <option value="Vermont" <?php if (!(strcmp("Vermont", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Vermont</option>
        <option value="Virginia" <?php if (!(strcmp("Virginia", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Virginia</option>
        <option value="Washington" <?php if (!(strcmp("Washington", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Washington</option>
        <option value="West Virginia" <?php if (!(strcmp("West Virginia", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>West Virginia</option>
        <option value="Wisconsin" <?php if (!(strcmp("Wisconsin", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Wisconsin</option>
        <option value="Wyoming" <?php if (!(strcmp("Wyoming", $row_rsUpdateRecord['State']))) {echo "selected=\"selected\"";} ?>>Wyoming</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Zip:</strong></td>
      <td><input type="text" name="Zip" value="<?php echo $row_rsUpdateRecord['Zip']; ?>" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Phone Number:</strong></td>
      <td><input type="text" name="PhoneNumber" value="<?php echo $row_rsUpdateRecord['PhoneNumber']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*Email Address:</strong></td>
      <td><input type="text" name="EmailAddress" value="<?php echo $row_rsUpdateRecord['EmailAddress']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Experience Level:</strong></td>
      <td><select name="ExperienceLevel" title="<?php echo $row_rsUpdateRecord['ExperienceLevel']; ?>">
          <option value="N/A" selected>Select Level</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsExperience['experience_level']?>"><?php echo $row_rsExperience['experience_level']?></option>
        <?php
} while ($row_rsExperience = mysql_fetch_assoc($rsExperience));
  $rows = mysql_num_rows($rsExperience);
  if($rows > 0) {
      mysql_data_seek($rsExperience, 0);
	  $row_rsExperience = mysql_fetch_assoc($rsExperience);
  }
?>
      </select>      </td>
    </tr>
    <tr valign="baseline" class="tableTop">
      <td colspan="2" align="right" nowrap="nowrap"><div align="left">Additional Presenters </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Name:</strong></td>
      <td><input type="text" name="addName1" value="<?php echo $row_rsUpdateRecord['addName1']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle1" value="<?php echo $row_rsUpdateRecord['addTitle1']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution1" value="<?php echo $row_rsUpdateRecord['addInstitution1']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Name:</strong></td>
      <td><input type="text" name="addName2" value="<?php echo $row_rsUpdateRecord['addName2']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle2" value="<?php echo $row_rsUpdateRecord['addTitle2']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution2" value="<?php echo $row_rsUpdateRecord['addInstitution2']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Name:</strong></td>
      <td><input type="text" name="addName3" value="<?php echo $row_rsUpdateRecord['addName3']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle3" value="<?php echo $row_rsUpdateRecord['addTitle3']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution3" value="<?php echo $row_rsUpdateRecord['addInstitution3']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline" class="tableTop">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left"><span class="tableheader">Program Information </span></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Session Type:</strong></td>
      <td valign="top"><select name="SessionType" id="SessionType">
        <option value="-------------" <?php if (!(strcmp("-------------", $row_rsUpdateRecord['SessionType']))) {echo "selected=\"selected\"";} ?>>-------------</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsSession['session_type']?>"<?php if (!(strcmp($row_rsSession['session_type'], $row_rsUpdateRecord['SessionType']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSession['session_type']?></option>
        <?php
} while ($row_rsSession = mysql_fetch_assoc($rsSession));
  $rows = mysql_num_rows($rsSession);
  if($rows > 0) {
      mysql_data_seek($rsSession, 0);
	  $row_rsSession = mysql_fetch_assoc($rsSession);
  }
?>
      </select>
</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Target Audience:</strong><br /></td>
      <td><textarea name="target_audience" cols="32" rows="5" id="target_audience"><?php echo $row_rsUpdateRecord['target_audience']; ?></textarea>
<br /></td>
    </tr>
    <tr valign="baseline" class="tableTop">
      <td colspan="2" align="right" nowrap="nowrap"><div align="left">Audio/Visual  Equipment Needs</div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="left">Check only the equipment you definitely need and  can not provide yourself. <br />
      A flip chart or white board and a projection screen  will be available in every room</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>
        <label>DVD player and Monitor</label>
:</strong></td>
      <td><input <?php if (!(strcmp($row_rsUpdateRecord['EquipmentNeeds'],"DVD player and Monitor"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="EquipmentNeeds" value="DVD player and Monitor " /></td>
    </tr>
    <?php /*?><tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>
        <label>Overhead Transparency Projector</label>
      :</strong></td>
      <td><input <?php if (!(strcmp($row_rsUpdateRecord['EquipmentNeeds2'],"Overhead Transparency Projector"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="EquipmentNeeds2" value="Overhead Transparency Projector" /></td>
    </tr><?php */?>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Other:</strong></td>
      <td><input name="EquipmentNeedsO" type="text" value="<?php echo $row_rsUpdateRecord['EquipmentNeedsO']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left"><strong>Schedule Request</strong><br />
      Do you plan to submit more than one program proposal for  SEAHO 2010?</div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left">
        <table>
          <tr>
            <td><input <?php if (!(strcmp($row_rsUpdateRecord['SchRequests'],"Yes"))) {echo "checked=\"checked\"";} ?> type="radio" name="SchRequests" value="Yes" />
              Yes</td>
            </tr>
          <tr>
            <td><input <?php if (!(strcmp($row_rsUpdateRecord['SchRequests'],"No"))) {echo "checked=\"checked\"";} ?> type="radio" name="SchRequests" value="No" />
              No</td>
            </tr>
        </table>
        <br />
      If &ldquo;yes&rdquo; please rank your preferred order for programs <br />
      you  would like to present if more than one of your programs is selected.</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>1st Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle1" value="<?php echo $row_rsUpdateRecord['SchRequestsTitle1']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>1st Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter1" value="<?php echo $row_rsUpdateRecord['SchRequestsPresenter1']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>2nd Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle2" value="<?php echo $row_rsUpdateRecord['SchRequestsTitle2']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>2nd Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter2" value="<?php echo $row_rsUpdateRecord['SchRequestsPresenter2']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>3rd Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle3" value="<?php echo $row_rsUpdateRecord['SchRequestsTitle3']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>3rd Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter3" value="<?php echo $row_rsUpdateRecord['SchRequestsPresenter3']; ?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Best Seaho:</strong>
      <br /></td>
      <td valign="baseline">Would you like to be considered<br />
        for the Best of SEAHO
  <table>
        <tr>
          <td><input <?php if (!(strcmp($row_rsUpdateRecord['BestSeaho'],"Yes"))) {echo "checked=\"checked\"";} ?> type="radio" name="BestSeaho" value="Yes" />
            Yes</td>
        </tr>
        <tr>
          <td><input <?php if (!(strcmp($row_rsUpdateRecord['BestSeaho'],"No"))) {echo "checked=\"checked\"";} ?> type="radio" name="BestSeaho" value="No" />
            No</td>
        </tr>
      </table></td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Topic Area:</strong></td>
      <td><select name="TopicArea" title="<?php echo $row_rsUpdateRecord['TopicArea']; ?>">
        <option value="-------------------" selected <?php if (!(strcmp("-------------------", $row_rsUpdateRecord['TopicArea']))) {echo "selected=\"selected\"";} ?>>-------------------</option>
        <?php
do {  
?><option value="<?php echo $row_rsTopics['topic_area']?>"<?php if (!(strcmp($row_rsTopics['topic_area'], $row_rsUpdateRecord['TopicArea']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsTopics['topic_area']?></option>
        <?php
} while ($row_rsTopics = mysql_fetch_assoc($rsTopics));
  $rows = mysql_num_rows($rsTopics);
  if($rows > 0) {
      mysql_data_seek($rsTopics, 0);
	  $row_rsTopics = mysql_fetch_assoc($rsTopics);
  }
?>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left"><strong>Learning Objectives</strong><br />
      Please identify 3 learning objectives for your program (20 words each)</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Learning Objective 1:</strong></td>
      <td><textarea name="LearningObj1" cols="50" rows="5"><?php echo $row_rsUpdateRecord['LearningObj1']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Learning Objective 2:</strong></td>
      <td><textarea name="LearningObj2" cols="50" rows="5"><?php echo $row_rsUpdateRecord['LearningObj2']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Learning Objective 3:</strong></td>
      <td><textarea name="LearningOjb3" cols="50" rows="5"><?php echo $row_rsUpdateRecord['LearningOjb3']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left">        <strong>Please enter a  description of the program for the program booklet</strong>.
        <ul>
          <li> Type directly into the text box or cut and paste from a word processing document</li>
          <li> Must not exceed 100 word</li>
        </ul>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap">
        <div align="center">
          <textarea name="ProgramDescription" cols="75" rows="9"><?php echo $row_rsUpdateRecord['ProgramDescription']; ?></textarea>
        </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left">
        <p><strong>Outline of presentation</strong> (500 word maximum)</p>
        <ul>
          <li> Detailed outline of presentation</li>
          <li>Presentation method, and how it is connected to your learning objectives.</li>
          <li> Type directly into the text box or cut and paste from a word processing document</li>
          <li>Must not exceed 500 words</li>
        </ul>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="center">
        <textarea name="OutlineOfPresentation" cols="75" rows="10"><?php echo $row_rsUpdateRecord['OutlineOfPresentation']; ?></textarea>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="submission_date" value="<?php echo $systemDate;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Edit Proposal" /></td>
    </tr>
  </table>
  
    <input type="hidden" name="MM_update" value="form1">
</form>
<SCRIPT language="JavaScript">
		var frmvalidator  = new Validator("form1");
		
		frmvalidator.addValidation("ProgramTitle","req","Please enter a Program Title");
		frmvalidator.addValidation("FirstName","req","Please enter your First Name");
		frmvalidator.addValidation("LastName","req","Please enter your Last Name");
		frmvalidator.addValidation("EmailAddress","req","Please enter your email");
		frmvalidator.addValidation("EmailAddress","email","Please enter a valid email address");
			
	</SCRIPT>
</p>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSession);

mysql_free_result($rsTarget);

mysql_free_result($rsTopics);

mysql_free_result($rsExperience);

mysql_free_result($rsUpdateRecord);
?>
