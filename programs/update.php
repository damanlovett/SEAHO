<?php require_once('Connections/connSeahoAdmin.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE committee SET Active=%s WHERE id=%s",
                       GetSQLValueString($_POST['account_id'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
  $Result1 = mysql_query($updateSQL, $connSeahoAdmin) or die(mysql_error());
}

mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
$query_rsUpdate = "SELECT accounts.id, accounts.active FROM accounts";
$rsUpdate = mysql_query($query_rsUpdate, $connSeahoAdmin) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <input name="id" type="hidden" id="id" value="<?php echo $row_rsUpdate['id']; ?>" />
  <input name="account_id" type="hidden" id="account_id" value="<?php echo create_guid();?>" />
  <input type="submit" name="Submit" value="Submit" />
  <input type="hidden" name="MM_update" value="form1">
</form>
<?php do { ?>
  <?php  
  $account_id = "Yes";
  $updateSQL = sprintf("UPDATE committee SET active=%s WHERE id=%s",
                       GetSQLValueString($account_id, "text"),
                       GetSQLValueString($row_rsUpdate['id'], "int"));

  mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
  $Result1 = mysql_query($updateSQL, $connSeahoAdmin) or die(mysql_error());
?>
  <?php } while ($row_rsUpdate = mysql_fetch_assoc($rsUpdate)); ?></body>
</html>
<?php
mysql_free_result($rsUpdate);
?>
