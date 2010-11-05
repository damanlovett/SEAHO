<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>
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

mysql_select_db($database_Directory, $Directory);
$query_rsEditorsOne = "SELECT * FROM state_editors WHERE `column` = 1 ORDER BY `order` ASC";
$rsEditorsOne = mysql_query($query_rsEditorsOne, $Directory) or die(mysql_error());
$row_rsEditorsOne = mysql_fetch_assoc($rsEditorsOne);
$totalRows_rsEditorsOne = mysql_num_rows($rsEditorsOne);

mysql_select_db($database_Directory, $Directory);
$query_rsEditorsTwo = "SELECT * FROM state_editors WHERE `column` = 2 ORDER BY `order` ASC";
$rsEditorsTwo = mysql_query($query_rsEditorsTwo, $Directory) or die(mysql_error());
$row_rsEditorsTwo = mysql_fetch_assoc($rsEditorsTwo);
$totalRows_rsEditorsTwo = mysql_num_rows($rsEditorsTwo);
?>
<?php

DeleteRecord(team_positions,position_id);

// Unassign Member

if(isset($_GET['recordID'])){
  $clear = "";
  $updateSQL = sprintf("UPDATE team_positions SET user_id=NULL WHERE position_id=%s AND user_id=%s",
                       GetSQLValueString($_GET['positionID'], "text"),
                       GetSQLValueString($_GET['recordID'], "text"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

// Delete Record - set to 1

DeleteRecord("team_positions","position_id");
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
<title>State Editor Manager</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
</script><!-- InstanceEndEditable -->
</head>
<body>
<div id="header">
  <?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadUserAdmin">State Editor Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" --><br />
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">State Rep Lists</li>
        </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
		<p><input name="refresh" type="button" id="refresh" onclick="MM_goToURL('parent','<?php echo $_SERVER['../committeesadmin/PHP_SELF'];?>');return document.MM_returnValue" value="Refresh List" />
		</p>
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <th width="50%" align="left" valign="top">Column #1</th>
              <th width="50%" align="left" valign="top">Column #2</th>
            </tr>
            <tr>
              <td width="50%" align="left" valign="top"><table border="0" cellpadding="5" cellspacing="0" class="tableborder">
                  <tr class="tableTop">
                    <td><strong>State</strong></td>
                    <td><strong>Rep</strong></td>
                    <td><strong>Email</strong></td>
                    <td><strong>Order</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php do { ?>
                    <tr >
                      <td><?php echo $row_rsEditorsOne['state']; ?></td>
                      <td><?php echo $row_rsEditorsOne['first_name']; ?>&nbsp;<?php echo $row_rsEditorsOne['last_name']; ?></td>
                      <td><?php echo $row_rsEditorsOne['email']; ?></td>
                      <td><div align="center"><?php echo $row_rsEditorsOne['order']; ?></div></td>
                      <td><a href="#"><img src="../images/imgUpdate.gif" alt="Edit" width="14" height="14" border="0" onclick="MM_openBrWindow('update.php?recordID=<?php echo $row_rsEditorsOne['editor_id']; ?>','update','width=400,height=400')" /></a></td>
                    </tr>
                    <?php } while ($row_rsEditorsOne = mysql_fetch_assoc($rsEditorsOne)); ?>
</table>
              <p>&nbsp;</p></td>
              <td width="50%" align="left" valign="top"><table border="0" cellpadding="5" cellspacing="0" class="tableborder">
                  <tr class="tableTop">
                    <td><strong>State</strong></td>
                    <td><strong>Rep</strong></td>
                    <td><strong>Email</strong></td>
                    <td><strong>Order</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php do { ?>
                    <tr >
                      <td><?php echo $row_rsEditorsTwo['state']; ?></td>
                      <td><?php echo $row_rsEditorsTwo['first_name']; ?>&nbsp;<?php echo $row_rsEditorsTwo['last_name']; ?></td>
                      <td><?php echo $row_rsEditorsTwo['email']; ?></td>
                      <td><div align="center"><?php echo $row_rsEditorsTwo['order']; ?></div></td>
                      <td><a href="#"><img src="../images/imgUpdate.gif" alt="Edit" border="0" onclick="MM_openBrWindow('update.php?recordID=<?php echo $row_rsEditorsTwo['editor_id']; ?>','update','width=500,height=400')" /></a></td>
                    </tr>
              <?php } while ($row_rsEditorsTwo = mysql_fetch_assoc($rsEditorsTwo)); ?>
</table></td>
            </tr>
          </table>
        </div>
        </div>
    </div>
    <p class="cleartable">&nbsp;</p>
    <script type="text/javascript">
<!--
	<?php if((isset($_GET['recordID'])) && (!isset($_GET['position_id']))) {?>
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
<?php } else { ?>
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
<?php }?>
//-->
</script>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsEditorsOne);

mysql_free_result($rsEditorsTwo);

mysql_free_result($rsActiveMembers);
?>