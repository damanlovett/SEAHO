<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Awards.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updateaward")) {
  $updateSQL = sprintf("UPDATE awards SET award=%s, `description`=%s, nomination=%s, accepting=%s, visible=%s, `year`=%s, mod_by=%s WHERE award_id=%s",
                       GetSQLValueString($_POST['award'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['nomination'], "text"),
                       GetSQLValueString($_POST['accepting'], "int"),
                       GetSQLValueString($_POST['visible'], "int"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['mod_by'], "text"),
                       GetSQLValueString($_POST['award_id'], "text"));

  mysql_select_db($database_Awards, $Awards);
  $Result1 = mysql_query($updateSQL, $Awards) or die(mysql_error());
}

$colname_rsAwards = "-1";
if (isset($_GET['awardID'])) {
  $colname_rsAwards = $_GET['awardID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsAwards = sprintf("SELECT *, DATE_FORMAT(awards.mod_on,'%%m/%%d/%%Y  %%r') AS modified_on FROM awards WHERE awards.deleted=0 AND awards.award_id=%s", GetSQLValueString($colname_rsAwards, "text"));
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../includefiles/help.js"></script>

<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	width : "100%",
	height : "200",
	theme_advanced_toolbar_align : "left",
	gecko_spellcheck : true,
	theme_advanced_toolbar_location : "top",
	theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter ,justifyright,justifyfull,separator,cut,copy,paste",
	theme_advanced_buttons2 : "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator",
	theme_advanced_buttons3 : "",
	mode : "textareas"
});
</script>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<link href="../styles/help.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">Awards Page Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      </p>
      <form id="updateaward" name="updateaward" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableDetails">
          <tr>
            <td nowrap="nowrap" bgcolor="#E5E5E5"><strong>Awards  Information </strong></td>
            <td bgcolor="#E5E5E5">&nbsp;
            <?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updateaward")) {?>
           
            <span class="homepageBlocks">Award information has been updated</span>
            
            <?php }?>
            </td>
            <td bgcolor="#E5E5E5"><div align="right"><strong>
                <input name="button" type="button" id="button" onclick="MM_goToURL('parent','details.php?awardID=<?php echo $row_rsAwards['award_id']; ?>');return document.MM_returnValue" value="Return to Menu" />
            </strong></div></td>
          </tr>
          <tr>
            <td width="20%" valign="top" class="labelsDetails"><div align="right"><strong>Award:&nbsp;&nbsp;</strong></div></td>
            <td width="80%" colspan="2" valign="top"><em><strong>
              <label for="award"></label>
              <input name="award" type="text" id="award" value="<?php echo $row_rsAwards['award']; ?>" size="70" />
            </strong></em></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong>Description:&nbsp;&nbsp;</strong></div></td>
            <td colspan="2" valign="top"><label for="description"></label>
            <textarea name="description" id="description" cols="65" rows="8"><?php echo $row_rsAwards['description']; ?></textarea></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onmouseover="showhint('This information will display above the text box on the nomination form.', this, event, '150px')">[?]</a>Nomination Info:&nbsp;&nbsp;</strong></div></td>
            <td colspan="2" valign="top"><label for="nomination"></label>
            <textarea name="nomination" id="nomination" cols="65" rows="7"><?php echo $row_rsAwards['nomination']; ?></textarea></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onmouseover="showhint('Setting this to yes will allow nomination submissions.', this, event, '150px')">[?]</a>Accepting:</strong></div></td>
            <td colspan="2" valign="top"><label for="accepting"></label>
              <select name="accepting" id="accepting">
                <option value="1" <?php if (!(strcmp(1, $row_rsAwards['accepting']))) {echo "selected=\"selected\"";} ?>>Yes</option>
                <option value="0" <?php if (!(strcmp(0, $row_rsAwards['accepting']))) {echo "selected=\"selected\"";} ?>>No</option>
              </select></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onmouseover="showhint('Setting this to yes will allow the award to be visible on the Awards Information page.', this, event, '150px')">[?]</a>Visible:</strong></div></td>
            <td colspan="2" valign="top"><label for="visible"></label>
              <select name="visible" id="visible">
                <option value="1" <?php if (!(strcmp(1, $row_rsAwards['visible']))) {echo "selected=\"selected\"";} ?>>Yes</option>
                <option value="0" <?php if (!(strcmp(0, $row_rsAwards['visible']))) {echo "selected=\"selected\"";} ?>>No</option>
              </select></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onmouseover="showhint('This sets the nomination forms for the current year.', this, event, '150px')">[?]</a>Current Year:</strong></div></td>
            <td colspan="2" valign="top"><label for="year"></label>
              <select name="year" id="year">
                <option value="2007" <?php if (!(strcmp(2007, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2007</option>
                <option value="2008" <?php if (!(strcmp(2008, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2008</option>
                <option value="2009" <?php if (!(strcmp(2009, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2009</option>
                <option value="2010" <?php if (!(strcmp(2010, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2010</option>
                <option value="2011" <?php if (!(strcmp(2011, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2011</option>
                <option value="2012" <?php if (!(strcmp(2012, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2012</option>
                <option value="2013" <?php if (!(strcmp(2013, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2013</option>
                <option value="2014" <?php if (!(strcmp(2014, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2014</option>
                <option value="2014" <?php if (!(strcmp(2014, $row_rsAwards['year']))) {echo "selected=\"selected\"";} ?>>2014</option>
              </select>
              <input name="award_id" type="hidden" id="award_id" value="<?php echo $row_rsAwards['award_id']; ?>" />
              <input name="mod_by" type="hidden" id="mod_by" value="<?php echo $_SESSION['display_name']; ?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails">&nbsp;</td>
            <td colspan="2" valign="top"><input type="submit" name="button2" id="button2" value="Update Award" /></td>
          </tr>
          <tr>
            <td colspan="3" valign="top" class="labelsDetails">Modified by: <?php echo $row_rsAwards['mod_by']; ?> at <?php echo $row_rsAwards['modified_on']; ?></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="updateaward" />
      </form>
    </div>
    <br />
	<p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsAwards);
?>