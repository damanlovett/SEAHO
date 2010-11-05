<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$table = $_REQUEST['table'];
//$table = "topic_area";

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insert")) {

	$message = "The new ".$_REQUEST['label']." has been added";
	
	}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insert")) {
  $insertSQL = sprintf("INSERT INTO ".$table." (".$table.") VALUES (%s)",
                       GetSQLValueString($_POST['entry'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
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
  <form id="insert" name="insert" method="POST" action="<?php echo $editFormAction; ?>">
    <label>
    <input name="entry" type="text" id="entry" size="45" />
    </label>
    <input type="submit" name="Submit" value="add new" />
    <input type="hidden" name="MM_insert" value="insert">
</form><br />
<br />
<br />
<input type=button value="Close Window" onClick="javascript:window.close();">
</div>
</body>
</html>
