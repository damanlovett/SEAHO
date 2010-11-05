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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// -----------------------------------

// Sets the recordset to READ -----------------------------------------------

if (isset($_GET["read"])) {
  $updateSQL = sprintf("UPDATE reviewers SET `read`=%s WHERE id=%s",
                       GetSQLValueString($_GET['read'], "int"),
                       GetSQLValueString($_GET['reviewID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

// ----------------------------------------------------------------------------

$colname_rsPrograms = "-1";
if (isset($_GET['programID'])) {
  $colname_rsPrograms = (get_magic_quotes_gpc()) ? $_GET['programID'] : addslashes($_GET['programID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = sprintf("SELECT ProgramTitle, ProgramNumber FROM callforprograms WHERE id = %s", GetSQLValueString($colname_rsPrograms, "int"));
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);

$colname_reviewID = "-1";
if (isset($_GET['reviewID'])) {
  $colname_reviewID = (get_magic_quotes_gpc()) ? $_GET['reviewID'] : addslashes($_GET['reviewID']);
}
mysql_select_db($database_Programming, $Programming);
$query_reviewID = sprintf("SELECT `read`, vote, notes FROM reviewers WHERE id = %s", GetSQLValueString($colname_reviewID, "int"));
$reviewID = mysql_query($query_reviewID, $Programming) or die(mysql_error());
$row_reviewID = mysql_fetch_assoc($reviewID);
$totalRows_reviewID = mysql_num_rows($reviewID);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><?php echo $row_rsPrograms['ProgramTitle']; ?></p>
    <p><?php echo $row_rsPrograms['ProgramNumber']; ?></p>
    <form id="vote" name="vote" method="POST" action="<?php echo $editFormAction; ?>">
      <label>
        <select name="vote" id="vote">
          <option>Vote on Program</option>
          <option value="1">Yes</option>
          <option value="2">No</option>
          <option value="3">Maybe</option>
        </select>
        </label>
      <label>
      <input type="submit" name="Submit" value="Submit" />
      </label>
      <input name="reviewID" type="hidden" id="reviewID" value="<?php $_GET['reviewID'];?>" />
      <input type="hidden" name="MM_update" value="vote">
</form>    <p><a href="javascript:window.close()">Close Window</a></p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsPrograms);

mysql_free_result($reviewID);
?>
