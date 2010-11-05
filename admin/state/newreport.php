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
<?php require_once('../../fckeditor/fckeditor.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php

// Post for new report

$_POST['title'] = $_POST['typeof']." ".$_POST['year'];


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newreport")) {
  $insertSQL = sprintf("INSERT INTO team_pages (page_id, state_id, title, type, content, submitted_by, created_on) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['page_id'], "text"),
                       GetSQLValueString($_POST['state_id'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['submitted_by'], "text"),
                       GetSQLValueString($_POST['created_on'], "date"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}

mysql_select_db($database_Directory, $Directory);
$query_rsReports = "SELECT * FROM team_reports ORDER BY `description` ASC";
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
.style1 {
	font-size: 12px;
	font-weight: bold;
	color: #000099;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">State Report Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
    <?php if(isset($_POST['Submit'])){echo "<strong>New Report Added</strong> - ( <a href='index.php'>Return to State Menu</a> )";}?>
      <form action="<?php echo $editFormAction; ?>" method="POST" name="newreport" id="newreport">
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#D6DFF7">
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><span class="style1">Title</span>            
              <label>
              <select name="typeof" id="typeof">
                <?php
do {  
?>
                <option value="<?php echo $row_rsReports['description']?>"><?php echo $row_rsReports['description']?></option>
                <?php
} while ($row_rsReports = mysql_fetch_assoc($rsReports));
  $rows = mysql_num_rows($rsReports);
  if($rows > 0) {
      mysql_data_seek($rsReports, 0);
	  $row_rsReports = mysql_fetch_assoc($rsReports);
  }
?>
              </select>
              </label>
			  <label>
              <select name="year" id="year">
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2008">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="---------------" selected="selected">---------------</option>
              </select>
            </label></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><hr /></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#D6DFF7"><div class="style1">Report Information</div>
            <br />
<?php
$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/fckconfigState.js' ;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '500' ;
$oFCKeditor->Value = 'Enter Report Here';
$oFCKeditor->Create() ;
?></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td bgcolor="#FFFFFF"><label>
              <input name="Submit" type="submit" class="submitButton" id="Submit" value="Submit Report" />
              <input name="page_id" type="hidden" id="page_id" value="<?php echo create_guid();?>" />
              <input name="type" type="hidden" id="type" value="State" />
              <input name="title" type="hidden" id="title" />
              <input name="submitted_by" type="hidden" id="submitted_by" value="<?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?>" />
              <input name="state_id" type="hidden" id="state_id" value="<?php echo $_SESSION['staccess'];?>" />
              <input name="created_on" type="hidden" id="created_on" value="<?php echo date("YmdHis");?>" />
            </label></td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="newreport">
      </form>
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
