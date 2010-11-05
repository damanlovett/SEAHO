<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
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

$table = $_REQUEST['table'];

if ((isset($_GET['recordID'])) && ($_GET['recordID'] != "") && (isset($_GET['delete']))) {
  $deleteSQL = sprintf("UPDATE $table SET `deleted`= 1 WHERE id=%s",
                       GetSQLValueString($_GET['recordID'], "int"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($deleteSQL, $Programming) or die(mysql_error());
}
?>
<?php

mysql_select_db($database_Programming, $Programming);
$query_rsAudience = "SELECT audience.id, audience.audience FROM audience WHERE audience.deleted =0 ORDER BY audience.audience";
$rsAudience = mysql_query($query_rsAudience, $Programming) or die(mysql_error());
$row_rsAudience = mysql_fetch_assoc($rsAudience);
$totalRows_rsAudience = mysql_num_rows($rsAudience);

mysql_select_db($database_Programming, $Programming);
$query_rsSessionType = "SELECT session_type.id, session_type.session_type FROM session_type WHERE session_type.deleted =0 ORDER BY session_type.session_type";
$rsSessionType = mysql_query($query_rsSessionType, $Programming) or die(mysql_error());
$row_rsSessionType = mysql_fetch_assoc($rsSessionType);
$totalRows_rsSessionType = mysql_num_rows($rsSessionType);

mysql_select_db($database_Programming, $Programming);
$query_rsTopicArea = "SELECT topic_area.id, topic_area FROM topic_area WHERE topic_area.deleted =0 ORDER BY topic_area";
$rsTopicArea = mysql_query($query_rsTopicArea, $Programming) or die(mysql_error());
$row_rsTopicArea = mysql_fetch_assoc($rsTopicArea);
$totalRows_rsTopicArea = mysql_num_rows($rsTopicArea);

mysql_select_db($database_Programming, $Programming);
$query_rsExperience = "SELECT experience_level.id, experience_level.experience_level, experience_level.deleted FROM experience_level WHERE experience_level.deleted !=1";
$rsExperience = mysql_query($query_rsExperience, $Programming) or die(mysql_error());
$row_rsExperience = mysql_fetch_assoc($rsExperience);
$totalRows_rsExperience = mysql_num_rows($rsExperience);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "create_user")) {
NewMemberEmail($_POST['firstname'],$_POST['email'],$_POST['password']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Table Manager</title>
<script language="JavaScript" type="text/javascript" src="../../includefiles/make-popup.js"></script>
<script src="../../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<link href="../../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
    <h2><!-- InstanceBeginEditable name="PageTite" -->
<img src="../../images/LCCMPHtables.jpg" alt="Admin User" width="65" height="51" />Table Manager  <!-- InstanceEndEditable --></h2>
	<!-- InstanceBeginEditable name="SectionTitle" --><!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageInformation" -->
<div id="pageInformation">
  <ul>
    <li>Topic Area: <strong><?php echo $totalRows_rsTopicArea ?></strong> </li>
<li>Session Type: <strong><?php echo $totalRows_rsSessionType ?></strong> </li>
<li>Audience: <strong><?php echo $totalRows_rsAudience ?></strong> </li>
  </ul>
  </div>
	

	<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="PageText" -->
<p>&nbsp;</p>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Topic Area </li>
    <li class="TabbedPanelsTab" tabindex="0">Session Type</li>
    <li class="TabbedPanelsTab" tabindex="0">Audience</li>
    <li class="TabbedPanelsTab" tabindex="0">Experience Level</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <br />
    <table width="450" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" class="tableTop"><a name="topic" id="topic"></a><strong>TOPIC AREA TABLE</strong><label>
          <input name="Submit1" type="submit" id="Submit1" onclick="makePopup('insert.php?table=topic_area&label=Topic Area', 400, 400, 'scroll')" value="Add new" />
          <input name="Submit2" type="submit" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Refresh List" />
          </label>
        </td>
      </tr>
      <tr>
        <th>Item</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><?php echo $row_rsTopicArea['topic_area']; ?></td>
          <td>&nbsp;</td>
          <td><div align="right"><a href="index.php?recordID=<?php echo $row_rsTopicArea['id']; ?>&amp;delete=yes&amp;table=topic_area"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
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
        <?php } while ($row_rsTopicArea = mysql_fetch_assoc($rsTopicArea)); ?>
<tr>
        <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table></div>
    <div class="TabbedPanelsContent">
    <br />
    <table width="450" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="3" class="tableTop"><a name="session" id="session"></a><strong>SESSION TYPE TABLE</strong> 
          <input name="Submit3" type="submit" onclick="makePopup('insert.php?table=session_type&amp;label=Session Type', 400, 400, 'scroll')" value="Add new" />
          <input name="Submit4" type="submit" id="Submit4" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Refresh List" />
        </td>
      </tr>
      <tr>
        <th>Item</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><?php echo $row_rsSessionType['session_type']; ?></td>
          <td>&nbsp;</td>
          <td><div align="right"><a href="index.php?recordID=<?php echo $row_rsSessionType['id']; ?>&amp;delete=yes&amp;table=session_type"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
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
        <?php } while ($row_rsSessionType = mysql_fetch_assoc($rsSessionType)); ?>
<tr>
        <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table></div>
    <div class="TabbedPanelsContent"> <br />
        <table width="450" border="0" cellpadding="5" cellspacing="0" class="tableborder">
          <tr>
            <td colspan="3" class="tableTop"><a name="audience" id="audience"></a><strong>AUDIENCE TABLE</strong>
                <input name="Submit5" type="submit" id="Submit5" onclick="makePopup('insert.php?table=audience&amp;label=Audience', 400, 200, 'scroll')" value="Add new" />
                <input name="Submit6" type="submit" id="Submit6" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Refresh List" />
            </td>
          </tr>
          <tr>
            <th>Item</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <?php do { ?>
            <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
              <td nowrap="nowrap"><?php echo $row_rsAudience['audience']; ?></td>
              <td>&nbsp;</td>
              <td><div align="right"><a href="index.php?recordID=<?php echo $row_rsAudience['id']; ?>&amp;delete=yes&amp;table=audience"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
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
            <?php } while ($row_rsAudience = mysql_fetch_assoc($rsAudience)); ?>
          <tr>
            <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
          </tr>
        </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="450" border="0" cellpadding="5" cellspacing="0" class="tableborder">
        <tr>
          <td colspan="3" class="tableTop"><a name="audience" id="audience2"></a><strong>Experience Level</strong>
              <input name="Submit7" type="submit" id="Submit3" onclick="makePopup('insert.php?table=experience_level&amp;label=experience_level', 400, 200, 'scroll')" value="Add new" />
              <input name="Submit7" type="submit" id="Submit3" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Refresh List" />
          </td>
        </tr>
        <tr>
          <th>Item</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
        <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><?php echo $row_rsExperience['experience_level']; ?></td>
          <td>&nbsp;</td>
          <td><div align="right"><a href="index.php?recordID=<?php echo $row_rsExperience['id']; ?>&amp;delete=yes&amp;table=experience_level"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
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
        <?php } while ($row_rsExperience = mysql_fetch_assoc($rsExperience)); ?>
        <tr>
          <td colspan="3" nowrap="nowrap" class="tableBottom">&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
</div>
<br />
	
    <br />
    <br />

<br />
    <p class="cleartable">&nbsp;</p>
    <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1"); 
//-->
    </script>
	<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsAudience);

mysql_free_result($rsSessionType);

mysql_free_result($rsTopicArea);

mysql_free_result($rsExperience);
?>
