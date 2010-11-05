<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Awards.php'); ?>
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

mysql_select_db($database_Awards, $Awards);
$query_rsAwards = "SELECT *, DATE_FORMAT(awards.mod_on,'%m/%d/%Y  %r') AS modified_date FROM awards WHERE awards.deleted=0";
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);

mysql_select_db($database_Directory, $Directory);
$query_rsAwardPage = "SELECT * FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsAwardPage = mysql_query($query_rsAwardPage, $Directory) or die(mysql_error());
$row_rsAwardPage = mysql_fetch_assoc($rsAwardPage);
$totalRows_rsAwardPage = mysql_num_rows($rsAwardPage);
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">Awards Page Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableDetails">
  <tr>
    <td nowrap="nowrap" bgcolor="#E5E5E5"><strong>Awards Page Information
      
    </strong></td>
    <td bgcolor="#E5E5E5"><div align="right"><strong>
      <input name="button" type="button" id="button" onclick="MM_goToURL('parent','editpage.php');return document.MM_returnValue" value="Edit Info" />
    </strong><strong>
    <input name="button" type="button" id="button" onclick="MM_goToURL('parent','newaward.php');return document.MM_returnValue" value="New Award" />
    </strong></div></td>
  </tr>
  <tr>
    <td width="20%" valign="top" class="labelsDetails"><div align="right"><strong>Header:&nbsp;&nbsp;</strong></div></td>
    <td width="80%" valign="top"><?php echo $row_rsAwardPage['header']; ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong>Information:&nbsp;&nbsp;</strong></div></td>
    <td valign="top"><?php echo $row_rsAwardPage['page_info']; ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong>Footer:&nbsp;&nbsp;</strong></div></td>
    <td valign="top"><?php echo $row_rsAwardPage['footer']; ?></td>
  </tr>
</table>
</p>
    </div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop"><strong>Award</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Current Year</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Accepting</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Visible</strong></td>
        <td nowrap="nowrap" class="tableTop"><strong>Modified</strong></td>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
          <td nowrap="nowrap"><a href="details.php?awardID=<?php echo $row_rsAwards['award_id']; ?>"><?php echo $row_rsAwards['award']; ?></a></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsAwards['year']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo basicSwitch($row_rsAwards['accepting']); ?></td>
          <td>&nbsp;</td>
          <td><?php echo basicSwitch($row_rsAwards['visible']); ?></td>
          <td><?php echo $row_rsAwards['modified_date']; ?></td>
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
        <?php } while ($row_rsAwards = mysql_fetch_assoc($rsAwards)); ?>

<tr>
        <td colspan="8" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
	<br />
	<p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsAwards);

mysql_free_result($rsAwardPage);
?>