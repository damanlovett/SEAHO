<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incPUAddOn.php'); ?>
<?php

$message = "
<p> Here is the information submitted:</p>

<p>
Name: ".$_POST['first_name']." ".$_POST['last_name']."<br />
Address: ".$_POST['address']."<br />
Office Phone: ".$_POST['office']."<br />
Email: ".$_POST['email']."<br />
Mobile Phone: ".$_POST['mobile']."<br />
Title: ".$_POST['position']."<br />
Institution: ".$_POST['institution']."<br />
Type: ".$_POST['type_institution']."<br />
Position: ".$_POST['current_position']."<br />
Full-Time: ".$_POST['fullTime']."<br />
State: ".$_POST['state']."<br />
Size: ".$_POST['size_institution']."<br />
Supervisor: ".$_POST['supervisor']."<br />
Supervisor email: ".$_POST['supervisor_email']."<br />
Gain: ".$_POST['hope_to_gain']."<br />
Goals: ".$_POST['professional_goals']."<br />
Race: ".$_POST['race']."<br />
T-shirt: ".$_POST['tshirt']."<br />
Special: ".$_POST['special']."<br />
Meals: ".$_POST['meals']."<br />
Financial: ".$_POST['financial']."<br />
Scholarship: <br />".$_POST['registration']."<br />
".$_POST['travel']."<br />

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
  $muf->toEmail = "reli@seaho.org";
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
label {
	text-align: left;
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
      <?php require_once('../includefiles/importantlinks.inc.php'); ?>
      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <p><strong>RELI Form</strong></p>
      <p>The timeline for applications will be: </p>
      <ul>
        <li>Applications     Open &ndash; <span class="boldRed">NOW</span></li>
        <li>Application     Deadline &ndash; March 11th, 5:00pm EST</li>
        <li>Successful     Applicants Notified &ndash; April 1st</li>
      </ul>
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
            <td><input name="email" type="text" id="email" size="40" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="mobile">Cell Number:</label></td>
            <td><input type="text" name="mobile" id="mobile" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="position">Position Title:</label></td>
            <td><input name="position" type="text" id="position" size="40" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="institution">Institution:</label></td>
            <td><input name="institution" type="text" id="institution" size="40" /></td>
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
            <td><label for="fullTime"> Total length of time in professional full-time positions:</label></td>
            <td><input type="text" name="fullTime" id="fullTime" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label for="state">State of Institution:</label></td>
            <td><select name="state">
              <option value="" selected="selected">Choose a State</option>
              <option value="AL">Alabama</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="MS">Mississippi</option>
              <option value="NC">North Carolina</option>
              <option value="SC">South Carolina</option>
              <option value="TN">Tennessee</option>
              <option value="VA">Virginia</option>
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
            <td><label for="race"> Race/Ethnicity (Optional):</label> </td>
            <td>
              <input type="text" name="race" id="race" />
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" valign="top"><span id="sprytextarea1"> What do you hope to gain from attending RELI ?<span id="countsprytextarea1">&nbsp;</span> <br />
            <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span>
              <br />
            <textarea name="hope_to_gain" cols="60" rows="10" wrap="virtual" id="hope_to_gain"></textarea></td>
          </tr>
          <tr>
            <td colspan="5"><span id="sprytextarea2">
            <label for="professional_goals"> What are your professional goals for the next 3-5 years?</label>
            <span id="countsprytextarea2">&nbsp;</span><br /> 
            <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span><br />
            <textarea name="professional_goals" cols="60" rows="7" wrap="virtual" id="professional_goals"></textarea></td>
          </tr>
          <tr>
            <td colspan="5"><label for="support" class="leftFloat">Please submit  a current resume: <br />
              :</label>
            <input name="resume" type="file" id="resume" onchange="checkOneFileUpload(this,'',true,'','','','','','','')" size="35" /></td>
          </tr><tr>
            <td colspan="5"><label for="support"> Please attach a letter of reference and support from your <br />
              Director of Housing or Director of Residence Life<br />
(higher level supervisor or CHO):</label>
            <input name="support" type="file" id="support" onchange="checkOneFileUpload(this,'',true,'','','','','','','')" size="35" /></td>
          </tr>
          <tr>
            <td colspan="5"><strong><em>The following questions relate to conference&nbsp;</em></strong><strong><em>logis</em></strong><strong><em>tics and possible scholarship awards should you be selected as a RELI 2011 partipant --</em></strong></td>
          </tr>
          <tr>
            <td> What is your T-shirt size: ____ </td>
            <td><label>
              <select name="tshirt" id="tshirt">
                <option value="n/a">-----</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="2XL">2XL</option>
                <option value="3XL">3XL</option>
                <option value="4XL">4XL</option>
              </select>
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td> What, if any, special accomodations would you require to participate in RELI: </td>
            <td><label>
              <textarea name="special" id="special" cols="45" rows="5"></textarea>
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td> What, if any, special meal needs would you have (ie: food allegies, vegetarian option needed): </td>
            <td><label>
              <textarea name="meals" id="meals" cols="45" rows="5"></textarea>
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5"><strong> Scholarships are available for SEAHO participants. Please answer the following questions to determine your qualifications for a scholarship award -- </strong></td>
          </tr>
          <tr>
            <td><em>Which best classifies you</em><em>r financial need:</em></td>
            <td colspan="4"><table width="="200" align="left">
<tr><td><label>
                <input type="radio" name="financial" value="self-funded" id="financial_0" />
                I would be self-funded for RELI 2011</label>
              </td></tr>
              <tr><td><label>
                <input type="radio" name="financial" value="institution-funded" id="financial_1" />
                My institution would fund my registration and travel costs</label>
              </td></tr>
</table>
            </p></td>
          </tr>
          <tr>
            <td colspan="5"><hr /></td>
          </tr>
          <tr>
            <td> Scholarship requests:</td>
            <td colspan="4"><table width="200" align="left">
              <tr>
                <td><label>
                  <input type="checkbox" name="registration" value="Registration Waiver" id="registration" />
                  Registration Waiver</label></td>
                </tr>
              <tr>
                <td><label>
<input type="checkbox" name="travel" value="Travel Reimbursement" id="travel" />
Travel Reimbursement</label></td>
                </tr>
            </table>              <p>&nbsp;</p></td>
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
