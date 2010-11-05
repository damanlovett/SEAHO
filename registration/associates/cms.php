<?php require_once('../../Connections/CMS.php'); ?>
<?php require_once('../includefiles/initAssociates.php'); ?>
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

mysql_select_db($database_CMS, $CMS);
$query_rsCMSinfo = "SELECT * FROM sys_configuration";
$rsCMSinfo = mysql_query($query_rsCMSinfo, $CMS) or die(mysql_error());
$row_rsCMSinfo = mysql_fetch_assoc($rsCMSinfo);
$totalRows_rsCMSinfo = mysql_num_rows($rsCMSinfo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO CMS Home</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
        <?php require_once('../includefiles/headerAssociateHome.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
<?php require_once('../includefiles/leftNavAssociates.php'); ?>
      <!-- InstanceEndEditable --><img src="../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h1>About CMS</h1>
      <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableDetails">
        <tr>
          <td width="29%" class="labels">System Status</td>
          <td width="71%"><?php echo $row_rsCMSinfo['status']; ?></td>
        </tr>
        <tr>
          <td class="labels">Site Name</td>
          <td><?php echo $row_rsCMSinfo['sitename']; ?></td>
        </tr>
        <tr>
          <td class="labels">CMS Version</td>
          <td><?php echo $row_rsCMSinfo['sysVersion']; ?></td>
        </tr>
        <tr>
          <td class="labels">Creation Date</td>
          <td><?php echo $row_rsCMSinfo['sysCreation']; ?></td>
        </tr>
        <tr>
          <td class="labels">System Operator</td>
          <td><?php echo $row_rsCMSinfo['sysOperator']; ?></td>
        </tr>
        <tr>
          <td class="labels">System Liaison</td>
          <td><?php echo $row_rsCMSinfo['sysLiaison']; ?></td>
        </tr>
        <tr>
          <td class="labels">Contract Renewal Date</td>
          <td><?php echo $row_rsCMSinfo['sysContract']; ?></td>
        </tr>
        <tr>
          <td colspan="2" class="labels"><div align="left">System Description</div></td>
        </tr>
        
        <tr>
          <td colspan="2"><?php echo $row_rsCMSinfo['sysDescription']; ?></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCMSinfo);
?>
