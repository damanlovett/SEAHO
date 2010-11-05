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
?>
<?php require_once('../../includefiles/init.php'); ?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE rooms SET id=%s, programID=%s, location=%s, in_use=%s, start_time=%s, end_time=%s, notes=%s WHERE roomID=%s",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['programID'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['in_use'], "date"),
                       GetSQLValueString($_POST['start_time'], "text"),
                       GetSQLValueString($_POST['end_time'], "text"),
                       GetSQLValueString($_POST['notes'], "text"),
                       GetSQLValueString($_POST['roomID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

$colname_rsRooms = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsRooms = $_GET['recordID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsRooms = sprintf("SELECT rooms.id, rooms.roomID, rooms.programID, rooms.location, rooms.start_time, rooms.end_time, callforprograms.ProgramTitle, rooms.notes, rooms.in_use FROM rooms, callforprograms WHERE rooms.roomID = %s", GetSQLValueString($colname_rsRooms, "text"));
$rsRooms = mysql_query($query_rsRooms, $Programming) or die(mysql_error());
$row_rsRooms = mysql_fetch_assoc($rsRooms);
$totalRows_rsRooms = mysql_num_rows($rsRooms);

mysql_select_db($database_Programming, $Programming);
$query_rsProgramList = "SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.`session` FROM callforprograms";
$rsProgramList = mysql_query($query_rsProgramList, $Programming) or die(mysql_error());
$row_rsProgramList = mysql_fetch_assoc($rsProgramList);
$totalRows_rsProgramList = mysql_num_rows($rsProgramList);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="" src="../../includefiles/calendarDateInput.js" type="text/javascript">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>

<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="detailspopup">
<p class="homepageTitles"><?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
echo "Room ".$_REQUEST['location']." has been updated.";
}?></p>
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table align="center">
      <tr valign="baseline">
        <td nowrap align="right"><strong>Program:</strong></td>
        <td><select name="programID">
    		  <option value="--------------------">--------------------</option>
          <?php
do {  
?><option value="<?php echo $row_rsProgramList['id']?>" <?php if (!(strcmp($row_rsProgramList['id'], $row_rsRooms['programID']))) {echo "selected=\"selected\"";} ?>><?php echo substr($row_rsProgramList['ProgramTitle'],0,30)."..."?></option>
          <?php
} while ($row_rsProgramList = mysql_fetch_assoc($rsProgramList));
  $rows = mysql_num_rows($rsProgramList);
  if($rows > 0) {
      mysql_data_seek($rsProgramList, 0);
	  $row_rsProgramList = mysql_fetch_assoc($rsProgramList);
  }
?>
          <?php
do {  
?>
          <option value="<?php echo $row_rsProgramList['id']?>"<?php if (!(strcmp($row_rsProgramList['id'], $row_rsRooms['programID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsProgramList['ProgramTitle']?></option>
          <?php
} while ($row_rsProgramList = mysql_fetch_assoc($rsProgramList));
  $rows = mysql_num_rows($rsProgramList);
  if($rows > 0) {
      mysql_data_seek($rsProgramList, 0);
	  $row_rsProgramList = mysql_fetch_assoc($rsProgramList);
  }
?>
          </select>        </td>
      <tr>
      <tr valign="baseline">
        <td nowrap align="right"><strong>Location:</strong></td>
        <td><input type="text" name="location" value="<?php echo $row_rsRooms['location']; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><strong>Date:</strong></td>
        <td><script>DateInput('in_use', true, 'YYYY-MM-DD', '<?php echo $row_rsRooms['in_use']; ?>')</script></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><strong>Start time:</strong></td>
        <td><input type="text" name="start_time" value="<?php echo $row_rsRooms['start_time']; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right"><strong>End time:</strong></td>
        <td><input type="text" name="end_time" value="<?php echo $row_rsRooms['end_time']; ?>" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td align="right" valign="top" nowrap><strong>Notes:</strong></td>
        <td><textarea name="notes" cols="32" rows="5"><?php echo $row_rsRooms['notes']; ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Update room"></td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo $row_rsRooms['id']; ?>">
    <input type="hidden" name="roomID" value="<?php echo $row_rsRooms['roomID']; ?>">
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="roomID" value="<?php echo $row_rsRooms['roomID']; ?>">
  </form>
<br />
<br />
<br />
  <p align="center"><input type=button value="Close Window" onClick="javascript:window.close();">&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($rsRooms);

mysql_free_result($rsProgramList);
?>
