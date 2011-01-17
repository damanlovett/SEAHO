<?php require_once('../Connections/Directory.php'); ?>
<?php require_once('../Connections/Awards.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($HTTP_GET_VARS['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = "../admin/awards/documents";
	$ppu->extensions = "";
	$ppu->formName = "form1";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "";
	$ppu->nameConflict = "over";
	$ppu->requireUpload = "false";
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
?>
<?php require_once('../Connections/Forms.php'); ?>
<?php require_once('../includefiles/initAwards.php'); ?>
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

if (isset($editFormAction)) {
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $HTTP_SERVER_VARS['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO nominations (nomination_id, award_id, first_name, last_name, `position`, institution, address, city, `state`, zip, email, nomination, nom_first, nom_last, nom_position, nom_institution, nom_address, nom_city, nom_state, nom_zip, nom_email, `year`, created_on, doc_1, doc_2, doc_3, doc_4, doc_5) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomination_id'], "text"),
                       GetSQLValueString($_POST['award_id'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['institution'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nomination'], "text"),
                       GetSQLValueString($_POST['nom_first'], "text"),
                       GetSQLValueString($_POST['nom_last'], "text"),
                       GetSQLValueString($_POST['nom_position'], "text"),
                       GetSQLValueString($_POST['nom_institution'], "text"),
                       GetSQLValueString($_POST['nom_address'], "text"),
                       GetSQLValueString($_POST['nom_city'], "text"),
                       GetSQLValueString($_POST['nom_state'], "text"),
                       GetSQLValueString($_POST['nom_zip'], "text"),
                       GetSQLValueString($_POST['nom_email'], "text"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['created_on'], "date"),
                       GetSQLValueString($_FILES['doc_1']['name'], "text"),
                       GetSQLValueString($_FILES['doc_2']['name'], "text"),
                       GetSQLValueString($_FILES['doc_3']['name'], "text"),
                       GetSQLValueString($_FILES['doc_4']['name'], "text"),
                       GetSQLValueString($_FILES['doc_5']['name'], "text"));

  mysql_select_db($database_Awards, $Awards);
  $Result1 = mysql_query($insertSQL, $Awards) or die(mysql_error());

  $insertGoTo = "awardsconfirmation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Directory, $Directory);
$query_rsChair = "SELECT team_positions.`position`, team_positions.email, users.first_name, users.last_name, users.school FROM team_positions, users WHERE team_positions.Position LIKE '%Awards and Recognition%'  AND team_positions.user_id = users.user_id";
$rsChair = mysql_query($query_rsChair, $Directory) or die(mysql_error());
$row_rsChair = mysql_fetch_assoc($rsChair);
$totalRows_rsChair = mysql_num_rows($rsChair);

$colname_rsAwards = "-1";
if (isset($_GET['awardsID'])) {
  $colname_rsAwards = $_GET['awardsID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsAwards = sprintf("SELECT * FROM awards WHERE awards.award_id=%s", GetSQLValueString($colname_rsAwards, "text"));
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);

mysql_select_db($database_Awards, $Awards);
$query_rsAwardYear = "SELECT * FROM nominations GROUP BY nominations.`year` ORDER BY nominations.`year`";
$rsAwardYear = mysql_query($query_rsAwardYear, $Awards) or die(mysql_error());
$row_rsAwardYear = mysql_fetch_assoc($rsAwardYear);
$totalRows_rsAwardYear = mysql_num_rows($rsAwardYear);

$colname_rsWinners = "-1";
if (isset($_GET['award_year'])) {
  $colname_rsWinners = $_GET['award_year'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsWinners = sprintf("SELECT awards.award, awards.`year`, nominations.first_name, nominations.last_name, nominations.`position`, nominations.institution FROM awards, nominations WHERE awards.`year`=%s AND awards.award_id=nominations.award_id AND nominations.winner=1", GetSQLValueString($colname_rsWinners, "text"));
$rsWinners = mysql_query($query_rsWinners, $Awards) or die(mysql_error());
$row_rsWinners = mysql_fetch_assoc($rsWinners);
$totalRows_rsWinners = mysql_num_rows($rsWinners);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - Form</title>
<!-- InstanceEndEditable -->
<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
#form1 strong {
	font-size: 12px;
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
<div class="adanavigation">Skip to <a href="#content">Content</a> or <a href="#pageNav">Page Navigation</a> or <a href="#siteNav">Site Navigation</a></div>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
      <div align="center"><img src="../images/banner/bannerawards.jpg" alt="" width="764" height="95" /></div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><a name="pageNav" id="pageNav"></a><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../includefiles/awards.inc.php'); ?>

      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><a name="content" id="content"></a><!-- InstanceBeginEditable name="mainContent" -->
<h2> <?php echo $row_rsAwards['award']; ?> Nomination Form</h2>

<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="checkFileUpload(this,'',false,'','','','','','','');return document.MM_returnValue">
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Nominee First Name:</strong></td>
      <td><input name="first_name" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Nominee Last Name:</strong></td>
      <td><input name="last_name" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Position:</strong></td>
      <td><input name="position" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input name="institution" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Address:</strong></td>
      <td><textarea name="address" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>City:</strong></td>
      <td><input name="city" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>State:</strong></td>
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
        </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Zip:</strong></td>
      <td><input name="zip" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Email:</strong></td>
      <td><input name="email" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" valign="top"><div align="left"><?php echo $row_rsAwards['nomination']; ?></div></td>
      </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><strong>Nomination:</strong></td>
      <td><textarea name="nomination" cols="60" rows="14"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Nominator First Name:</strong></td>
      <td><input name="nom_first" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Nominator Last Name:</strong></td>
      <td><input name="nom_last" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Position:</strong></td>
      <td><input name="nom_position" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Institution:</strong></td>
      <td><input name="nom_institution" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Address:</strong></td>
      <td><input name="nom_address" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>City:</strong></td>
      <td><input name="nom_city" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>State:</strong></td>
      <td><input name="nom_state" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Zip:</strong></td>
      <td><input name="nom_zip" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Email:</strong></td>
      <td><input name="nom_email" type="text" class="smallform" value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Document #1:</strong></td>
      <td><label for="doc_1"></label>
        <input name="doc_1" type="file" id="doc_1" onchange="checkOneFileUpload(this,'',false,'','','','','','','')" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Document #2:</strong></td>
      <td><input name="doc_2" type="file" id="doc_1" onchange="checkOneFileUpload(this,'',false,'','','','','','','')" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Document #3:</strong></td>
      <td><input name="doc_3" type="file" id="doc_1" onchange="checkOneFileUpload(this,'',false,'','','','','','','')" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Document #4:</strong></td>
      <td><input name="doc_4" type="file" id="doc_1" onchange="checkOneFileUpload(this,'',false,'','','','','','','')" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Document #5:</strong></td>
      <td><input name="doc_5" type="file" id="doc_1" onchange="checkOneFileUpload(this,'',false,'','','','','','','')" size="45" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="smallform" value="Submit Nomination" /></td>
    </tr>
  </table>
  <input type="hidden" name="nomination_id" value="<?php echo create_guid();?>" />
  <input type="hidden" name="award_id" value="<?php echo $row_rsAwards['award_id']; ?>" />
  <input type="hidden" name="created_on" value="<?php echo $systemDate;?>" />
  <input type="hidden" name="MM_insert" value="form1" />
  <input name="year" type="hidden" id="year" value="<?php echo $row_rsAwards['year']; ?>" />
</form>
<p>&nbsp;</p>
<p align="center"><b>If you have any questions you may contact <a href="mailto:<?php echo $row_rsChair['email']; ?>"><?php echo $row_rsChair['first_name']; ?></a><a href="mailto:presidentelect@seaho.org"><?php echo $row_rsChair['last_name']; ?></a>  <?php echo $row_rsChair['position']; ?></b><br />
</p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsChair);

mysql_free_result($rsAwards);

mysql_free_result($rsAwardYear);

mysql_free_result($rsWinners);
?>
