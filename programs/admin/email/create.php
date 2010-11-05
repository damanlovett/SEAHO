<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?>
<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>
<?php require_once('../../../fckeditor/fckeditor.php'); ?>
<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsEmailList = 20;
$pageNum_rsEmailList = 0;
if (isset($_GET['pageNum_rsEmailList'])) {
  $pageNum_rsEmailList = $_GET['pageNum_rsEmailList'];
}
$startRow_rsEmailList = $pageNum_rsEmailList * $maxRows_rsEmailList;

mysql_select_db($database_Programming, $Programming);
$query_rsEmailList = "SELECT email_records.id, email_records.title, email_records.emailmessage, email_records.sent_to, email_records.sent_by, DATE_FORMAT(email_records.sent_date,'%M %d %Y - %r') AS sent_date, email_records.emailID FROM email_records ORDER BY email_records.sent_date DESC";
$query_limit_rsEmailList = sprintf("%s LIMIT %d, %d", $query_rsEmailList, $startRow_rsEmailList, $maxRows_rsEmailList);
$rsEmailList = mysql_query($query_limit_rsEmailList, $Programming) or die(mysql_error());
$row_rsEmailList = mysql_fetch_assoc($rsEmailList);

if (isset($_GET['totalRows_rsEmailList'])) {
  $totalRows_rsEmailList = $_GET['totalRows_rsEmailList'];
} else {
  $all_rsEmailList = mysql_query($query_rsEmailList);
  $totalRows_rsEmailList = mysql_num_rows($all_rsEmailList);
}
$totalPages_rsEmailList = ceil($totalRows_rsEmailList/$maxRows_rsEmailList)-1;

$queryString_rsEmailList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsEmailList") == false && 
        stristr($param, "totalRows_rsEmailList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsEmailList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsEmailList = sprintf("&totalRows_rsEmailList=%d%s", $totalRows_rsEmailList, $queryString_rsEmailList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>System Emails</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/LCCMPHemails.jpg" alt="email" width="65" height="51" />System Emails <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --> <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
	<br />
	  <ul>
        <li></li>
	  </ul>
	  <hr/>
	<ul>
	  <li></li>
	  </ul>

</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
	<div class="pageInformation"><p><form id="form1" name="form1" method="post" action="emailprocess.php">
  <label><strong>Subject</strong>
  <input name="subject" type="text" id="subject" value="-------------------------" size="45" />
  </label>
  <br />
  <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#d6dff7" class="texteditor">
  <tr>
    <td><?php
$oFCKeditor = new FCKeditor('emailmessage') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/fckconfigProgram.js' ;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '200' ;
$oFCKeditor->Value = 'Default text in editor';
$oFCKeditor->Create() ;
?></td>
  </tr>
</table>

  <p>
    <label><strong>Send to</strong>
    <select name="status" id="status">
      <option value="Accepted">Accepted</option>
      <option value="To Be Reviewed">To Be Reviewed</option>
    </select>
    </label>
  </p>
  <p>
    <label>
    <input type="submit" name="Submit" value="Send" />
    </label>
  </p>
</form></p></div>
	<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsEmailList);

mysql_free_result($rsPrograms);
?>
