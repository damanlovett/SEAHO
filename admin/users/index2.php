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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsActiveMembers = 20;
$pageNum_rsActiveMembers = 0;
if (isset($_GET['pageNum_rsActiveMembers'])) {
  $pageNum_rsActiveMembers = $_GET['pageNum_rsActiveMembers'];
}
$startRow_rsActiveMembers = $pageNum_rsActiveMembers * $maxRows_rsActiveMembers;

mysql_select_db($database_Directory, $Directory);
$query_rsActiveMembers = "SELECT users.id, users.user_id, users.first_name, users.last_name, users.middle, users.`position`, users.title, users.address, users.school, users.email, users.`access`, users.`delete` FROM users WHERE users.`delete`='0' ORDER BY users.last_name";
$query_limit_rsActiveMembers = sprintf("%s LIMIT %d, %d", $query_rsActiveMembers, $startRow_rsActiveMembers, $maxRows_rsActiveMembers);
$rsActiveMembers = mysql_query($query_limit_rsActiveMembers, $Directory) or die(mysql_error());
$row_rsActiveMembers = mysql_fetch_assoc($rsActiveMembers);

if (isset($_GET['totalRows_rsActiveMembers'])) {
  $totalRows_rsActiveMembers = $_GET['totalRows_rsActiveMembers'];
} else {
  $all_rsActiveMembers = mysql_query($query_rsActiveMembers);
  $totalRows_rsActiveMembers = mysql_num_rows($all_rsActiveMembers);
}
$totalPages_rsActiveMembers = ceil($totalRows_rsActiveMembers/$maxRows_rsActiveMembers)-1;

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
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>User Management</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="../../SpryAssets/xpath.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryData.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
var ds1 = new Spry.Data.XMLDataSet("../xmldata/users.php", "export/row");
//-->
</script>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadUserAdmin">User Management</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1" id="form1">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>Search By</strong></td>
            <td nowrap="nowrap"><select name="select">
              <option value="last_name">Last Name</option>
              <option value="first_name">First Name</option>
              <option value="title">Title</option>
              <option value="school">School</option>
              <?php 
do {  
?>
              <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
            </select></td>
            <td><input name="textfield" type="text" size="40" />            </td>
            <td>&nbsp;</td>
            <td nowrap="nowrap"><select name="select2">
              <option value="id">--- Sort by ---</option>
              <option value="last_name">Last Name</option>
              <option value="first_name">First Name</option>
              <option value="title">Title</option>
              <option value="school">School</option>
              <?php 
do {  
?>
              <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Search" /></td>
          </tr>
        </table>
      </form>
    </div>
    <br />
    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Active Members</li>
        <li class="TabbedPanelsTab" tabindex="0">Inactive Members</li>
        <li class="TabbedPanelsTab" tabindex="0">Add Member</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <td class="tableTop">&nbsp;<?php echo ($startRow_rsActiveMembers + 1) ?> to <?php echo min($startRow_rsActiveMembers + $maxRows_rsActiveMembers, $totalRows_rsActiveMembers) ?> of <?php echo $totalRows_rsActiveMembers ?> </td>
              <td class="tableTop">&nbsp;</td>
              <td colspan="5" class="tableTop">&nbsp;
                <?php if ($pageNum_rsActiveMembers > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, 0, $queryString_rsActiveMembers); ?>"><img src="../voting/First.gif" border="0" /></a>
                  <?php } // Show if not first page ?>&nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, max(0, $pageNum_rsActiveMembers - 1), $queryString_rsActiveMembers); ?>"><img src="../voting/Previous.gif" border="0" /></a>
                  <?php } // Show if not first page ?>&nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers < $totalPages_rsActiveMembers) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, min($totalPages_rsActiveMembers, $pageNum_rsActiveMembers + 1), $queryString_rsActiveMembers); ?>"><img src="../voting/Next.gif" border="0" /></a>
                  <?php } // Show if not last page ?>&nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers < $totalPages_rsActiveMembers) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, $totalPages_rsActiveMembers, $queryString_rsActiveMembers); ?>"><img src="../voting/Last.gif" border="0" /></a>
                  <?php } // Show if not last page ?>              </td>
            </tr>
            <tr>
              <th>Name</th>
              <th colspan="2">&nbsp;</th>
              <th>Institution</th>
              <th>&nbsp;</th>
              <th>Access</th>
              <th><div align="center"></div></th>
            </tr>
            <?php do { ?>
              <tr  class="tableRowColor">
                <td nowrap="nowrap"><a href="#"><?php echo $row_rsActiveMembers['last_name']; ?>, <?php echo $row_rsActiveMembers['first_name']; ?></a> </td>
                <td colspan="2">&nbsp; </td>
                <td nowrap="nowrap"><?php echo $row_rsActiveMembers['school']; ?></td>
                <td nowrap="nowrap">&nbsp;</td>
                <td nowrap="nowrap"><?php echo login($row_rsActiveMembers['access']); ?> </td>
                <td nowrap="nowrap"><div align="center"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></div></td>
              </tr>
              <?php } while ($row_rsActiveMembers = mysql_fetch_assoc($rsActiveMembers)); ?>
            <tr>
              <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <div spry:region="ds1">
            <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
              <tr>
                <th spry:sort="last_name">Last_name</th>
                <th spry:sort="first_name">First_name</th>
                <th spry:sort="school">School</th>
                <th spry:sort="access">Access</th>
              </tr>
              <tr spry:repeat="ds1" spry:setrow="ds1" spry:odd="oddrow" spry:even="evenrow" spry:hover="hover">
                <td>{last_name}</td>
                <td>{first_name}</td>
                <td>{school}</td>
                <td>{access}</td>
              </tr>
            </table>
          </div>
          <p>&nbsp;</p>
        </div>
        <div class="TabbedPanelsContent">
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <td colspan="8" class="tableTop">&nbsp;</td>
            </tr>
            <tr>
              <th>Name</th>
              <th>&nbsp;</th>
              <th>Title</th>
              <th>&nbsp;</th>
              <th nowrap="nowrap">School</th>
              <th>&nbsp;</th>
              <th>Access</th>
              <th><div align="center"></div></th>
            </tr>
            <tr  class="tableRowColor">
              <td nowrap="nowrap"><a href="#">Lovett, Eddie</a> </td>
              <td>&nbsp;</td>
              <td nowrap="nowrap">Assistant Director </td>
              <td>&nbsp;</td>
              <td nowrap="nowrap">NC State </td>
              <td nowrap="nowrap">&nbsp;</td>
              <td nowrap="nowrap">Access 1 - Super Admin </td>
              <td nowrap="nowrap"><div align="center"><img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" /></div></td>
            </tr>
            <tr>
              <td colspan="8" nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
          </table>
        </div>
        <div class="TabbedPanelsContent">Content 3</div>
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
mysql_free_result($rsActiveMembers);
?>
