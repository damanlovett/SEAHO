<?php require_once('../Connections/Directory.php'); ?>
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

mysql_select_db($database_Directory, $Directory);
$query_rsTest = "SELECT * FROM team_positions";
$rsTest = mysql_query($query_rsTest, $Directory) or die(mysql_error());
$row_rsTest = mysql_fetch_assoc($rsTest);
$totalRows_rsTest = mysql_num_rows($rsTest);
?><?
function db2xml($host,$user,$password,$database,$table,$xml_file)
{

	global $database_Directory;
	global $Directory;

$create_xml = fopen($xml_file,"w");
fwrite($create_xml,"<xml>rn<table>rn");

mysql_select_db($database_Directory, $Directory);
$query_rsTest = "SELECT * FROM team_positions";
$rsTest = mysql_query($query_rsTest, $Directory) or die(mysql_error());

mysql_connect($host, $user, $password);
$req = mysql_db_query($database, "select * from $table");
while($row = mysql_fetch_array($rsTest))
{
fwrite($create_xml,"<item>rn");
for($j=0;$line=each($row);$j++)
{
if($j%2)
{
fwrite($create_xml,"<$line[0]>$line[1]</$line[0]>rn");
}
}
fwrite($create_xml,"</item>rn");
}
fwrite($create_xml,"</table>rn</xml>");
fclose($create_xml);
mysql_free_result($req);
}
?> 
<?php db2xml("db413.perfora.net","dbo169066589","cromag65","db169066589","team_position","xml_test.xml");
mysql_free_result($rsTest);
?>