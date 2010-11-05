<?php require_once('../Connections/Directory.php'); ?>
<?php
// Load the XML classes
require_once('../includes/XMLExport/XMLExport.php');

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

$colname_rsUsers = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUsers = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsUsers = sprintf("SELECT id, user_id, first_name, last_name, `position` FROM users WHERE last_name LIKE %s ORDER BY last_name ASC", GetSQLValueString($colname_rsUsers . "%", "text"));
$rsUsers = mysql_query($query_rsUsers, $Directory) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);

// Begin XMLExport rsUsers
$xmlExportObj = new XMLExport();
$xmlExportObj->setRecordset($rsUsers);
$xmlExportObj->addColumn("id", "id");
$xmlExportObj->addColumn("user_id", "user_id");
$xmlExportObj->addColumn("first_name", "first_name");
$xmlExportObj->addColumn("last_name", "last_name");
$xmlExportObj->addColumn("position", "position");
$xmlExportObj->setMaxRecords("ALL");
$xmlExportObj->setDBEncoding("UTF-8");
$xmlExportObj->setXMLEncoding("UTF-8");
$xmlExportObj->setXMLFormat("NODES");
$xmlExportObj->Execute();
// End XMLExport rsUsers
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($rsUsers);
?>
