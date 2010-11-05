<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#E7E7E7";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO cholist (rep_id, `State`, College, Location, `Chief Housing Officer`, Title, `Email Address`, `Mailing Address`, `Address 2`, Phone) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rep_id'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['College'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Chief_Housing_Officer'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Email_Address'], "text"),
                       GetSQLValueString($_POST['Mailing_Address'], "text"),
                       GetSQLValueString($_POST['Address_2'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}
?>
<?php

DeleteRecord("cholist","cholist.id");

$maxRows_rsStatePages = 10;
$pageNum_rsStatePages = 0;
if (isset($_GET['pageNum_rsStatePages'])) {
  $pageNum_rsStatePages = $_GET['pageNum_rsStatePages'];
}
$startRow_rsStatePages = $pageNum_rsStatePages * $maxRows_rsStatePages;

$colname_rsStatePages = "-1";
if (isset($_SESSION['staccess'])) {
  $colname_rsStatePages = (get_magic_quotes_gpc()) ? $_SESSION['staccess'] : addslashes($_SESSION['staccess']);
}

$colname_rsStatePages = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsStatePages = $_REQUEST['recordID'];
}
$colname_rsStatePages = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsStatePages = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsStatePages = sprintf("SELECT cholist.rep_id, cholist.`State`, cholist.College, cholist.`Chief Housing Officer`, cholist.Title, cholist.id FROM cholist WHERE cholist.rep_id = %s AND cholist.`delete` != 1 ORDER BY cholist.College", GetSQLValueString($colname_rsStatePages, "text"));
$rsStatePages = mysql_query($query_rsStatePages, $Directory) or die(mysql_error());
$row_rsStatePages = mysql_fetch_assoc($rsStatePages);
$totalRows_rsStatePages = mysql_num_rows($rsStatePages);

$colname_rsStateInfo = "-1";
if (isset($_REQUEST['recordID'])) {
  $colname_rsStateInfo = $_REQUEST['recordID'];
}
mysql_select_db($database_Directory, $Directory);
$query_rsStateInfo = sprintf("SELECT team_positions.id, team_positions.position_id, team_positions.user_id, team_positions.`position`, team_positions.`group` FROM team_positions WHERE team_positions.position_id = %s", GetSQLValueString($colname_rsStateInfo, "text"));
$rsStateInfo = mysql_query($query_rsStateInfo, $Directory) or die(mysql_error());
$row_rsStateInfo = mysql_fetch_assoc($rsStateInfo);
$totalRows_rsStateInfo = mysql_num_rows($rsStateInfo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>CHO Page Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate"><?php echo substr($row_rsStateInfo['position'],0,-4); ?> CHO List </span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
	<?php if(isset($_POST['MM_insert'])){?>
	<p class="homepageBlocks">CHO Has Been Added</p>
	<?php }?>
      <form method="post" name="search" id="search">
        <table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td><strong>Current CHOs : <?php echo $totalRows_rsStatePages ?> </strong></td>
            <td><label></label>              <label>
            <input name="button" type="button" class="submitButton" id="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Return to Menu" />
            </label></td>
            <td><input name="Button" type="button" class="submitButton" onclick="MM_goToURL('parent','choreviewindex.php?recordID=<?php echo $row_rsStatePages['rep_id']; ?>');return document.MM_returnValue" value="Refresh List" /></td>
            <td><input name="Button" type="button" class="submitButton" onclick="MM_goToURL('parent','choreviewindex.php?recordID=<?php echo $row_rsStatePages['rep_id']; ?>&amp;newcho=yes');return document.MM_returnValue" value="Add CHO" /></td>
          </tr>
        </table>
      </form>
    </div>
    <?php if(isset($_GET['newcho'])){?>
	<div class="pageInformation">
	
	<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table border="0" align="left" cellpadding="5" cellspacing="0">
          <tr valign="baseline">
            <td nowrap align="right"><strong>State:</strong></td>
            <td><select name="State" id="State">
                <option value="" selected="selected">Choose a State</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="OR">Oregon</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>CHO First and Last Name :</strong></td>
            <td><input type="text" name="Chief_Housing_Officer" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>College:</strong></td>
            <td><input type="text" name="College" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Location:</strong></td>
            <td><input type="text" name="Location" value="" size="32"></td>
          </tr>
          
          <tr valign="baseline">
            <td nowrap align="right"><strong>Title:</strong></td>
            <td><input type="text" name="Title" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Email Address:</strong></td>
            <td><input type="text" name="Email_Address" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Address 1:</strong></td>
            <td><input type="text" name="Mailing_Address" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Address 2:</strong></td>
            <td><input type="text" name="Address_2" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><strong>Phone:</strong></td>
            <td><input type="text" name="Phone" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input name="addcho" type="submit" id="addcho" value="Add CHO"></td>
          </tr>
        </table>
        <input type="hidden" name="rep_id" value="<?php echo $row_rsStatePages['rep_id']; ?>">
        <input type="hidden" name="MM_insert" value="form1">
      </form>
      <p class="cleartable">&nbsp;</p>
	</div>
	<?php }?>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
        <td class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>CHO </th>
        <th>&nbsp;</th>
        <th>Title</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">College
          <div align="center"></div></th>
        <th nowrap="nowrap"><div align="center">Administration</div></th>
      </tr>
      <?php do { ?>
        <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
          <td nowrap="nowrap"><?php echo $row_rsStatePages['Chief Housing Officer']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsStatePages['Title']; ?></td>
          <td>&nbsp;</td>
          <td nowrap="nowrap"><?php echo $row_rsStatePages['College']; ?> 
          <div align="center"></div></td>
          <td nowrap="nowrap"><div align="center"><a href="#" onclick="MM_openBrWindow('choedit.php?recordID=<?php echo $row_rsStatePages['id']; ?>','choedit','scrollbars=yes,resizable=yes,width=500')" ><img src="../images/imgAdminEdit.gif" alt="Edit" border="0" /></a>&nbsp;&nbsp;<a href="choreviewindex.php?delete=<?php echo $row_rsStatePages['id']; ?>&amp;recordID=<?php echo $row_rsStatePages['rep_id']; ?>"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" border="0" /></a></div></td>
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
        <?php } while ($row_rsStatePages = mysql_fetch_assoc($rsStatePages)); ?>
<tr>
        <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsStatePages);

mysql_free_result($rsStateInfo);
?>
