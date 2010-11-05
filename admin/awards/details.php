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

$colname_rsAwards = "-1";
if (isset($_GET['awardID'])) {
  $colname_rsAwards = $_GET['awardID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsAwards = sprintf("SELECT *, DATE_FORMAT(awards.mod_on,'%%m/%%d/%%Y  %%r') AS modified_on FROM awards WHERE awards.deleted=0 AND awards.award_id=%s", GetSQLValueString($colname_rsAwards, "text"));
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);

mysql_select_db($database_Directory, $Directory);
$query_rsAwardPage = "SELECT * FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsAwardPage = mysql_query($query_rsAwardPage, $Directory) or die(mysql_error());
$row_rsAwardPage = mysql_fetch_assoc($rsAwardPage);
$totalRows_rsAwardPage = mysql_num_rows($rsAwardPage);

$colname_rsNomination = "-1";
if (isset($_GET['awardID'])) {
  $colname_rsNomination = $_GET['awardID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsNomination = sprintf("SELECT *, DATE_FORMAT( nominations.created_on,'%%m/%%d/%%Y  %%r') AS nom_date FROM nominations WHERE nominations.award_id=%s AND nominations.deleted=0 ORDER BY nominations.`year`, nominations.last_name, nominations.created_on", GetSQLValueString($colname_rsNomination, "text"));
$rsNomination = mysql_query($query_rsNomination, $Awards) or die(mysql_error());
$row_rsNomination = mysql_fetch_assoc($rsNomination);
$totalRows_rsNomination = mysql_num_rows($rsNomination);
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
<script type="text/javascript" src="../includefiles/help.js"></script>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<link href="../styles/help.css" rel="stylesheet" type="text/css" />
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
    <td nowrap="nowrap" bgcolor="#E5E5E5"><strong>Awards  Information
      
    </strong></td>
    <td bgcolor="#E5E5E5"><div align="right"><strong>
      <input name="button" type="button" id="button" onclick="MM_goToURL('parent','editaward.php?awardID=<?php echo $row_rsAwards['award_id']; ?>');return document.MM_returnValue" value="Edit Info" />
    </strong><strong>
    <input name="button" type="button" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
    </strong></div></td>
  </tr>
  <tr>
    <td width="20%" valign="top" class="labelsDetails"><div align="right"><strong>Award:&nbsp;&nbsp;</strong></div></td>
    <td width="80%" valign="top"><em><strong><?php echo $row_rsAwards['award']; ?></strong></em></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong>Description:&nbsp;&nbsp;</strong></div></td>
    <td valign="top"><?php echo $row_rsAwards['description']; ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onMouseover="showhint('This information will display above the text box on the nomination form.', this, event, '150px')">[?]</a> Nomination Info:&nbsp;&nbsp;</strong></div></td>
    <td valign="top"><?php echo $row_rsAwards['nomination']; ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onMouseover="showhint('Setting this to yes will allow nomination submissions.', this, event, '150px')">[?]</a>Accepting:</strong></div></td>
    <td valign="top"><?php echo basicSwitch($row_rsAwards['accepting']); ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onMouseover="showhint('Setting this to yes will allow the award to be visible on the Awards Information page.', this, event, '150px')">[?]</a>Visible:</strong></div></td>
    <td valign="top"><?php echo basicSwitch($row_rsAwards['visible']); ?></td>
  </tr>
  <tr>
    <td valign="top" class="labelsDetails"><div align="right"><strong><a href="#" class="hintanchor" onMouseover="showhint('This sets the nomination forms for the current year.', this, event, '150px')">[?]</a>Current Year:</strong></div></td>
    <td valign="top"><?php echo $row_rsAwards['year']; ?></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" class="labelsDetails">Modified by: <?php echo $row_rsAwards['mod_by']; ?> at <?php echo $row_rsAwards['modified_on']; ?></td>
    </tr>
</table>
</p>
    </div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop"><strong>Nominee</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Position</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Nominator</strong></td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop"><strong>Year</strong></td>
        <td nowrap="nowrap" class="tableTop"><strong>Submitted</strong></td>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
          <td nowrap="nowrap"><a href="nominationdetails.php?nominationID=<?php echo $row_rsNomination['nomination_id']; ?>&amp;awardID=<?php echo $row_rsAwards['award_id']; ?>"><?php echo $row_rsNomination['last_name']; ?>, <?php echo $row_rsNomination['first_name']; ?></a></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsNomination['position']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsNomination['nom_first']; ?>&nbsp;<?php echo $row_rsNomination['nom_last']; ?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsNomination['year']; ?></td>
          <td><?php echo $row_rsNomination['nom_date']; ?></td>
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
        <?php } while ($row_rsNomination = mysql_fetch_assoc($rsNomination)); ?>

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

mysql_free_result($rsNomination);
?>