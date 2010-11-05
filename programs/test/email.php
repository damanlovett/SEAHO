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

mysql_select_db($database_Programming, $Programming);
$query_rsEmails = "SELECT id, title, emailmessage, sent_to, sent_by, sent_date FROM email_records";
$rsEmails = mysql_query($query_rsEmails, $Programming) or die(mysql_error());
$row_rsEmails = mysql_fetch_assoc($rsEmails);
$totalRows_rsEmails = mysql_num_rows($rsEmails);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p><a href="email2.php">Email2</a></p>
<table border="0" cellpadding="3" cellspacing="0"><?php do { ?>
    <tr>
      <td><?php echo $row_rsEmails['id']; ?></td>
      <td><?php echo strtoupper($row_rsEmails['title']); ?></td>
      <td>&nbsp;</td>
      <td><?php echo $row_rsEmails['sent_to']; ?></td>
      <td><?php echo strtoupper($row_rsEmails['sent_by']); ?></td>
      <td><?php echo $row_rsEmails['sent_date']; ?></td>
    </tr>
    <tr>
      <td colspan="6"><?php echo $row_rsEmails['emailmessage']; ?></td>
    </tr>
    <?php } while ($row_rsEmails = mysql_fetch_assoc($rsEmails)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsEmails);
?>
