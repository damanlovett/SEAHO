<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
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
<?php require_once('../includefiles/init.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE users SET first_name=%s, last_name=%s, title=%s, address=%s, city=%s, `state`=%s, zip=%s, school=%s, email=%s, password=%s WHERE id=%s",
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['school'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['updateID'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}
?>
<?php require_once('../includefiles/init.php'); ?>
<?php

$colname_rsUpdate = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsUpdate = $_SESSION['userID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsUpdate = sprintf("SELECT id, user_id, first_name, last_name, middle, `position`, title, address, city, `state`, zip, school, email, password, `access` FROM users WHERE user_id = %s", GetSQLValueString($colname_rsUpdate, "text"));
$rsUpdate = mysql_query($query_rsUpdate, $Directory) or die(mysql_error());
$row_rsUpdate = mysql_fetch_assoc($rsUpdate);
$totalRows_rsUpdate = mysql_num_rows($rsUpdate);

$colname_rsPosition = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsPosition = $_SESSION['userID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsPosition = sprintf("SELECT id, position_id, user_id, `position`, `group`, votes, `column`, `order` FROM team_positions WHERE user_id = %s AND `group` = 'Committee'", GetSQLValueString($colname_rsPosition, "text"));
$rsPosition = mysql_query($query_rsPosition, $Directory) or die(mysql_error());
$row_rsPosition = mysql_fetch_assoc($rsPosition);
$totalRows_rsPosition = mysql_num_rows($rsPosition);

$colname_rsPosition2 = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsPosition2 = $_SESSION['userID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsPosition2 = sprintf("SELECT id, position_id, user_id, `position`, `group`, votes, `column`, `order` FROM team_positions WHERE user_id = %s AND (`group` = 'State Rep.' OR `group` = 'Governing Council')", GetSQLValueString($colname_rsPosition2, "text"));
$rsPosition2 = mysql_query($query_rsPosition2, $Directory) or die(mysql_error());
$row_rsPosition2 = mysql_fetch_assoc($rsPosition2);
$totalRows_rsPosition2 = mysql_num_rows($rsPosition2);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>My Profile</title>
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
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeaduser"><?php echo $_SESSION['display_name']; ?>'s Profile</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
            <form action="<?php echo $editFormAction; ?>" method="POST" name="update" id="update">
        <table border="0" cellpadding="5" cellspacing="0">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>Title:</strong></td>
            <td colspan="3"><input type="text" name="title" value="<?php echo htmlentities($row_rsUpdate['title'], ENT_COMPAT, 'iso-8859-1'); ?>" size="50" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>First Name:</strong></td>
            <td><input type="text" name="first_name" value="<?php echo htmlentities($row_rsUpdate['first_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
            <td><strong>Last Name:</strong></td>
            <td><input type="text" name="last_name" value="<?php echo htmlentities($row_rsUpdate['last_name'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>School:</strong></td>
            <td><input type="text" name="school" value="<?php echo htmlentities($row_rsUpdate['school'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
            <td><strong>Email:</strong></td>
            <td><input type="text" name="email" value="<?php echo htmlentities($row_rsUpdate['email'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>

          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>Address:</strong></td>
            <td><input type="text" name="address" value="<?php echo htmlentities($row_rsUpdate['address'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
            <td><strong>City:</strong></td>
            <td><input type="text" name="city" value="<?php echo htmlentities($row_rsUpdate['city'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>

          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>State:</strong></td>
            <td><select name="state" id="state">
                <option value="" selected="selected" <?php if (!(strcmp("", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Choose a State</option>
                <option value="AL" <?php if (!(strcmp("AL", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Alabama</option>
                <option value="AK" <?php if (!(strcmp("AK", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Alaska</option>
                <option value="AZ" <?php if (!(strcmp("AZ", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Arizona</option>
                <option value="AR" <?php if (!(strcmp("AR", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Arkansas</option>
                <option value="CA" <?php if (!(strcmp("CA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>California</option>
                <option value="CO" <?php if (!(strcmp("CO", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Colorado</option>
                <option value="CT" <?php if (!(strcmp("CT", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Connecticut</option>
                <option value="DE" <?php if (!(strcmp("DE", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Delaware</option>
                <option value="DC" <?php if (!(strcmp("DC", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>District Of Columbia</option>
                <option value="FL" <?php if (!(strcmp("FL", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Florida</option>
                <option value="GA" <?php if (!(strcmp("GA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
                <option value="HI" <?php if (!(strcmp("HI", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Hawaii</option>
                <option value="ID" <?php if (!(strcmp("ID", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Idaho</option>
                <option value="IL" <?php if (!(strcmp("IL", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Illinois</option>
                <option value="IN" <?php if (!(strcmp("IN", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Indiana</option>
                <option value="IA" <?php if (!(strcmp("IA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Iowa</option>
                <option value="KS" <?php if (!(strcmp("KS", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Kansas</option>
                <option value="KY" <?php if (!(strcmp("KY", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Kentucky</option>
                <option value="LA" <?php if (!(strcmp("LA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Louisiana</option>
                <option value="ME" <?php if (!(strcmp("ME", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Maine</option>
                <option value="MD" <?php if (!(strcmp("MD", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Maryland</option>
                <option value="MA" <?php if (!(strcmp("MA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Massachusetts</option>
                <option value="MI" <?php if (!(strcmp("MI", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Michigan</option>
                <option value="MN" <?php if (!(strcmp("MN", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Minnesota</option>
                <option value="MS" <?php if (!(strcmp("MS", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Mississippi</option>
                <option value="MO" <?php if (!(strcmp("MO", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Missouri</option>
                <option value="MT" <?php if (!(strcmp("MT", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Montana</option>
                <option value="NE" <?php if (!(strcmp("NE", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Nebraska</option>
                <option value="NV" <?php if (!(strcmp("NV", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Nevada</option>
                <option value="NH" <?php if (!(strcmp("NH", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New Hampshire</option>
                <option value="NJ" <?php if (!(strcmp("NJ", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New Jersey</option>
                <option value="NY" <?php if (!(strcmp("NY", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>New York</option>
                <option value="NC" <?php if (!(strcmp("NC", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>North Carolina</option>
                <option value="ND" <?php if (!(strcmp("ND", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>North Dakota</option>
                <option value="OH" <?php if (!(strcmp("OH", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Ohio</option>
                <option value="OK" <?php if (!(strcmp("OK", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oklahoma</option>
                <option value="OR" <?php if (!(strcmp("OR", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
                <option value="PA" <?php if (!(strcmp("PA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Pennsylvania</option>
                <option value="OR" <?php if (!(strcmp("OR", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
                <option value="RI" <?php if (!(strcmp("RI", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Rhode Island</option>
                <option value="SC" <?php if (!(strcmp("SC", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>South Carolina</option>
                <option value="SD" <?php if (!(strcmp("SD", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>South Dakota</option>
                <option value="TN" <?php if (!(strcmp("TN", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Tennessee</option>
                <option value="TX" <?php if (!(strcmp("TX", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Texas</option>
                <option value="UT" <?php if (!(strcmp("UT", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Utah</option>
                <option value="VT" <?php if (!(strcmp("VT", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Vermont</option>
                <option value="VA" <?php if (!(strcmp("VA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Virginia</option>
                <option value="WA" <?php if (!(strcmp("WA", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Washington</option>
                <option value="WV" <?php if (!(strcmp("WV", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>West Virginia</option>
                <option value="WI" <?php if (!(strcmp("WI", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Wisconsin</option>
                <option value="WY" <?php if (!(strcmp("WY", $row_rsUpdate['state']))) {echo "selected=\"selected\"";} ?>>Wyoming</option>
            </select>            </td>
            <td><strong>Zip:</strong></td>
            <td><input type="text" name="zip" value="<?php echo htmlentities($row_rsUpdate['zip'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
          </tr>

          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><strong>Password:</strong></td>
            <td><input type="password" name="password" value="<?php echo $row_rsUpdate['password']; ?>" size="32" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" class="submitButton" value="Update record" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input name="updateID" type="hidden" id="updateID" value="<?php echo $row_rsUpdate['id']; ?>" />
        <input type="hidden" name="MM_update" value="update" />
</form>
    <?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) { echo "<div class='homepageBlocks'><p>Your Profile has been updated</p></div>";}?>

    </div>
    
    
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Current Positions</li>
        <li class="TabbedPanelsTab" tabindex="0">Current Committees</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent"> <br />
          <?php if ($totalRows_rsPosition2 > 0) { // Show if recordset not empty ?>
            <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
              <tr>
                <td class="tableTop"><strong>Position</strong></td>
                <td class="tableTop">&nbsp;</td>
                <td class="tableTop"><strong>Group</strong></td>
                <td class="tableTop">&nbsp;</td>
                <td class="tableTop"><strong>Voting Member</strong></td>
                <td class="tableTop">&nbsp;</td>
              </tr>
              <?php do { ?>
                <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
                  <td nowrap="nowrap"><?php echo $row_rsPosition2['position']; ?> </td>
                  <td>&nbsp;</td>
                  <td nowrap="nowrap"><?php echo $row_rsPosition2['group']; ?></td>
                  <td>&nbsp;</td>
                  <td nowrap="nowrap"><?php OnOffSwitch($row_rsPosition2['votes'],"No","Yes");?></td>
                  <td nowrap="nowrap">&nbsp;</td>
                </tr>
                <?php } while ($row_rsPosition2 = mysql_fetch_assoc($rsPosition2)); ?>
              <?php 
// technocurve arc 3 php bv block3/3 start
if ($color == $color1) {
	$color = $color2;
} else {
	$color = $color1;
}
// technocurve arc 3 php bv block3/3 end
?>
              <tr>
                <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
              </tr>
            </table>
            <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsPosition2 == 0) { // Show if recordset empty ?>
            <p class="homepageBlocks">You current are assigned to any positions.</p>
            <?php } // Show if recordset empty ?>
</div>
        <div class="TabbedPanelsContent">
          <?php if ($totalRows_rsPosition > 0) { // Show if recordset not empty ?>
            <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
                <tr>
                  <td class="tableTop"><strong>Position</strong></td>
                  <td class="tableTop">&nbsp;</td>
                  <td class="tableTop"><strong>Group</strong></td>
                  <td class="tableTop">&nbsp;</td>
                  <td class="tableTop"><strong>Voting Member</strong></td>
                  <td class="tableTop">&nbsp;</td>
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
                <?php do { ?>
                <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
                  <td nowrap="nowrap"><?php echo $row_rsPosition['position']; ?> </td>
                  <td>&nbsp;</td>
                  <td nowrap="nowrap"><?php echo $row_rsPosition['group']; ?></td>
                  <td>&nbsp;</td>
                  <td nowrap="nowrap"><?php OnOffSwitch($row_rsPosition['votes'],"No","Yes");?></td>
                  <td nowrap="nowrap">&nbsp;</td>
                </tr>
                <?php } while ($row_rsPosition = mysql_fetch_assoc($rsPosition)); ?>
                <tr>
                  <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
              </tr>
            </table>
            <?php } // Show if recordset not empty ?>
          <?php if ($totalRows_rsPosition == 0) { // Show if recordset empty ?>
            <p class="homepageBlocks">You are current not on any committees.</p>
            <?php } // Show if recordset empty ?>
</div>
      </div>
    </div>
    <p class="cleartable">&nbsp;</p>
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
mysql_free_result($rsUpdate);

mysql_free_result($rsPosition);

mysql_free_result($rsPosition2);
?>
