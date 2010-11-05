<?php require_once('../../Connections/SEAHOdocuments.php'); ?>
<?php require_once('../../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
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

// Pure PHP Upload 2.1.3
if (isset($HTTP_GET_VARS['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = "../../documents";
	$ppu->extensions = "";
	$ppu->formName = "uploadform";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "";
	$ppu->nameConflict = "over";
	$ppu->requireUpload = "true";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "";
	$ppu->maxHeight = "";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
	$ppu->progressBar = "";
	$ppu->progressWidth = "";
	$ppu->progressHeight = "";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  if (!eregi("GP_upload=true", $HTTP_SERVER_VARS['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$HTTP_SERVER_VARS['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$HTTP_SERVER_VARS['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($editFormAction)) {
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $HTTP_SERVER_VARS['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "uploadform")) {
  $insertSQL = sprintf("INSERT INTO attachments (doc_id, categories, cat_id, title, `file`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['doc_id'], "text"),
                       GetSQLValueString($_POST['categories'], "text"),
                       GetSQLValueString($_POST['cat_id'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['file'], "text"));

  mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
  $Result1 = mysql_query($insertSQL, $SEAHOdocuments) or die(mysql_error());
}

mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
$query_rsAttachments = "SELECT id, doc_id, categories, cat_id, title, `file` FROM attachments WHERE categories = 'gc_reports'";
$rsAttachments = mysql_query($query_rsAttachments, $SEAHOdocuments) or die(mysql_error());
$row_rsAttachments = mysql_fetch_assoc($rsAttachments);
$totalRows_rsAttachments = mysql_num_rows($rsAttachments);

$colname_rsBallot = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsBallot = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT id, `description`, attachment, ballot_id, title, DATE_FORMAT(due_date,'%%a %%M %%d, %%Y') AS due_date,  modified_on, created_on, `delete` FROM vote_ballot WHERE ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$rsBallot = mysql_query($query_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);
$totalRows_rsBallot = mysql_num_rows($rsBallot);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Governing Council Uploads</title>
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
    <h2><!-- InstanceBeginEditable name="PageTitle" -->
      <script language='javascript' src='../../ScriptLibrary/incPureUpload.js'></script>
      <span class="pageHeadVotingAdmin">Governing Council Uploads</span>
    <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <ul>
        <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="uploadform" onsubmit="checkFileUpload(this,'',true,'','','','','','','');return document.MM_returnValue">
  <table border="0" cellpadding="5" cellspacing="0" class="box">
    <tr>
      <td><input name="doc_id" type="hidden" id="doc_id" value="<?php echo create_guid();?>">
		<input name="categories" type="hidden" id="categories" value="gc_reports" />
        <input name="cat_id" type="hidden" id="cat_id" value="<?php echo $_GET['recordID'];?>" />
		<?php $_POST['filename'] = $_FILES['userfile']['name'];?></td> 
      <td colspan="2"><strong>Document Title</strong><br />
        <input name="title" type="text" id="title" size="35" /></td>
      </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><input name="file" type="file" class="box" id="file" onchange="checkOneFileUpload(this,'',true,'','','','','','','')" size="35" /></td>
      <td width="80">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
        <input name="upload" type="submit" class="box" id="upload" value="  Upload  " />
      </div></td>
      </tr>
  </table>
        <input type="hidden" name="MM_insert" value="uploadform">
        </form>
      </ul>
    <?php echo "<p class='commenttext'> $message </p>";?></div>
	<table width="75%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
  <tr>
    <td colspan="3" class="tableTop"><input name="Button" type="button" onclick="MM_goToURL('parent','uploadgc.php');return document.MM_returnValue" value="Refresh List" /></td>
    </tr>
  <tr>
    <th nowrap="nowrap">Document Title</th>
    <th nowrap="nowrap">File</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr>
        <td><?php echo $row_rsAttachments['title']; ?></td>
      <td><a href="/documents/<?php echo $row_rsAttachments['file']; ?>" target="_blank"><?php echo $row_rsAttachments['file']; ?></a></td>
      <td><a href="../../documents/deletegcreport.php?recordID=<?php echo $row_rsAttachments['doc_id']; ?>&amp;document=<?php echo $row_rsAttachments['file']; ?>"><img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></td>
    </tr>
    <?php } while ($row_rsAttachments = mysql_fetch_assoc($rsAttachments)); ?>
<tr>
      <td colspan="3" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsAttachments);

mysql_free_result($rsBallot);

mysql_free_result($rsGetDownload);
?>
