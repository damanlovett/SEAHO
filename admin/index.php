<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DBDBDB";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?>
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
?>
<?php require_once('includefiles/init.php'); ?>

<?php

$maxRows_rsVotes = 5;
$pageNum_rsVotes = 0;
if (isset($_GET['pageNum_rsVotes'])) {
  $pageNum_rsVotes = $_GET['pageNum_rsVotes'];
}
$startRow_rsVotes = $pageNum_rsVotes * $maxRows_rsVotes;

mysql_select_db($database_Directory, $Directory);
$query_rsVotes = "SELECT id, `description`, attachment, ballot_id, title, due_date, `close`, vote_ballot.`delete` FROM vote_ballot WHERE vote_ballot.`delete`=0 ORDER BY due_date ASC";
$query_limit_rsVotes = sprintf("%s LIMIT %d, %d", $query_rsVotes, $startRow_rsVotes, $maxRows_rsVotes);
$rsVotes = mysql_query($query_limit_rsVotes, $Directory) or die(mysql_error());
$row_rsVotes = mysql_fetch_assoc($rsVotes);

if (isset($_GET['totalRows_rsVotes'])) {
  $totalRows_rsVotes = $_GET['totalRows_rsVotes'];
} else {
  $all_rsVotes = mysql_query($query_rsVotes);
  $totalRows_rsVotes = mysql_num_rows($all_rsVotes);
}
$totalPages_rsVotes = ceil($totalRows_rsVotes/$maxRows_rsVotes)-1;

$maxRows_rsVisitors = 5;
$pageNum_rsVisitors = 0;
if (isset($_GET['pageNum_rsVisitors'])) {
  $pageNum_rsVisitors = $_GET['pageNum_rsVisitors'];
}
$startRow_rsVisitors = $pageNum_rsVisitors * $maxRows_rsVisitors;

mysql_select_db($database_Directory, $Directory);
$query_rsVisitors = "SELECT name, user_id, DATE_FORMAT(time_stamp,'%m/%d/%Y  %r') AS time_stamp, audit_report.page FROM audit_report WHERE audit_report.page='/admin/index.php' AND name !='Eddie Lovett' ORDER BY audit_report.time_stamp DESC";
$query_limit_rsVisitors = sprintf("%s LIMIT %d, %d", $query_rsVisitors, $startRow_rsVisitors, $maxRows_rsVisitors);
$rsVisitors = mysql_query($query_limit_rsVisitors, $Directory) or die(mysql_error());
$row_rsVisitors = mysql_fetch_assoc($rsVisitors);

if (isset($_GET['totalRows_rsVisitors'])) {
  $totalRows_rsVisitors = $_GET['totalRows_rsVisitors'];
} else {
  $all_rsVisitors = mysql_query($query_rsVisitors);
  $totalRows_rsVisitors = mysql_num_rows($all_rsVisitors);
}
$totalPages_rsVisitors = ceil($totalRows_rsVisitors/$maxRows_rsVisitors)-1;

