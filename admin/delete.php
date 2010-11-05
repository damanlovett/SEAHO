<?php require_once('../Connections/MessageBoard.php'); ?>
<?php require_once('includefiles/init.php'); ?>

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

mysql_select_db($database_MessageBoard, $MessageBoard);
$query_Recordset1 = "SELECT accessid, userid, username, applicationCode, ipaddress, urlstring, accesstime FROM access_logs ORDER BY accesstime DESC LIMIT 50";
$Recordset1 = mysql_query($query_Recordset1, $MessageBoard) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>username</td>
    <td>applicationCode</td>
    <td>ipaddress</td>
    <td>urlstring</td>
    <td>accesstime</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['username']; ?></td>
      <td><?php echo $row_Recordset1['applicationCode']; ?></td>
      <td><?php echo $row_Recordset1['ipaddress']; ?></td>
      <td><?php if($systemtDate<$row_Recordset1['accesstime']){echo "bigger $systemDate";}?></td>
      <td><?php echo $row_Recordset1['accesstime']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
