<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->State Page Manager  <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="newreport" id="newreport">
      </form>
    </div>
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="7" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Report </th>
        <th>&nbsp;</th>
        <th>Submitted by </th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Submitted on </th>
        <th>&nbsp;</th>
        <th><div align="center"></div></th>
      </tr>
      <tr  class="tableRowColor">
        <td nowrap="nowrap"><a href="#">Mid-Year 2007 Report </a></td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">Eddie Lovett  </td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">Sunday, May 6, 2007 </td>
        <td nowrap="nowrap">&nbsp;</td>
        <td nowrap="nowrap"><div align="center"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></div></td>
      </tr>
<tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
