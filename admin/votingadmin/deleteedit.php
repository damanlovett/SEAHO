<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?

$colname_rsBallot = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsBallot = $_GET['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsBallot = sprintf("SELECT id, `description`, attachment, deletevote.ballot_id, deletevote.title, deletevote.due_date, deletevote.modified_on, deletevote.created_on, deletevote.`close`, deletevote.`delete` FROM deletevote WHERE ballot_id = %s", GetSQLValueString($colname_rsBallot, "text"));
$rsBallot = mysql_query($query_rsBallot, $Directory) or die(mysql_error());
$row_rsBallot = mysql_fetch_assoc($rsBallot);
$totalRows_rsBallot = mysql_num_rows($rsBallot);
?>
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
<script type="text/javascript" src="/admin/includefiles/calendarDateInput2.js">

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
            <td><strong>Due Date</strong><br /></td>
            <td><?php dateSelect(due_date, $row_rsBallot['due_date']);?>&nbsp;&nbsp;<?php timeSelect(due_date, $row_rsBallot['due_date']);?></td>
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
          
        <input type="hidden" name="MM_update" value="updateballot">
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
?>
