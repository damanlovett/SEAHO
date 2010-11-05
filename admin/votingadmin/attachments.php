<?php require_once('../../Connections/SEAHOdocuments.php'); ?>
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
<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?><?php

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['delete']))) {
  $deleteSQL = sprintf("DELETE FROM upload WHERE id=%s",
                       GetSQLValueString($_GET['ID'], "int"));

  mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
  $Result1 = mysql_query($deleteSQL, $SEAHOdocuments) or die(mysql_error());
}

$colname_rsAttachments = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsAttachments = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
$query_rsAttachments = sprintf("SELECT * FROM upload WHERE cat_id = %s", GetSQLValueString($colname_rsAttachments, "text"));
$rsAttachments = mysql_query($query_rsAttachments, $SEAHOdocuments) or die(mysql_error());
$row_rsAttachments = mysql_fetch_assoc($rsAttachments);
$totalRows_rsAttachments = mysql_num_rows($rsAttachments);

$colname_rsBallot = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsBallot = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT id, `description`, attachment, ballot_id, title, due_date, modified_on, created_on FROM vote_ballot WHERE ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$rsBallot = mysql_query($query_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);
$totalRows_rsBallot = mysql_num_rows($rsBallot);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Voting Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Attachements for <?php echo $row_rsAttachments['title']; ?><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
	<p class="commenttext"><?php echo $row_rsBallot['title']; ?><br />
	Due: <?php echo $row_rsBallot['due_date']; ?></p>
      <ul>
        <form action="attachments.php" method="POST" enctype="multipart/form-data" name="uploadform">
  <table border="0" cellpadding="1" cellspacing="1" class="box">
    <tr>
      <td>
	  <?
//  Upload files into a database instructions

// 1. Create form and include a file upload
// 2. Name the submit button upload
// 3. Create recordset and insert to get the connection
// 4. Copy and add the mysql_select_db statement before the insert
// 5. Delete the insert creatd by DW

if(isset($_POST['upload']))
{
        $fileName = $_FILES['userfile']['name'];
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
		
		// Extra fields needed - must add them to the insert statement
		$categories = $_POST['categories'];
		$doc_id = $_POST['doc_id'];
        
        $fp = fopen($tmpName, 'r');
        $content = fread($fp, $fileSize);
        $content = addslashes($content);
        fclose($fp);
        
        if(!get_magic_quotes_gpc())
        {
            $fileName = addslashes($fileName);
        }
        

  mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
        
        $query = "INSERT INTO upload (doc_id, categories, name, size, type, content ) ".
                 "VALUES ('$doc_id', '$categories', '$fileName', '$fileSize', '$fileType', '$content')";

        mysql_query($query) or die('Error, query failed');                    
        
        echo "<br>File $fileName uploaded<br>";
}        
?>
	  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <input name="doc_id" type="hidden" id="doc_id" value="<?php echo create_guid();?>"><input name="categories" type="hidden" id="categories" value="Voting Attachment" />
        <input name="cat_id" type="hidden" id="cat_id" value="<?php echo $_GET['recordID'];?>" />
</td> 
      <td width="246"><input name="userfile" type="file" class="box" id="userfile" size="45">         </td>
      <td width="80"><input name="upload" type="submit" class="box" id="upload" value="  Upload  "></td>
    </tr>
  </table>
</form>
      </ul>
      <?php echo "<p class='commenttext'> $message </p>";?></div>
	<table border="0" cellpadding="5" cellspacing="0" class="tableborder">
  <tr>
    <td colspan="3" class="tableTop"><label>
      <input name="Button" type="button" onclick="MM_goToURL('parent','attachments.php?recordID=<?php echo $row_rsAttachments['cat_id']; ?>');return document.MM_returnValue" value="Refresh List" />
    </label></td>
    </tr>
  <tr>
    <th nowrap="nowrap">name</th>
    <th nowrap="nowrap">size</th>
    <th nowrap="nowrap">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr>
        <td><a href="details.php?recordID=<?php echo $row_rsAttachments['doc_id']; ?>"><?php echo $row_rsAttachments['name']; ?></a></td>
      <td><?php echo $row_rsAttachments['size']; ?></td>
      <td><a href="attachments.php?ID=<?php echo $row_rsAttachments['id']; ?>&amp;delete=yes&amp;recordID=<?php echo $row_rsAttachments['cat_id']; ?>"><img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></td>
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
