<?php require_once('../Connections/Forms.php'); ?>
<?php $formname = $_POST['formname'];
$leader = $_POST['leader'];
$leaderemail = $_POST['leaderemail'];
$speaker = $_POST['firstName'];
$subject = $_POST['subject'];?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "humanaward")) {
  $insertSQL = sprintf("INSERT INTO humanitarian (nominee, positionnee, addressnee, citynee, statenee, zipnee, institutionnee, phonenee, emailnee, `year`, nominator, `position`, address, city, `state`, zip, institution, phone, email, `date`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nominee'], "text"),
                       GetSQLValueString($_POST['Positionnee'], "text"),
                       GetSQLValueString($_POST['Addressnee'], "text"),
                       GetSQLValueString($_POST['citynee'], "text"),
                       GetSQLValueString($_POST['statenee'], "text"),
                       GetSQLValueString($_POST['zippnee'], "text"),
                       GetSQLValueString($_POST['institutionnee'], "text"),
                       GetSQLValueString($_POST['telephonenee'], "text"),
                       GetSQLValueString($_POST['emailnee'], "text"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['Nominator'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Zip'], "text"),
                       GetSQLValueString($_POST['Institution'], "text"),
                       GetSQLValueString($_POST['Telephone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['Date'], "text"));

  mysql_select_db($database_Forms, $Forms);
  $Result1 = mysql_query($insertSQL, $Forms) or die(mysql_error());

  $insertGoTo = "../emailnotify/index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Awards - Humanitarian Nomination Form</title>

<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
</body>
</html>
