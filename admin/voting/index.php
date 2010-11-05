<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsBallot = 10;
$pageNum_rsBallot = 0;
if (isset($_GET['pageNum_rsBallot'])) {
  $pageNum_rsBallot = $_GET['pageNum_rsBallot'];
}
$startRow_rsBallot = $pageNum_rsBallot * $maxRows_rsBallot;

if(isset($_POST['Submit'])) {

$title = $_POST['title'];
$sortby = $_POST['sortby'];

mysql_select_db($database_Directory, $Directory);
$query_rsBallot = "SELECT vote_ballot.id, vote_ballot.`description`, vote_ballot.close, vote_ballot.ballot_id, vote_ballot.title, DATE_FORMAT(vote_ballot.due_date,'%a, %M %d, %Y') AS due_date, DATE_FORMAT(vote_ballot.created_on,'%a, %M %d, %Y') AS created_date, vote_ballot.`delete` FROM vote_ballot WHERE vote_ballot.`delete` != 1 AND vote_ballot.title LIKE '%".$title."%' ORDER BY ".$sortby."";
$query_limit_rsBallot = sprintf("%s LIMIT %d, %d", $query_rsBallot, $startRow_rsBallot, $maxRows_rsBallot);
$rsBallot = mysql_query($query_limit_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);

} else {

mysql_select_db($database_Directory, $Directory);
$query_rsBallot = "SELECT vote_ballot.id, vote_ballot.`description`, vote_ballot.close, vote_ballot.ballot_id, vote_ballot.title, DATE_FORMAT(vote_ballot.due_date,'%a, %M %d, %Y') AS due_date, DATE_FORMAT(vote_ballot.created_on,'%a, %M %d, %Y') AS created_date, vote_ballot.`delete`, vote_ballot.due_date AS sort_date FROM vote_ballot WHERE vote_ballot.`delete` != 1 ORDER BY sort_date";
$query_limit_rsBallot = sprintf("%s LIMIT %d, %d", $query_rsBallot, $startRow_rsBallot, $maxRows_rsBallot);
$rsBallot = mysql_query($query_limit_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);

}

if (isset($_GET['totalRows_rsBallot'])) {
  $totalRows_rsBallot = $_GET['totalRows_rsBallot'];
} else {
  $all_rsBallot = mysql_query($query_rsBallot);
  $totalRows_rsBallot = mysql_num_rows($all_rsBallot);
}
$totalPages_rsBallot = ceil($totalRows_rsBallot/$maxRows_rsBallot)-1;

$queryString_rsBallot = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsBallot") == false && 
        stristr($param, "totalRows_rsBallot") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsBallot = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsBallot = sprintf("&totalRows_rsBallot=%d%s", $totalRows_rsBallot, $queryString_rsBallot);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Voting Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadVoting">Voting Central  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="search" id="search">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><label><strong>Search by </strong><input name="title" type="text" id="title" onFocus="if(this.value=='----- Title ----- ')this.value='';" value="----- Title ----- " size="40"/></label>            </td>
            <td>&nbsp;</td>
            <td nowrap="nowrap"><select name="sortby" id="sortby">
              <option value="vote_ballot.id">--- Sort by ---</option>
              <option value="vote_ballot.title">Report</option>
              <option value="vote_ballot.due_date">Due Date</option>
              <?php 
do {  
?>
              <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="Submit" type="submit" class="submitButton" id="Submit" value="Search" /></td>
            <td><label>
              <input name="Reset" type="button" class="submitButton" id="Reset" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Reset List" />
            </label></td>
          </tr>
        </table>
      </form>
    </div>
		<?php if ($totalRows_rsBallot == 0) { // Show if recordset empty ?>
<p class="commenttext">No Ballots  Founds!</p>
<?php } // Show if recordset empty ?>
	<?php if ($totalRows_rsBallot > 0) { // Show if recordset not empty ?>
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" nowrap="nowrap" class="tableTop"><?php echo ($startRow_rsBallot + 1) ?> to <?php echo min($startRow_rsBallot + $maxRows_rsBallot, $totalRows_rsBallot) ?> of <?php echo $totalRows_rsBallot ?> </td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td colspan="2" nowrap="nowrap" class="tableTop"><?php if ($pageNum_rsBallot > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsBallot=%d%s", $currentPage, max(0, $pageNum_rsBallot - 1), $queryString_rsBallot); ?>">Previous</a>
                    <?php } // Show if not first page ?>&nbsp;&nbsp;<?php if ($pageNum_rsBallot < $totalPages_rsBallot) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_rsBallot=%d%s", $currentPage, min($totalPages_rsBallot, $pageNum_rsBallot + 1), $queryString_rsBallot); ?>">Next</a>
        <?php } // Show if not last page ?></td>
      </tr>
      <tr>
        <th>Report </th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Description        </th>
        <th>&nbsp;</th>
        <th>Status</th>
        <th>&nbsp;</th>
        <th>Created on</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Vote Due Date </th>
        <th><div align="center">&nbsp;</div></th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?> >
          <td nowrap="nowrap"><a href="details.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"><?php echo $row_rsBallot['title']; ?></a></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo substr($row_rsBallot['description'],0, 30).". . ."; ?></td>
          <td>&nbsp;</td>
          <td><?php echo OnOffSwitch($row_rsBallot['close'],"------","Passed","Failed","Tabled");?></td>
          <td>&nbsp;</td>
          <td><?php echo $row_rsBallot['created_date']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsBallot['due_date']; ?></td>
          <td nowrap="nowrap">&nbsp;</td>
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
        <?php } while ($row_rsBallot = mysql_fetch_assoc($rsBallot)); ?>
<tr>
        <td colspan="10" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
<?php } // Show if recordset not empty ?>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsBallot);
?>
