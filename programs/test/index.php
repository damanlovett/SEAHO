<?php require_once('../../Connections/Programming.php'); ?>
<?php 

// Sessions added to simulate login ----------------------------------

session_start();
$_SESSION['userID'] = 43;

// --------------------------------------------------------------------
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "assign")) {
  $insertSQL = sprintf("INSERT INTO reviewers (userID, programID) VALUES (%s, %s)",
                       GetSQLValueString($_POST['reviewer'], "text"),
                       GetSQLValueString($_POST['program'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
}

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = "SELECT callforprograms.id, callforprograms.ProgramTitle FROM callforprograms LIMIT 10";
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);

// Lovett was entered to limit results 
mysql_select_db($database_Programming, $Programming);
$query_rsReviewers = "SELECT * FROM login WHERE LastName = 'Lovett'";
$rsReviewers = mysql_query($query_rsReviewers, $Programming) or die(mysql_error());
$row_rsReviewers = mysql_fetch_assoc($rsReviewers);
$totalRows_rsReviewers = mysql_num_rows($rsReviewers);

$colname_rsProgramsReview = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsProgramsReview = (get_magic_quotes_gpc()) ? $_SESSION['userID'] : addslashes($_SESSION['userID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramsReview = sprintf("SELECT reviewID, userID, programID, `read`, vote, callforprograms.ProgramTitle, callforprograms.ProgramNumber, login.FirstName, login.LastName, reviewers.id FROM reviewers, callforprograms, login WHERE userID = %s AND login.id = userID AND reviewers.programID = callforprograms.id", GetSQLValueString($colname_rsProgramsReview, "text"));
$rsProgramsReview = mysql_query($query_rsProgramsReview, $Programming) or die(mysql_error());
$row_rsProgramsReview = mysql_fetch_assoc($rsProgramsReview);
$totalRows_rsProgramsReview = mysql_num_rows($rsProgramsReview);

mysql_select_db($database_Programming, $Programming);
$query_rsProgramsAssign = "SELECT callforprograms.id, callforprograms.ProgramTitle FROM callforprograms LIMIT 10";
$rsProgramsAssign = mysql_query($query_rsProgramsAssign, $Programming) or die(mysql_error());
$row_rsProgramsAssign = mysql_fetch_assoc($rsProgramsAssign);
$totalRows_rsProgramsAssign = mysql_num_rows($rsProgramsAssign);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<?php 

// Refresh was added to show read and unread

?>
<meta http-equiv="Refresh" content="30" />
<style type="text/css">
<!--
.unread {
	font-weight: bold;
}
.read {
	font-weight: normal;
}
-->
</style>
</head>

<body>
<p>Program list</p>
<p>&nbsp;</p>

<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>id</td>
    <td>ProgramTitle</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsPrograms['id']; ?></td>
      <td><?php echo $row_rsPrograms['ProgramTitle']; ?></td>
    </tr>
    <?php } while ($row_rsPrograms = mysql_fetch_assoc($rsPrograms)); ?>
</table>
<p>assign reviewers</p>
<form id="assign" name="assign" method="POST" action="<?php echo $editFormAction; ?>">
  <label>program
  <select name="program" id="program">
    <?php
do {  
?>
    <option value="<?php echo $row_rsProgramsAssign['id']?>"><?php echo $row_rsProgramsAssign['ProgramTitle']?></option>
    <?php
} while ($row_rsProgramsAssign = mysql_fetch_assoc($rsProgramsAssign));
  $rows = mysql_num_rows($rsProgramsAssign);
  if($rows > 0) {
      mysql_data_seek($rsProgramsAssign, 0);
	  $row_rsProgramsAssign = mysql_fetch_assoc($rsProgramsAssign);
  }
?>
  </select>
  </label>
  <label>reviewer
  <select name="reviewer" id="reviewer">
    <?php
do {  
?>
    <option value="<?php echo $row_rsReviewers['id']?>"><?php echo $row_rsReviewers['FirstName']?></option>
    <?php
} while ($row_rsReviewers = mysql_fetch_assoc($rsReviewers));
  $rows = mysql_num_rows($rsReviewers);
  if($rows > 0) {
      mysql_data_seek($rsReviewers, 0);
	  $row_rsReviewers = mysql_fetch_assoc($rsReviewers);
  }
?>
  </select>
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit" />
</label>
  <input type="hidden" name="MM_insert" value="assign">
</form>
<p>&nbsp;</p>
<p>see program for review  </p>
<p>&nbsp;</p>

<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td><a name="table" id="table"></a>ProgramTitle</td>
    <td>ProgramNumber</td>
    <td>FirstName</td>
    <td>LastName</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
  <tr <?php if($row_rsProgramsReview['read']==1){?>class="read"<?php } else {?> class="unread"<?php }?>>
    <td><a href="#table" onclick="MM_openBrWindow('detailspopup.php?reviewID=<?php echo $row_rsProgramsReview['id']; ?>&amp;programID=<?php echo $row_rsProgramsReview['programID']; ?>&amp;read=1','teds','width=400,height=400')"><?php echo $row_rsProgramsReview['ProgramTitle']; ?></a></td>
    <td><?php echo $row_rsProgramsReview['ProgramNumber']; ?></td>
    <td><?php echo $row_rsProgramsReview['FirstName']; ?></td>
    <td><?php echo $row_rsProgramsReview['LastName']; ?></td>
    <td><?php if($row_rsProgramsReview['read'] == 1){ echo "Read";} else { echo "<strong>UNREAD</strong>";}?></td>
  </tr>
  <?php } while ($row_rsProgramsReview = mysql_fetch_assoc($rsProgramsReview)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsPrograms);

mysql_free_result($rsReviewers);

mysql_free_result($rsProgramsReview);

mysql_free_result($rsProgramsAssign);
?>
