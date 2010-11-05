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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO callforprograms (ProgramTitle, FirstName, LastName, MiddleInitial, Title, Institution, Address, City, `State`, Zip, PhoneNumber, EmailAddress, ExperienceLevel, addName1, addTitle1, addInstitution1, addName2, addTitle2, addInstitution2, addName3, addTitle3, addInstitution3, SessionType, target_audience, EquipmentNeeds, EquipmentNeeds2, EquipmentNeedsO, SchRequests, SchRequestsTitle1, SchRequestsPresenter1, SchRequestsTitle2, SchRequestsPresenter2, SchRequestsTitle3, SchRequestsPresenter3, BestSeaho, TopicArea, LearningObj1, LearningObj2, LearningOjb3, ProgramDescription, OutlineOfPresentation, submission_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString(join(", ",$_POST['target_audience']), "text"),
                       GetSQLValueString($_POST['EquipmentNeeds'], "text"),
                       GetSQLValueString($_POST['EquipmentNeeds2'], "text"),
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
                       GetSQLValueString($_POST['submission_date'], "date"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());

  $insertGoTo = "confirmation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
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
    <h2><!-- InstanceBeginEditable name="PageTite" --><span><img src="../../images/LCCMPHadminUser.jpg" alt="Users" width="65" height="51" />Admin Proposal Form</span><!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" -->
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
<br />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table border="0" align="center" cellpadding="5" cellspacing="0" class="tableborder">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*Program Title:</strong></td>
      <td><input type="text" name="ProgramTitle" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" class="tableTop"><div align="left">Conference Presenter </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*First Name:</strong></td>
      <td><input type="text" name="FirstName" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*Last Name:</strong></td>
      <td><input type="text" name="LastName" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Middle Initial:</strong></td>
      <td><input type="text" name="MiddleInitial" value="" size="7" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="Title" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="Institution" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Address:</strong></td>
      <td><textarea name="Address" cols="32" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>City:</strong></td>
      <td><input type="text" name="City" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>State:</strong></td>
      <td><select name="State" id="State">
          <option value="" selected="selected">Choose a State</option>
          <option value="Alabama">Alabama</option>
          <option value="Alaska">Alaska</option>
          <option value="Arizona">Arizona</option>
          <option value="Arkansas">Arkansas</option>
          <option value="California">California</option>
          <option value="Colorado">Colorado</option>
          <option value="Connecticut">Connecticut</option>
          <option value="Delaware">Delaware</option>
          <option value="District Of Columbia">District Of Columbia</option>
          <option value="Florida">Florida</option>
          <option value="Georgia">Georgia</option>
          <option value="Hawaii">Hawaii</option>
          <option value="Idaho">Idaho</option>
          <option value="Illinois">Illinois</option>
          <option value="Indiana">Indiana</option>
          <option value="Iowa">Iowa</option>
          <option value="Kansas">Kansas</option>
          <option value="Kentucky">Kentucky</option>
          <option value="Louisiana">Louisiana</option>
          <option value="Maine">Maine</option>
          <option value="Maryland">Maryland</option>
          <option value="Massachusetts">Massachusetts</option>
          <option value="Michigan">Michigan</option>
          <option value="Minnesota">Minnesota</option>
          <option value="Mississippi">Mississippi</option>
          <option value="Missouri">Missouri</option>
          <option value="Montana">Montana</option>
          <option value="Nebraska">Nebraska</option>
          <option value="Nevada">Nevada</option>
          <option value="New Hampshire">New Hampshire</option>
          <option value="New Jersey">New Jersey</option>
          <option value="New York">New York</option>
          <option value="North Carolina">North Carolina</option>
          <option value="North Dakota">North Dakota</option>
          <option value="Ohio">Ohio</option>
          <option value="Oklahoma">Oklahoma</option>
          <option value="Oregon">Oregon</option>
          <option value="Pennsylvania">Pennsylvania</option>
          <option value="Oregon">Oregon</option>
          <option value="Rhode Island">Rhode Island</option>
          <option value="South Carolina">South Carolina</option>
          <option value="South Dakota">South Dakota</option>
          <option value="Tennessee">Tennessee</option>
          <option value="Texas">Texas</option>
          <option value="Utah">Utah</option>
          <option value="Vermont">Vermont</option>
          <option value="Virginia">Virginia</option>
          <option value="Washington">Washington</option>
          <option value="West Virginia">West Virginia</option>
          <option value="Wisconsin">Wisconsin</option>
          <option value="Wyoming">Wyoming</option>
        </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Zip:</strong></td>
      <td><input type="text" name="Zip" value="" size="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Phone Number:</strong></td>
      <td><input type="text" name="PhoneNumber" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>*Email Address:</strong></td>
      <td><input type="text" name="EmailAddress" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Experience Level:</strong></td>
      <td><select name="ExperienceLevel">
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
      <td><input type="text" name="addName1" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle1" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution1" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Name:</strong></td>
      <td><input type="text" name="addName2" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle2" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution2" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Name:</strong></td>
      <td><input type="text" name="addName3" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
      <td><input type="text" name="addTitle3" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input type="text" name="addInstitution3" value="" size="45" /></td>
    </tr>
    <tr valign="baseline" class="tableTop">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left"><span class="tableheader">Program Information </span></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Session Type:</strong></td>
      <td valign="top"><?php do { ?>
          <input type="radio" name="SessionType" value="<?php echo $row_rsSession['session_type']; ?>" />
          <?php echo $row_rsSession['session_type']; ?><br />
          <?php } while ($row_rsSession = mysql_fetch_assoc($rsSession)); ?></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Target Audience:</strong><br /></td>
      <td><select name="target_audience[]" size="6" multiple="multiple">
        <?php
do {  
?>
        <option value="<?php echo $row_rsTarget['experience_level']?>"><?php echo $row_rsTarget['experience_level']?></option>
        <?php
} while ($row_rsTarget = mysql_fetch_assoc($rsTarget));
  $rows = mysql_num_rows($rsTarget);
  if($rows > 0) {
      mysql_data_seek($rsTarget, 0);
	  $row_rsTarget = mysql_fetch_assoc($rsTarget);
  }
?>
      </select>
      <br />
      (Use shift key to select multiple targets)</td>
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
      <td><input type="checkbox" name="EquipmentNeeds" value="DVD player and Monitor " /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>
        <label>Overhead Transparency Projector</label>
      :</strong></td>
      <td><input type="checkbox" name="EquipmentNeeds2" value="Overhead Transparency Projector" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Other:</strong></td>
      <td><input name="EquipmentNeedsO" type="text" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left"><strong>Schedule Request</strong><br />
      Do you plan to submit more than one program proposal for  SEAHO 2007?</div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left">
        <table>
          <tr>
            <td><input type="radio" name="SchRequests" value="Yes" />
              Yes</td>
            </tr>
          <tr>
            <td><input type="radio" name="SchRequests" value="No" />
              No</td>
            </tr>
        </table>
        <br />
      If &ldquo;yes&rdquo; please rank your preferred order for programs <br />
      you  would like to present if more than one of your programs is selected.</div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>1st Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle1" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>1st Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter1" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>2nd Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle2" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>2nd Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter2" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>3rd Choice Title Title:</strong></td>
      <td><input type="text" name="SchRequestsTitle3" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>3rd Choice Title Presenter:</strong></td>
      <td><input type="text" name="SchRequestsPresenter3" value="" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><strong>Best Seaho:</strong>
      <br /></td>
      <td valign="baseline">Would you like to be considered<br />
        for the Best of SEAHO
  <table>
        <tr>
          <td><input type="radio" name="BestSeaho" value="Yes" />
            Yes</td>
        </tr>
        <tr>
          <td><input type="radio" name="BestSeaho" value="No" />
            No</td>
        </tr>
      </table></td></tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Topic Area:</strong></td>
      <td><select name="TopicArea">
          <option value="-------------------" selected>-------------------</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsTopics['topic_area']?>"><?php echo $row_rsTopics['topic_area']?></option>
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
      <td><textarea name="LearningObj1" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Learning Objective 2:</strong></td>
      <td><textarea name="LearningObj2" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Learning Objective 3:</strong></td>
      <td><textarea name="LearningOjb3" cols="50" rows="5"></textarea>      </td>
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
          <textarea name="ProgramDescription" cols="75" rows="5"></textarea>
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
        <textarea name="OutlineOfPresentation" cols="50" rows="5"></textarea>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="hidden" name="submission_date" value="<?php echo $systemDate;?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Submit Proposal" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<SCRIPT language="JavaScript">
		var frmvalidator  = new Validator("form1");
		
		frmvalidator.addValidation("ProgramTitle","req","Please enter a Program Title");
		frmvalidator.addValidation("FirstName","req","Please enter your First Name");
		frmvalidator.addValidation("LastName","req","Please enter your Last Name");
		frmvalidator.addValidation("EmailAddress","req","Please enter your email");
		frmvalidator.addValidation("EmailAddress","email","Please enter a valid email address");
			
	</SCRIPT>
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
?>
