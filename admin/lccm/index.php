<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>About LCCM</title>

<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.tableborder th {
	background-image: none;
	background-color: #E4E4E4;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: none;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-color: #FFFFFF;
	border-bottom-color: #999999;
	border-right-color: #CCCCCC;
	border-left-color: #666666;
}
.systemInfo {
	background-color: #F5F5F5;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: none;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-color: #FFFFFF;
	border-bottom-color: #999999;
	border-right-color: #CCCCCC;
	border-left-color: #666666;

}
#mainContent #mainText {
	background-color: #F4F4F4;
}
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <p>&nbsp;</p>
    <table width="65%" border="0" align="center" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" class="tableTop"><span class="style1">SEAHO Adminstrative Portal</span></td>
      </tr>
      <tr>
        <th>System Status </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemStatus']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">Site Name </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemSitename']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">Support Email </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemSupportEmail']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">LCCM Version </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemVersion']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">Creation Date </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemCreation']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">System Operator </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemOperator']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">System Liaison </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemLiaison']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th nowrap="nowrap">Contract Renewal Date </th>
        <td colspan="2" class="systemInfo"><?php echo $_SESSION['systemContract']; ?></td>
      </tr>
      <tr  class="tableRowColor">
        <th colspan="3" nowrap="nowrap">System Description </th>
      </tr>
      <tr  class="tableRowColor">
        <td colspan="3"><?php echo $_SESSION['systemDescription']; ?></td>
      </tr>
      
<tr>
        <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
        <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
        <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
</tr>
    </table>
    <p>&nbsp;</p>
  </div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
</html>
