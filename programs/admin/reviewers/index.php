<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end

// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#EAEAEA";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if(isset($_GET['reset'])){
  $updateSQL = sprintf("UPDATE users SET `group`=NULL WHERE userID=%s",
                       GetSQLValueString($_GET['reset'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

//if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
//  $insertSQL = sprintf("INSERT INTO reviewers (id, reviewID, userID, programID) VALUES (%s, %s, %s, %s)",
//                       GetSQLValueString($_POST['id'], "int"),
//                       GetSQLValueString($_POST['reviewID'], "text"),
//                       GetSQLValueString($_POST['userID'], "text"),
//                       GetSQLValueString($_POST['programID'], "text"));
//
//  mysql_select_db($database_Programming, $Programming);
//  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());
//}

if ((isset($_GET['reset'])) && ($_GET['reset'] != "")) {
  $deleteSQL = sprintf("DELETE FROM reviewers WHERE reviewID=%s",
                       GetSQLValueString($_GET['reset'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($deleteSQL, $Programming) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $updateSQL = sprintf("UPDATE users SET `group`=%s WHERE userID=%s",
                       GetSQLValueString($_POST['programID'], "text"),
                       GetSQLValueString($_POST['userID'], "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($updateSQL, $Programming) or die(mysql_error());
}

?>
<?php
mysql_select_db($database_Programming, $Programming);
$query_rsReviewers = "SELECT reviewers.id, COUNT(reviewers.id) AS total, reviewers.reviewID, COUNT(reviewers.userID) AS r_users, reviewers.userID, reviewers.programID, reviewers.`read`, COUNT(reviewers.`read`) AS r_read, COUNT(reviewers.vote) AS r_vote, reviewers.vote, users.id, users.userID, users.first_name, users.last_name, users.email FROM reviewers, users WHERE reviewers.userID = users.userID GROUP BY reviewers.userID ORDER BY users.last_name";
$rsReviewers = mysql_query($query_rsReviewers, $Programming) or die(mysql_error());
$row_rsReviewers = mysql_fetch_assoc($rsReviewers);
$totalRows_rsReviewers = mysql_num_rows($rsReviewers);

mysql_select_db($database_Programming, $Programming);
$query_rsPrograms = "SELECT callforprograms.id, COUNT(callforprograms.ProgramTitle) AS total_review, callforprograms.ProgramTitle, callforprograms.Status FROM callforprograms WHERE callforprograms.Status = 'To Be Review' GROUP BY callforprograms.Status";
$rsPrograms = mysql_query($query_rsPrograms, $Programming) or die(mysql_error());
$row_rsPrograms = mysql_fetch_assoc($rsPrograms);
$totalRows_rsPrograms = mysql_num_rows($rsPrograms);

mysql_select_db($database_Programming, $Programming);
$query_rsProgramsList = "SELECT topic_area.id, topic_area.topic_area FROM topic_area WHERE topic_area.deleted =0 ORDER BY topic_area.topic_area";
$rsProgramsList = mysql_query($query_rsProgramsList, $Programming) or die(mysql_error());
$row_rsProgramsList = mysql_fetch_assoc($rsProgramsList);
$totalRows_rsProgramsList = mysql_num_rows($rsProgramsList);

mysql_select_db($database_Programming, $Programming);
$query_rsReviewerList = "SELECT userID, first_name, last_name, `group` FROM users WHERE users.`group` IS NULL ORDER BY last_name ASC";
$rsReviewerList = mysql_query($query_rsReviewerList, $Programming) or die(mysql_error());
$row_rsReviewerList = mysql_fetch_assoc($rsReviewerList);
$totalRows_rsReviewerList = mysql_num_rows($rsReviewerList);

mysql_select_db($database_Programming, $Programming);
$query_rsUsersReviews = "SELECT users.userID, users.first_name, users.last_name, users.`group` FROM users WHERE users.`group`IS NOT NULL ORDER BY users.last_name";
$rsUsersReviews = mysql_query($query_rsUsersReviews, $Programming) or die(mysql_error());
$row_rsUsersReviews = mysql_fetch_assoc($rsUsersReviews);
$totalRows_rsUsersReviews = mysql_num_rows($rsUsersReviews);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reviewer Manager</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
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
<style type="text/css">
<!--
.style1 {color: #000099}
-->
</style>
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
    <h2><!-- InstanceBeginEditable name="PageTite" --><img src="../../images/PHprogramsReview.jpg" alt="program review" width="65" height="51" />Reviewer Manager  <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
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
            </select>          </td>
          <td>&nbsp;</td>
          <td><strong>Reviewer</strong></td>
          <td><select name="userID">
		  <option>--------</option>
            <?php 
do {  
?>
            <option value="<?php echo $row_rsReviewerList['userID']?>" ><?php echo $row_rsReviewerList['last_name']?>, <?php echo $row_rsReviewerList['first_name']; ?></option>
            <?php
} while ($row_rsReviewerList = mysql_fetch_assoc($rsReviewerList));
?>
          </select></td>
        
          <td>&nbsp;</td>
          <td><input name="submit" type="submit" value="Assign" /></td>
        <tr valign="baseline">
          <td colspan="2" align="right" nowrap><div align="left"></div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="id" value="">
      <input type="hidden" name="reviewID" value="<?php echo create_guid();?>">
      <input type="hidden" name="MM_insert" value="form1">
    </form>
<strong>NOTE: Click on User to view/print reviews</strong></div>
	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
	<p>
	  <span class="homepageBlocks">
	  <?php if ($totalRows_rsUsersReviews == 0) { // Show if recordset empty ?>
	    No reviews have been assigned
	    <?php } // Show if recordset empty ?></span>	  </p>
	
      <?php if ($totalRows_rsUsersReviews > 0) { // Show if recordset not empty ?>
        <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
          <tr>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Reviewer</th>
            <th>group</th>
            <th>&nbsp;</th>
          </tr>
          <?php do { ?>
            <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
              <td><a href="#" onclick="MM_openBrWindow('details.php?recordID=<?php echo $row_rsUsersReviews['userID']; ?>','details','scrollbars=yes,width=400')"><img src="../../images/imgAdminView.gif" alt="Reviews" /><?php echo $row_rsUsersReviews['last_name']; ?>, <?php echo $row_rsUsersReviews['first_name']; ?></a></td>
              <td><?php if(!isset($row_rsUsersReviews['group'])){?>
                  <span class="style1"><strong>No Group has been assigned</strong></span>
                  <?php }else{?>
                  <?php echo $row_rsUsersReviews['group']; ?>
                  <?php }?>
              </td>
              <td><?php if(isset($row_rsUsersReviews['group'])){?>
                  <label>
                  <input name="Button" type="button" onclick="MM_goToURL('parent','index.php?reset=<?php echo $row_rsUsersReviews['userID']; ?>');return document.MM_returnValue" value="Reset" />
                  </label>
                  <?php }?></td>
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
            <?php } while ($row_rsUsersReviews = mysql_fetch_assoc($rsUsersReviews)); ?>
          <tr>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
          </tr>
      </table>
        <?php } // Show if recordset not empty ?><!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReviewers);

mysql_free_result($rsPrograms);

mysql_free_result($rsProgramsList);

mysql_free_result($rsReviewerList);

mysql_free_result($rsUsersReviews);
?>
