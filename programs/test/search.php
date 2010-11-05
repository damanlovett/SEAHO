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

$colname_rsPrograms = "-1";
if (isset($_REQUEST['session'])) {
  $colname_rsPrograms = (get_magic_quotes_gpc()) ? $_REQUEST['session'] : addslashes($_REQUEST['session']);
}
$colname2_rsPrograms = "-1";
if (isset($_REQUEST['TopicArea'])) {
  $colname2_rsPrograms = (get_magic_quotes_gpc()) ? $_REQUEST['TopicArea'] : addslashes($_REQUEST['TopicArea']);
}
if(!isset($_REQUEST['sort'])){ $sort = 'ORDER BY callforprograms.ProgramTitle';} else {$sort = "ORDER BY ".$_REQUEST['sort']."";}

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = sprintf("SELECT ProgramTitle, ProgramNumber, `session`, FirstName, LastName, TopicArea FROM callforprograms WHERE `session` = %s OR callforprograms.TopicArea = %s".$sort."", GetSQLValueString($colname_rsPrograms, "text"),GetSQLValueString($colname2_rsPrograms, "text"));
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);

mysql_select_db($database_Programming, $Programming);
$query_rsTopics = "SELECT TopicArea FROM callforprograms GROUP BY TopicArea ORDER BY TopicArea";
$rsTopics = mysql_query($query_rsTopics, $Programming) or die(mysql_error());
$row_rsTopics = mysql_fetch_assoc($rsTopics);
$totalRows_rsTopics = mysql_num_rows($rsTopics);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <ol>
    <li>Sessions
      <select name="session" id="session">
	  	<option>-------</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
    </li>
    <li>Topic Area
      <select name="TopicArea" id="TopicArea">
        <?php
do {  
?>
        <option value="<?php echo $row_rsTopics['TopicArea']?>"><?php echo $row_rsTopics['TopicArea']?></option>
        <?php
} while ($row_rsTopics = mysql_fetch_assoc($rsTopics));
  $rows = mysql_num_rows($rsTopics);
  if($rows > 0) {
      mysql_data_seek($rsTopics, 0);
	  $row_rsTopics = mysql_fetch_assoc($rsTopics);
  }
?>
      </select>
    </li>
    <li>Sort By
      <select name="sort" id="sort">
        <option value="ProgramTitle">Title</option>
        <option value="ProgramNumber">Number</option>
        <option value="session">Session</option>
        <option value="FirstName">First Name</option>
        <option value="LastName">LastName</option>
        <option value="TopicArea">Topic</option>
      </select>
    </li>
    <li>
      <input type="submit" name="Submit" value="Submit" />
    </li>
  </ol>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td>ProgramTitle</td>
    <td>ProgramNumber</td>
    <td>session</td>
    <td>FirstName</td>
    <td>LastName</td>
    <td>TopicArea</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsPrograms['ProgramTitle']; ?></td>
      <td><?php echo $row_rsPrograms['ProgramNumber']; ?></td>
      <td><?php echo $row_rsPrograms['session']; ?></td>
      <td><?php echo $row_rsPrograms['FirstName']; ?></td>
      <td><?php echo $row_rsPrograms['LastName']; ?></td>
      <td><?php echo $row_rsPrograms['TopicArea']; ?></td>
    </tr>
    <?php } while ($row_rsPrograms = mysql_fetch_assoc($rsPrograms)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsPrograms);

mysql_free_result($rsTopics);
?>