$colname_rsUserInfo = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUserInfo = $_SESSION['userID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsUserInfo = sprintf("SELECT * FROM users WHERE user_id = %s", GetSQLValueString($colname_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $Directory) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>LCCM Home Page</title>
<link href="styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="styles/table.css" rel="stylesheet" type="text/css" />
<link href="styles/navLeft.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body>
<div id="header"><?php require_once('includefiles/userInfo.php'); ?></div>
<div id="mainContentHome">
  <div id="mainText">
  	<br />
  	<div id="pageInformationHome">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><div align="center" class="homeAdminBox"><a href="voting/index.php"><img src="images/AdminHomevoting.png" alt="Voting" width="83" height="85" /></a><br />
              <br />
              <a href="voting/index.php">Voting Central</a></div></td>
          <td valign="top"><div align="center" class="homeAdminBox"><a href="state/index.php"><img src="images/AdminHomestate.png" alt="State" width="83" height="85" /></a><br />
              <br />
              <a href="state/index.php">State Reports</a></div></td>
          <td valign="top"><div align="center" class="homeAdminBox"><a href="committees/index.php"><img src="images/AdminHomecommittee.png" alt="Committee" width="83" height="85" /></a><br />
              <br />
              <a href="committees/index.php">Committee Pages</a></div></td>
          <td valign="top"><div align="center" class="homeAdminBox"><a href="myprofile/index.php"><img src="images/AdminHomemyprofile.png" alt="User" width="83" height="85" /></a><br />
              <br />
              <a href="myprofile/index.php">My Profile</a></div></td>
          <td valign="top">
<?php if(($_SESSION['access']) == 1 OR ($_SESSION['access'])== 2) {?>
<div align="center" class="homeAdminBox"><a href="users/index.php"><img src="images/imgHeaderAdminHome.png" alt="User" width="88" height="68" /></a><br />
              <br />
              <a href="users/index.php">Administration</a></div>
<?php } else {?>
<strong class="commenttext">PROFILE INFORMATION</strong><br />
<?php echo $_SESSION['display_name']; ?><br />
<?php echo $row_rsUserInfo['title']; ?><br />
<?php echo $row_rsUserInfo['school']; ?><br />
<?php echo $row_rsUserInfo['address']; ?><br />
<?php echo $row_rsUserInfo['city']; ?>, <?php echo $row_rsUserInfo['state']; ?><br />
<?php echo $row_rsUserInfo['zip']; ?><br />
<?php if($_SESSION['votes'] == 1) {echo "SEAHO Voting Member";}?>
<?php }?>              </td>
        </tr>

        <tr valign="top">
          <td colspan="3">&nbsp;</td>
          <td colspan="2"></td>
        </tr>
        <tr valign="top">
          <td colspan="5" bgcolor="#000099">&nbsp;</td>
        </tr>
        <tr valign="top">
          <td colspan="3">&nbsp;</td>
          <td colspan="2"></td>
        </tr>
        <tr valign="top">
          <td colspan="3"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr class="tableTop">
              <td colspan="5"><span class="style1">Recent Ballots - last 5</span></td>
            </tr>
            <tr>
              <th>Vote</th>
              <th>&nbsp;</th>
              <th>Due Date</th>
              <th>&nbsp;</th>
              <th>Status</th>
            </tr>
            <?php do { ?>
              <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
                <td><a href="voting/details.php?recordID=<?php echo $row_rsVotes['ballot_id']; ?>"><?php echo substr($row_rsVotes['title'],0,20); ?></a></td>
                <td>&nbsp;</td>
                <td><?php echo formatDate($row_rsVotes['due_date'],"M d, Y"); ?></td>
                <td>&nbsp;</td>
                <td><?php echo OnOffSwitch($row_rsVotes['close'],"------","Passed","Failed","Tabled"); ?></td>
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
              <?php } while ($row_rsVotes = mysql_fetch_assoc($rsVotes)); ?>
            <tr class="tableBottom">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
           </p></td>
          <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr class="tableTop">
              <td colspan="3"><span class="style1">Recent Visitors - last 5</span></td>
            </tr>
            <tr>
              <th>User</th>
              <th>&nbsp;</th>
              <th>Date/Time</th>
            </tr>
            <?php do { ?>
              <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
                <td><?php echo $row_rsVisitors['name']; ?></td>
                <td>&nbsp;</td>
                <td><?php echo $row_rsVisitors['time_stamp']; ?></td>
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
              <?php } while ($row_rsVisitors = mysql_fetch_assoc($rsVisitors)); ?>
            <tr class="tableBottom">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="top">
          <td colspan="5" bgcolor="#DBDBDB">&nbsp;</td>
        </tr>
      </table>
      <div class="cleartable">&nbsp;</div>
    </div>
  </div>
</div>
<div id="footer"><?php require_once('includefiles/footer.php'); ?>
</div>
</body>
</html>
<?php
mysql_free_result($rsVotes);

mysql_free_result($rsVisitors);

mysql_free_result($rsUserInfo);
?>
