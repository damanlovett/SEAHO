<?php
// technocurve arc 3 php bv block1/3 start
$color1 = "#FFFFFF";
$color2 = "#E9E9E9";
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
<?php require_once('../includefiles/initEmails.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>

<?php 

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addmember")) {
  $insertSQL = sprintf("INSERT INTO users (user_id, first_name, last_name, email, password, `access`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "text"),
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['access'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}

// New Member email
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addmember")) {

NewMemberEmail($_POST['first_name'],$_POST['email'],$_POST['password']);

}

// Delete Member

if (isset($_GET['delete'])) {

	DeleteRecord("users","user_id");
	
}

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
-->
</style>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header">
  <?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadUserAdmin">User Management</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form id="addmember" name="addmember" method="POST" action="<?php echo $editFormAction; ?>">
            <table border="0" cellpadding="5" cellspacing="0" bordercolor="#DEDEDE">
              <tr>
                <td><span class="style1">
                  <label for="first_name"><strong>First Name</strong></label>
                </span></td>
                <td><input type="text" name="first_name" id="first_name" /></td>
                <td>&nbsp;</td>
                <td><label for="last_name"><strong>Last Name</strong></label></td>
                <td><input name="last_name" type="text" id="last_name" size="35" /></td>
              </tr>
              <tr>
                <td><span class="style1">
                  <label for="access"><strong>Access</strong></label>
                </span></td>
                <td><select name="access" id="access">
                  <option value="3" selected="selected">Member</option>
                  <option value="2">Administrator</option>
                </select></td>
                <td>&nbsp;</td>
                <td><label for="email"><span id="sprytextfield2"><span class="formlabel"><strong>Email</strong></span></span></label></td>
                <td><span id="sprytextfield">
                  <input type="text" name="email" id="email" size="35" />
                </span>
                  <input name="user_id" type="hidden" id="user_id" value="<?php echo create_guid();?>" />
                  <input name="password" type="hidden" id="password" value="<?php echo createPassword();?>" />
                  <input name="MM_insert" type="hidden" id="MM_insert" value="addmember" /></td>
              </tr>
              <tr>
                <td colspan="5"><label for="email">
                <input type="submit" name="button2" id="button2" value="Add New User" onclick="TabbedPanels1.showPanel(1)"/>
                <?php if(isset($_POST['button'])) { echo "<p><div class='homepageBlocks'>".$_POST['first_name']." ".$_POST['last_name']." has been created</div></p>";}?>
                </label></td>
              </tr>
            </table>
      </form>
    </div>
<br />
<br />

    <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Active Members</li>
      </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent">
          <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
            <tr>
              <td class="tableTop">&nbsp;<?php echo ($startRow_rsActiveMembers + 1) ?> to <?php echo min($startRow_rsActiveMembers + $maxRows_rsActiveMembers, $totalRows_rsActiveMembers) ?> of <?php echo $totalRows_rsActiveMembers ?> </td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td colspan="2" class="tableTop">&nbsp;
                  <?php if ($pageNum_rsActiveMembers > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, 0, $queryString_rsActiveMembers); ?>"><img src="../images/First.gif" border="0" /></a>
                    <?php } // Show if not first page ?>
                &nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, max(0, $pageNum_rsActiveMembers - 1), $queryString_rsActiveMembers); ?>"><img src="../images/Previous.gif" border="0" /></a>
                  <?php } // Show if not first page ?>
                &nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers < $totalPages_rsActiveMembers) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, min($totalPages_rsActiveMembers, $pageNum_rsActiveMembers + 1), $queryString_rsActiveMembers); ?>"><img src="../images/Next.gif" border="0" /></a>
                  <?php } // Show if not last page ?>
                &nbsp;&nbsp;
                <?php if ($pageNum_rsActiveMembers < $totalPages_rsActiveMembers) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rsActiveMembers=%d%s", $currentPage, $totalPages_rsActiveMembers, $queryString_rsActiveMembers); ?>"><img src="../images/Last.gif" border="0" /></a>
                  <?php } // Show if not last page ?>
              </td>
            </tr>
            <tr>
              <th>Name</th>
              <th>&nbsp;</th>
              <th>Institution</th>
              <th>&nbsp;</th>
              <th>Access</th>
              <th><div align="center">&nbsp;</div></th>
            </tr>
            <?php do { ?>
              <tr <?php 
// technocurve arc 3 php bv block2/3 start
echo " style=\"background-color:$color\"";
// technocurve arc 3 php bv block2/3 end
?>  class="tableRowColor">
                <td nowrap="nowrap">
                <?php if($row_rsActiveMembers['access']!=1){?>
                <a href="details.php?recordID=<?php echo $row_rsActiveMembers['user_id']; ?>">
				<?php echo $row_rsActiveMembers['last_name']; ?>, <?php echo $row_rsActiveMembers['first_name']; ?></a>
                <?php } else { ?>
                <?php echo $row_rsActiveMembers['last_name']; ?>, <?php echo $row_rsActiveMembers['first_name']; ?>
                <?php }?>
                 </td>
                <td>&nbsp;</td>
                <td nowrap="nowrap"><?php echo $row_rsActiveMembers['school']; ?></td>
                <td nowrap="nowrap">&nbsp;</td>
                <td nowrap="nowrap"><?php echo login($row_rsActiveMembers['access']); ?> </td>
                <td nowrap="nowrap"><div title="Set to Inactive" align="center"><a href="index.php?delete=<?php echo $row_rsActiveMembers['user_id']; ?>">
                <?php if($row_rsActiveMembers['access']!=1){?>
                <img src="../images/imgAdminDelete.gif" alt="Delete" width="14" height="14" />
                <?php }?>
                </a></div></td>
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
              <?php } while ($row_rsActiveMembers = mysql_fetch_assoc($rsActiveMembers)); ?>
            <tr>
              <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
            </tr>
          </table>
        </div>
        </div>
    </div>
    <br />
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

mysql_free_result($rsSearch);

mysql_free_result($rsActiveMembers);
?>