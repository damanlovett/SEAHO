<?php require_once('../Connections/Programming.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsProgramList = 15;
$pageNum_rsProgramList = 0;
if (isset($_GET['pageNum_rsProgramList'])) {
  $pageNum_rsProgramList = $_GET['pageNum_rsProgramList'];
}
$startRow_rsProgramList = $pageNum_rsProgramList * $maxRows_rsProgramList;

mysql_select_db($database_Programming, $Programming);
$query_rsProgramList = "SELECT id, ProgramTitle, ProgramNumber, `session`, location, FirstName, LastName, Institution, TopicArea, ProgramDescription FROM callforprograms WHERE callforprograms.Status = 'Accepted' ORDER BY ProgramTitle ASC";
$query_limit_rsProgramList = sprintf("%s LIMIT %d, %d", $query_rsProgramList, $startRow_rsProgramList, $maxRows_rsProgramList);
$rsProgramList = mysql_query($query_limit_rsProgramList, $Programming) or die(mysql_error());
$row_rsProgramList = mysql_fetch_assoc($rsProgramList);

if (isset($_GET['totalRows_rsProgramList'])) {
  $totalRows_rsProgramList = $_GET['totalRows_rsProgramList'];
} else {
  $all_rsProgramList = mysql_query($query_rsProgramList);
  $totalRows_rsProgramList = mysql_num_rows($all_rsProgramList);
}
$totalPages_rsProgramList = ceil($totalRows_rsProgramList/$maxRows_rsProgramList)-1;

$queryString_rsProgramList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsProgramList") == false && 
        stristr($param, "totalRows_rsProgramList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsProgramList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsProgramList = sprintf("&totalRows_rsProgramList=%d%s", $totalRows_rsProgramList, $queryString_rsProgramList);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>SEAHO | Program List</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2900.2873" name=GENERATOR>
<link href="../stylesheets/conferencestyle2007.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
#container #content p {
	line-height: 1.4em;
}
#container #content li {
	line-height: 1.5em;
}
.tableformat {
	border: 1px solid #999999;
}
.tableheader {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	font-size: 10px;
	margin: 0px;
	padding: 5px;
}
.tableheader2 {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	text-align: right;
	padding-right: 10px;
	font-size: 10px;
	margin: 0px;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}
.tableheader2bottom {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CCCCCC;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #FFFFFF;
	text-align: right;
	padding-right: 10px;
	margin: 0px;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}
.tableheaderbottom {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CCCCCC;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #FFFFFF;
	font-size: 10px;
	margin: 0px;
	padding: 5px;
}
.smalltextbutton {
	font-size: 10px;
}
.ProgramTitles {
	color: #000066;
	font-weight: bold;
	background-color: #E4E8F3;
	display: block;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #999999;
	border-bottom-color: #CCCCCC;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 5px;
	margin-left: 0px;
}
.ProgramTitles h4 {
	margin: 0px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	padding: 2px;
	font-size: 12px;
}
.tableformat p {
	padding: 5px;
}
.formFormat {
	background-color: #FFFFFF;
	border: 1px solid #CCCCCC;
}
.smallHeader {
	padding-left:75px;
}
-->
</style>
</HEAD>
<BODY>
<DIV id=container>
<div class="smallHeader"><h1>SEAHO 2010 Programs</h2></div>
  <DIV id=content>
    
