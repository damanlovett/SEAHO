<?php require_once('../../../Connections/Programming.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "review,admin,super";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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

$currentPage = $_SERVER["PHP_SELF"];

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

$SSAdv_colors1 = array("#CCCCCC","#FFFFFF");
$SSAdv_k1 = 0;
$SSAdv_m1 = 0;
$SSAdv_change_every1 = 1;

$colname_rsFavorites = "-1";
if (isset($_SESSION['userid'])) {
  $colname_rsFavorites = (get_magic_quotes_gpc()) ? $_SESSION['userid'] : addslashes($_SESSION['userid']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsFavorites = sprintf("SELECT `favorites`.`userid`, `favorites`.`programid`, `callforprograms`.`id`, `callforprograms`.`ProgramTitle`, `callforprograms`.`FirstName`, `callforprograms`.`LastName` FROM `callforprograms` , `favorites` WHERE `favorites`.`programid` =  `callforprograms`.`id` AND `favorites`.`userid` =  %s", GetSQLValueString($colname_rsFavorites, "int"));
$rsFavorites = mysql_query($query_rsFavorites, $Programming) or die(mysql_error());
$row_rsFavorites = mysql_fetch_assoc($rsFavorites);
$totalRows_rsFavorites = mysql_num_rows($rsFavorites);

$maxRows_rsProgramNames = 100;
$pageNum_rsProgramNames = 0;
if (isset($_GET['pageNum_rsProgramNames'])) {
  $pageNum_rsProgramNames = $_GET['pageNum_rsProgramNames'];
}
$startRow_rsProgramNames = $pageNum_rsProgramNames * $maxRows_rsProgramNames;

mysql_select_db($database_Programming, $Programming);
$query_rsProgramNames = "SELECT `favorites`.`programid`, `callforprograms`.`id`, `callforprograms`.`ProgramTitle`, `callforprograms`.`FirstName`, `callforprograms`.`LastName`, COUNT( * ) AS programname FROM `callforprograms` , `favorites` WHERE `callforprograms`.`id` = `favorites`.`programid` GROUP BY `callforprograms`.`id` ORDER BY programname DESC ";
$query_limit_rsProgramNames = sprintf("%s LIMIT %d, %d", $query_rsProgramNames, $startRow_rsProgramNames, $maxRows_rsProgramNames);
$rsProgramNames = mysql_query($query_limit_rsProgramNames, $Programming) or die(mysql_error());
$row_rsProgramNames = mysql_fetch_assoc($rsProgramNames);

if (isset($_GET['totalRows_rsProgramNames'])) {
  $totalRows_rsProgramNames = $_GET['totalRows_rsProgramNames'];
} else {
  $all_rsProgramNames = mysql_query($query_rsProgramNames);
  $totalRows_rsProgramNames = mysql_num_rows($all_rsProgramNames);
}
$totalPages_rsProgramNames = ceil($totalRows_rsProgramNames/$maxRows_rsProgramNames)-1;

$maxRows_rsProgramNames = 20;
$pageNum_rsProgramNames = 0;
if (isset($_GET['pageNum_rsProgramNames'])) {
  $pageNum_rsProgramNames = $_GET['pageNum_rsProgramNames'];
}
$startRow_rsProgramNames = $pageNum_rsProgramNames * $maxRows_rsProgramNames;

mysql_select_db($database_Programming, $Programming);
$query_rsProgramNames = "SELECT `favorites`.`programid`, `callforprograms`.`id`, `callforprograms`.`ProgramTitle`, `callforprograms`.`FirstName`, `callforprograms`.`LastName`, `callforprograms`.`Status`, COUNT( * ) AS programname FROM `callforprograms` , `favorites` WHERE `callforprograms`.`id` = `favorites`.`programid` GROUP BY `callforprograms`.`id` ORDER BY programname DESC ";

$query_limit_rsProgramNames = sprintf("%s LIMIT %d, %d", $query_rsProgramNames, $startRow_rsProgramNames, $maxRows_rsProgramNames);
$rsProgramNames = mysql_query($query_limit_rsProgramNames, $Programming) or die(mysql_error());
$row_rsProgramNames = mysql_fetch_assoc($rsProgramNames);

if (isset($_GET['totalRows_rsProgramNames'])) {
  $totalRows_rsProgramNames = $_GET['totalRows_rsProgramNames'];
} else {
  $all_rsProgramNames = mysql_query($query_rsProgramNames);
  $totalRows_rsProgramNames = mysql_num_rows($all_rsProgramNames);
}
$totalPages_rsProgramNames = ceil($totalRows_rsProgramNames/$maxRows_rsProgramNames)-1;

$queryString_rsProgramNames = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsProgramNames") == false && 
        stristr($param, "totalRows_rsProgramNames") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsProgramNames = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsProgramNames = sprintf("&totalRows_rsProgramNames=%d%s", $totalRows_rsProgramNames, $queryString_rsProgramNames);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Favorites Program</title>
<link href="../../stylesheet/mainstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="headerbar"></div>
<div class="topnav">
<?php require_once('../navigation/topnav.php'); ?>
</div>
<div class="mainbody">
  <div class="ltnav">
    <h2>Accepting Programs </h2>
  </div>
  <div class="maincontent">
    <p><strong>NOTE</strong>: The list below is only programs that at least have one vote by committee members. </p>
    <table width="70%" border="0" align="center" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3">&nbsp;
Records <?php echo ($startRow_rsProgramNames + 1) ?> to <?php echo min($startRow_rsProgramNames + $maxRows_rsProgramNames, $totalRows_rsProgramNames) ?> of <?php echo $totalRows_rsProgramNames ?> </td>
        <td>&nbsp;</td>
        <td><div align="right">
            <?php if ($pageNum_rsProgramNames > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsProgramNames=%d%s", $currentPage, max(0, $pageNum_rsProgramNames - 1), $queryString_rsProgramNames); ?>">Previous</a>&nbsp;&nbsp;
                    <?php } // Show if not first page ?>
              <?php if ($pageNum_rsProgramNames < $totalPages_rsProgramNames) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsProgramNames=%d%s", $currentPage, min($totalPages_rsProgramNames, $pageNum_rsProgramNames + 1), $queryString_rsProgramNames); ?>">Next</a>
        <?php } // Show if not last page ?> </div></td>
      </tr>
      <tr class="tableheader">
        <td nowrap="nowrap">Accept / Status </td>
        <td nowrap="nowrap"><div align="center">Program # </div></td>
        <td>Program Title</td>
        <td>Presenter</td>
        <td><div align="center"># of Votes </div></td>
      </tr>
        <?php do { ?>
          <tr bgcolor="<?php
if($SSAdv_m1%$SSAdv_change_every1==0 && $SSAdv_m1>0){
$SSAdv_k1++;
}
print $SSAdv_colors1[$SSAdv_k1%count($SSAdv_colors1)];
$SSAdv_m1++;
?>">
            <td><div align="center"><?php if (($row_rsProgramNames['ID']) > 294) {echo " <span class='subheading'>*  </span>";}?><a href="../status/statusdetails.php?recordID=<?php echo $row_rsProgramNames['id']; ?>"><img src="../../../images/LCCM/checkgrey.gif" alt="accept" width="14" height="14" border="0" /></a>&nbsp;&nbsp;
              
              <?php if (($row_rsProgramNames['Status'])== "Accepted") {echo " - <span class='subheading'>Yes</span>";} else {echo " - No";}?>
              
            </div></td>
            <td><div align="center"><?php echo $row_rsProgramNames['programid']; ?></div></td>
            <td><a href="../reviewing/review.php?recordID=<?php echo $row_rsProgramNames['programid']; ?>"><?php echo $row_rsProgramNames['ProgramTitle']; ?></a></td>
            <td><?php echo $row_rsProgramNames['FirstName']; ?> <?php echo $row_rsProgramNames['LastName']; ?></td>
            <td class="width10"><div align="center"><?php echo $row_rsProgramNames['programname']; ?></div></td>
          </tr>
          <?php } while ($row_rsProgramNames = mysql_fetch_assoc($rsProgramNames)); ?>
    </table>
  </div>
</div>
<div class="footer">
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</div>

</body>
</html>
<?php
mysql_free_result($rsProgramNames);

mysql_free_result($rsProgramNames);

mysql_free_result($rsFavorites);

mysql_free_result($rsProgramNames);
?>
