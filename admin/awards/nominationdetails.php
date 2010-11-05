<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?><?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#DEDEDE";
$color = $color1;
// technocurve arc 3 php bv block1/3 end
?><?php require_once('../../Connections/Awards.php'); ?>
<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../../Connections/Awards.php'); ?>
<?php require_once('../../Connections/Directory.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "update")) {
  $updateSQL = sprintf("UPDATE nominations SET winner=%s WHERE nomination_id=%s",
                       GetSQLValueString($_POST['winner'], "int"),
                       GetSQLValueString($_POST['nomination_id'], "text"));

  mysql_select_db($database_Awards, $Awards);
  $Result1 = mysql_query($updateSQL, $Awards) or die(mysql_error());
}

$colname_rsAwards = "-1";
if (isset($_GET['awardID'])) {
  $colname_rsAwards = $_GET['awardID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsAwards = sprintf("SELECT *, DATE_FORMAT(awards.mod_on,'%%m/%%d/%%Y  %%r') AS modified_on FROM awards WHERE awards.deleted=0 AND awards.award_id=%s", GetSQLValueString($colname_rsAwards, "text"));
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);

mysql_select_db($database_Directory, $Directory);
$query_rsAwardPage = "SELECT * FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsAwardPage = mysql_query($query_rsAwardPage, $Directory) or die(mysql_error());
$row_rsAwardPage = mysql_fetch_assoc($rsAwardPage);
$totalRows_rsAwardPage = mysql_num_rows($rsAwardPage);

$colname_rsNomination = "-1";
if (isset($_GET['nominationID'])) {
  $colname_rsNomination = $_GET['nominationID'];
}
mysql_select_db($database_Awards, $Awards);
$query_rsNomination = sprintf("SELECT *, DATE_FORMAT( nominations.created_on,'%%m/%%d/%%Y  %%r') AS nom_date FROM nominations WHERE nominations.nomination_id=%s", GetSQLValueString($colname_rsNomination, "text"));
$rsNomination = mysql_query($query_rsNomination, $Awards) or die(mysql_error());
$row_rsNomination = mysql_fetch_assoc($rsNomination);
$totalRows_rsNomination = mysql_num_rows($rsNomination);

mysql_select_db($database_Directory, $Directory);
$query_rsAccess = "SELECT * FROM team_positions WHERE position_id = '2078edb0-b01c-3e0e-2196-463553fd2f0c'";
$rsAccess = mysql_query($query_rsAccess, $Directory) or die(mysql_error());
$row_rsAccess = mysql_fetch_assoc($rsAccess);
$totalRows_rsAccess = mysql_num_rows($rsAccess);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards Page Manager</title>
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
//-->
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 12pt;
	font-weight: bold;
	color: #000099;
}
-->
</style>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">Awards Page Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="POST" action="<?php echo $editFormAction; ?>" name="update" id="update">
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableDetails">
  <tr>
    <td colspan="2" nowrap="nowrap" bgcolor="#E5E5E5"><span class="style1">Nomination for <?php echo strtoupper($row_rsNomination['first_name']." ".$row_rsNomination['last_name']); ?></span></td>
    <td bgcolor="#E5E5E5"><div align="right"><strong>
    <input name="button" type="button" id="button" onclick="MM_goToURL('parent','details.php?awardID=<?php echo $row_rsNomination['award_id']; ?>');return document.MM_returnValue" value="Return to Menu" />
    </strong></div></td>
  </tr>
  
  <?php if($_SESSION['userID']==$row_rsAccess['user_id'] || $_SESSION['access']<3) {?>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><label for="winner">
      <div align="right"><strong>Award Status:</strong></div>
      </label></td>
    <td colspan="2" valign="top"><select name="winner" id="winner">
      <option value="0" <?php if (!(strcmp(0, $row_rsNomination['winner']))) {echo "selected=\"selected\"";} ?>>No Status</option>
      <option value="1" <?php if (!(strcmp(1, $row_rsNomination['winner']))) {echo "selected=\"selected\"";} ?>>Winner</option>
      </select>
      <label for="updateAward"></label>
      <input type="submit" name="updateAward" id="updateAward" value="Submit" />
      <input name="nomination_id" type="hidden" id="nomination_id" value="<?php echo $row_rsNomination['nomination_id']; ?>" /><?php if($_POST["MM_update"] == "update") { echo "Nomination Updated"; }?></td>
  </tr>
  <?php }?>
  
  <tr>
    <td width="20%" valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Award:&nbsp;&nbsp;</strong></div></td>
    <td width="80%" colspan="2" valign="top"><em><strong><?php echo $row_rsAwards['award']; ?>&nbsp;</strong></em></td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Position:&nbsp;&nbsp;</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['position']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Institution:&nbsp;&nbsp;</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['institution']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Address:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['address']; ?><br />
      <?php echo $row_rsNomination['city']; ?>, <?php echo $row_rsNomination['state']; ?>&nbsp;<?php echo $row_rsNomination['zip']; ?></td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Email:</strong></div></td>
    <td colspan="2" valign="top"><a href="mailto:<?php echo $row_rsNomination['email']; ?>"><?php echo $row_rsNomination['email']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Nomination:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['nomination']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Document One:</strong></div></td>
    <td colspan="2" valign="top"><a href="documents/<?php echo str_replace(" ","_",$row_rsNomination['doc_1']); ?>"><?php echo $row_rsNomination['doc_1']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Document Two:</strong></div></td>
    <td colspan="2" valign="top"><a href="documents/<?php echo str_replace(" ","_",$row_rsNomination['doc_2']); ?>"><?php echo $row_rsNomination['doc_2']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Document Three:</strong></div></td>
    <td colspan="2" valign="top"><a href="documents/<?php echo str_replace(" ","_",$row_rsNomination['doc_3']); ?>"><?php echo $row_rsNomination['doc_3']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Document Four:</strong></div></td>
    <td colspan="2" valign="top"><a href="documents/<?php echo str_replace(" ","_",$row_rsNomination['doc_4']); ?>"><?php echo $row_rsNomination['doc_4']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Document Five:</strong></div></td>
    <td colspan="2" valign="top"><a href="documents/<?php echo str_replace(" ","_",$row_rsNomination['doc_5']); ?>"><?php echo $row_rsNomination['doc_5']; ?></a>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3" valign="top" nowrap="nowrap" class="labelsDetails">&nbsp;</td>
    </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Nominator:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['first_name']; ?>&nbsp;<?php echo $row_rsNomination['last_name']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Postion:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['position']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Institution:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['institution']; ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Address:</strong></div></td>
    <td colspan="2" valign="top"><?php echo $row_rsNomination['address']; ?><br />
      <?php echo $row_rsNomination['city']; ?>, <?php echo $row_rsNomination['state']; ?>&nbsp;<?php echo $row_rsNomination['zip']; ?></td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap" class="labelsDetails"><div align="right"><strong>Email:</strong></div></td>
    <td colspan="2" valign="top"><a href="mailto:<?php echo $row_rsNomination['nom_email']; ?>"><?php echo $row_rsNomination['email']; ?></a>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="labelsDetails">Submitted by: <?php echo $row_rsNomination['nom_first']; ?>&nbsp;<?php echo $row_rsNomination['nom_last']; ?> at <?php echo $row_rsNomination['nom_date']; ?></td>
    </tr>
</table>
<input type="hidden" name="MM_update" value="update" />
      </form>
</p>
    </div>
    <br />
	<p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsAwards);

mysql_free_result($rsAwards);

mysql_free_result($rsAwardPage);

mysql_free_result($rsNomination);

mysql_free_result($rsAccess);
?>