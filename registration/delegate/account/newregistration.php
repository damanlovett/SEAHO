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
		$captcha_error_message="<div class=\"captcha_error_message\">Please re-enter the code above.</div><script>function setCaptchaFocus(){var c=document.getElementById('captcha');c.scrollIntoView(true);c.select()};function addEvt(){if (window.addEventListener){window.addEventListener('load',setCaptchaFocus,null);return true}else if(window.attachEvent){return window.attachEvent('onload',setCaptchaFocus)}}; addEvt();</script>";
	}
}
function makeCaptcha($im,$len,$t1,$t2,$t3,$b1,$b2,$b3,$error_message){
	echo "<input name=\"captcha\" type=\"text\" autocomplete=\"off\" id=\"captcha\" /><br /><img onclick=\"rfr='&'+(new Date()).getTime();this.src+=rfr\" style=\"cursor:pointer\" src=\"captcha.php?image_file=".$im."&len=".$len."&t1=".$t1."&t2=".$t2."&t3=".$t3."&b1=".$b1."&b2=".$b2."&b3=".$b3."\" />".$error_message;
}
 
?><?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initFunctions.php'); ?>
<?php require_once('../../includefiles/initEmails.php'); ?>

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
NewMemberEmail($_POST['first_name'],$_POST['email'],$_POST['password']);

}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO delegate (delegate_id, first_name, last_name, preferred_name, title, institution, email, alt_email, password, phone, alt_phone, fax, address, city, `state`, zip, created) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['delegate_id'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['preferred_name'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['institution'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['alt_email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['alt_phone'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['created'], "date"));
sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());
  $insertGoTo = "confirmation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_CMS, $CMS);
$query_rsNewAccount = "SELECT delegate_id, first_name, last_name, preferred_name, title, institution, email, alt_email, password, phone, alt_phone, fax, address, city, `state`, zip, created FROM delegate";
$rsNewAccount = mysql_query($query_rsNewAccount, $CMS) or die(mysql_error());
$row_rsNewAccount = mysql_fetch_assoc($rsNewAccount);
$totalRows_rsNewAccount = mysql_num_rows($rsNewAccount);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>New Delegate Account</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
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
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
        <?php require_once('../../includefiles/header.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
      <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
        <?php require_once('../../../includefiles/importantlinks.inc.php'); ?>
<!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong> Delegate Account Form</strong></h3>
      <p class="steps">Step 2 of 2: Account Creation</p>
      <p>Enter your personal information below to create your account in the 
        Conference Manager System.  Do not print this screen before you hit 
        submit as the encripted code at the bottom of this page will change and 
        you will be unable to create your account.  This personal information <br />
      will be used as a part of your conference registration. </p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table border="0" align="center" cellpadding="0" cellspacing="0" class="tableBasicForm">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>First Name:</h2></td>
            <td><input name="first_name" type="text" value="<?php echo $_SESSION['first'];?>" size="20" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Last Name:</h2></td>
            <td><input name="last_name" type="text" value="<?php echo $_SESSION['last'];?>" size="20" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Name on Nametag:</h2></td>
            <td><input type="text" name="preferred_name" value="" size="30" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>Title:</h2></td>
            <td><input type="text" name="title" value="" size="30" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>Institution:</h2></td>
            <td><input type="text" name="institution" value="" size="30" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Email:</h2></td>
            <td><input name="email" type="text" id="email" value="<?php echo $_SESSION['email'];?>" size="45" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Alternate email:</h2></td>
            <td><input type="text" name="alt_email" value="" size="45" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Password:</h2></td>
            <td><input type="text" name="password" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2><span class="required">*</span>Phone:</h2></td>
            <td><input type="text" name="phone" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>Alternate phone:</h2></td>
            <td><input type="text" name="alt_phone" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>Fax:</h2></td>
            <td><input type="text" name="fax" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" valign="middle" nowrap="nowrap"><h2>Address:</h2></td>
            <td><textarea name="address" cols="32" rows="4"></textarea></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>City:</h2></td>
            <td><input type="text" name="city" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>State:</h2></td>
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
            </select>            </td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>Zip:</h2></td>
            <td><input type="text" name="zip" size="15" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><span class="required">*</span>Enter Code:</td>
            <td><?php makeCaptcha("captcha.png","6","0","0","0","233","235","235",$captcha_error_message);?>
            <p>( Can't read code? Refresh page )</p></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><h2>&nbsp;</h2></td>
            <td><input type="submit" value="Submit New Account" /></td>
          </tr>
        </table>
        <input type="hidden" name="delegate_id" value="<?php echo create_guid();?>" />
        <input type="hidden" name="created" value="<?php echo $systemDate;?>" />
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
<SCRIPT language="JavaScript">
		var frmvalidator  = new Validator("form1");
		
		frmvalidator.addValidation("first_name","req","Please enter your First Name");
		frmvalidator.addValidation("last_name","req","Please enter your Last Name");
		frmvalidator.addValidation("preferred_name","req","Please enter your Name Tag Name");
		frmvalidator.addValidation("email","req","Please enter your email");
		frmvalidator.addValidation("email","email","Please enter a valid email address");
		frmvalidator.addValidation("alt_email","req","Please enter your alternative email");
		frmvalidator.addValidation("alt_email","email","Please enter a valid email address");
		frmvalidator.addValidation("password","req","Please enter your password");
		frmvalidator.addValidation("phone","req","Please enter your Phone Number");
	
			
	</SCRIPT>      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsNewAccount);
?>
