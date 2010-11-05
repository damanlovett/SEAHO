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
$query_WADAcallforprograms = sprintf("SELECT id, ProgramTitle, ProgramNumber, session, location, programTime, FirstName, LastName, MiddleInitial, Title, Institution FROM callforprograms WHERE id = %s", GetSQLValueString($Paramid_WADAcallforprograms, "int"));
$WADAcallforprograms = mysql_query($query_WADAcallforprograms, $Programming) or die(mysql_error());
$row_WADAcallforprograms = mysql_fetch_assoc($WADAcallforprograms);
$totalRows_WADAcallforprograms = mysql_num_rows($WADAcallforprograms);?>
<?php 
// WA Application Builder Update
if (isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $Programming;
  $WA_table = "callforprograms";
  $WA_redirectURL = "callforprograms_Detail.php?id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "ProgramTitle|ProgramNumber|session|location|programTime|FirstName|LastName|MiddleInitial|Title|Institution";
  $WA_fieldValuesStr = "".((isset($_POST["ProgramTitle"]))?$_POST["ProgramTitle"]:"")  ."" . "|" . "".((isset($_POST["ProgramNumber"]))?$_POST["ProgramNumber"]:"")  ."" . "|" . "".((isset($_POST["session"]))?$_POST["session"]:"")  ."" . "|" . "".((isset($_POST["location"]))?$_POST["location"]:"")  ."" . "|" . "".((isset($_POST["programTime"]))?$_POST["programTime"]:"")  ."" . "|" . "".((isset($_POST["FirstName"]))?$_POST["FirstName"]:"")  ."" . "|" . "".((isset($_POST["LastName"]))?$_POST["LastName"]:"")  ."" . "|" . "".((isset($_POST["MiddleInitial"]))?$_POST["MiddleInitial"]:"")  ."" . "|" . "".((isset($_POST["Title"]))?$_POST["Title"]:"")  ."" . "|" . "".((isset($_POST["Institution"]))?$_POST["Institution"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_where_columnTypesStr = "none,none,NULL";
  $WA_where_comparisonStr = "=";
  $WA_where_fieldNames = explode("|", $WA_indexField);
  $WA_where_fieldValues = explode("|", $WA_where_fieldValuesStr);
  $WA_where_columns = explode("|", $WA_where_columnTypesStr);
  $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
  
  $WA_connectionDB = $database_Programming;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
  $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
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
<title>Update callforprograms</title>
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
    
    
    <div class="WADAUpdateContainer">
      <?php if ($totalRows_WADAcallforprograms > 0) { // Show if recordset not empty ?>
        <form action="callforprograms_Update.php?id=<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" method="post" name="WADAUpdateForm" id="WADAUpdateForm">
          <div class="WADAHeader">Update Record</div>
          <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
          <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <th class="WADADataTableHeader">ProgramTitle:</th>
              <td class="WADADataTableCell"><input type="text" name="ProgramTitle" id="ProgramTitle" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['ProgramTitle'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">ProgramNumber:</th>
              <td class="WADADataTableCell"><input type="text" name="ProgramNumber" id="ProgramNumber" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['ProgramNumber'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">session:</th>
              <td class="WADADataTableCell"><input type="text" name="session" id="session" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['session'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">location:</th>
              <td class="WADADataTableCell"><input type="text" name="location" id="location" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['location'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">programTime:</th>
              <td class="WADADataTableCell"><input type="text" name="programTime" id="programTime" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['programTime'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">FirstName:</th>
              <td class="WADADataTableCell"><input type="text" name="FirstName" id="FirstName" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['FirstName'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">LastName:</th>
              <td class="WADADataTableCell"><input type="text" name="LastName" id="LastName" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['LastName'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">MiddleInitial:</th>
              <td class="WADADataTableCell"><input type="text" name="MiddleInitial" id="MiddleInitial" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['MiddleInitial'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">Title:</th>
              <td class="WADADataTableCell"><input type="text" name="Title" id="Title" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['Title'])); ?>" size="32" /></td>
            </tr>
            <tr>
              <th class="WADADataTableHeader">Institution:</th>
              <td class="WADADataTableCell"><input type="text" name="Institution" id="Institution" value="<?php echo(str_replace('"', '&quot;', $row_WADAcallforprograms['Institution'])); ?>" size="32" /></td>
            </tr>
          </table>
          <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
          <div class="WADAButtonRow">
            <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Update" id="Update" value="Update" alt="Update" src="../../WA_DataAssist/images/Pacifica/Refined_update.gif"  /></td>
                <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="callforprograms_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
              </tr>
            </table>
            <input name="WADAUpdateRecordID" type="hidden" id="WADAUpdateRecordID" value="<?php echo(rawurlencode($row_WADAcallforprograms['id'])); ?>" />
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
