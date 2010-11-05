<?php require_once('../includefiles/init.php'); ?>
<?php 

$old = ini_get('include_path');

// windows users must use ';' instead of ':' in the line below
ini_set('include_path', $old.';/WA_iRite/');

require_once 'WARichEditorPHP.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Reviewer Manager</title>
<!-- InstanceEndEditable -->
<link href="/admin/styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="/admin/styles/table.css" rel="stylesheet" type="text/css" />
<link href="/admin/styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Reviewer Manager Test<!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1" id="form1">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>Program</strong></td>
            <td><select name="programID">
                <?php 
do {  
?>
                <option value="<?php echo $row_rsProgramsList['topic_area']?>" ><?php echo substr($row_rsProgramsList['topic_area'],0,30)?> ... </option>
                <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
              </select>            </td>
            <td>&nbsp;</td>
            <td><strong>Reviewer</strong></td>
            <td><select name="userID">
                <option>--------</option>
                <?php 
do {  
?>
                <option value="<?php echo $row_rsReviewerList['userID']?>" ><?php echo $row_rsReviewerList['last_name']?>, <?php echo $row_rsReviewerList['first_name']; ?></option>
                <?php
} while ($row_rsReviewerList = mysql_fetch_assoc($rsReviewerList));
?>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Assign" /></td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap="nowrap"><div align="left"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="reviewID" value="<?php echo create_guid();?>" />
      </form>
    </div>
    <form id="email_all" name="email_all" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td><label>Subject:
            <input type="text" name="subject" id="subject" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><?php
// WebAssist iRite: Rich Text Editor for Dreamweaver
$WARichTextEditor_1 = CreateRichTextEditor ("content", "/WA_iRite/", "100%", "200px", "Custom", "../custom/emailformall_content2.js", "");
?></td>
        </tr>
        <tr>
          <td><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
