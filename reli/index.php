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
Title: ".$_POST['title']."<br />
Institution: ".$_POST['institution']."<br />
Type: ".$_POST['type_institution']."<br />
Position: ".$_POST['current_position']."<br />
State: ".$_POST['state']."<br />
Size: ".$_POST['size_institution']."<br />
Supervisor: ".$_POST['supervisor']."<br />
Supervisor email: ".$_POST['supervisor_email']."<br />
Gain: ".$_POST['hope_to_gain']."<br />
Goals: ".$_POST['professional_goals']."<br />


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
      <?php require_once('../includefiles/importantlinks.inc.php'); ?>
      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->

<p><img src="../images/imgreliLogo2009.jpg" alt="Reli Image" width="288" height="90" hspace="5" vspace="5" /></p>
<p>The 8th Annual SEAHO   Regional Entry Level Institute (RELI) will be held June 1– June 4, 2011 on   the beautiful campus of Duke University in Durham, North Carolina. Co-sponsored   by SEAHO and Southwest Contract, SEAHO’s Regional Entry Level Institute is an intensive four-day professional development seminar featuring activities for new  
professionals who aspire to mid-level positions in housing and residential life.  RELI is open to professionals with 1-3 years of full-time  
experience and, to insure an appropriate mentoring environment, is limited to a maximum of 32 students.  The Institute’s 8 faculty  
members will spend classroom and individual time with attendees making it beneficial as both a professional and personal experience.  </p>
      <p><strong><em>This year&rsquo;s accompl</em></strong><strong><em>ished faculty and the </em></strong><strong><em>topics they will be facilitating are:</em></strong></p>
<hr />
      <table cellpadding="4" cellspacing="0">
        <tbody>
          <tr> <td><strong>Steve Stauffer </strong></td><td></td><td>University of Kentucky</td> </tr>
          <tr> <td><strong>Kayla Hamilton </strong></td><td></td><td>Emory University  </td> </tr>
          <tr> <td><strong>Adrienne Frame </strong></td><td></td><td>Florida State University  </td> </tr>
          <tr> <td><strong>Gretchen Brockmann </strong></td><td></td><td>East Carolina University  </td> </tr>
          <tr> <td><strong>Vickie Hawkins </strong></td><td></td><td>Appalachian State University  </td> </tr>
          <tr> <td><strong>Jason Cassidy </strong></td><td></td><td>Furman University  </td> </tr>
          <tr> <td><strong>Chris Crenshaw </strong></td><td></td><td>University of Southern Mississippi  </td> </tr>
          <tr> <td><strong>Nik Clegorne </strong></td><td></td><td>Louisiana State University  </td> </tr>
        </tbody>
      </table>
<hr />


<div class="hideDiv"> <!-- Hidden div -->
<p><strong><em>Application Process:</em></strong></p>
      <ul>
        <li>As  part of the application process you will answer questions that ask you  to reflect on your professional goals as well as what you hope to gain  from the institute.</li>
        <li>You will also be asked to submit two documents: </li>
                  <ul>
<li>A current resume</li>
            <li>A letter of reference and support from your Director of Housing or your Director of Residence Life.        </li>
          </ul>
        <!--- <li>The <a href="formApplication.php">RELI 2011 Application</a> ( Available  <span class="smallBoldRed">NOW</span> )</li> -->
      </ul>
<p><strong><em>RELI 2011 Timeline: </em></strong></p>
      <ul>
        <li><a href="formApplication.php">Applications Open</a> &ndash; <span class="smallBoldRed">NOW</span> </li> -->
        <li>Application Deadline &ndash; March 11th, 5:00pm EST</li>
        <li>Successful Applicants Notified &ndash; April 1st </li>
      </ul>
      <p><em><strong>Institute Costs:
      </strong></em></p>
      <ul dir="ltr">
        <li>
          <div>The registration rate for RELI 2011 will be $150 per participant and includes three nights lodging, meals and materials.</div>
        </li>
        <li>
          <div>A number of travel and registration scholarships will be available. If you awarded a scholarship, you will be notified when you are&nbsp;made aware&nbsp;of your selection status.</div>
        </li>
      </ul>

</div> <!-- End of hidden div -->


<p>&nbsp;</p>
      <form action="<?php echo $GP_uploadAction; ?>" method="post" enctype="multipart/form-data" name="reliapplication" id="reliapplication" onsubmit="checkFileUpload(this,'',true,'','','','','','','');return document.MM_returnValue">
        <table width="90%" border="0" cellspacing="0" cellpadding="4">
          <tr>          </tr>
          <tr>          </tr>
        </table>
      </form>
      <p>
        <label for="institution"></label>
</p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
