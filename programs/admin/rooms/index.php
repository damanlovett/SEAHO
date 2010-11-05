<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../../Connections/Programming.php'); ?>
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
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$_POST['start_time'] = $_POST['hour1'].":".$_POST['minute1']." ".$_POST['stamp1'];
$_POST['end_time'] = $_POST['hour2'].":".$_POST['minute2']." ".$_POST['stamp2'];
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO rooms (roomID, programID, location, in_use, start_time, end_time) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['roomID'], "text"),
                       GetSQLValueString($_POST['programID'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['in_use'], "date"),
                       GetSQLValueString($_POST['start_time'], "text"),
                       GetSQLValueString($_POST['end_time'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}

if ((isset($_GET['delete'])) && ($_GET['delete'] != "")) {
  $deleteSQL = sprintf("DELETE FROM rooms WHERE roomID=%s",
                       GetSQLValueString($_GET['delete'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($deleteSQL, $Programming) or die(mysql_error());
}

mysql_select_db($database_Programming, $Programming);
$query_rsProgramList = "SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.`session` FROM callforprograms ORDER BY callforprograms.ProgramTitle";
$rsProgramList = mysql_query($query_rsProgramList, $Programming) or die(mysql_error());
$row_rsProgramList = mysql_fetch_assoc($rsProgramList);
$totalRows_rsProgramList = mysql_num_rows($rsProgramList);

$maxRows_rsAssignment = 10;
$pageNum_rsAssignment = 0;
if (isset($_GET['pageNum_rsAssignment'])) {
  $pageNum_rsAssignment = $_GET['pageNum_rsAssignment'];
}
$startRow_rsAssignment = $pageNum_rsAssignment * $maxRows_rsAssignment;

mysql_select_db($database_Programming, $Programming);
$query_rsAssignment = "SELECT rooms.id, rooms.in_use, rooms.roomID, rooms.programID, rooms.location, rooms.start_time, rooms.end_time, callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, rooms.in_use FROM rooms LEFT JOIN callforprograms ON rooms.programID = callforprograms.id ORDER BY rooms.location, rooms.in_use";
$query_limit_rsAssignment = sprintf("%s LIMIT %d, %d", $query_rsAssignment, $startRow_rsAssignment, $maxRows_rsAssignment);
$rsAssignment = mysql_query($query_limit_rsAssignment, $Programming) or die(mysql_error());
$row_rsAssignment = mysql_fetch_assoc($rsAssignment);

if (isset($_GET['totalRows_rsAssignment'])) {
  $totalRows_rsAssignment = $_GET['totalRows_rsAssignment'];
} else {
  $all_rsAssignment = mysql_query($query_rsAssignment);
  $totalRows_rsAssignment = mysql_num_rows($all_rsAssignment);
}
$totalPages_rsAssignment = ceil($totalRows_rsAssignment/$maxRows_rsAssignment)-1;

mysql_select_db($database_Programming, $Programming);
$query_rsExcel = "SELECT rooms.location, DATE_FORMAT(rooms.in_use, '%M %d, %Y') AS in_use, rooms.start_time, rooms.end_time,  callforprograms.ProgramTitle, callforprograms.ProgramNumber FROM rooms LEFT JOIN callforprograms ON rooms.programID = callforprograms.id ORDER BY rooms.location, rooms.in_use";
$rsExcel = mysql_query($query_rsExcel, $Programming) or die(mysql_error());
$row_rsExcel = mysql_fetch_assoc($rsExcel);
$totalRows_rsExcel = mysql_num_rows($rsExcel);

//Export to Excel Server Behavior
if (isset($_GET['excel'])&&($_GET['excel']=="yes")){
$lang=(strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'],",")===false)?$_SERVER['HTTP_ACCEPT_LANGUAGE']:substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'],","));
$semi_array=array("af","zh-hk","zh-mo","zh-cn","zh-sg","zh-tw","fr-ch","de-li","de-ch","it-ch","ja","ko","es-do","es-sv","es-gt","es-hn","es-mx","es-ni","es-pa","es-pe","es-pr","sw");
$delim=(in_array($lang,$semi_array) || substr_count($lang,"en")>0)?",":";";
$output="";
$include_hdr="1";
if($include_hdr=="1"){
	$totalColumns_rsExcel=mysql_num_fields($rsExcel);
	for ($x=0; $x<$totalColumns_rsExcel; $x++) {
		if($x==$totalColumns_rsExcel-1){$comma="";}else{$comma=$delim;}
		$output = $output.(ereg_replace("_", " ",mysql_field_name($rsExcel, $x))).$comma;
	}
	$output = $output."\r\n";
}

do{$fixcomma=array();
    foreach($row_rsExcel as $r){array_push($fixcomma,ereg_replace($delim,"¸",$r));}
    $line = join($delim,$fixcomma);
    $line=ereg_replace("\r\n", " ",$line);
    $line = "$line\n";
    $output=$output.$line;}while($row_rsExcel = mysql_fetch_assoc($rsExcel));
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=room_report.csv");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", false);
echo $output;
die();
}

$queryString_rsAssignment = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsAssignment") == false && 
        stristr($param, "totalRows_rsAssignment") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsAssignment = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsAssignment = sprintf("&totalRows_rsAssignment=%d%s", $totalRows_rsAssignment, $queryString_rsAssignment);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Room Assignment</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script language="" src="../../includefiles/calendarDateInput.js" type="text/javascript">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<!-- InstanceEndEditable --><!-- InstanceParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTite" --><span><img src="../../images/PHrooms.jpg" alt="rooms" width="65" height="51" />Room Assignments </span><!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
<div class="pageInformation">
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table border="0" cellpadding="3" cellspacing="0">

          <tr valign="baseline">
            <td nowrap align="right"><strong>Program:</strong></td>
            <td colspan="3"><div align="left">
              <select name="programID">
    		  <option value="--------------------">--------------------</option>
                <?php 
do {  
?>
                <option value="<?php echo $row_rsProgramList['id']?>" ><?php echo substr($row_rsProgramList['ProgramTitle'],0,35)?></option>
                <?php
} while ($row_rsProgramList = mysql_fetch_assoc($rsProgramList));
?>
              </select>
            </div></td>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Room:</strong></td>
            <td colspan="3"><input type="text" name="location" value="--------------------" size="32" onFocus="if(this.value=='--------------------')this.value='';"></td>
          </tr>

          <tr valign="baseline">
            <td align="right" valign="middle" nowrap><strong>Date:</strong></td>
            <td nowrap="nowrap"><script>DateInput('in_use', true, 'YYYY-MM-DD')</script></td>
            <td>&nbsp;</td>
            <td nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Start time:</strong></td>
            <td nowrap="nowrap"><select name="hour1" id="hour1">
  	<option selected="selected">--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
 :  
 
  <select name="minute1" id="minute1">
  	<option selected="selected">--</option>
    <option value="00">00</option>
    <option value="05">05</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    <option value="25">25</option>
    <option value="30">30</option>
    <option value="35">35</option>
    <option value="40">40</option>
    <option value="45">45</option>
    <option value="50">50</option>
    <option value="55">55</option>
  </select>
  <select name="stamp1" id="stamp1">
    <option value="am">am</option>
    <option value="pm">pm</option>
  </select>  </td>
            <td>&nbsp;</td>
            <td nowrap="nowrap">
  <strong>End Time:</strong>
  <select name="hour2" id="hour2">
  	<option selected="selected">--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
 :  
 
  <select name="minute2" id="minute2">
  	<option>--</option>
    <option value="00">00</option>
    <option value="05">05</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    <option value="25">25</option>
    <option value="30">30</option>
    <option value="35">35</option>
    <option value="40">40</option>
    <option value="45">45</option>
    <option value="50">50</option>
    <option value="55">55</option>
  </select>
  <select name="stamp2" id="stamp2">
    <option value="am">am</option>
    <option value="pm">pm</option>
  </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Create New Room">
            <input name="roomID" type="hidden" id="roomID" value="<?php echo create_guid();?>" />
            <input name="start_time" type="hidden" id="start_time" />
            <input name="end_time" type="hidden" id="end_time" />
            <input name="MM_insert" type="hidden" id="MM_insert" value="form1" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    </div>
	<?php if ($totalRows_rsAssignment > 0) { // Show if recordset not empty ?>
	  <p>Room <?php echo ($startRow_rsAssignment + 1) ?> to <?php echo min($startRow_rsAssignment + $maxRows_rsAssignment, $totalRows_rsAssignment) ?> of <?php echo $totalRows_rsAssignment ?> </p>
	  <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
	    <tr class="tableTop">
	      <td align="left" valign="top" class="tableTop"><a name="table" id="table"></a>
          <input name="Button" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Refresh List" /></td>
	      <td align="left" valign="top" class="tableTop">&nbsp;</td>
	      <td align="left" valign="top" class="tableTop">&nbsp;</td>
	      <td align="left" valign="top" class="tableTop">&nbsp;</td>
	      <td align="left" valign="top" nowrap="nowrap" class="tableTop"><?php if ($pageNum_rsAssignment > 0) { // Show if not first page ?>
	            <a href="<?php printf("%s?pageNum_rsAssignment=%d%s", $currentPage, 0, $queryString_rsAssignment); ?>">First</a>
	            <?php } // Show if not first page ?>
	        &nbsp;
	        <?php if ($pageNum_rsAssignment > 0) { // Show if not first page ?>
	          <a href="<?php printf("%s?pageNum_rsAssignment=%d%s", $currentPage, max(0, $pageNum_rsAssignment - 1), $queryString_rsAssignment); ?>">Previous</a>
	          <?php } // Show if not first page ?>
	        &nbsp;
	        <?php if ($pageNum_rsAssignment < $totalPages_rsAssignment) { // Show if not last page ?>
	          <a href="<?php printf("%s?pageNum_rsAssignment=%d%s", $currentPage, min($totalPages_rsAssignment, $pageNum_rsAssignment + 1), $queryString_rsAssignment); ?>">Next</a>
	          <?php } // Show if not last page ?>
	        &nbsp;
	        <?php if ($pageNum_rsAssignment < $totalPages_rsAssignment) { // Show if not last page ?>
	          <a href="<?php printf("%s?pageNum_rsAssignment=%d%s", $currentPage, $totalPages_rsAssignment, $queryString_rsAssignment); ?>">Last</a>
          <?php } // Show if not last page ?></td>
	      <td colspan="3" class="tableTop"><label for="button"></label>
	        <label for="button"></label>
          <input name="button" type="button" id="button" onclick="MM_goToURL('parent','index.php?excel=yes');return document.MM_returnValue" value="Export to Excel" /></td>
	      <td align="left" valign="top" class="tableTop">&nbsp;</td>
        </tr>
	    <tr>
	      <th nowrap="nowrap">Room </th>
          <th>Date</th>
          <th nowrap="nowrap">Program</th>
          <th>&nbsp;</th>
          <th>Title</th>
          <th colspan="3">Time</th>
          <th>&nbsp;</th>
        </tr>
	    <?php do { ?>
	      <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor">
	        <td nowrap="nowrap"><a href="#table" onclick="MM_openBrWindow('update.php?recordID=<?php echo $row_rsAssignment['roomID']; ?>','','scrollbars=yes,width=500,height=400')"><img src="../../images/imgAdminEdit.gif" alt="edit" width="14" height="14" /><?php echo $row_rsAssignment['location']; ?></a> </td>
	        <td nowrap="nowrap"><?php echo formatDate($row_rsAssignment['in_use'],'M. d, Y'); ?></td>
	        <td><?php echo $row_rsAssignment['ProgramNumber']; ?></td>
	        <td nowrap="nowrap">&nbsp;</td>
	        <td><?php echo $row_rsAssignment['ProgramTitle']; ?>. . . </td>
	        <td nowrap="nowrap"><?php echo $row_rsAssignment['start_time']; ?></td>
	        <td nowrap="nowrap">-</td>
	        <td nowrap="nowrap"><div align="center"><?php echo $row_rsAssignment['end_time']; ?></div></td>
	        <td><a href="index.php?delete=<?php echo $row_rsAssignment['roomID']; ?>"><img src="../../images/imgAdminDelete.gif" alt="delete" width="14" height="14" border="0" /></a></td>
          </tr>
	      <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
	      <?php } while ($row_rsAssignment = mysql_fetch_assoc($rsAssignment)); ?>
	    <tr>
	      <td colspan="5" nowrap="nowrap" class="tableBottom">&nbsp;</td>
          <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
          <td nowrap="nowrap" class="tableBottom">&nbsp;</td>
        </tr>
      </table>
	  <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rsAssignment == 0) { // Show if recordset empty ?>
	    <p class="homepageTitles">There are no rooms in the system</p>
	    <?php } // Show if recordset empty ?>
  <p>&nbsp;</p><!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsProgramList);

mysql_free_result($rsAssignment);

mysql_free_result($rsExcel);
?>
