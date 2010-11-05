<?php
//CAPTCHA***
session_start();
$captcha_error_message="";
$captcha_var="";
//Has the Action variable been submitted?
if(isset($_POST["MM_insert"])){
	//store captcha field value
	if(isset($_POST['captcha'])){
		$captcha_var=$_POST['captcha'];
	}else if(isset($_GET['captcha'])){
		$captcha_var=$_GET['captcha'];
	}
	//Check for failure:
	//1. Is there $_SESSION['captcha']?
	//2. Is $_SESSION['captcha'] blank?
	//3. Is captcha string blank (it is by deafault)?
	//4. Is there a match?
	if(!isset($_SESSION['captcha']) || $_SESSION['captcha']=="" || $captcha_var=="" || (isset($_SESSION['captcha']) && md5($captcha_var)!=$_SESSION['captcha'])){
		unset($_POST["MM_insert"]);
		$captcha_error_message="<div class=\"captcha_error_message\">Incorrect! Please re-enter validation code.</div><script>function setCaptchaFocus(){var c=document.getElementById('captcha');c.scrollIntoView(true);c.select()};function addEvt(){if (window.addEventListener){window.addEventListener('load',setCaptchaFocus,null);return true}else if(window.attachEvent){return window.attachEvent('onload',setCaptchaFocus)}}; addEvt();</script>";
	}
}
function makeCaptcha($im,$len,$t1,$t2,$t3,$b1,$b2,$b3,$error_message){
	echo "<input name=\"captcha\" type=\"text\" autocomplete=\"off\" id=\"captcha\" /><br /><img onclick=\"rfr='&'+(new Date()).getTime();this.src+=rfr\" style=\"cursor:pointer\" src=\"captcha.php?image_file=".$im."&len=".$len."&t1=".$t1."&t2=".$t2."&t3=".$t3."&b1=".$b1."&b2=".$b2."&b3=".$b3."\" />".$error_message;
}
 
?><?php require_once('../../../Connections/CMS.php'); ?>
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
<?php require_once('../../includefiles/initFunctions.php'); ?>
<?php require_once('../../includefiles/initEmails.php'); ?>

<?php

