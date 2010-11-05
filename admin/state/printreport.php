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

$colname_rsPrint = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsPrint = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsPrint = sprintf("SELECT team_pages.content FROM team_pages WHERE team_pages.page_id=%s", GetSQLValueString($colname_rsPrint, "text"));
$rsPrint = mysql_query($query_rsPrint, $Directory) or die(mysql_error());
$row_rsPrint = mysql_fetch_assoc($rsPrint);
$totalRows_rsPrint = mysql_num_rows($rsPrint);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Version</title>
</head>

<body>
<form>
  <input name="Print" onclick="window.print();return false" type="button" value="Print Report" />
</form>
<?php echo $row_rsPrint['content']; ?>
</body>
</html>
<?php
mysql_free_result($rsPrint);
?>
