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

$colname_rsProgramList = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsProgramList = $_GET['recordID'];
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramList = sprintf("SELECT id, ProgramTitle, ProgramNumber, `session`, location, programTime, FirstName, LastName, Title, Institution, addName1, addTitle1, addInstitution1, addName2, addTitle2, addInstitution2, addName3, addTitle3, addInstitution3, SessionType, targetAudience1, targetAudience2, targetAudience3, targetAudience4, targetAudience5, targetAudience6, targetAudience7, TopicArea, LearningObj1, LearningObj2, LearningOjb3, ProgramDescription, OutlineOfPresentation, Status, callforprograms.moderated, callforprograms.target_audience FROM callforprograms WHERE id = %s AND callforprograms.Status = 'Accepted' ORDER BY ProgramTitle ASC", GetSQLValueString($colname_rsProgramList, "int"));
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
?><!DOCTYPE HTML> 
<html>
<HEAD>
<meta charset="UTF-8">
<TITLE>SEAHO | Program Details</TITLE>

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
.smallHeader {
	padding-left:75px;
}
.smalltextbutton {
	font-size: 10px;
}
.ProgramTitles {
	color: #000066;
	font-weight: bold;
	background-color: #E4E8F3;
	display: block;
	margin: 0px;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #999999;
	border-bottom-color: #CCCCCC;
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
.Listpadding {
	display: block;
}
.tableformat p {
	padding: 5px;
}
.Listcolumnpadding {
	display: block;
	width: 50%;
	float: left;
}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</HEAD>
<BODY>
<DIV id=container>
<div class="smallHeader"><h1>SEAHO Program Details</h2></div>
<DIV id=content>
<br />
<br />
<p>
  <label>
  <input name="Button" type="button" class="smalltextbutton" onClick="MM_goToURL('parent','../programs/programlist.php');return document.MM_returnValue" value="Back to Programlist">
  </label>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableformat">
  <?php do { ?>
    <tr>
        <td width="100%" colspan="2" bgcolor="#FFFFFF"><span class="ProgramTitles"><h4><?php echo $row_rsProgramList['ProgramTitle']; ?></h4></span>
          <p><strong>Presenter(s)</strong><br> 
            <?php echo $row_rsProgramList['FirstName']; ?> <?php echo $row_rsProgramList['LastName']; ?>&nbsp;<?php echo $row_rsProgramList['Institution']; ?><br>
            <span class="Listpadding"><?php echo $row_rsProgramList['addName1']; ?>&nbsp;<?php echo $row_rsProgramList['addInstitution1']; ?></span><span class="Listpadding"><?php echo $row_rsProgramList['addName2']; ?>&nbsp;<?php echo $row_rsProgramList['addInstitution2']; ?></span><span class="Listpadding"><?php echo $row_rsProgramList['addName3']; ?>&nbsp;<?php echo $row_rsProgramList['addInstitution3']; ?></span><br>
            <strong>Program Information</strong><br>
            <?php echo $row_rsProgramList['TopicArea']; ?><br>
            Program Number <?php echo $row_rsProgramList['ProgramNumber']; ?><br>
          Session <?php echo $row_rsProgramList['session']; ?> at 
          <?php echo $row_rsProgramList['programTime']; ?>, <?php echo $row_rsProgramList['location']; ?><br>
          <br>
          <strong>Audience(s): </strong><br>
          <?php echo $row_rsProgramList['target_audience']; ?></p>
          <br>
            <p><strong>Description</strong><br />
			<?php echo htmlspecialchars($row_rsProgramList['ProgramDescription'], ENT_QUOTES); ?></p>
            <p><strong>Learning Objectives</strong></p>
            <ul>
              <li><?php echo $row_rsProgramList['LearningObj1']; ?></li>
              <li><?php echo $row_rsProgramList['LearningObj2']; ?></li>
              <li><?php echo $row_rsProgramList['LearningOjb3']; ?></li>
            </ul>            
            <p><?php if($row_rsProgramList['moderated'] =="no") { ?>Request to [ <a href="#" onClick="MM_openBrWindow('../programs/moderator.php?recordID=<?php echo $row_rsProgramList['id']; ?>','ModerateProgram','width=400,height=400')">Moderate this Program</a> ] 
              <?php }?>
            </p>          </td>
    </tr>
    <?php } while ($row_rsProgramList = mysql_fetch_assoc($rsProgramList)); ?>
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