$colname_rsDuplicate = "-1";
if (isset($_POST['email'])) {
  $colname_rsDuplicate = $_POST['email'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsDuplicate = sprintf("SELECT associate_id, email FROM associate WHERE email = %s", GetSQLValueString($colname_rsDuplicate, "text"));
$rsDuplicate = mysql_query($query_rsDuplicate, $CMS) or die(mysql_error());
$row_rsDuplicate = mysql_fetch_assoc($rsDuplicate);
$totalRows_rsDuplicate = mysql_num_rows($rsDuplicate);

if($totalRows_rsDuplicate!=0){

header("Location: newDuplicateAccount.php?duplicate=1");
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newassociates")) {

NewMemberEmail($_POST['first_name'],$_POST['email'],$_POST['password']);

}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newassociates")) {
  $insertSQL = sprintf("INSERT INTO associate (associate_id, org_name, seaho_years, provides, first_name, last_name, preferred_name, job_title, email, alt_email, password, address1, city, `state`, zip, office_phone, cell_phone, fax, website, created) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['associate_id'], "text"),
                       GetSQLValueString($_POST['org_name'], "text"),
                       GetSQLValueString($_POST['seaho_years'], "int"),
                       GetSQLValueString($_POST['provides'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['preferred_name'], "text"),
                       GetSQLValueString($_POST['job_title'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alt_email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['address1'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['office_phone'], "text"),
                       GetSQLValueString($_POST['cell_phone'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['website'], "text"),
                       GetSQLValueString($_POST['created'], "date"));
sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());

  $insertGoTo = "newconfirmation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>New Associate Account</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<script type="text/javascript" src="../../includefiles/gen_validatorv2.js"></script>
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
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" --> <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../../../includefiles/importantlinks.inc.php'); ?>
    <!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h1>New Associate Account </h1>
      <p>Fields marked <span class="required">*</span> are required
      <form action="<?php echo $editFormAction; ?>" method="POST" name="newassociates" id="newassociates">
  <table border="0" align="center" cellpadding="0" cellspacing="0" class="tableBasicForm">
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><div align="left">
        <h2><strong>Contact Information</strong></h2>
      </div></td>
      <td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Company Name:</h2></td>
      <td valign="middle"><input name="org_name" type="text" value="<?php echo $_POST['org_name'];?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Years with SEAHO:</h2></td>
      <td valign="middle"><input name="seaho_years" type="text" value="<?php echo $_POST['seaho_years']?>" size="10" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap">
        <h2>Service: </h2></td>
      <td valign="middle">
        <select name="provides" id="provides">
          <option value="<?php echo $_POST['provides']?>"><?php echo $_POST['provides']?></option>
          <option value="Goods">Goods</option>
          <option value="Services">Services</option>
          <option value="Goods &amp; Services">Goods and Services</option>
        </select>        </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>First Name:</h2></td>
      <td valign="middle"><input name="first_name" type="text" id="first_name" value="<?php echo $_POST['first_name']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Last Name:</h2></td>
      <td valign="middle"><input name="last_name" type="text" value="<?php echo $_POST['last_name']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Name for nametag:</h2></td>
      <td valign="middle"><input name="preferred_name" type="text" value="<?php echo $_POST['preferred_name']?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Job Title:</h2></td>
      <td valign="middle"><input name="job_title" type="text" value="<?php echo $_POST['job_title']?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Email:</h2></td>
      <td valign="middle"><input name="email" type="text" value="<?php echo $_POST['email']?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Alternate Email:</h2></td>
      <td valign="middle"><input name="alt_email" type="text" value="<?php echo $_POST['alt_email']?>" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Password:</h2></td>
      <td valign="middle"><input name="password" type="password" value="<?php echo $_POST['password']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
      <td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><div align="left">
        <h2><strong>Company Information</strong></h2>
      </div></td>
      <td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="middle"><h2>Address:</h2></td>
      <td valign="middle"><textarea name="address1" cols="50" rows="5"><?php echo $_POST['address1']?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>City:</h2></td>
      <td valign="middle"><input name="city" type="text" value="<?php echo $_POST['city']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>State:</h2></td>
      <td valign="middle"><select name="state" id="state">
      <?php if(isset($_POST['state'])) {?>
        <option value="<?php echo $_POST['state']?>" selected="selected"><?php echo $_POST['state']?></option>
       <?php } else {?>
        <option value="" selected="selected">Choose a State</option>
       <?php }?>
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
        </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Zip:</h2></td>
      <td valign="middle"><input name="zip" type="text" value="<?php echo $_POST['zip']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2><span class="required">*</span>Office Phone:</h2></td>
      <td valign="middle"><input name="office_phone" type="text" value="<?php echo $_POST['office_phone']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Cell Phone:</h2></td>
      <td valign="middle"><input name="cell_phone" type="text" value="<?php echo $_POST['cell_phone']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Fax:</h2></td>
      <td valign="middle"><input name="fax" type="text" value="<?php echo $_POST['fax']?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><h2>Website:</h2></td>
      <td valign="middle"><input name="website" type="text" value="http://" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap="nowrap"><div align="left">
        <h2><strong>Verification Code</strong></h2>
      </div></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><h2><span class="required">*</span>Enter Code:</h2></td>
      <td valign="middle"><?php makeCaptcha("../../../images/captcha/image1.jpg","","0","0","0","0","153","204",$captcha_error_message);?><br />
      ( Can't read code? Refresh page )</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><input name="associate_id" type="hidden" id="associate_id" value="<?php echo create_guid();?>" />
      <input name="created" type="hidden" id="created" value="<?php echo $systemDate;?>" /></td>
      <td valign="middle"><input type="submit" value="Create Account" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="newassociates" />
      </form>
      <SCRIPT language="JavaScript">
		var frmvalidator  = new Validator("newassociates");
		
		frmvalidator.addValidation("org_name","req","Please enter your Company's Name");
		frmvalidator.addValidation("first_name","req","Please enter your First Name");
		frmvalidator.addValidation("last_name","req","Please enter your Last Name");
		frmvalidator.addValidation("preferred_name","req","Please enter your Name Tag Name");
		frmvalidator.addValidation("email","req","Please enter your email");
		frmvalidator.addValidation("email","email","Please enter a valid email address");
		frmvalidator.addValidation("alt_email","req","Please enter your alternative email");
		frmvalidator.addValidation("alt_email","email","Please enter a valid email address");
		frmvalidator.addValidation("password","req","Please enter your password");
		frmvalidator.addValidation("office_phone","req","Please enter your Phone Number");
	
			
	</SCRIPT>
      </p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd -->

<p>&nbsp;</p>
</html>
<?php
mysql_free_result($rsDuplicate);

mysql_free_result($rsAccountInfo);
?>
