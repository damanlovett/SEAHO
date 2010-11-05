<?php
ob_start();
session_start();
$systemDate = date ("Y-m-d G:i:s");
$currentDate = date('Y-m-d');

// Magic Quotes - This is the normal magic quotes that Dreamweaver adds to pages with recordsets
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

#Records all sqlQueries for Debugging
function sqlQueryLog($query) {
global $CMS;
global $database_CMS;
$urlstring = addslashes($_SERVER['PHP_SELF']);
if (!empty($_SERVER['QUERY_STRING'])) {
$urlstring .= "?".addslashes($_SERVER['QUERY_STRING']);
}

#ipAddress tracking
$userID = "N/A";
$displayname = "N/A";
$systemDate = date ("Y-m-d G:i:s");
$ipaddress = addslashes($_SERVER['REMOTE_ADDR']);
$trackingSQL = sprintf("INSERT INTO sys_queries (userid, username, ipaddress, urlstring, mysqlquery, accesstime) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($userID, "text"),
                       GetSQLValueString($displayname, "text"),
                       GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
                       GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                       GetSQLValueString($query, "text"),
                       GetSQLValueString($systemDate, "text"));

mysql_select_db($database_CMS, $CMS);
$Result6 = mysql_query($trackingSQL, $CMS) or die(mysql_error());
}


//     Create guid function - this is used to create a unigue id       
function create_guid()

{

    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);

    $dec_hex = sprintf("%x", $a_dec* 1000000);
    $sec_hex = sprintf("%x", $a_sec);

    ensure_length($dec_hex, 5);
    ensure_length($sec_hex, 6);

    $guid = "";
    $guid .= $dec_hex;
    $guid .= create_guid_section(3);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= $sec_hex;
    $guid .= create_guid_section(6);

    return $guid;
}

 

function create_guid_section($characters)

{

    $return = "";
    for($i=0; $i<$characters; $i++)
    {
    $return .= sprintf("%x", mt_rand(0,15));
    }

    return $return;
}

 

function ensure_length(&$string, $length)

{
    $strlen = strlen($string);
    if($strlen < $length)

    {

    $string = str_pad($string,$length,"0");

    }

    else if($strlen > $length)

    {

    $string = substr($string, 0, $length);

    }

}

 

function microtime_diff($a, $b) {

   list($a_dec, $a_sec) = explode(" ", $a);
   list($b_dec, $b_sec) = explode(" ", $b);
   return $b_sec - $a_sec + $b_dec - $a_dec;

}
?>