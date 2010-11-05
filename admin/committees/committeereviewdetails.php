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
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php 

$colname_rsReports = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsReports = $_REQUEST['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsReports = sprintf("SELECT committee_pages.id, committee_pages.position_id, committee_pages.user_id, committee_pages.content, committee_pages.page_title, committee_pages.modified_by, DATE_FORMAT(committee_pages.modified_on,'%%a %%M %%d %%Y') AS mod_date, committee_pages.`position` FROM committee_pages WHERE committee_pages.position_id = %s", GetSQLValueString($colname_rsReports, "text"));
$rsReports = mysql_query($query_rsReports, $Directory) or die(mysql_error());
$row_rsReports = mysql_fetch_assoc($rsReports);
$totalRows_rsReports = mysql_num_rows($rsReports);
?>
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
.style4 {color: #000099}
.style5 {
	font-size: 14px;
	font-weight: bold;
	color: #000099;
}
-->
</style>
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadcommittee">View - <?php echo $row_rsReports['position']; ?></span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
    <p>
      <input name="button" type="button" class="submitButton" id="button" onclick="MM_goToURL('parent','../committees/index.php');return document.MM_returnValue" value="Return to Menu" />
      <?php if($row_rsReports['user_id']==$_SESSION['userID']){?><label>
      <input name="button2" type="button" class="submitButton" id="button2" onclick="MM_goToURL('parent','edit.php?recordID=<?php echo $row_rsReports['position_id']; ?>');return document.MM_returnValue" value="Edit Page" />
      </label><?php }?>
    </p>
            <p class="style5">Page Title: <?php echo $row_rsReports['page_title']; ?></p>
<p>modified on <?php echo $row_rsReports['mod_date']; ?>
                        </p>
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
