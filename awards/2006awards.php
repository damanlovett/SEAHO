<?php require_once('../Connections/Awards.php'); ?>
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

$colname_rsWinners = "-1";
if (isset($_GET['award_year'])) {
  $colname_rsWinners = $_GET['award_year'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsWinners = sprintf("SELECT awards.award, awards.`year`, nominations.first_name, nominations.last_name, nominations.`position`, nominations.institution FROM awards, nominations WHERE awards.`year`=%s AND awards.award_id=nominations.award_id AND nominations.winner=1", GetSQLValueString($colname_rsWinners, "text"));
$rsWinners = mysql_query($query_rsWinners, $Awards) or die(mysql_error());
$row_rsWinners = mysql_fetch_assoc($rsWinners);
$totalRows_rsWinners = mysql_num_rows($rsWinners);

mysql_select_db($database_Awards, $Awards);
$query_rsAwardYear = "SELECT * FROM nominations GROUP BY nominations.`year` ORDER BY nominations.`year`";
$rsAwardYear = mysql_query($query_rsAwardYear, $Awards) or die(mysql_error());
$row_rsAwardYear = mysql_fetch_assoc($rsAwardYear);
$totalRows_rsAwardYear = mysql_num_rows($rsAwardYear);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - 2006 Winners</title>
<!-- InstanceEndEditable -->
<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<div class="adanavigation">Skip to <a href="#content">Content</a> or <a href="#pageNav">Page Navigation</a> or <a href="#siteNav">Site Navigation</a></div>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <div align="center"><img src="../images/banner/bannerawards.jpg" alt="" width="764" height="95" /></div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><a name="pageNav" id="pageNav"></a><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../includefiles/awards.inc.php'); ?>

      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><a name="content" id="content"></a><!-- InstanceBeginEditable name="mainContent" -->

<h2> 2006 - Award   Winners</h2>
<p><strong>Charles W. Beene Memorial Service   Award: <br />
</strong>Stephen Stauffer,   University of Kentucky </p>
<p><strong>SEAHO Founders Award: <br />
</strong>Paul Jahr, Georgia College and State University</p>
<p><strong>James C. Grimm Outstanding New Professional   Award</strong>: <br />
  Robert Hayes, University of Alabama</p>
<p><strong>SEAHO PEACE Award: <br />
</strong>Peter Smith, Appalachian State   University</p>
<p><strong>Graduate Student of the Year</strong>: <br />
  Serena   Loconte, University of Southern Mississippi</p>
<p><strong>SEAHO Report Feature Article of the Year: <br />
</strong></p>
<p><strong>Mid-Level Manager Award: <br />
</strong>Melissa Jones, Virginia   Commonwealth University</p>
<p><strong>Humanitarian Award: <br />
</strong>Tulane Housing Staff - Joe   DiMaria, Erica Woodley, Amy Garbacz, Lauren Bledsoe, Evane Charles, Jahanna   Westerfield, Ebony Williams, and Lori Antonik </p>
<p><strong>Educational Programs Grant Winners:<br />
</strong></p>
<p><strong>Conference Fee Waiver Scholarship Winners: <br />
  </strong>Kathi Akers,   Univ. of North Florida<br />
  Nichol Armstrong, Univ. of Southern   Mississippi<br />
  Rachel Dickens, Meredith College<br />
  Amanda Gunter, Georgia   College &amp; State Univ.<br />
  Prakash Karnani, Florida International   Univ.<br />
  Sharlene Provilus, Meredith College<br />
  Gavin Roark, Mississippi State   Univ.<br />
  Eddie Seavers, Christopher Newport University</p>
<p><strong>New Professional Case Study Winner: <br />
</strong></p>
<p><strong>Graduate Student Case Study Winner: <br />
</strong></p>
<p><strong>Best of SEAHO Programs: </strong></p>
<h2>&nbsp;</h2>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsWinners);

mysql_free_result($rsAwardYear);
?>
