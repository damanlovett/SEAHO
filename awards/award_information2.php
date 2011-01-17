<?php require_once('../Connections/Directory.php'); ?>
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

mysql_select_db($database_Directory, $Directory);
$query_rsChair = "SELECT team_positions.`position`, team_positions.email, users.first_name, users.last_name, users.school FROM team_positions, users WHERE team_positions.Position LIKE '%Awards and Recognition%'  AND team_positions.user_id = users.user_id";
$rsChair = mysql_query($query_rsChair, $Directory) or die(mysql_error());
$row_rsChair = mysql_fetch_assoc($rsChair);
$totalRows_rsChair = mysql_num_rows($rsChair);

mysql_select_db($database_Directory, $Directory);
$query_rsPageInfo = "SELECT * FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsPageInfo = mysql_query($query_rsPageInfo, $Directory) or die(mysql_error());
$row_rsPageInfo = mysql_fetch_assoc($rsPageInfo);
$totalRows_rsPageInfo = mysql_num_rows($rsPageInfo);

$maxRows_rsAwards = 10;
$pageNum_rsAwards = 0;
if (isset($_GET['pageNum_rsAwards'])) {
  $pageNum_rsAwards = $_GET['pageNum_rsAwards'];
}
$startRow_rsAwards = $pageNum_rsAwards * $maxRows_rsAwards;

mysql_select_db($database_Awards, $Awards);
$query_rsAwards = "SELECT * FROM awards WHERE awards.visible=1 AND awards.deleted=0 ORDER BY awards.award DESC";
$query_limit_rsAwards = sprintf("%s LIMIT %d, %d", $query_rsAwards, $startRow_rsAwards, $maxRows_rsAwards);
$rsAwards = mysql_query($query_limit_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);

if (isset($_GET['totalRows_rsAwards'])) {
  $totalRows_rsAwards = $_GET['totalRows_rsAwards'];
} else {
  $all_rsAwards = mysql_query($query_rsAwards);
  $totalRows_rsAwards = mysql_num_rows($all_rsAwards);
}
$totalPages_rsAwards = ceil($totalRows_rsAwards/$maxRows_rsAwards)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - Information</title>
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
<h2 align="left"> <?php echo $row_rsPageInfo['header']; ?></h2>
<p align="left"><?php echo $row_rsPageInfo['page_info']; ?> </p>
<?php do { ?>
  <p><strong><?php echo $row_rsAwards['award']; ?> </strong>
        <br />
      <?php echo $row_rsAwards['description']; ?><br />
    <?php if ($row_rsAwards['accepting']==1){?>
    [ <a href="awardsform.php?awardsID=<?php echo $row_rsAwards['award_id']; ?>"><?php echo $row_rsAwards['year']; ?>&nbsp;Nomination Form</a> ]
    
    <?php }?>
  <hr />
  </p>
  <?php } while ($row_rsAwards = mysql_fetch_assoc($rsAwards)); ?>
  <p> For more information regarding SEAHO Awards and Scholarships, please go to <strong><a href="http://www.SEAHO.org">www.SEAHO.org</a> </strong></p>
  <p>Please submit all Award and Scholarship Applications to the address below.</p>
  <?php do { ?>
  <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p><strong><?php echo $row_rsChair['first_name']; ?>&nbsp;<?php echo $row_rsChair['last_name']; ?>, <?php echo $row_rsChair['school']; ?></strong><br />
          Chair, <?php echo $row_rsChair['position']; ?><br />
          <a href="mailto:recognition@seaho.org">recognition@seaho.org</a><a onclick="return !window.open(this.href,'newemail','height=850, width=750, resizable=no, scrollbars=yes');" href="https://webmailcluster.perfora.net/xml/webmail/mailDetail;jsessionid=11637A90DB6C7992B55E3F67DB660527.TC134a?__frame=_top&amp;__lf=AdresseUebernehmenFlow&amp;__sendingdata=1&amp;resyncFolder.Doit=true&amp;resyncFolder.TreeID=leftNaviTree&amp;createMail.Action=create&amp;createMail.To=recognition@seaho.org&amp;__jumptopage=mailNew&amp;__CMD%5BmailDetail%5D:SELWRP=resyncFolder&amp;__CMD%5BmailDetail%5D:SELWRP=createMail"></a><a href="mailto:<?php echo $row_rsChair['seahoemail']; ?>"></a></p>
          <p>&nbsp;</p></td>
      </tr>
      </table>
  <?php } while ($row_rsChair = mysql_fetch_assoc($rsChair)); ?>
<p align="center"> <?php echo $row_rsPageInfo['footer']; ?></p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsChair);

mysql_free_result($rsPageInfo);

mysql_free_result($rsAwards);
?>
