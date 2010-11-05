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
$query_rsAudience = "SELECT audience.id, audience.audience FROM audience";
$rsAudience = mysql_query($query_rsAudience, $Programming) or die(mysql_error());
$row_rsAudience = mysql_fetch_assoc($rsAudience);
$totalRows_rsAudience = mysql_num_rows($rsAudience);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <?php do { ?>
    <p>
      <label>
        <input type="radio" name="RadioGroup1" value="<?php echo $row_rsAudience['audience']; ?>" />
        <?php echo $row_rsAudience['audience']; ?></label>
      <br />
        </p>
    <?php } while ($row_rsAudience = mysql_fetch_assoc($rsAudience)); ?></form>
</body>
</html>
<?php
mysql_free_result($rsAudience);
?>
