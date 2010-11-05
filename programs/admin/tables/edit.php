<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>

<?php

$table = $_REQUEST['table'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "insert")) {
  $updateSQL = sprintf("UPDATE ".$table." SET ".$table."=%s WHERE id=%s",
                       GetSQLValueString($_POST['entry'], "text"),
                       GetSQLValueString($_POST['recordID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}
?>
<?php

$colname_rsUpdate = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsUpdate = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsUpdate = sprintf("SELECT id, ".$table." FROM ".$table." WHERE id = %s", GetSQLValueString($colname_rsUpdate, "int"));
$rsUpdate = mysql_query($query_rsUpdate, $Programming) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);
?>
<?php
//$table = "topic_area";

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insert")) {

	$message = "The new ".$_REQUEST['label']." has been added";
	
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="detailspopup">
  <p><strong>Enter New <?php echo $_REQUEST['label'];?> </strong></p>
  <?php echo "<p> $message </p>";?>
  <p><?php echo $_REQUEST['recordID'];?></p>
  <form action="<?php echo $editFormAction; ?>" id="insert" name="insert" method="POST">
    <label>
    <input name="entry" type="text" id="entry" value="<?php echo $row_rsUpdate['topic_area']; ?>" size="45" />
    </label>
    <input type="submit" name="Submit" value="add new" />
    <input name="id" type="hidden" id="id" value="<?php $_REQUEST['recordID'];?>" />
    <input type="hidden" name="MM_update" value="insert">
  </form><br />
<br />
<br />
<input type=button value="Close Window" onClick="javascript:window.close();">
</div>
</body>
</html>
<?php
mysql_free_result($rsUpdate);
?>
