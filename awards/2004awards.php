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
<title>Awards - 2004 Winners</title>
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
<h2> 2004 - Award Winners</h2>
<strong>Charles W. Beene Memorial Service Award:</strong><br />
  Tom Kane, University of South Florida </p>
<p><strong>SEAHO Founders Award:</strong><br />
  Rita Moser, Florida State University <br />
  <br />
  <strong>James C. Grimm Outstanding New Professional Award</strong>:<br />
Ryan Winget</p>
<p><strong>SEAHO PEACE Award: </strong><br />
Michael Collins, Millsaps College </p>
<p><strong>Graduate Student of the Year</strong>: <br />
Camilla Jones, Clemson University</p>
<p><strong>Graduate Issues and Involvement SPE Grant Winner:</strong><br />
Molly Cuicchi, University of Georgia</p>
<p><strong>SEAHO Report Feature Article of the Year: </strong><br />
Dei Allard, University of North Carolina at Chapel Hill, Bridging the Gap Between Faculty and Residential Life </p>
<p><strong>Humanitarian Winners:</strong><br />
  Miguel Hernandez, Appalachian State University<br />
Joline Esterling, University of Southern Mississippi</p>
<p><strong>E</strong><strong>ducational Programs Grant Winners:<br />
</strong>Gary Kimble, University of Southern Mississippi, &quot;Care Package&quot;<br />
  Maylen Aldana, Appalachian State University, &quot;The Power of One&quot;<br />
  Heidi LeCount, Meredith College, &quot;Pre-Spring Break Beach Party&quot;<br />
  Brad Shuck, Western Kentucky University, &quot;The Six O'Clock Hour&quot;<br />
  <br />
  <strong>Conference Fee Waiver Scholarship Winners: </strong><br />
Meredith Varner, Kerri Ekberg, Rinardo Reddick, Miguel Hernandez, Tim Martin, Sherry R. Ingram, John P. Stinchon, Deidre Repass, Karl S. Burns, and George Timson. </p>
<p><strong>New Professional Case Study Winner:</strong><br />
Julie Anne Cunningham, Georgia Southern University and Ronika Anderson, Georgia Southern University</p>
<p><strong>Graduate Student Case Study Winner:</strong><br />
Christopher Coogan, University of Florida and Jonathon Wylie, Clemson University</p>
<p><strong>Best of SEAHO:</strong><br />
&quot;Tennessee House Calls&quot;, Jerry Adams and Brandon Dotson, University of Tennessee </p>
<p><strong>SEAHO Top 5:</strong></p>
<ol>
  <li>&quot;Why are all the black professionals sitting together at the conference&quot;, Countess Hughes, Georgia State University</li>
  <li>&quot;Who keeps moving my gorillas, Tradition in Residence Hall Communities&quot;, Shane Cadden and Meredith Varner, University of Central Florida </li>
  <li>&quot;What a Bright Idea&quot;, Ashley Smith and Jenny Slear, Valdosta State University</li>
  <li>&quot;Moving off campus, Freedom comes with a price&quot;, Joe Paulick, University of Central Florida</li>
  <li>&quot;Developing a Retention State of Mind&quot;, Rob Foreman, Gardner-Webb University&nbsp; </li>
</ol>
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
