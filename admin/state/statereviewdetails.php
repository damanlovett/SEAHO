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

$colname_rsReports = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsReports = $_REQUEST['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsReports = sprintf("SELECT team_pages.id, team_pages.page_id, team_pages.state_id, team_pages.title, team_pages.content, team_pages.submitted_by, DATE_FORMAT(team_pages.mondified_on,'%%a, %%M %%d %%Y   %%r') AS mod_date, DATE_FORMAT(team_pages.created_on,'%%a %%M %%d %%Y   %%r') AS create_date FROM team_pages WHERE team_pages.page_id = %s", GetSQLValueString($colname_rsReports, "text"));
$rsReports = mysql_query($query_rsReports, $Directory) or die(mysql_error());
$row_rsReports = mysql_fetch_assoc($rsReports);
$totalRows_rsReports = mysql_num_rows($rsReports);
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>State Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {color: #000099}
-->
</style>
<script src="../../SpryAssets/SpryEffects.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_effectAppearFade(targetElement, duration, from, to, toggle)
{
	Spry.Effect.DoFade(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate"><?php echo $row_rsReports['title']; ?></span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
    <p onclick="MM_effectAppearFade('header', 1000, 100, 0, false)">
      <input name="button" type="button" class="submitButton" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
      <input name="button2" type="button" class="submitButton" id="button2" onclick="MM_goToURL('parent','edit.php?recordID=<?php echo $row_rsReports['page_id']; ?>');return document.MM_returnValue" value="Edit Report" />
    </p>
      <p class="style1"><?php echo $row_rsReports['title']; ?><br />
        Submitted by <?php echo $row_rsReports['submitted_by']; ?><br />
        Created on <?php echo $row_rsReports['create_date']; ?><br />
      modified on <?php echo $row_rsReports['mod_date']; ?></p>
        <hr />
		<p><?php echo $row_rsReports['content']; ?></p>
    </div>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReports);
?>
