<?php require_once('../../Connections/Programming.php'); ?>
<?php require_once("../../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
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
<?php
$Paramid_WADAcallforprograms = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAcallforprograms = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_Programming, $Programming);
$query_WADAcallforprograms = sprintf("SELECT id, ProgramTitle, ProgramNumber, session, location FROM callforprograms WHERE id = %s", GetSQLValueString($Paramid_WADAcallforprograms, "int"));
$WADAcallforprograms = mysql_query($query_WADAcallforprograms, $Programming) or die(mysql_error());
$row_WADAcallforprograms = mysql_fetch_assoc($WADAcallforprograms);
$totalRows_WADAcallforprograms = mysql_num_rows($WADAcallforprograms);?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $Programming;
  $WA_table = "callforprograms";
  $WA_redirectURL = "callforprograms_Results.php";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "id";
  $WA_columnTypesStr = "none,none,NULL";
  $WA_fieldValuesStr = "".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_comparisions = explode("|", $WA_comparisonStr);
  $WA_connectionDB = $database_Programming;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $deleteParamsObj = WA_AB_generateWhereClause($WA_fieldNames, $WA_columns, $WA_fieldValues, $WA_comparisions);
  $WA_Sql = "DELETE FROM `" . $WA_table . "` WHERE " . $deleteParamsObj->sqlWhereClause;
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Delete callforprograms</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Reviewer Manager Test<!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1">
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
              </select>
            </td>
            <td>&nbsp;</td>
            <td><strong>Reviewer</strong></td>
            <td><select name="userID">
                <option>--------</option>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Assign" /></td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap><div align="left"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="reviewID" />
      </form>
    </div>
    <table width="400" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="7" class="tableTop">&nbsp;Reviewers:  &nbsp;&nbsp;Programs: </td>
      </tr>
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>Reviews</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Read</th>
        <th>&nbsp;</th>
        <th>Votes</th>
      </tr>
      <tr  class="tableRowColor">
        <td nowrap="nowrap"><a href="#">, </a><a href="#"></a> </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td nowrap="nowrap"></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td nowrap="nowrap"></td>
      </tr>
      <tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    
    
    <div class="WADADeleteContainer">
      <?php if ($totalRows_WADAcallforprograms > 0) { // Show if recordset not empty ?>
        <form action="callforprograms_Delete.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" method="post" name="WADADeleteForm" id="WADADeleteForm">
          <div class="WADAHeader">Delete Record</div>
          <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
          <p class="WADAMessage">Are you sure you want to delete the following record?</p>
          <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <th class="WADADataTableHeader">id:</th>
              <td class="WADADataTableCell"><?php echo($row_WADAcallforprograms['id']); ?></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">ProgramTitle:</th>
              <td class="WADADataTableCell"><?php echo($row_WADAcallforprograms['ProgramTitle']); ?></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">ProgramNumber:</th>
              <td class="WADADataTableCell"><?php echo($row_WADAcallforprograms['ProgramNumber']); ?></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">session:</th>
              <td class="WADADataTableCell"><?php echo($row_WADAcallforprograms['session']); ?></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">location:</th>
              <td class="WADADataTableCell"><?php echo($row_WADAcallforprograms['location']); ?></td>
            </tr>
          </table>
          <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
          <div class="WADAButtonRow">
            <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Delete" id="Delete" value="Delete" alt="Delete" src="../../WA_DataAssist/images/Pacifica/Refined_delete.gif"  /></td>
                <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="callforprograms_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
              </tr>
            </table>
            <input name="WADADeleteRecordID" type="hidden" id="WADADeleteRecordID" value="<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" />
          </div>
        </form>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_WADAcallforprograms == 0) { // Show if recordset empty ?>
        <div class="WADANoResults">
          <div class="WADANoResultsMessage">No record found.</div>
        </div>
      <?php } // Show if recordset empty ?>
    </div>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($WADAcallforprograms);
?>
