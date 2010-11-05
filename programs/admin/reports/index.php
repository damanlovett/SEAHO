<?php require_once('../../../Connections/Programming.php'); ?>
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
?>
<?php require_once('../../includefiles/init.php'); ?>

<?php

$table = $_REQUEST['table'];

mysql_select_db($database_Programming, $Programming);
$query_rsTopicCounts = "SELECT state, COUNT(state) FROM callforprograms GROUP BY state ORDER BY callforprograms.state";
$rsTopicCounts = mysql_query($query_rsTopicCounts, $Programming) or die(mysql_error());
$row_rsTopicCounts = mysql_fetch_assoc($rsTopicCounts);
$totalRows_rsTopicCounts = mysql_num_rows($rsTopicCounts);
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "create_user")) {
NewMemberEmail($_POST['firstname'],$_POST['email'],$_POST['password']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Table Manager</title>
<script language="JavaScript" type="text/javascript" src="../../includefiles/make-popup.js"></script>
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
    <h2><!-- InstanceBeginEditable name="PageTite" -->
<img src="../../images/LCCMPHtables.jpg" alt="Admin User" width="65" height="51" />Report Manager  <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
<p><strong>Programs by State</strong>
    <ul>
	  	<?php do { ?>

        <li><?php echo $row_rsTopicCounts['state']; ?>: <strong><?php echo $row_rsTopicCounts['COUNT(state)']; ?></strong></li>
		<?php } while ($row_rsTopicCounts = mysql_fetch_assoc($rsTopicCounts)); ?>

      </ul>
		</p>
	</div>

	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
<table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Report</th>
        <th>&nbsp;</th>
        <th><div align="center">Format</div></th>
      </tr>
      <tr>
        <td nowrap="nowrap"><span class="width40"><a href="programsAll.php">All Programs</a></span></td>
        <td>&nbsp;</td>
        <td><div align="center"><img src="../../images/excel.gif" alt="Excel" width="16" height="16" /></div></td>
      </tr>
      <tr bgcolor="#DEDEDE">
        <td nowrap="nowrap"><span class="width40"><a href="programsAccepted.php">Accepted Programs</a></span></td>
        <td>&nbsp;</td>
        <td><div align="center"><img src="../../images/excel.gif" alt="Excel" width="16" height="16" /></div></td>
      </tr>
      <tr>
        <td nowrap="nowrap"><a href="programsPending.php">Pending Presenters</a></td>
        <td>&nbsp;</td>
        <td><div align="center"><img src="../../images/excel.gif" alt="Excel" width="16" height="16" /></div></td>
      </tr>
      <tr   class="tableRowColor">
        <td nowrap="nowrap"><span class="width40"><a href="programsAlternate.php">Alternate Presenters </a></span></td>
        <td>&nbsp;</td>
        <td><div align="center"><img src="../../images/excel.gif" alt="Excel" width="16" height="16" /></div></td>
      </tr>
      <tr bgcolor="#DEDEDE">
        <td nowrap="nowrap"><span class="width40"><a href="programsDenied.php">Denied Presenters </a></span></td>
        <td>&nbsp;</td>
        <td><div align="center"><img src="../../images/excel.gif" alt="Excel" width="16" height="16" /></div></td>
      </tr>
      <tr>
        <td nowrap="nowrap"></td>
        <td>&nbsp;</td>
        <td><div align="center"></div></td>
      </tr>
      <tr>
        <td nowrap="nowrap"></td>
        <td>&nbsp;</td>
        <td><div align="center"></div></td>
      </tr>
      <tr>
        <td nowrap="nowrap"></td>
        <td>&nbsp;</td>
        <td><div align="center"></div></td>
      </tr>
<tr>
        <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
<br />
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsTopicCounts);
?>