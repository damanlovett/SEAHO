<?php require_once('../../Connections/Awards.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO awards (award_id, award, `year`, `description`, nomination, accepting, visible, created_on, created_by) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['award_id'], "text"),
                       GetSQLValueString($_POST['award'], "text"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['nomination'], "text"),
                       GetSQLValueString($_POST['accepting'], "int"),
                       GetSQLValueString($_POST['visible'], "int"),
                       GetSQLValueString($_POST['created_on'], "date"),
                       GetSQLValueString($_POST['created_by'], "text"));

  mysql_select_db($database_Awards, $Awards);
  $Result1 = mysql_query($insertSQL, $Awards) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Awards, $Awards);
$query_rsAwards = "SELECT * FROM awards WHERE awards.deleted=0";
$rsAwards = mysql_query($query_rsAwards, $Awards) or die(mysql_error());
$row_rsAwards = mysql_fetch_assoc($rsAwards);
$totalRows_rsAwards = mysql_num_rows($rsAwards);
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
<script type="text/javascript" src="../includefiles/help.js"></script>
<link href="../styles/help.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadstate">Awards Page Manager</span> <!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation"></div>
    
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="tableDetails">
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="labelsDetails">Award Name:</td>
          <td><input type="text" name="award" value="" size="50" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="labelsDetails"><strong><a href="#" class="hintanchor" onmouseover="showhint('This sets the nomination forms for the current year.', this, event, '150px')">[?]</a></strong>Current Year:</td>
          <td><select name="year">
              <option value="2007" <?php if (!(strcmp(2007, ""))) {echo "SELECTED";} ?>>2007</option>
              <option value="2008" <?php if (!(strcmp(2008, ""))) {echo "SELECTED";} ?>>2008</option>
              <option value="2009" <?php if (!(strcmp(2009, ""))) {echo "SELECTED";} ?>>2009</option>
              <option value="2010" <?php if (!(strcmp(2010, ""))) {echo "SELECTED";} ?>>2010</option>
              <option value="2011" <?php if (!(strcmp(2011, ""))) {echo "SELECTED";} ?>>2011</option>
              <option value="2012" <?php if (!(strcmp(2012, ""))) {echo "SELECTED";} ?>>2012</option>
              <option value="2013" <?php if (!(strcmp(2013, ""))) {echo "SELECTED";} ?>>2013</option>
              <option value="2014" <?php if (!(strcmp(2014, ""))) {echo "SELECTED";} ?>>2014</option>
              <option value="2015" <?php if (!(strcmp(2015, ""))) {echo "SELECTED";} ?>>2015</option>
            </select>          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap" class="labelsDetails">Description:</td>
          <td><textarea name="description" cols="50" rows="10"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="top" nowrap="nowrap" class="labelsDetails"><strong><a href="#" class="hintanchor" onmouseover="showhint('This information will display above the text box on the nomination form.', this, event, '150px')">[?]</a></strong>Nomination Info:</td>
          <td><textarea name="nomination" cols="50" rows="8"></textarea>          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="labelsDetails"><strong><a href="#" class="hintanchor" onmouseover="showhint('Setting this to yes will allow nomination submissions.', this, event, '150px')">[?]</a></strong>Accepting:</td>
          <td><select name="accepting">
              <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Yes</option>
              <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>No</option>
            </select>          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="labelsDetails"><strong><a href="#" class="hintanchor" onmouseover="showhint('Setting this to yes will allow the award to be visible on the Awards Information page.', this, event, '150px')">[?]</a></strong>Visible:</td>
          <td><select name="visible">
              <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Yes</option>
              <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>No</option>
            </select>          </td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="labelsDetails">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="award_id" value="<?php echo create_guid(); ?>" />
      <input type="hidden" name="created_on" value="<?php echo $systemDate; ?>" />
      <input type="hidden" name="created_by" value="<?php echo $_SESSION['display_name']; ?>" />
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
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
?>