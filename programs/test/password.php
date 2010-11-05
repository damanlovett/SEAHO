<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>

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


mysql_select_db($database_Directory, $Directory);
$query_rsUpdate = "SELECT team_positions.id, team_positions.position_id, team_positions.`Position`, team_positions.Voting FROM team_positions";
$rsUpdate = mysql_query($query_rsUpdate, $Directory) or die(mysql_error());
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
  <input name="user_id" type="hidden" id="user_id" value="<?php echo create_guid();?>" />
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
<ul>
  <?php do { ?>
    <li>
      <?php 
  $userID = create_guid();
  $updateSQL = sprintf("UPDATE team_positions SET position_id=%s WHERE id=%s",
                       GetSQLValueString($userID, "text"),
                       GetSQLValueString($row_rsUpdate['id'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());

?>
        </li>
    <?php } while ($row_rsUpdate = mysql_fetch_assoc($rsUpdate)); ?></ul>
</body>
</html>
<?php
mysql_free_result($rsUpdate);
?>
