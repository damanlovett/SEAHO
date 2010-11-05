<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php //require_once('../../fckeditor/fckeditor.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


$colname_rsEditReport = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsEditReport = $_REQUEST['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsEditReport = sprintf("SELECT id, position_id, user_id, content, page_title, modified_by, modified_on, test, `position`, `group`, votes FROM committee_pages WHERE position_id = %s", GetSQLValueString($colname_rsEditReport, "text"));
$rsEditReport = mysql_query($query_rsEditReport, $Directory) or die(mysql_error());
$row_rsEditReport = mysql_fetch_assoc($rsEditReport);
$totalRows_rsEditReport = mysql_num_rows($rsEditReport);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editreport")) {
  $updateSQL = sprintf("UPDATE committee_pages SET page_title=%s, content=%s WHERE position_id=%s",
                       GetSQLValueString($_POST['page_title'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_REQUEST['recordID'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Page Manager</title>
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
<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_simple.js"></script>


<script type="text/JavaScript">
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadcommittee">Edit - <?php echo $row_rsEditReport['position']; ?></span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form action="<?php echo $editFormAction; ?>" method="POST" name="editreport" id="editreport">
	  <?php if(isset($_POST['Submit'])) {?>
	  <p><label>
	    <input name="return" type="button" class="submitButton" id="return" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
	    </label>
	    <span class="commenttext">
	  &nbsp;&nbsp;Your page has been updated! </span></p>
	  <?php } else {?>
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#D6DFF7">
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><label><span class="style1">Page Title<br />
            </span>
                <input name="page_title" type="text" id="page_title" value="<?php echo $row_rsEditReport['page_title']; ?>" size="45" />
            </label></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td colspan="2" bgcolor="#D6DFF7"><div class="style1">Report Information</div>
              <br />
  <?php /*?><?php
$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/fckconfigState.js' ;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '500' ;
$oFCKeditor->Value = $row_rsEditReport['content'];
$oFCKeditor->Create() ;
?><?php */?>
  <textarea name="content" rows="45" id="content" style="width:100%"><?php echo $row_rsEditReport['content']; ?></textarea>
  <input name="recordID" type="hidden" id="recordID" value="<?php echo $row_rsEditReport['position_id']; ?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><label>
              <input name="Submit" type="submit" class="submitButton" id="Submit" value="Edit Page" />
            </label></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
        <?php }?>
        <input type="hidden" name="MM_update" value="editreport">
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
