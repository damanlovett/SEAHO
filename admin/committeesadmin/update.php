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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE team_positions SET email=%s, votes=%s, `column`=%s, `order`=%s WHERE id=%s",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['vote'], "int"),
                       GetSQLValueString($_POST['column'], "int"),
                       GetSQLValueString($_POST['order'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

$colname_rsUpdate = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUpdate = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsUpdate = sprintf("SELECT * FROM team_positions WHERE position_id = %s", GetSQLValueString($colname_rsUpdate, "text"));
$rsUpdate = mysql_query($query_rsUpdate, $Directory) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Update</title>
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin: 20px;
}
-->
</style>
</head>

<body>
<h2 align="left"><?php echo $row_rsUpdate['position']; ?></h2>
<form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
        <table width="150" border="0" align="left" cellpadding="5" cellspacing="0" class="detailspopup">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><div align="right"><strong>Voting Member</strong></div></td>
            <td><label>
              <select name="vote" id="vote">
                <option value="1" <?php if (!(strcmp(1, $row_rsUpdate['votes']))) {echo "selected=\"selected\"";} ?>>Yes</option>
                <option value="0" <?php if (!(strcmp(0, $row_rsUpdate['votes']))) {echo "selected=\"selected\"";} ?>>No</option>
              </select>
            </label></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><label for="label">
              <div align="right"><strong>Row</strong></div>
            </label></td>
            <td><select name="order" id="order">
              <option value="1" selected="selected" <?php if (!(strcmp(1, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>1</option>
              <option value="2" <?php if (!(strcmp(2, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>2</option>
              <option value="3" <?php if (!(strcmp(3, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>3</option>
              <option value="4" <?php if (!(strcmp(4, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>4</option>
              <option value="5" <?php if (!(strcmp(5, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>5</option>
              <option value="6" <?php if (!(strcmp(6, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>6</option>
              <option value="7" <?php if (!(strcmp(7, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>7</option>
              <option value="8" <?php if (!(strcmp(8, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>8</option>
              <option value="9" <?php if (!(strcmp(9, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>9</option>
              <option value="10" <?php if (!(strcmp(10, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>10</option>
              <option value="11" <?php if (!(strcmp(11, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>11</option>
              <option value="12" <?php if (!(strcmp(12, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>12</option>
              <option value="13" <?php if (!(strcmp(13, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>13</option>
              <option value="14" <?php if (!(strcmp(14, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>14</option>
              <option value="15" <?php if (!(strcmp(15, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>15</option>
              <option value="16" <?php if (!(strcmp(16, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>16</option>
              <option value="17" <?php if (!(strcmp(17, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>17</option>
              <option value="18" <?php if (!(strcmp(18, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>18</option>
              <option value="19" <?php if (!(strcmp(19, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>19</option>
              <option value="20" <?php if (!(strcmp(20, $row_rsUpdate['order']))) {echo "selected=\"selected\"";} ?>>20</option>
            </select></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><div align="right"><strong>Column</strong></div></td>
            <td><select name="column" id="column">
              <option value="1" <?php if (!(strcmp(1, $row_rsUpdate['column']))) {echo "selected=\"selected\"";} ?>>1</option>
              <option value="2" <?php if (!(strcmp(2, $row_rsUpdate['column']))) {echo "selected=\"selected\"";} ?>>2</option>
            </select></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><div align="right"><strong>Email</strong></div></td>
            <td><input name="email" type="text" id="email" value="<?php echo $row_rsUpdate['email']; ?>" size="45" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><div align="right">
              <input name="id" type="hidden" id="id" value="<?php echo $row_rsUpdate['id']; ?>" />
            </div></td>
            <td><input name="button" type="submit" class="submitButton" id="button" value="Update" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td colspan="2" nowrap="nowrap">
              <div align="center">
                <?php if(isset($_POST["MM_update"])) {?>
                  </div>
              <div align="center" class="homepageBlocks">
                <div align="center">Record Updated </div>
              </div>
              
              <div align="center">
                <?php }?>
                </div></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="update">
</form>
<br />
<br class="cleartable" />
<p> <br />
<input type=button value="Close Window" onClick="javascript:window.close();"></p>
</body>
</html>
<?php
mysql_free_result($rsUpdate);
?>
