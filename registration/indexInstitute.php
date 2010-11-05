<?php require_once('../Connections/CMS.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

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

mysql_select_db($database_CMS, $CMS);
$query_Recordset1 = "SELECT * FROM institutions WHERE deleted = 0 ORDER BY institution ASC";
$Recordset1 = mysql_query($query_Recordset1, $CMS) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>SEAHO</title>

<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />

<link href="styles/cmsMain.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/JSRecordset.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/DynamicInput.js"></script>
<?php
//begin JSRecordset
$jsObject_Recordset1 = new WDG_JsRecordset("Recordset1");
echo $jsObject_Recordset1->getOutput();
//end JSRecordset
?>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label for="textfield"></label>
  <blockquote>
    <blockquote>
      <p>
        <input name="textfield" id="textfield" size="45" wdg:recordset="Recordset1" wdg:subtype="DynamicSearch" wdg:type="widget" wdg:displayfield="institution" wdg:norec="50" wdg:defaultoptiontext="no" />
          </p>
    </blockquote>
  </blockquote>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
