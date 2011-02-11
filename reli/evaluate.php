<?php require_once('../Connections/Forms.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "relievaluation")) {
  $insertSQL = sprintf("INSERT INTO reli_eval (evalID, eval_name, eval_submission, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9, question_10, question_11, question_12, question_13, question_14, question_15, question_16, question_17, question_18, question_19, question_20, question_21, question_22, question_23, question_n1, question_n2, question_n3, question_n4, question_n5, question_n6, question_n7, question_n8, question_n9, question_n10, question_n11, question_n12) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['evalID'], "text"),
                       GetSQLValueString($_POST['eval_name'], "text"),
                       GetSQLValueString($_POST['eval_submission'], "date"),
                       GetSQLValueString($_POST['question_1'], "text"),
                       GetSQLValueString($_POST['question_2'], "text"),
                       GetSQLValueString($_POST['question_3'], "text"),
                       GetSQLValueString($_POST['question_4'], "text"),
                       GetSQLValueString($_POST['question_5'], "text"),
                       GetSQLValueString($_POST['question_6'], "text"),
                       GetSQLValueString($_POST['question_7'], "text"),
                       GetSQLValueString($_POST['question_8'], "text"),
                       GetSQLValueString($_POST['question_9'], "text"),
                       GetSQLValueString($_POST['question_10'], "text"),
                       GetSQLValueString($_POST['question_11'], "text"),
                       GetSQLValueString($_POST['question_12'], "text"),
                       GetSQLValueString($_POST['question_13'], "text"),
                       GetSQLValueString($_POST['question_14'], "text"),
                       GetSQLValueString($_POST['question_15'], "text"),
                       GetSQLValueString($_POST['question_16'], "text"),
                       GetSQLValueString($_POST['question_17'], "text"),
                       GetSQLValueString($_POST['question_18'], "text"),
                       GetSQLValueString($_POST['question_19'], "text"),
                       GetSQLValueString($_POST['question_20'], "text"),
                       GetSQLValueString($_POST['question_21'], "text"),
                       GetSQLValueString($_POST['question_22'], "text"),
                       GetSQLValueString($_POST['question_23'], "text"),
                       GetSQLValueString($_POST['question_n1'], "text"),
                       GetSQLValueString($_POST['question_n2'], "text"),
                       GetSQLValueString($_POST['question_n3'], "text"),
                       GetSQLValueString($_POST['question_n4'], "text"),
                       GetSQLValueString($_POST['question_n5'], "text"),
                       GetSQLValueString($_POST['question_n6'], "text"),
                       GetSQLValueString($_POST['question_n7'], "text"),
                       GetSQLValueString($_POST['question_n8'], "text"),
                       GetSQLValueString($_POST['question_n9'], "text"),
                       GetSQLValueString($_POST['question_n10'], "text"),
                       GetSQLValueString($_POST['question_n11'], "text"),
                       GetSQLValueString($_POST['question_n12'], "text"));

  mysql_select_db($database_Forms, $Forms);
  $Result1 = mysql_query($insertSQL, $Forms) or die(mysql_error());

  $insertGoTo = "evalconfirm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
 $systemDate = date ("Y-m-d G:i:s");?>
<?php require_once('../admin/includefiles/initReli.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<style type="text/css">
<!--
form fieldset {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-bottom-width: 0px;
	padding-bottom: 15px;
	border-right-width: 0px;
	border-top-width: 0px;
	border-left-width: 0px;
	padding-left: 15px;
	float: left;
	width: 225px;
	font-weight: normal;
	margin-top: 0.3em;
	margin-right: 0.3em;
	margin-bottom: 1em;
	margin-left: 0.3em;
}
#contentmain strong {
	font-weight: normal;
	font-size: .95em;
}
fieldset.last {
	clear: both;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #333333;
	width: 95%;
}
select {
	font-size: .8em;
	margin-bottom: 10px;
}
.lastDIV {
	clear: both;
}
.boxquestions {
	background: #FFFFFF;
}
.boxquestions fieldset {
	clear: both;
}
-->
</style>

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
      <h1><strong>RELI 2010 Evaluation Form</strong></h1>
      <p>The 2010 Evaluation period has ended.</p>
      <p class="hideDiv"> Thanks so much for taking the time to provide feedback on your RELI experiences! Honest participant evaluation helps us to make the Institute better and better each year!&nbsp; </p>
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="relievaluation" class="hideDiv" id="relievaluation" onsubmit="checkFileUpload(this,'',true,'','','','','','','');return document.MM_returnValue">
      
      <fieldset>
<p><strong>Session I</strong> : 
    <strong>Professional Ethics</strong></p>
<label>
<select name="question_1" id="question_1">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n1" id="question_n1">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
      </fieldset>
<fieldset>
<p><strong>Session II</strong> : 
    <strong>Budgeting</strong></p>
<label>
<select name="question_2" id="question_2">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n2" id="question_n2">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Session III</strong>&nbsp;:    <strong>Supervision</strong></p>
<label>
<select name="question_3" id="111">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n3" id="question_n3">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Session IV</strong> : 
    <strong>Personal and Professional Balance</strong></p>
<label>
<select name="question_4" id="question_4">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n4" id="question_n4">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Session V</strong> : 
    <strong>Managing Risk</strong></p>
<label>
<select name="question_5" id="question_5">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n5" id="question_n5">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Session VI</strong> :<strong>Facilities</strong></p>
<label>
<select name="question_6" id="question_6">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n6" id="question_n6">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
<p>&nbsp;</p>
</fieldset>
<fieldset>
<p><strong>Session VII</strong> :<strong>Mentoring</strong></p>
<label>
<select name="question_7" id="question_7">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n7" id="question_n7">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Session VIII</strong> : 
    <strong>Professional Development</strong></p>
<label>
<select name="question_8" id="question_8">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n8" id="question_n8">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Book Discussion</strong></p>
<label>
<select name="question_9" id="question_9">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n9" id="question_n9">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Mentoring/Cluster Time</strong></p>
<label>
<select name="question_10" id="question_10">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n10" id="question_n10">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Faculty Panel</strong></p>
<label>
<select name="question_11" id="question_11">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n11" id="question_n11">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Graduation Luncheon</strong></p>
<label>
<select name="question_12" id="question_12">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied ">Unsatisfied </option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied ">Satisfied </option>
  <option value="Very Satisfied ">Very Satisfied </option>
</select>
</label>
<select name="question_n12" id="question_n12">
  <option value="N/A">-----------------------</option>
  <option value="Not Very Useful">Not Very Useful</option>
  <option value="Neutral">Neutral</option>
  <option value="Useful">Useful</option>
  <option value="Very Useful">Very Useful</option>
</select>
</fieldset>
<fieldset>
<p><strong>Housing Accommodations</strong></p>
<label><select name="question_13" id="question_13">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied">Unsatisfied</option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied">Satisfied</option>
  <option value="Very Satisfied">Very Satisfied</option>
</select>
</label>
</fieldset>
<fieldset>
<p><strong>Meals and Snacks</strong></p>
<label><select name="question_14" id="question_14">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied">Unsatisfied</option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied">Satisfied</option>
  <option value="Very Satisfied">Very Satisfied</option>
</select>
</label>
</fieldset>
<fieldset class="last">
<p><strong>Meeting Space</strong></p>
<label><select name="question_15" id="question_15">
  <option value="N/A">-----------------------</option>
  <option value="Unsatisfied">Unsatisfied</option>
  <option value="Neutral">Neutral</option>
  <option value="Satisfied">Satisfied</option>
  <option value="Very Satisfied">Very Satisfied</option>
</select>
</label>
</fieldset>
<div class="boxquestions">
  <fieldset>
  <p><strong>What would have made the  Institute more beneficial?</strong></p>
  <label><textarea name="question_16" cols="50" rows="5" id="question_16"></textarea>
  </label>
  </fieldset>
<fieldset>
<p><strong>Recommended faculty for  RELI 2011:</strong></p>
<label>
  <textarea name="question_17" cols="50" rows="5" id="question_17"></textarea>
</label>
</fieldset>
<fieldset>
  <strong>Recommended topics for RELI   2011:</strong>&nbsp;
  <label><textarea name="question_18" id="question_18" cols="45" rows="5"></textarea>
  </label>
</fieldset>
<fieldset>
  <label><strong>Recommended Common Reading Experience for 2011:
    </strong>
    <textarea name="question_19" id="question_19" cols="45" rows="5"></textarea>
  </label>
</fieldset>
<fieldset>
  <label><strong>How did you hear about RELI?
    </strong>
    <textarea name="question_20" id="question_20" cols="45" rows="5"></textarea>
  </label>
</fieldset>
<fieldset>
  <label><strong>Please provide any feedback you have about the application process.
    </strong>
    <textarea name="question_21" id="question_21" cols="45" rows="5"></textarea>
  </label>
</fieldset>
<fieldset>
  <label><strong>Please provide any feedback you have about the communication you received (from the chairs, the faculty, or the Furman hosts). </strong>
    <textarea name="question_22" id="question_22" cols="45" rows="5"></textarea>
  </label>
</fieldset>
<fieldset>
<p><strong>General suggestions and/or  comments:</strong></p>
<label><textarea name="question_23" cols="50" rows="5" id="question_23"></textarea>
</label>
</fieldset>
</div>
<div class="lastDIV">
<p>
  <label>
  <input type="submit" name="button" id="button" value="Submit" />
  </label>
  <input name="eval_name" type="hidden" id="eval_name" value="Reli Evaluation 2010" />
  <input name="eval_submission" type="hidden" id="eval_submission" value="<?php echo $systemDate;?>" />
  <input name="evalID" type="hidden" id="evalID" value="<?php echo create_guid();?>" />
</p>
<p>&nbsp;</p>
</div>

      <input type="hidden" name="MM_insert" value="relievaluation" />
      </form>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
