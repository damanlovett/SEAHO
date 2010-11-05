<?php require_once('../../Connections/Programming.php'); ?>
<?php
//WA Database Search Include
require_once("../../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAcallforprograms;
//Searchpage: callforprograms_Search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_GET["Search_x"]) && $_GET["Search_x"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("ProgramTitle","S_ProgramTitle","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ProgramNumber","S_ProgramNumber","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("session","S_session","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("location","S_location","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_callforprograms_Results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_callforprograms_Results"]) && $_SESSION["WADbSearch1_callforprograms_Results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_callforprograms_Results"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
?>
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
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_WADAcallforprograms = 5;
$pageNum_WADAcallforprograms = 0;
if (isset($_GET['pageNum_WADAcallforprograms'])) {
  $pageNum_WADAcallforprograms = $_GET['pageNum_WADAcallforprograms'];
}
$startRow_WADAcallforprograms = $pageNum_WADAcallforprograms * $maxRows_WADAcallforprograms;

mysql_select_db($database_Programming, $Programming);
$query_WADAcallforprograms = "SELECT ProgramTitle, id, ProgramNumber, session, location, programTime, FirstName, LastName, MiddleInitial, Title, Institution, Address, City, State, Zip FROM callforprograms";
setQueryBuilderSource($query_WADAcallforprograms,$WADbSearch1,false);
$query_limit_WADAcallforprograms = sprintf("%s LIMIT %d, %d", $query_WADAcallforprograms, $startRow_WADAcallforprograms, $maxRows_WADAcallforprograms);
$WADAcallforprograms = mysql_query($query_limit_WADAcallforprograms, $Programming) or die(mysql_error());
$row_WADAcallforprograms = mysql_fetch_assoc($WADAcallforprograms);

if (isset($_GET['totalRows_WADAcallforprograms'])) {
  $totalRows_WADAcallforprograms = $_GET['totalRows_WADAcallforprograms'];
} else {
  $all_WADAcallforprograms = mysql_query($query_WADAcallforprograms);
  $totalRows_WADAcallforprograms = mysql_num_rows($all_WADAcallforprograms);
}
$totalPages_WADAcallforprograms = ceil($totalRows_WADAcallforprograms/$maxRows_WADAcallforprograms)-1;
?>
<?php
$queryString_WADAcallforprograms = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAcallforprograms") == false && 
        stristr($param, "totalRows_WADAcallforprograms") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAcallforprograms = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAcallforprograms = sprintf("&totalRows_WADAcallforprograms=%d%s", $totalRows_WADAcallforprograms, $queryString_WADAcallforprograms);
?>
<?php
//WA AltClass Iterator
class WA_AltClassIterator     {
  var $DisplayIndex;
  var $DisplayArray;
  
  function WA_AltClassIterator($theDisplayArray = array(1)) {
    $this->ClassCounter = 0;
    $this->ClassArray   = $theDisplayArray;
  }
  
  function getClass($incrementClass)  {
    if (sizeof($this->ClassArray) == 0) return "";
  	if ($incrementClass) {
      if ($this->ClassCounter >= sizeof($this->ClassArray)) $this->ClassCounter = 0;
      $this->ClassCounter++;
    }
    if ($this->ClassCounter > 0)
      return $this->ClassArray[$this->ClassCounter-1];
    else
      return $this->ClassArray[0];
  }
}
?><?php
//WA Alternating Class
$WARRT_AltClass1 = new WA_AltClassIterator(explode("|", "WADAResultsRowDark|"));
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Results callforprograms</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/* Title Section */
#WADAPageTitleArea {
	width: 555px;
}
#WADAPageTitleArea div, #WADAPageTitleArea p {
	font-size: 11px;
	padding-bottom: 10px;
}
#WADAPageTitleArea div#WADAPageTitle, #WADAPageTitle {
	font-size: 14px;
	font-weight: bold;
}

.WADAResultsNavigation {
	padding-top: 5px;
	padding-bottom: 10px;
}
.WADAResultsCount {
	font-size: 11px;
}
.WADAResultsNavTop, .WADAResultsInsertButton {
	clear: none;
}
.WADAResultsNavTop {
	width: 60%;
	float: left;
}
.WADAResultsInsertButton {
	width: 30%;
	float: right;
	text-align: right;
}
.WADAResultsNavButtonCell, .WADAResultsInsertButton {
	padding: 2px;
}
.WADAResultsTable {
	font-size: 11px;
	clear: both;
	padding-top: 1px;
	padding-bottom: 1px;
}

.WADAResultsTableHeader, .WADAResultsTableCell {
	padding: 3px;
	text-align: left;
}

.WADAResultsTableHeader {
	padding-left: 12px;
	padding-right: 12px;
}

