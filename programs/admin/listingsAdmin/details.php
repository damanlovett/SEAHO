<?php require_once('../../../Connections/Programming.php'); ?>
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
  $updateSQL = sprintf("UPDATE callforprograms SET ProgramNumber=%s, `session`=%s, moderated=%s WHERE id=%s",
                       GetSQLValueString($_POST['ProgramNumber'], "text"),
                       GetSQLValueString($_POST['session'], "text"),
                       GetSQLValueString($_POST['moderated'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

$colname_rsAssignments = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsAssignments = $_GET['recordID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsAssignments = sprintf("SELECT id, ProgramTitle, ProgramNumber, `session`, moderated FROM callforprograms WHERE callforprograms.id=%s", GetSQLValueString($colname_rsAssignments, "text"));
$rsAssignments = mysql_query($query_rsAssignments, $Programming) or die(mysql_error());
$row_rsAssignments = mysql_fetch_assoc($rsAssignments);
$totalRows_rsAssignments = mysql_num_rows($rsAssignments);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Assignment Details</title>
<link href="../../../admin/styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../../admin/styles/table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #000099}
-->
</style>
</head>

<body>
<h2 class="style1"><?php echo $row_rsAssignments['ProgramTitle']; ?></h2>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table border="0" align="center" cellpadding="5" cellspacing="0" class="detailspopup">
    <tr valign="baseline">
      <td nowrap align="right"><strong>Program Number:</strong></td>
      <td><input type="text" name="ProgramNumber" value="<?php echo $row_rsAssignments['ProgramNumber']; ?>" size="10"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Session Number:</strong></td>
      <td><input type="text" name="session" value="<?php echo $row_rsAssignments['session']; ?>" size="10"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Moderated:</strong></td>
      <td><select name="moderated">
        <option value="yes" <?php if (!(strcmp("yes", $row_rsAssignments['moderated']))) {echo "SELECTED";} ?>>yes</option>
        <option value="no" <?php if (!(strcmp("no", $row_rsAssignments['moderated']))) {echo "SELECTED";} ?>>no</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><div align="center">
        <input type="submit" value="Make Assignment">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $row_rsAssignments['id']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_rsAssignments['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsAssignments);
?>
