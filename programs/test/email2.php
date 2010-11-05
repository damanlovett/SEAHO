<?php require_once('../../Connections/Programming.php'); ?>
<?php require_once('../../fckeditor/fckeditor.php'); ?>

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

$colname_rsPresenters = "-1";
if (isset($_POST['status'])) {
  $colname_rsPresenters = (get_magic_quotes_gpc()) ? $_POST['status'] : addslashes($_POST['status']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsPresenters = sprintf("SELECT ProgramTitle, ProgramNumber, `session`, location, programTime, FirstName, LastName, EmailAddress, Status FROM callforprograms WHERE Status = %s", GetSQLValueString($colname_rsPresenters, "text"));
$rsPresenters = mysql_query($query_rsPresenters, $Programming) or die(mysql_error());
$row_rsPresenters = mysql_fetch_assoc($rsPresenters);
$totalRows_rsPresenters = mysql_num_rows($rsPresenters);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="emailprocess.php">
  <label>Subject
  <input name="subject" type="text" id="subject" />
  </label>
  <p>
    <label>Message
<?php
$oFCKeditor = new FCKeditor('emailmessage') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/emailconfig.js' ;
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '200' ;
$oFCKeditor->Value = 'Default text in editor';
$oFCKeditor->Create() ;
?>    </label>
  </p>
  <p>
    <label>Send to
    <select name="status" id="status">
      <option value="Accepted">Accepted</option>
      <option value="To Be Reviewed">To Be Reviewed</option>
    </select>
    </label>
  </p>
  <p>
    <label>
    <input type="submit" name="Submit" value="Submit" />
    </label>
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($rsPresenters);
?>
