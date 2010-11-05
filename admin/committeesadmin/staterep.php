<?php
// technocurve arc 3 php mv block1/3 start
$mocolor1 = "#FFFFFF";
$mocolor2 = "#DEDEDE";
$mocolor3 = "#EEEEEE";
$mocolor = $mocolor1;
// technocurve arc 3 php mv block1/3 end

// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#EEEEEE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>


<?php

// Unassign Member

if ((isset($_GET['recordID'])) && (isset($_GET['positionID']))){
  $clear = "";
  $updateSQL = sprintf("UPDATE team_positions SET user_id=NULL WHERE position_id=%s AND user_id=%s",
                       GetSQLValueString($_GET['positionID'], "text"),
                       GetSQLValueString($_GET['recordID'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

mysql_select_db($database_Directory, $Directory);
$query_rsGovern1 = "SELECT id, position_id, user_id, `position`, `group`, votes, `column`, `order` FROM team_positions WHERE `column` = 1 AND `group` = 'State Rep.' ORDER BY `position` ASC";
$rsGovern1 = mysql_query($query_rsGovern1, $Directory) or die(mysql_error());
$row_rsGovern1 = mysql_fetch_assoc($rsGovern1);
$totalRows_rsGovern1 = mysql_num_rows($rsGovern1);

mysql_select_db($database_Directory, $Directory);
$query_rsGovern2 = "SELECT id, position_id, user_id, `position`, `group`, votes, `column`, `order` FROM team_positions WHERE `column` = 2 AND `group` = 'State Rep.' ORDER BY `position` ASC";
$rsGovern2 = mysql_query($query_rsGovern2, $Directory) or die(mysql_error());
$row_rsGovern2 = mysql_fetch_assoc($rsGovern2);
$totalRows_rsGovern2 = mysql_num_rows($rsGovern2);

mysql_select_db($database_Directory, $Directory);
$query_rsFullList = "SELECT team_positions.id, team_positions.position_id, team_positions.user_id, team_positions.`position`, team_positions.`group`, team_positions.votes, team_positions.`column`, team_positions.`order`, team_positions.`delete`, users.user_id, users.first_name, users.last_name FROM team_positions LEFT JOIN users ON team_positions.user_id =users.user_id WHERE team_positions.`group` = 'State Rep.' AND team_positions.`delete`=0 ORDER BY `position` ASC";
$rsFullList = mysql_query($query_rsFullList, $Directory) or die(mysql_error());
$row_rsFullList = mysql_fetch_assoc($rsFullList);
$totalRows_rsFullList = mysql_num_rows($rsFullList);
?>
<?php 

$currentPage = $_SERVER["PHP_SELF"];

$queryString_rsActiveMembers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsActiveMembers") == false && 
        stristr($param, "totalRows_rsActiveMembers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsActiveMembers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsActiveMembers = sprintf("&totalRows_rsActiveMembers=%d%s", $totalRows_rsActiveMembers, $queryString_rsActiveMembers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title> State Rep. Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header">
  <?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadUserAdmin"> State Rep. Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1" id="form1">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>State Rep</strong></td>
            <td nowrap="nowrap"><label>
              <input name="position" type="text" id="position" size="30" />
            </label></td>
            <td nowrap="nowrap"><strong>Voting Member</strong></td>
            <td><label>
              <select name="vote" id="vote">
                <option value="1" selected="selected">Yes</option>
                <option value="0">No</option>
              </select>
            </label></td>
            <td nowrap="nowrap"><label for="button"><strong>Row</strong></label></td>
            <td><label>
              <select name="order" id="order">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
              </select>
            </label></td>
            <td><strong>Column</strong></td>
            <td><select name="column" id="column">
                <option value="1">1</option>
                <option value="2">2</option>
            </select></td>
            <td><input name="button" type="submit" class="submitButton" id="button" value="Add Council" /></td>
          </tr>
        </table>
      </form>
    <?php if(isset($_POST['button'])) { echo "<p><div class='homepageBlocks'>".$_POST['position']." has been created</div></p>";}?></div>
<br />
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0"> Web Site View</li>
        <li class="TabbedPanelsTab" tabindex="0">Assignments</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <th width="50%" align="left" valign="top">Column #1</th>
              <th width="50%" align="left" valign="top">Column #2</th>
            </tr>
            <tr>
              <td width="50%" align="left" valign="top"><table border="0" cellpadding="5" cellspacing="0" class="tableborder">
                  <tr class="tableTop">
                    <td><strong>Position</strong></td>
                    <td><strong>Voter</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php do { ?>
                    <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>>
                      <td><?php echo substr($row_rsGovern1['position'],0,-10); ?></td>
                      <td><?php OnOffSwitch($row_rsGovern1['votes'],"No","Yes"); ?></td>
                      <td><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></td>
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
                    <?php } while ($row_rsGovern1 = mysql_fetch_assoc($rsGovern1)); ?>
                </table>
                  <p>&nbsp;</p></td>
              <td width="50%" align="left" valign="top"><table border="0" cellpadding="5" cellspacing="0" class="tableborder">
                  <tr class="tableTop">
                    <td><strong>Position</strong></td>
                    <td><strong>Voter</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php do { ?>
                    <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>>
                      <td><?php echo substr($row_rsGovern2['position'],0,-10); ?></td>
                      <td><?php OnOffSwitch($row_rsGovern2['votes'],"No","Yes"); ?></td>
                      <td><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></td>
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
                    <?php } while ($row_rsGovern2 = mysql_fetch_assoc($rsGovern2)); ?>
              </table></td>
            </tr>
          </table>
        </div>
        <div class="TabbedPanelsContent">
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr class="tableTop">
              <td><strong>position</strong></td>
              <td>&nbsp;</td>
              <td><strong>Assigned to</strong></td>
              <td>&nbsp;</td>
            </tr>
            <?php do { ?>
            <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>>
              <td><?php echo $row_rsFullList['position']; ?></td>
              <td>&nbsp;</td>
              <td><?php if($row_rsFullList['first_name']!=""){?>
                  <?php echo $row_rsFullList['first_name']; ?>&nbsp;<?php echo $row_rsFullList['last_name']; ?>
                  <?php } else {?>
                -----------------------
                <?php }?>              </td>
              <td>
              <?php if($row_rsFullList['first_name']!=NULL){?>
              <a href="<?php echo $currentPage;?>?recordID=<?php echo $row_rsFullList['user_id']; ?>&amp;positionID=<?php echo $row_rsFullList['position_id']; ?>"><img src="../images/removeuser.gif" alt="Remove Member" width="14" height="14" /></a><a href="<?php echo $currentPage;?>?recordID=<?php echo $row_rsFullList['user_id']; ?>&amp;positionID=<?php echo $row_rsFullList['position_id']; ?>"></a>
              <?php }?>
              </td>
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
            <?php } while ($row_rsFullList = mysql_fetch_assoc($rsFullList)); ?>
          </table>
        </div>
      </div>
    </div>
    <p class="cleartable">&nbsp;</p>
    <script type="text/javascript">
<!--
<?php if((isset($_GET['recordID'])) && (isset($_GET['positionID']))) {?>
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", { defaultTab: 1 });
<?php } else { ?>
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
<?php }?>
//-->
</script>
  <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsGovern1);

mysql_free_result($rsGovern2);

mysql_free_result($rsFullList);

mysql_free_result($rsActiveMembers);
?>