<table width="500" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>      <h4>Search Programs </h4>          </td>
  </tr>
  <tr>
    <td><form name="form2" method="post" action="../programs/search/session.php">
      <select name="search" class="smalltextbutton" id="label">
        <option selected>Select Session</option>
        <option value="Pre">Pre</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
      </select>
      <input name="Submit" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
  <tr>
    <td><form name="form3" method="post" action="../programs/search/topic.php">
      <select name="search" class="smalltextbutton" id="search">
        <option value="N/A" selected>Select Topic</option>
        <option value="Academic Initiatives and Partnerships">Academic Initiatives and Partnerships</option>
        <option value="Assessment and Benchmarking">Assessment and Benchmarking</option>
        <option value="Conference, Apartments, Family Housing">Conference, Apartments, Family Housing</option>
        <option value="Facilities, Purchasing, Construction and Renovation">Facilities, Purchasing, Construction and Renovation</option>
        <option value="PPP track- Pre-Professional Preparation">PPP track- Pre-Professional Preparation</option>
        <option value="Programming and Leadership Development">Programming and Leadership Development</option>
        <option value="Social and Personal Issues">Social and Personal Issues</option>
        <option value="Staff Supervision and Development">Staff Supervision and Development</option>
        <option value="Technology, Legal Issues, Administration and Business Operations">Technology, Legal Issues, Administration and Business Operations</option>
      </select>
      <input name="Submit2" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
  <tr>
    <td><form name="form4" method="post" action="../programs/search/title.php">
      <input name="search" type="text" class="smalltextbutton" id="search" value="Enter Title" size="45">
      <input name="Submit3" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
  <tr>
    <td><form name="form5" method="post" action="../programs/search/presenter.php">
      <input name="search" type="text" class="smalltextbutton" id="search" value="Enter Presenter Last Name" size="45">
      <input name="Submit4" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
</table></P>
<h2>  <?php if(!isset($_POST['search'])) { echo "All Programs"; } else { echo "Search Results for ".$_POST['search']." ";}?>
</h2>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableformat">
  <tr>
    <td width="51%" class="tableheader">&nbsp;
Programs <?php echo ($startRow_rsProgramList + 1) ?> to <?php echo min($startRow_rsProgramList + $maxRows_rsProgramList, $totalRows_rsProgramList) ?> of <?php echo $totalRows_rsProgramList ?> </td>
    <td width="49%" class="tableheader2">
        <?php if ($pageNum_rsProgramList > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsProgramList=%d%s", $currentPage, max(0, $pageNum_rsProgramList - 1), $queryString_rsProgramList); ?>">&laquo;&laquo;&nbsp;Previous</a>
          <?php } // Show if not first page ?>&nbsp;&nbsp;
<?php if ($pageNum_rsProgramList < $totalPages_rsProgramList) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_rsProgramList=%d%s", $currentPage, min($totalPages_rsProgramList, $pageNum_rsProgramList + 1), $queryString_rsProgramList); ?>">Next&nbsp;&raquo;&raquo;</a>
  <?php } // Show if not last page ?>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
        <td colspan="2" bgcolor="#FFFFFF"><span class="ProgramTitles"><h4><?php echo $row_rsProgramList['ProgramTitle']; ?></h4>
        </span> <strong>&nbsp;Presenter:</strong> <?php echo $row_rsProgramList['FirstName']; ?>&nbsp;<?php echo $row_rsProgramList['LastName']; ?>
        <p><strong>Description:</strong><br>
          <?php echo substr(($row_rsProgramList['ProgramDescription']),0,200); ?> . . .</p>
            <p>[ <a href="../programs/programdetails.php?recordID=<?php echo $row_rsProgramList['id']; ?>">Full Description</a> ]</p>          </td>
    </tr>
    <?php } while ($row_rsProgramList = mysql_fetch_assoc($rsProgramList)); ?>
  
  <tr>
    <td width="51%" class="tableheaderbottom">Programs <?php echo ($startRow_rsProgramList + 1) ?> to <?php echo min($startRow_rsProgramList + $maxRows_rsProgramList, $totalRows_rsProgramList) ?> of <?php echo $totalRows_rsProgramList ?> </td>
    <td width="49%" class="tableheader2bottom">
        <?php if ($pageNum_rsProgramList > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsProgramList=%d%s", $currentPage, max(0, $pageNum_rsProgramList - 1), $queryString_rsProgramList); ?>">&laquo;&laquo;&nbsp;Previous</a>
          <?php } // Show if not first page ?>&nbsp;&nbsp;
<?php if ($pageNum_rsProgramList < $totalPages_rsProgramList) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_rsProgramList=%d%s", $currentPage, min($totalPages_rsProgramList, $pageNum_rsProgramList + 1), $queryString_rsProgramList); ?>">Next&nbsp;&raquo;&raquo;</a>
  <?php } // Show if not last page ?>&nbsp;</td>
  </tr>
</table>
<BR>
</P>
<HR>

<P class=footer>&nbsp;</P>
</DIV>
</DIV>
</BODY></HTML>
<?php
mysql_free_result($rsProgramList);
?>
