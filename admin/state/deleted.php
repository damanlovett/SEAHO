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
      <form method="post" name="search" id="search">
        <table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td><strong>Search by </strong></td>
            <td><label>
              <select name="search" id="search">
                <option value="2007">---- Year ----</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
              </select>
            </label></td>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Search" />
            </label></td>
          </tr>
        </table>
      </form>
	  <a href="mystate.php">&raquo;&nbsp;Return to main list</a>    </div>
    <p> The recordID has to be $_SESSION['staaccess'] and passed on.  Also there has to be a if (isset($_SESSION['staaccess'])) then show the edit icon. </p>
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">1 of 10 reports </td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td colspan="3" class="tableTop">First Next Last </td>
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
        <td nowrap="nowrap"><div align="center"><img src="../images/imgUpdate.gif" alt="Update" width="14" height="14" /><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></div></td>
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
