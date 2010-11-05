<?php require_once('../../../Connections/Programming.php'); ?>
<?php require_once('../../includefiles/init.php'); ?>
<?php

$maxRows_rsLoginInfo = 10;
$pageNum_rsLoginInfo = 0;
if (isset($_GET['pageNum_rsLoginInfo'])) {
  $pageNum_rsLoginInfo = $_GET['pageNum_rsLoginInfo'];
}
$startRow_rsLoginInfo = $pageNum_rsLoginInfo * $maxRows_rsLoginInfo;

$colname_rsLoginInfo = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsLoginInfo = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsLoginInfo = sprintf("SELECT loginrecord.id, loginrecord.username, DATE_FORMAT(loginrecord.Timelog,'%%M %%d %%Y  at  %%r') AS timelog, users.first_name, users.last_name FROM loginrecord, users WHERE loginrecord.username = %s AND loginrecord.username = users.userID ORDER BY loginrecord.Timelog DESC", GetSQLValueString($colname_rsLoginInfo, "text"));
$query_limit_rsLoginInfo = sprintf("%s LIMIT %d, %d", $query_rsLoginInfo, $startRow_rsLoginInfo, $maxRows_rsLoginInfo);
$rsLoginInfo = mysql_query($query_limit_rsLoginInfo, $Programming) or die(mysql_error());
$row_rsLoginInfo = mysql_fetch_assoc($rsLoginInfo);

if (isset($_GET['totalRows_rsLoginInfo'])) {
  $totalRows_rsLoginInfo = $_GET['totalRows_rsLoginInfo'];
} else {
  $all_rsLoginInfo = mysql_query($query_rsLoginInfo);
  $totalRows_rsLoginInfo = mysql_num_rows($all_rsLoginInfo);
}
$totalPages_rsLoginInfo = ceil($totalRows_rsLoginInfo/$maxRows_rsLoginInfo)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Login Information</title>
<link href="../../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body><div class="detailspopup">
<?php if ($totalRows_rsLoginInfo > 0) { // Show if recordset not empty ?>
  
    <strong><?php echo strtoupper($row_rsLoginInfo['first_name']); ?> <?php echo strtoupper($row_rsLoginInfo['last_name']); ?></strong>
    <br />
    <br />
    <p>
      Last 10 Logins
      <ol>
        <?php do { ?>
        <li>
          <?php echo $row_rsLoginInfo['timelog']; ?>        </li>
        <?php } while ($row_rsLoginInfo = mysql_fetch_assoc($rsLoginInfo)); ?>
      </ol>
    </p>  <?php } // Show if recordset not empty ?>
       <?php if ($totalRows_rsLoginInfo == 0) { // Show if recordset empty ?>
       <p class="homepageTitles">There are no login records for this user.</p>
         <?php } // Show if recordset empty ?>
       <div class="cleartable"></div>
  </div>
</body>
</html>
<?php
mysql_free_result($rsLoginInfo);
?>
