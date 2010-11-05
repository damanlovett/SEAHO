<?php require_once('../../Connections/Programming.php'); ?>
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

mysql_select_db($database_Programming, $Programming);
$query_rsMD5 = "SELECT * From users";
$rsMD5 = mysql_query($query_rsMD5, $Programming) or die(mysql_error());
$row_rsMD5 = mysql_fetch_assoc($rsMD5);
$totalRows_rsMD5 = mysql_num_rows($rsMD5);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td>id</td>
    <td>userID</td>
    <td>password</td>
    <td>access</td>
    <td>Notes</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsMD5['id']; ?></td>
      <td><?php echo $row_rsMD5['userID']; ?></td>
      <td><?php echo $row_rsMD5['password']; ?></td>
      <td><?php echo md5($row_rsMD5['password']); ?></td>
      <td><?php if((md5($_POST['password'])) == "e5f6c83e6e97c74fc9e9760fc8972aed") { echo "ID's match"; }?>	  </td>
    </tr>
    <?php } while ($row_rsMD5 = mysql_fetch_assoc($rsMD5)); ?>
</table>
<form id="form1" name="form1" method="post" action="md5.php">
  <label>Password
  <input name="password" type="text" id="password" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
  </label>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsMD5);
?>
