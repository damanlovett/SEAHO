<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incPUAddOn.php'); ?>
<?php

$message = "
<p> Here is the information submitted:</p>

<p>
Name: ".$_POST['first_name']." ".$_POST['last_name']."<br />
Name: ".$_POST['address']."<br />
Name: ".$_POST['office']."<br />
Name: ".$_POST['email']."<br />
Name: ".$_POST['mobile']."<br />
Name: ".$_POST['title']."<br />
Name: ".$_POST['institution']."<br />
Name: ".$_POST['type_institution']."<br />
Name: ".$_POST['current_position']."<br />
Name: ".$_POST['state']."<br />
Name: ".$_POST['size_institution']."<br />
Name: ".$_POST['supervisor']."<br />
Name: ".$_POST['supervisor_email']."<br />
Name: ".$_POST['hope_to_gain']."<br />
Name: ".$_POST['professional_goals']."<br />


";

// Pure PHP Upload 2.1.3
if (isset($HTTP_GET_VARS['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = "resumes";
	$ppu->extensions = "";
	$ppu->formName = "reliapplication";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "";
	$ppu->nameConflict = "uniq";
	$ppu->requireUpload = "true";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "";
	$ppu->maxHeight = "";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
	$ppu->progressBar = "";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  if (!eregi("GP_upload=true", $HTTP_SERVER_VARS['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$HTTP_SERVER_VARS['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$HTTP_SERVER_VARS['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

// Mail Uploaded Files Addon 1.0.6
if (isset($HTTP_GET_VARS['GP_upload'])) {
  $muf = new mailUploadedFiles($ppu);
  $muf->fromName = "SEAHO Email";
  $muf->fromEmail = "no-reply@seaho.org";
  $muf->toName = "Reli Committee";
  $muf->toEmail = "eddie@lovettcreations.org";
  $muf->bccEmail = "";
  $muf->mailType = "mail";
  $muf->subject = "Reli Application";
  $muf->body = $message;
  $muf->errors = false;
  $muf->html = true;
  $muf->deleteFiles = false;
  $muf->smtpServer = "";
  $muf->smtpUserName = "";
  $muf->smtpPassword = "";
  $muf->checkVersion("1.0.6");
  $muf->sendMail();

  $mailGoTo = "applicationconfirm.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $mailGoTo .= (strpos($mailGoTo, '?')) ? "&" : "?";
    $mailGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $mailGoTo));
}

if (isset($editFormAction)) {
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $HTTP_SERVER_VARS['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
form {
	margin: 0px;
	padding: 0px;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
      <div align="center"><img src="../images/banner/sbannerconference.jpg" alt="" width="764" height="95" /></div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
      <fieldset>
      <legend>Important Links</legend>
      <a href="#">Calendar of Events </a><a href="#">Resources</a><a href="#">2007 Conference </a><a href="#">Southern Placement Exchange </a><a href="#">Online Directory </a><a href="#">SEAHO Report </a><a href="#">Resources</a>
      </fieldset>
      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <p><strong>RELI Form</strong></p>
      <form action="<?php echo $GP_uploadAction; ?>" method="post" enctype="multipart/form-data" name="reliapplication" id="reliapplication" onsubmit="checkFileUpload(this,'',true,'','','','','','','');return document.MM_returnValue">
        <table width="90%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td><label for="first_name">First Name:</label></td>
            <td><input type="text" name="first_name" id="first_name" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="last_name">Last Name:</label></td>
            <td><input type="text" name="last_name" id="last_name" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="address">Mailing Address:</label></td>
            <td colspan="4"><textarea name="address" id="address" cols="45" rows="5"></textarea></td>
          </tr>
          <tr>
            <td><label for="office">Office Number:</label></td>
            <td><input type="text" name="office" id="office" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="text" name="email" id="email" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="mobile">Mobile Number:</label></td>
            <td><input type="text" name="mobile" id="mobile" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="position">Position Title:</label></td>
            <td><input type="text" name="position" id="position" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="institution">Institution:</label></td>
            <td><input type="text" name="institution" id="institution" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="type_institution">Type Institution:</label></td>
            <td><select name="type_institution" id="type_institution">
              <option value="Public">Public</option>
              <option value="Private">Private</option>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="current_position">Length of Time in Current Position:</label></td>
            <td><input type="text" name="current_position" id="current_position" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="state">State of Institution:</label></td>
            <td><select name="state">
              <option value="" selected="selected">Choose a State</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District Of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="OR">Oregon</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="size_institution">Size of Institution:</label></td>
            <td><select name="size_institution" id="size_institution">
              <option value=">1500">>1500</option>
              <option value="1500-3000">1500-3000</option>
              <option value="3000-5000">3000-5000</option>
              <option value="<5000"><5000</option>
                        </select>              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="supervisor">Name of Direct Supervisor:</label></td>
            <td><input type="text" name="supervisor" id="supervisor" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><label for="supervisor_email">Email of Direct Supervisor:</label></td>
            <td valign="top"><input type="text" name="supervisor_email" id="supervisor_email" /></td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" valign="top"><span id="sprytextarea1">
            <label for="hope_to_gain">What Do You Hope to Gain?</label>
            <span id="countsprytextarea1">&nbsp;</span> <br />
            <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span>
              <br />
            <textarea name="hope_to_gain" cols="60" rows="10" wrap="virtual" id="hope_to_gain"></textarea></td>
          </tr>
          <tr>
            <td colspan="5"><span id="sprytextarea2">
            <label for="professional_goals">What are Your Professional Goals?</label>
            <span id="countsprytextarea2">&nbsp;</span><br /> 
            <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span><br />
            <textarea name="professional_goals" cols="60" rows="7" wrap="virtual" id="professional_goals"></textarea></td>
          </tr>
          <tr>
            <td colspan="5"><label for="resume">Attach Your Resume:</label>
            <input name="resume" type="file" id="resume" onchange="checkOneFileUpload(this,'',true,'','','','','','','')" size="35" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="button"></label>
            <input type="submit" name="button" id="button" value="Submit Application" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
      <p>
        <label for="institution"></label>
        <script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {counterId:"countsprytextarea1", counterType:"chars_count", maxChars:2000});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {counterId:"countsprytextarea2", maxChars:1000});
//-->
        </script>
</p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
