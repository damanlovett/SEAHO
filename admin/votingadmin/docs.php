<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Voting Manager</title>
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
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Voting Manager  <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="search" id="search">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><label><strong>Search by </strong><input name="title" type="text" id="title" onFocus="if(this.value=='----- Title ----- ')this.value='';" value="----- Title ----- " size="40"/></label>            </td>
            <td>&nbsp;</td>
            <td nowrap="nowrap"><select name="sortby" id="sortby">
              <option value="id">--- Sort by ---</option>
              <option value="last_name">Last Name</option>
              <option value="first_name">First Name</option>
              <option value="title">Title</option>
              <option value="school">School</option>
              <?php 
do {  
?>
              <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Search" /></td>
          </tr>
        </table>
      </form>
	  <ul>
	  <li><a href="#">&raquo;&nbsp;Add New Vote</a></li>
	  <li><a href="#">&raquo;&nbsp;View Trash</a></li>
	  </ul>
    </div>
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="6" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Title</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Vote Due Date  </th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Attachment </th>
        <th><div align="center"></div></th>
      </tr>
      <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
        <td nowrap="nowrap"><a href="#">Web Design Proposal </a></td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">Monday, May 7, 2007 5:00 PM </td>
        <td>&nbsp;</td>
        <td nowrap="nowrap"><a href="#">webdesign.doc</a></td>
        <td nowrap="nowrap"><img src="../../programs/images/imgAdminEdit.gif" alt="Edit" width="14" height="14" /><img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></td>
      </tr>
      <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
      <tr>
        <td nowrap="nowrap"><a href="#">Contingency Fund Proposal</a></td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">Sunday, May 6, 2007 4:30 PM </td>
        <td>&nbsp;</td>
        <td nowrap="nowrap"><a href="#">fundproposal.doc</a></td>
        <td nowrap="nowrap"><img src="../../programs/images/imgAdminEdit.gif" alt="Edit" width="14" height="14" /><img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></td>
      </tr>
<tr>
        <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
