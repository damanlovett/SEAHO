<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?>
<?php require_once('../../Connections/Directory.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE page_info SET header=%s, page_info=%s, footer=%s, mod_by=%s WHERE page_id=%s",
                       GetSQLValueString($_POST['header_info'], "text"),
                       GetSQLValueString($_POST['page_info'], "text"),
                       GetSQLValueString($_POST['footer_info'], "text"),
                       GetSQLValueString($_POST['mod_by'], "text"),
                       GetSQLValueString($_POST['page_id'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

mysql_select_db($database_Directory, $Directory);
$query_rsAwardPage = "SELECT *, DATE_FORMAT(page_info.mod_on,'%m/%d/%Y  %r') AS modified_on FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsAwardPage = mysql_query($query_rsAwardPage, $Directory) or die(mysql_error());
$row_rsAwardPage = mysql_fetch_assoc($rsAwardPage);
$totalRows_rsAwardPage = mysql_num_rows($rsAwardPage);
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
      <form id="update" name="update" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableDetails">
          <tr>
            <td nowrap="nowrap" bgcolor="#E5E5E5"><strong>Awards Page Information </strong></td>
            <td bgcolor="#E5E5E5">&nbsp;
            
            <?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {?>
            <span class="homepageBlocks">Page information has been update</span>            <?php }?>            </td>
            <td bgcolor="#E5E5E5"><div align="right"><strong>
                <input name="button" type="button" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
            </strong></div></td>
          </tr>
          <tr>
            <td width="20%" valign="top" class="labelsDetails"><div align="right"><strong>
              <label>Header:</label>
              &nbsp;&nbsp;</strong></div></td>
            <td width="80%" colspan="2" valign="top" class="labelsDetailsWhite"><label for="header_info"></label>
            <input name="header_info" type="text" id="header_info" value="<?php echo $row_rsAwardPage['header']; ?>" size="65" /></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong>Information:&nbsp;&nbsp;</strong></div></td>
            <td colspan="2" valign="top" class="labelsDetailsWhite"><label for="page_info"></label>
              <textarea name="page_info" cols="65" rows="10" id="page_info"><?php echo $row_rsAwardPage['page_info']; ?></textarea></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails"><div align="right"><strong>
              <input name="page_id" type="hidden" id="page_id" value="<?php echo $row_rsAwardPage['page_id']; ?>" />
              <input name="mod_by" type="hidden" id="mod_by" value="<?php echo $_SESSION['display_name']; ?>" />
              Footer:&nbsp;&nbsp;</strong></div></td>
            <td colspan="2" valign="top" class="labelsDetailsWhite"><label for="footer_info"></label>
            <input name="footer_info" type="text" id="footer_info" value="<?php echo $row_rsAwardPage['footer']; ?>" size="65" /></td>
          </tr>
          <tr>
            <td valign="top" class="labelsDetails">&nbsp;</td>
            <td colspan="2" valign="top" class="labelsDetailsWhite"><label for="button2"></label>
            <input type="submit" name="button2" id="button2" value="Update Page Info" /></td>
          </tr>
          <tr>
            <td colspan="3" valign="top" class="labelsDetails">Last Modified by: <?php echo $row_rsAwardPage['mod_by']; ?> on <?php echo $row_rsAwardPage['modified_on']; ?></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="update" />
      </form>
      </p>
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
mysql_free_result($rsAwardPage);

mysql_free_result($rsAwardPage);
?>