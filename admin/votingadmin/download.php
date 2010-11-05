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

$colname_rsGetDownload = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsGetDownload = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_SEAHOdocuments, $SEAHOdocuments);
//$query_rsGetDownload = sprintf("SELECT * FROM upload WHERE id = %s", GetSQLValueString($colname_rsGetDownload, "int"));
//$rsGetDownload = mysql_query($query_rsGetDownload, $SEAHOdocuments) or die(mysql_error());
//$row_rsGetDownload = mysql_fetch_assoc($rsGetDownload);
//$totalRows_rsGetDownload = mysql_num_rows($rsGetDownload);

// Download files out of database

// 1. Create recordset using $_GET['recordID']
// 2. Place this snippet after the $totalrows and the mysql_free_result

$id    = $_GET['recordID'];
$query = "SELECT name, type, size, content " .
         "FROM upload WHERE doc_id = '$id'";

$result = mysql_query($query) or die('Error, query failed');
list($name, $type, $size, $content) = mysql_fetch_array($result);

header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;


mysql_free_result($rsGetDownload);
?>