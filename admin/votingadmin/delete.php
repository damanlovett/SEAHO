<?php
// technocurve arc 3 php mv block1/3 start
$mocolor1 = "#FFFFFF";
$mocolor2 = "#EEEEEE";
$mocolor3 = "#DEDEDE";
$mocolor = $mocolor1;
// technocurve arc 3 php mv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?php 
#iKiosk Date Input
function dateSelect($name, $default) {
$iKioskDate = "<script>DateInput('".$name."', true, 'YYYY-MM-DD'";
if (!empty($default)) {$iKioskDate .= ", '".$default."'";}
$iKioskDate .= ")</script>";
echo $iKioskDate;
}

#iKiosk Time Input
function timeSelect($name, $default) {

if (empty($default)) {
	$min = date("i");
	if ($min <=15) {$min = "00";}
	if ($min >=16) {$min = "30";}
	$default = date("H").":".$min.":00";
	$default = strtotime($default);
	$default = timezoneProcess($default);
	$default = strtotime($default);
	$default = date("H:i:s", $default);
}
$iKioskTime = "<select name=\"".$name."\">";
$iKioskTime .= "<option value=\"00:00:00\" ";
if ($default == "00:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >12:00 AM</option>";
$iKioskTime .= "<option value=\"00:30:00\" ";
if ($default == "00:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >12:30 AM</option>";
$iKioskTime .= "<option value=\"01:00:00\" ";
if ($default == "01:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >1:00 AM</option>";
$iKioskTime .= "<option value=\"01:30:00\" ";
if ($default == "01:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >1:30 AM</option>";
$iKioskTime .= "<option value=\"02:00:00\" ";
if ($default == "02:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >2:00 AM</option>";
$iKioskTime .= "<option value=\"02:30:00\" ";
if ($default == "02:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >2:30 AM</option>";
$iKioskTime .= "<option value=\"03:00:00\" ";
if ($default == "03:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >3:00 AM</option>";
$iKioskTime .= "<option value=\"03:30:00\" ";
if ($default == "03:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >3:30 AM</option>";
$iKioskTime .= "<option value=\"04:00:00\" ";
if ($default == "04:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >4:00 AM</option>";
$iKioskTime .= "<option value=\"04:30:00\" ";
if ($default == "04:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >4:30 AM</option>";
$iKioskTime .= "<option value=\"05:00:00\" ";
if ($default == "05:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >5:00 AM</option>";
$iKioskTime .= "<option value=\"05:30:00\" ";
if ($default == "05:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >5:30 AM</option>";
$iKioskTime .= "<option value=\"06:00:00\" ";
if ($default == "06:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >6:00 AM</option>";
$iKioskTime .= "<option value=\"06:30:00\" ";
if ($default == "06:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >6:30 AM</option>";
$iKioskTime .= "<option value=\"07:00:00\" ";
if ($default == "07:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >7:00 AM</option>";
$iKioskTime .= "<option value=\"07:30:00\" ";
if ($default == "07:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >7:30 AM</option>";
$iKioskTime .= "<option value=\"08:00:00\" ";
if ($default == "08:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >8:00 AM</option>";
$iKioskTime .= "<option value=\"08:30:00\" ";
if ($default == "08:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >8:30 AM</option>";
$iKioskTime .= "<option value=\"09:00:00\" ";
if ($default == "09:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >9:00 AM</option>";
$iKioskTime .= "<option value=\"09:30:00\" ";
if ($default == "09:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >9:30 AM</option>";
$iKioskTime .= "<option value=\"10:00:00\" ";
if ($default == "10:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >10:00 AM</option>";
$iKioskTime .= "<option value=\"10:30:00\" ";
if ($default == "10:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >10:30 AM</option>";
$iKioskTime .= "<option value=\"11:00:00\" ";
if ($default == "11:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >11:00 AM</option>";
$iKioskTime .= "<option value=\"11:30:00\" ";
if ($default == "11:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >11:30 AM</option>";
$iKioskTime .= "<option value=\"12:00:00\" ";
if ($default == "12:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >12:00 PM</option>";
$iKioskTime .= "<option value=\"12:30:00\" ";
if ($default == "12:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >12:30 PM</option>";
$iKioskTime .= "<option value=\"13:00:00\" ";
if ($default == "13:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >1:00 PM</option>";
$iKioskTime .= "<option value=\"13:30:00\" ";
if ($default == "13:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >1:30 PM</option>";
$iKioskTime .= "<option value=\"14:00:00\" ";
if ($default == "14:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >2:00 PM</option>";
$iKioskTime .= "<option value=\"14:30:00\" ";
if ($default == "14:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >2:30 PM</option>";
$iKioskTime .= "<option value=\"15:00:00\" ";
if ($default == "15:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >3:00 PM</option>";
$iKioskTime .= "<option value=\"15:30:00\" ";
if ($default == "15:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >3:30 PM</option>";
$iKioskTime .= "<option value=\"16:00:00\" ";
if ($default == "16:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >4:00 PM</option>";
$iKioskTime .= "<option value=\"16:30:00\" ";
if ($default == "16:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >4:30 PM</option>";
$iKioskTime .= "<option value=\"17:00:00\" ";
if ($default == "17:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >5:00 PM</option>";
$iKioskTime .= "<option value=\"17:30:00\" ";
if ($default == "17:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >5:30 PM</option>";
$iKioskTime .= "<option value=\"18:00:00\" ";
if ($default == "18:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >6:00 PM</option>";
$iKioskTime .= "<option value=\"18:30:00\" ";
if ($default == "18:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >6:30 PM</option>";
$iKioskTime .= "<option value=\"19:00:00\" ";
if ($default == "19:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >7:00 PM</option>";
$iKioskTime .= "<option value=\"19:30:00\" ";
if ($default == "19:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >7:30 PM</option>";
$iKioskTime .= "<option value=\"20:00:00\" ";
if ($default == "20:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >8:00 PM</option>";
$iKioskTime .= "<option value=\"20:30:00\" ";
if ($default == "20:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >8:30 PM</option>";
$iKioskTime .= "<option value=\"21:00:00\" ";
if ($default == "21:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >9:00 PM</option>";
$iKioskTime .= "<option value=\"21:30:00\" ";
if ($default == "21:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >9:30 PM</option>";
$iKioskTime .= "<option value=\"22:00:00\" ";
if ($default == "22:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >10:00 PM</option>";
$iKioskTime .= "<option value=\"22:30:00\" ";
if ($default == "22:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >10:30 PM</option>";
$iKioskTime .= "<option value=\"23:00:00\" ";
if ($default == "23:00:00") {$iKioskTime .="selected";}
$iKioskTime .= " >11:00 PM</option>";
$iKioskTime .= "<option value=\"23:30:00\" ";
if ($default == "23:30:00") {$iKioskTime .="selected";}
$iKioskTime .= " >11:30 PM</option>";
$iKioskTime .= "</select>";
echo $iKioskTime ;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addballot")) {
  $insertSQL = sprintf("INSERT INTO vote_ballot (`description`, ballot_id, title, due_date, created_on) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['ballot_id'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['due_date'], "date"),
                       GetSQLValueString($_POST['created_on'], "date"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}

DeleteRecord(vote_ballot,ballot_id);

$maxRows_rsBallot = 20;
$pageNum_rsBallot = 0;
if (isset($_GET['pageNum_rsBallot'])) {
  $pageNum_rsBallot = $_GET['pageNum_rsBallot'];
}
$startRow_rsBallot = $pageNum_rsBallot * $maxRows_rsBallot;

mysql_select_db($database_Directory, $Directory);
$query_rsBallot = "SELECT vote_ballot.id, vote_ballot.`description`, vote_ballot.attachment, vote_ballot.ballot_id, vote_ballot.title, DATE_FORMAT(vote_ballot.modified_on,'%M %d, %Y %r') as mod_date, DATE_FORMAT(vote_ballot.created_on,'%M %d, %Y %r') as create_date, DATE_FORMAT(vote_ballot.due_date,'%a, %M %d, %Y') as due_date, vote_ballot.`close` FROM vote_ballot WHERE vote_ballot.`delete`!= 1";
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
<title>Voting Manager</title>
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
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadVoting">Voting Manager  </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div>
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Ballot List</li>
        
        <li class="TabbedPanelsTab" tabindex="0">Add Ballot</li>
      
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
            <br />
<table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr >
        <td colspan="6" class="tableTop">&nbsp;</td>
      </tr>
<tr>
        <th>Title</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Due Date </th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Created on</th>
        <th>Status&nbsp;</th>
        </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>  >
          <td nowrap="nowrap"><a href="edit.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"><img src="../../programs/images/imgAdminEdit.gif" alt="Edit" width="14" height="14" border="0" /></a><a href="index.php?delete=<?php echo $row_rsBallot['ballot_id']; ?>"><img src="../../programs/images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a><a href="upload.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"><img src="../images/imgAdminAttach.gif" alt="Attachment" width="16" height="16" border="0" /></a><a href="voters.php?recordID=<?php echo $row_rsBallot['ballot_id']; ?>"><img src="../images/imgSmallUser.gif" alt="Voters" width="20" height="20" border="0" /></a>&nbsp;&nbsp;<?php echo $row_rsBallot['title']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsBallot['due_date']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsBallot['create_date']; ?></td>
          <td nowrap="nowrap"><?php echo OnOffSwitch($row_rsBallot['close'],"------","Passed","Failed","Tabled");?></td>
          </tr>
        <?php 
// technocurve arc 3 php mv block3/3 start
if ($mocolor == $mocolor1) {
	$mocolor = $mocolor2;
} else {
	$mocolor = $mocolor1;
}
// technocurve arc 3 php mv block3/3 end
?>
<?php } while ($row_rsBallot = mysql_fetch_assoc($rsBallot)); ?>
<tr>
        <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
        </div>
        <div class="TabbedPanelsContent"><form id="addballot" name="addballot" method="POST" action="<?php echo $editFormAction; ?>">
	    <table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td><strong>Title</strong><br />
              <label>
              <input name="title" type="text" id="title" size="35" />
            </label></td>
            <td nowrap="nowrap"><strong>Due Date</strong><br />
              <label>
              <script>DateInput('due_date', true, 'YYYY-MM-DD')</script><?php /*?><input name="due_date" type="text" id="due_date" onFocus="if(this.value=='(yyyy-mm-dd)')this.value='';" value="(yyyy-mm-dd)"/><?php */?>
            </label></td>
            <td nowrap="nowrap"><?php dateSelect(due_date, $default);?>&nbsp;&nbsp;<?php timeSelect(due_date, $default);?></td>
          </tr>
          <tr>
            <td colspan="3"><strong>Description</strong><br />
              <label>
              <textarea name="description" cols="60" rows="5" id="description"></textarea>
            </label></td>
          </tr>
          <tr>
            <td><label>
              <input name="Submit" type="submit" class="submitButton" value="Add Ballot" />
              <input name="ballot_id" type="hidden" id="ballot_id" value="<?php echo create_guid();?>" />
              <input name="created_on" type="hidden" id="created_on" value="<?php echo date("Y-m-d H:i:s");?>" />
            </label></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
          <input type="hidden" name="MM_insert" value="addballot">
      </form></div>
      </div>
    </div>
    <p class="cleartable">&nbsp;</p>
    </div>
    <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
    </script>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsBallot);
?>
