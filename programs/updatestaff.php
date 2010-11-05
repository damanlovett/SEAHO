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
  $updateSQL = sprintf("UPDATE committee SET userID=%s WHERE committee_id=%s",
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['committee_id'], "text"));

  mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
  $Result1 = mysql_query($updateSQL, $connSeahoAdmin) or die(mysql_error());

  $updateGoTo = "committees.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsUpdate = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUpdate = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
$query_rsUpdate = sprintf("SELECT id, committee_id, userID, `Position`, Team FROM committee WHERE committee_id = %s", GetSQLValueString($colname_rsUpdate, "text"));
$rsUpdate = mysql_query($query_rsUpdate, $connSeahoAdmin) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);

mysql_select_db($database_connSeahoAdmin, $connSeahoAdmin);
$query_rsAccounts = "SELECT id, account_id, first_name, last_name FROM accounts";
$rsAccounts = mysql_query($query_rsAccounts, $connSeahoAdmin) or die(mysql_error());
$row_rsAccounts = mysql_fetch_assoc($rsAccounts);
$totalRows_rsAccounts = mysql_num_rows($rsAccounts);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>

<p>&nbsp;</p>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Committee_id:</td>
      <td><?php echo $row_rsUpdate['committee_id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Position:</td>
      <td><?php echo $row_rsUpdate['Position']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">UserID:</td>
      <td><select name="userID">
        <?php 
do {  
?>
        <option value="<?php echo $row_rsAccounts['account_id']?>" <?php if (!(strcmp($row_rsAccounts['account_id'], $row_rsUpdate['userID']))) {echo "SELECTED";} ?>><?php echo $row_rsAccounts['last_name']?></option>
        <?php
} while ($row_rsAccounts = mysql_fetch_assoc($rsAccounts));
?>
      </select>
      </td>
    <tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="committee_id" value="<?php echo $row_rsUpdate['committee_id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUpdate);

mysql_free_result($rsAccounts);
?>
