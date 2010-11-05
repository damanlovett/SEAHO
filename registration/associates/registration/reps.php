<?php require_once('../../../Connections/CMS.php'); ?>
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
<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php

if(!isset($_SESSION['reg_id'])) {$_SESSION['reg_id'] = $_GET['recordID'];}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['rep_id'])) && ($_GET['rep_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM associate_reps WHERE rep_id=%s",
                       GetSQLValueString($_GET['rep_id'], "text"));

  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($deleteSQL, $CMS) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO associate_reps (rep_id, associate_id, registration_id, conference_id, first_name, last_name, tag_name, email) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rep_id'], "text"),
                       GetSQLValueString($_POST['associate_id'], "text"),
                       GetSQLValueString($_POST['registration_id'], "text"),
                       GetSQLValueString($_POST['conference_id'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['tag_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"));
sqlQueryLog($insertSQL);
  mysql_select_db($database_CMS, $CMS);
  $Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());
}

$colname_rsReps = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsReps = $_GET['recordID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsReps = sprintf("SELECT rep_id, associate_id, registration_id, first_name, last_name, tag_name, email FROM associate_reps WHERE registration_id = %s", GetSQLValueString($colname_rsReps, "text"));
$rsReps = mysql_query($query_rsReps, $CMS) or die(mysql_error());
$row_rsReps = mysql_fetch_assoc($rsReps);
$totalRows_rsReps = mysql_num_rows($rsReps);

$colname_rsRegInfo = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsRegInfo = $_GET['recordID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegInfo = sprintf("SELECT registration_id, conference_id, associate_id, invoice_no FROM associate_registrations WHERE registration_id = %s", GetSQLValueString($colname_rsRegInfo, "text"));
$rsRegInfo = mysql_query($query_rsRegInfo, $CMS) or die(mysql_error());
$row_rsRegInfo = mysql_fetch_assoc($rsRegInfo);
$totalRows_rsRegInfo = mysql_num_rows($rsRegInfo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
<link href="../../styles/table.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
  <?php require_once('../../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <div align="center"><?php require_once('../../includefiles/headerAssociateHome.php'); ?>
</div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
    <?php require_once('../../includefiles/leftNavAssociates.php'); ?>
<!-- InstanceEndEditable --><img src="../../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->

      <h1><?php echo $_SESSION['org_name'];?>'s Reps</h1>
      
      
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
          <tr>
            <td width="16%" class="labels">First Name:</td>
            <td class="labelsDetails"><input type="text" name="first_name" id="first_name" /></td>
            <td width="16%" class="labels">Last Name:</td>
            <td width="33%" class="labelsDetails"><input type="text" name="last_name" id="last_name" />            </td>
          </tr>
          <tr>
            <td class="labels">Email</td>
            <td class="labelsDetails"><input type="text" name="email" id="email" /></td>
            <td class="labels">Name Tag:</td>
            <td class="labelsDetails"><input name="tag_name" type="text" id="tag_name" /></td>
          </tr>
          <tr>
            <td class="labels"><label for="button"></label></td>
            <td class="labelsDetails"><input name="rep_id" type="hidden" id="rep_id" value="<?php echo create_guid();?>" />
            <input name="associate_id" type="hidden" id="associate_id" value="<?php echo $row_rsRegInfo['associate_id']; ?>" />
            <input name="registration_id" type="hidden" id="registration_id" value="<?php echo $row_rsRegInfo['registration_id']; ?>" />
            <input name="conference_id" type="hidden" id="conference_id" value="<?php echo $row_rsRegInfo['conference_id']; ?>" /></td>
            <td class="labels">&nbsp;</td>
            <td class="labelsDetails"><div align="right">
              <input type="submit" name="button" id="button" value="Add Rep" />
            </div></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp;</p>
      
      <?php if ($totalRows_rsReps > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop"><?php echo $totalRows_rsReps ?> Representative(s)</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>Name Tag</th>
            <th>&nbsp;</th>
            <th>Email</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <?php do { ?>
            <tr>
              <td class="tablerows"><?php echo $row_rsReps['first_name']; ?> <?php echo $row_rsReps['last_name']; ?>&nbsp;</td>
              <td class="tablerows">&nbsp;</td>
              <td class="tablerows"><?php echo $row_rsReps['tag_name']; ?>&nbsp;</td>
              <td class="tablerows">&nbsp;</td>
              <td class="tablerows"><?php echo $row_rsReps['email']; ?>&nbsp;</td>
              <td class="tablerows"><div align="center">&nbsp;</div></td>
              <td class="tablerows"><a href="reps.php?rep_id=<?php echo $row_rsReps['rep_id']; ?>"><img src="../../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></a></td>
            </tr>
            <?php } while ($row_rsReps = mysql_fetch_assoc($rsReps)); ?>
          <tr>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
          </tr>
</table>
        <?php } // Show if recordset not empty ?>
      <p></p>
      <?php if ($totalRows_rsReps == 0) { // Show if recordset empty ?>
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>Name Tag</th>
            <th>&nbsp;</th>
            <th>Email</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <tr>
            <td colspan="7" class="tablerows"><div align="center">There are no representatives for <?php echo $_SESSION['org_name'];?></div></td>
          </tr>
          <tr>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
            <td class="tableBottom">&nbsp;</td>
          </tr>
        </table>
        <?php } // Show if recordset empty ?>
<p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsReps);

mysql_free_result($rsRegInfo);
?>