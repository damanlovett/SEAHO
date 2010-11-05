<?php require_once('../Connections/Programming.php'); ?>
<?php session_start();?>
<?php require_once('includefiles/moderatorEmail.php'); ?>
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

$colname_rsProgramInfo = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsProgramInfo = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramInfo = sprintf("SELECT id, ProgramTitle, ProgramNumber FROM callforprograms WHERE id = %s", GetSQLValueString($colname_rsProgramInfo, "int"));
$rsProgramInfo = mysql_query($query_rsProgramInfo, $Programming) or die(mysql_error());
$row_rsProgramInfo = mysql_fetch_assoc($rsProgramInfo);
$totalRows_rsProgramInfo = mysql_num_rows($rsProgramInfo);?>

<? if(isset($_GET['request'])){
moderatorEmail($row_rsProgramInfo['ProgramTitle'],$row_rsProgramInfo['ProgramNumber'],$_POST['modName'],$_POST['modEmail'],$_POST['message']);
$error="Your request has been sent";
}?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Program Moderator</title>
<style type="text/css">
<!--
body {
	background-color: #666666;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style></head>

<body>
<table width="400" height="340" border="1" cellpadding="7" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><h3>Program Moderator Form</h3>
    <?php echo "<p><span class='style1'>$error</span></p>";?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>?request=yes&amp;recordID=<?php echo $row_rsProgramInfo['id']; ?>" method="post" name="request" id="request">
  <label for="textfield">Name:</label>
    <input name="modName" type="text" id="modName">
  <p>
    <label for="label3">Email:</label>
    <input name="modEmail" type="text" id="label3" size="45">
  </p>
  <p>
    <label for="label2">Message<br />
    </label>
    <textarea name="message" cols="40" rows="6" id="label2">I would like to moderate program "<?php echo $row_rsProgramInfo['ProgramTitle']; ?>" - Program Number <?php echo $row_rsProgramInfo['ProgramNumber']; ?></textarea>
	</p>
	<p>
	<label>
    <input type="submit" name="Submit" value="Request to Moderate" />
    </label>
  </p>
	<p align="center"><a href="javascript:window.close();">Close This Window</a></p>
</form>
</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsProgramInfo);
?>
