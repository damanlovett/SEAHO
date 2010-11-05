<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updateballot")) {
  $updateSQL = sprintf("UPDATE vote_ballot SET `description`=%s, title=%s, due_date=%s, `close`=%s WHERE ballot_id=%s",
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['due_date'], "date"),
                       GetSQLValueString($_POST['close'], "int"),
                       GetSQLValueString($_POST['ballot_id'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}
?>
<?php
$maxRows_rsBallot = 20;
$pageNum_rsBallot = 0;
if (isset($_GET['pageNum_rsBallot'])) {
  $pageNum_rsBallot = $_GET['pageNum_rsBallot'];
}
$startRow_rsBallot = $pageNum_rsBallot * $maxRows_rsBallot;

$colname_rsBallot = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsBallot = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT id, `description`, attachment, ballot_id, title, due_date, modified_on, created_on, vote_ballot.`close` FROM vote_ballot WHERE ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$query_limit_rsBallot = sprintf("%s LIMIT %d, %d", $query_rsBallot, $startRow_rsBallot, $maxRows_rsBallot);
$rsBallot = mysql_query($query_limit_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);

if (isset($_GET['totalRows_rsBallot'])) {
  $totalRows_rsBallot = $_GET['totalRows_rsBallot'];
} else {
  $all_rsBallot = mysql_query($query_rsBallot);
  $totalRows_rsBallot = mysql_num_rows($all_rsBallot);
}
$totalPages_rsBallot = ceil($totalRows_rsBallot/$maxRows_rsBallot)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Update Ballot</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="/admin/includefiles/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadVoting">Update -  <?php echo $row_rsBallot['title']; ?></span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form action="<?php echo $editFormAction; ?>" id="updateballot" name="updateballot" method="POST">
	    <table border="0" cellspacing="0" cellpadding="5">
          <?php if (isset($_POST['Submit'])){?>
		  <tr>
            <td colspan="2"><label>
              <input name="Submit2" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
              <span class="commenttext">Ballot Updated</span> </label></td>
          </tr><?php }?>
          <tr>
            <td><strong>Title</strong><br />
              <label>
              <input name="title" type="text" id="title" value="<?php echo $row_rsBallot['title']; ?>" size="35" />
            </label></td>
            <td nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>Due Date</strong><br />
                <script>DateInput('due_date', true, 'YYYY-MM-DD','<?php echo $row_rsBallot['due_date']; ?>')</script></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Description</strong><br />
              <label>
              <textarea name="description" cols="60" rows="5" id="description"><?php echo $row_rsBallot['description']; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td><label><strong>Status<br />
              </strong>
              <select name="close" id="close">
                <option value="" <?php if (!(strcmp("", $row_rsBallot['close']))) {echo "selected=\"selected\"";} ?>>-------------</option>
                <option value="1" <?php if (!(strcmp(1, $row_rsBallot['close']))) {echo "selected=\"selected\"";} ?>>Passed</option>
                <option value="2" <?php if (!(strcmp(2, $row_rsBallot['close']))) {echo "selected=\"selected\"";} ?>>Failed</option>
                <option value="3" <?php if (!(strcmp(3, $row_rsBallot['close']))) {echo "selected=\"selected\"";} ?>>Tabled</option>
                </select>
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><label>
              <input type="submit" name="Submit" value="Update Ballot" />
              <input name="ballot_id" type="hidden" id="ballot_id" value="<?php echo $row_rsBallot['ballot_id']; ?>" />
            </label></td>
            <td><?php if (!isset($_POST['Submit'])){?>
<input name="Submit3" type="button" id="Submit3" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Cancel Update" />
<?php } ?></td>
          </tr>
        </table>
          
        <input type="hidden" name="MM_update" value="updateballot" />
      </form>
    </div>
    <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsBallot);

mysql_free_result($rsBallot);
?>
