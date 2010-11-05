<?php require_once('../../Connections/Directory.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editreport")) {
  $updateSQL = sprintf("UPDATE team_pages SET content=%s WHERE page_id=%s",
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['page_id'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php require_once('../../fckeditor/fckeditor.php'); ?>

<?php
$colname_rsEditReport = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsEditReport = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsEditReport = sprintf("SELECT id, page_id, state_id, title, type, content, submitted_by, mondified_on, created_on, `delete` FROM team_pages WHERE page_id = %s", GetSQLValueString($colname_rsEditReport, "text"));
$rsEditReport = mysql_query($query_rsEditReport, $Directory) or die(mysql_error());
$row_rsEditReport = mysql_fetch_assoc($rsEditReport);
$totalRows_rsEditReport = mysql_num_rows($rsEditReport);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>State Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
	color: #000099;
}
.style2 {color: #000099}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	width : "100%",
	height : "500",
	theme_advanced_toolbar_align : "left",
	gecko_spellcheck : true,
	theme_advanced_toolbar_location : "top",
	mode : "textareas"
});
</script>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">Edit - <?php echo $row_rsEditReport['title']; ?>- Report  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form action="<?php echo $editFormAction; ?>" method="POST" name="editreport" id="editreport">
	  <?php if(isset($_POST['Submit'])) {?>
	  <p><label>
	    <input name="return" type="button" class="submitButton" id="return" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
	    </label>
	    <span class="commenttext">
	  &nbsp;&nbsp;Your report has been updated! </span></p>
	  <?php }?>
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#D6DFF7">
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#D6DFF7"><div class="style1">Report Information</div>
            <br />
            <label for="content"></label>
            <textarea name="content" id="content"><?php echo $row_rsEditReport['content']; ?></textarea>
            <input name="page_id" type="hidden" id="page_id" value="<?php echo $row_rsEditReport['page_id']; ?>" /></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><label>
              <input name="Submit" type="submit" class="submitButton" id="Submit" value="Edit Report" />
            </label></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
        
        <input type="hidden" name="MM_update" value="editreport" />
      </form>
    </div>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEditReport);
?>