.WADAResultsTableCell {
	padding-left: 14px;
	padding-right: 14px;
}

.WADAResultsTableCell {
	border-left: 1px solid #BABDC2;
}

.WADAResultsEditButtons {
	border-left: 1px solid #BABDC2;
	border-right: 1px solid #BABDC2;
}

.WADAResultsRowDark {
	background-color: #DFE4E9;
}
</style>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Reviewer Manager Test<!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr valign="baseline">
            <td nowrap align="right"><strong>Program</strong></td>
            <td><select name="programID">
                <?php 
do {  
?>
                <option value="<?php echo $row_rsProgramsList['topic_area']?>" ><?php echo substr($row_rsProgramsList['topic_area'],0,30)?> ... </option>
                <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
              </select>
            </td>
            <td>&nbsp;</td>
            <td><strong>Reviewer</strong></td>
            <td><select name="userID">
                <option>--------</option>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Assign" /></td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap><div align="left"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="reviewID" />
      </form>
    </div>
    <table width="400" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="7" class="tableTop">&nbsp;Reviewers:  &nbsp;&nbsp;Programs: </td>
      </tr>
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>Reviews</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Read</th>
        <th>&nbsp;</th>
        <th>Votes</th>
      </tr>
      <tr  class="tableRowColor">
        <td nowrap="nowrap"><a href="#">, </a><a href="#"></a> </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td nowrap="nowrap"></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td nowrap="nowrap"></td>
      </tr>
      <tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    
    
    <div class="WADAResultsContainer"> <a name="top"></a>
        <div id="WADAPageTitleArea">
          <div id="WADAPageTitle">Page Title</div>
        </div>
      <div class="WADASearchContainer">
          <form action="callforprograms_Results.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" method="get" name="WADASearchForm" id="WADASearchForm">
            <div class="WADAHeader">Search</div>
            <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
            <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <th class="WADADataTableHeader">ProgramTitle:</th>
                <td class="WADADataTableCell"><input type="text" name="S_ProgramTitle" id="S_ProgramTitle" value="" size="32" /></td>
              </tr>
              <tr>
                <th class="WADADataTableHeader">ProgramNumber:</th>
                <td class="WADADataTableCell"><input type="text" name="S_ProgramNumber" id="S_ProgramNumber" value="" size="32" /></td>
              </tr>
              <tr>
                <th class="WADADataTableHeader">session:</th>
                <td class="WADADataTableCell"><input type="text" name="S_session" id="S_session" value="" size="32" /></td>
              </tr>
              <tr>
                <th class="WADADataTableHeader">location:</th>
                <td class="WADADataTableCell"><input type="text" name="S_location" id="S_location" value="" size="32" /></td>
              </tr>
            </table>
            <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
            <div class="WADAButtonRow">
              <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Search" id="Search" value="Search" alt="Search" src="../../WA_DataAssist/images/Pacifica/Refined_search.gif"  /></td>
                </tr>
              </table>
            </div>
          </form>
      </div>
      <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <?php if ($totalRows_WADAcallforprograms > 0) { // Show if recordset not empty ?>
          <div class="WADAResults">
            <div class="WADAResultsNavigation">
              <div class="WADAResultsCount">Records
                <?php echo ($startRow_WADAcallforprograms + 1) ?>
                to
                <?php echo min($startRow_WADAcallforprograms + $maxRows_WADAcallforprograms, $totalRows_WADAcallforprograms) ?>
                of
                <?php echo $totalRows_WADAcallforprograms ?>
              </div>
              <div class="WADAResultsNavTop">
                <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
                  <tr valign="middle">
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, 0, $queryString_WADAcallforprograms); ?>" title="First"><img border="0" name="First" id="First" alt="First" src="../../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
                    <?php } // Show if not first page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, max(0, $pageNum_WADAcallforprograms - 1), $queryString_WADAcallforprograms); ?>" title="Previous"><img border="0" name="Previous" id="Previous" alt="Previous" src="../../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
                    <?php } // Show if not first page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms < $totalPages_WADAcallforprograms) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, min($totalPages_WADAcallforprograms, $pageNum_WADAcallforprograms + 1), $queryString_WADAcallforprograms); ?>" title="Next"><img border="0" name="Next" id="Next" alt="Next" src="../../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
                    <?php } // Show if not last page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms < $totalPages_WADAcallforprograms) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, $totalPages_WADAcallforprograms, $queryString_WADAcallforprograms); ?>" title="Last"><img border="0" name="Last" id="Last" alt="Last" src="../../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
                    <?php } // Show if not last page ?></td>
                  </tr>
                </table>
              </div>
              <div class="WADAResultsInsertButton"> <a href="callforprograms_Insert.php" title="Insert"><img border="0" name="Insert" id="Insert" alt="Insert" src="../../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
            </div>
            <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th class="WADAResultsTableHeader">ProgramTitle:</th>
                <th class="WADAResultsTableHeader">id:</th>
                <th class="WADAResultsTableHeader">ProgramNumber:</th>
                <th class="WADAResultsTableHeader">session:</th>
                <th class="WADAResultsTableHeader">location:</th>
                <th class="WADAResultsTableHeader">programTime:</th>
                <th class="WADAResultsTableHeader">FirstName:</th>
                <th class="WADAResultsTableHeader">LastName:</th>
                <th class="WADAResultsTableHeader">MiddleInitial:</th>
                <th class="WADAResultsTableHeader">Title:</th>
                <th class="WADAResultsTableHeader">Institution:</th>
                <th class="WADAResultsTableHeader">Address:</th>
                <th class="WADAResultsTableHeader">City:</th>
                <th class="WADAResultsTableHeader">State:</th>
                <th class="WADAResultsTableHeader">Zip:</th>
                <th>&nbsp;</th>
              </tr>
              <?php do { ?>
                <tr class="<?php echo $WARRT_AltClass1->getClass(true); ?>">
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['ProgramTitle']); ?></td>
                  <td class="WADAResultsTableCell"><a href="callforprograms_Detail.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" ><?php echo($row_WADAcallforprograms['id']); ?></a></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['ProgramNumber']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['session']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['location']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['programTime']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['FirstName']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['LastName']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['MiddleInitial']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['Title']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['Institution']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['Address']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['City']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['State']); ?></td>
                  <td class="WADAResultsTableCell"><?php echo($row_WADAcallforprograms['Zip']); ?></td>
                  <td class="WADAResultsEditButtons" nowrap="nowrap"><table class="WADAEditButton_Table">
                    <tr>
                      <td><a href="callforprograms_Detail.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" title="View"><img border="0" name="View<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" id="View<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" alt="View" src="../../WA_DataAssist/images/Pacifica/Refined_zoom.gif" /></a></td>
                      <td><a href="callforprograms_Update.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" title="Update"><img border="0" name="Update<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" id="Update<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" alt="Update" src="../../WA_DataAssist/images/Pacifica/Refined_edit.gif" /></a></td>
                      <td><a href="callforprograms_Delete.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" title="Delete"><img border="0" name="Delete<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" id="Delete<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" alt="Delete" src="../../WA_DataAssist/images/Pacifica/Refined_trash.gif" /></a></td>
                    </tr>
                  </table></td>
                </tr>
              <?php } while ($row_WADAcallforprograms = mysql_fetch_assoc($WADAcallforprograms)); ?>
            </table>
            <div class="WADAResultsNavigation">
              <div class="WADAResultsCount">Records
                <?php echo ($startRow_WADAcallforprograms + 1) ?>
                to
                <?php echo min($startRow_WADAcallforprograms + $maxRows_WADAcallforprograms, $totalRows_WADAcallforprograms) ?>
                of
                <?php echo $totalRows_WADAcallforprograms ?>
              </div>
              <div class="WADAResultsNavBottom">
                <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
                  <tr valign="middle">
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, 0, $queryString_WADAcallforprograms); ?>" title="First"><img border="0" name="First1" id="First1" alt="First" src="../../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
                    <?php } // Show if not first page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, max(0, $pageNum_WADAcallforprograms - 1), $queryString_WADAcallforprograms); ?>" title="Previous"><img border="0" name="Previous1" id="Previous1" alt="Previous" src="../../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
                    <?php } // Show if not first page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms < $totalPages_WADAcallforprograms) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, min($totalPages_WADAcallforprograms, $pageNum_WADAcallforprograms + 1), $queryString_WADAcallforprograms); ?>" title="Next"><img border="0" name="Next1" id="Next1" alt="Next" src="../../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
                    <?php } // Show if not last page ?></td>
                    <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAcallforprograms < $totalPages_WADAcallforprograms) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_WADAcallforprograms=%d%s", $currentPage, $totalPages_WADAcallforprograms, $queryString_WADAcallforprograms); ?>" title="Last"><img border="0" name="Last1" id="Last1" alt="Last" src="../../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
                    <?php } // Show if not last page ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      <?php } // Show if recordset not empty ?>
        <?php if ($totalRows_WADAcallforprograms == 0) { // Show if recordset empty ?>
          <div class="WADANoResults">
            <div class="WADANoResultsMessage">No results for your search</div>
            <div> <a href="callforprograms_Insert.php" title="Insert"><img border="0" name="Insert1" id="Insert1" alt="Insert" src="../../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
          </div>
        <?php } // Show if recordset empty ?>
    </div>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($WADAcallforprograms);
?>
