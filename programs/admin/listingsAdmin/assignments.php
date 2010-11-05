<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../../Connections/Programming.php'); ?>
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
?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

if (isset($_GET['updateID'])) {
  $updateSQL = sprintf("UPDATE callforprograms SET Status=%s WHERE id=%s",
                       GetSQLValueString($_GET['status'], "text"),
                       GetSQLValueString($_GET['updateID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_Programming, $Programming);
$query_rsTopics = "SELECT id, TopicArea FROM callforprograms GROUP by TopicArea ORDER by TopicArea";
$rsTopics = mysql_query($query_rsTopics, $Programming) or die(mysql_error());
$row_rsTopics = mysql_fetch_assoc($rsTopics);
$totalRows_rsTopics = mysql_num_rows($rsTopics);

mysql_select_db($database_Programming, $Programming);
$query_rsTotalPrograms = "SELECT Count(id) AS total, Status FROM callforprograms GROUP by Status";
$rsTotalPrograms = mysql_query($query_rsTotalPrograms, $Programming) or die(mysql_error());
$row_rsTotalPrograms = mysql_fetch_assoc($rsTotalPrograms);
$totalRows_rsTotalPrograms = mysql_num_rows($rsTotalPrograms);

$maxRows_rsPrograms = 30;
$pageNum_rsPrograms = 0;
if (isset($_GET['pageNum_rsPrograms'])) {
  $pageNum_rsPrograms = $_GET['pageNum_rsPrograms'];
}
$startRow_rsPrograms = $pageNum_rsPrograms * $maxRows_rsPrograms;

$colname_rsPrograms = "-1";
if (isset($_POST['session'])) {
  $colname_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['session'] : addslashes($_POST['session']);
}
$colname2_rsPrograms = "-1";
if (isset($_POST['ProgramTitle'])) {
  $colname2_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['ProgramTitle'] : addslashes($_POST['ProgramTitle']);
}
$colname3_rsPrograms = "-1";
if (isset($_POST['FirstName'])) {
  $colname3_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['FirstName'] : addslashes($_POST['FirstName']);
}
$colname4_rsPrograms = "-1";
if (isset($_POST['LastName'])) {
  $colname4_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['LastName'] : addslashes($_POST['LastName']);
}
$colname5_rsPrograms = "-1";
if (isset($_POST['TopicArea'])) {
  $colname5_rsPrograms = (get_magic_quotes_gpc()) ? $_POST['TopicArea'] : addslashes($_POST['TopicArea']);
}
//$_POST['sortby'] = "ORDER BY ProgramTitle ASC";
if (isset($_POST['sortby'])) {
  $_POST['sortby'] = "ORDER BY ".$_POST['sortby'];
}


// Default recordset, start with regular recordset, if form submitted create complex sql
if(isset($_POST['Submit'])) {
mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.location, callforprograms.FirstName, callforprograms.LastName, callforprograms.EmailAddress, callforprograms.TopicArea, callforprograms.Status, callforprograms.moderated FROM callforprograms WHERE `session` = %s OR ProgramTitle LIKE CONCAT('%%', %s, '%%') OR FirstName LIKE CONCAT('%%', %s, '%%') OR LastName LIKE CONCAT('%%', %s, '%%') OR TopicArea = %s ".$_POST['sortby']."", 
	GetSQLValueString($colname_rsPrograms, "text"),
	GetSQLValueString($colname2_rsPrograms, "text"),
	GetSQLValueString($colname3_rsPrograms, "text"),
	GetSQLValueString($colname4_rsPrograms, "text"),
	GetSQLValueString($colname5_rsPrograms, "text"));
$query_limit_rsPrograms = sprintf("%s LIMIT %d, %d", $query_rsPrograms, $startRow_rsPrograms, $maxRows_rsPrograms);
$rsPrograms = mysql_query($query_limit_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);

} else {

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = sprintf("SELECT callforprograms.id, callforprograms.ProgramTitle, callforprograms.ProgramNumber, callforprograms.`session`, callforprograms.location, callforprograms.FirstName, callforprograms.LastName, callforprograms.EmailAddress, callforprograms.TopicArea, callforprograms.Status, callforprograms.moderated, COUNT(reviewers.programID) AS num_reviewers, reviewers.programID, reviewers.reviewID FROM callforprograms LEFT JOIN reviewers ON callforprograms.id = reviewers.programID GROUP by callforprograms.id");
$query_limit_rsPrograms = sprintf("%s LIMIT %d, %d", $query_rsPrograms, $startRow_rsPrograms, $maxRows_rsPrograms);
$rsPrograms = mysql_query($query_limit_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
}

if (isset($_GET['totalRows_rsPrograms'])) {
  $totalRows_rsPrograms = $_GET['totalRows_rsPrograms'];
} else {
  $all_rsPrograms = mysql_query($query_rsPrograms);
  $totalRows_rsPrograms = mysql_num_rows($all_rsPrograms);
}
$totalPages_rsPrograms = ceil($totalRows_rsPrograms/$maxRows_rsPrograms)-1;

$queryString_rsPrograms = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsPrograms") == false && 
        stristr($param, "totalRows_rsPrograms") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsPrograms = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsPrograms = sprintf("&totalRows_rsPrograms=%d%s", $totalRows_rsPrograms, $queryString_rsPrograms);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Program Listings</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
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
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/PHprograms.jpg" alt="programs" width="65" height="51" />Program Assignments <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --> <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
	<br />

      <hr/>
	<ul>
	  <li>
	    <form id="search" name="search" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	      <ul><li>
	        <select name="TopicArea" id="TopicArea">
	          <option value="">Select Topic Area</option>
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
	        <li> <br />
	          <br />
	          <input name="FirstName" type="text" id="FirstName" value="By First Name" onFocus="if(this.value=='By First Name')this.value='';"/>
	        </li>
	        <li>
	          <input name="LastName" type="text" id="LastName" value="By Last Name" onFocus="if(this.value=='By Last Name')this.value='';"/>
	          </li>
	        <li>
	          <input name="ProgramTitle" type="text" id="ProgramTitle" value="By Program Title" onFocus="if(this.value=='By Program Title')this.value='';"/>
	          </li>
	        <li>
	          <select name="session" id="session">
	            <option value="--------">Select Session</option>
	            <option value="Pre">Pre-Pro</option>
	            <option value="1">1</option>
	            <option value="2">2</option>
	            <option value="3">3</option>
	            <option value="4">4</option>
	            <option value="5">5</option>
	            <option value="6">6</option>
	            <option value="7">7</option>
	            </select>
	        </li>
	        <li>
	          <select name="sortby" id="sortby">
	            <option value="ProgramTitle">---- Sort By ----</option>
	            <option value="FirstName">First Name</option>
	            <option value="LastName">Last Name</option>
	            <option value="ProgramTitle">Program Title</option>
	            <option value="TopicArea">Topic Area</option>
	            <option value="session">Session</option>
	            </select>
</li>
	        </ul>
			<br />
			<input type="submit" name="Submit" value="Search" />
	      </form>
	  </li>
	  </ul>

</div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
	<?php if ($totalRows_rsPrograms > 0) { // Show if recordset not empty ?>
      <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
        <tr>
          <td colspan="12" class="tableTop"><input name="Submit2" type="button" onclick="MM_goToURL('parent','<?php echo $_SERVER['PHP_SELF'];?>');return document.MM_returnValue" value="Refresh List" /><?php if ($pageNum_rsPrograms > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsPrograms=%d%s", $currentPage, 0, $queryString_rsPrograms); ?>">First</a>
            <?php } // Show if not first page ?>
          &nbsp;<?php if ($pageNum_rsPrograms > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsPrograms=%d%s", $currentPage, max(0, $pageNum_rsPrograms - 1), $queryString_rsPrograms); ?>">Previous</a>
                <?php } // Show if not first page ?>
                &nbsp;<?php if ($pageNum_rsPrograms < $totalPages_rsPrograms) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsPrograms=%d%s", $currentPage, min($totalPages_rsPrograms, $pageNum_rsPrograms + 1), $queryString_rsPrograms); ?>">Next</a>
                <?php } // Show if not last page ?>
                &nbsp;<?php if ($pageNum_rsPrograms < $totalPages_rsPrograms) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsPrograms=%d%s", $currentPage, $totalPages_rsPrograms, $queryString_rsPrograms); ?>">Last</a>
                <?php } // Show if not last page ?></td>
          <td colspan="2" class="tableTop">&nbsp;</td>
          <td class="tableTop">&nbsp;
            <?php echo ($startRow_rsPrograms + 1) ?> to <?php echo min($startRow_rsPrograms + $maxRows_rsPrograms, $totalRows_rsPrograms) ?> of <?php echo $totalRows_rsPrograms ?></td>
        </tr>
        <tr>
          <th>&nbsp;</th>
          <th>Title</th>
          <th nowrap="nowrap">&nbsp;</th>
          <th nowrap="nowrap">#</th>
          <th nowrap="nowrap">&nbsp;</th>
          <th nowrap="nowrap">Session</th>
          <th nowrap="nowrap">&nbsp;</th>
          <th nowrap="nowrap">Moderated</th>
          <th nowrap="nowrap">&nbsp;</th>
          <th>Presenter</th>
          <th>&nbsp;</th>
          <th colspan="3">&nbsp;</th>
          <th>Status</th>
        </tr>
        <?php do { ?>
          <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> class="tableRowColor" >
            <td nowrap="nowrap"><div align="center"></div></td>
            <td nowrap="nowrap"><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsPrograms['id']; ?>','ProgramsDetails','location=yes,scrollbars=yes,width=500')"><?php echo substr($row_rsPrograms['ProgramTitle'],0,35)."..."; ?></a> </td>
            <td>&nbsp;</td>
            <td>
            <?php echo $row_rsPrograms['ProgramNumber']; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsPrograms['session']; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsPrograms['moderated']; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $row_rsPrograms['FirstName']; ?> <?php echo $row_rsPrograms['LastName']; ?></td>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td nowrap="nowrap"><?php echo $row_rsPrograms['Status']; ?> </td>
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
<?php } while ($row_rsPrograms = mysql_fetch_assoc($rsPrograms)); ?>
        <tr>
          <td colspan="15" nowrap="nowrap" class="tableBottom"><?php echo ($startRow_rsPrograms + 1) ?> to <?php echo min($startRow_rsPrograms + $maxRows_rsPrograms, $totalRows_rsPrograms) ?> of <?php echo $totalRows_rsPrograms ?> </td>
        </tr>
      </table>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsPrograms == 0) { // Show if recordset empty ?>
        <p class="homepageTitles">No Programs were found</p>
  <?php } // Show if recordset empty ?><!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsTopics);

mysql_free_result($rsTotalPrograms);

mysql_free_result($rsPrograms);
?>
