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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE cholist SET `State`=%s, College=%s, Location=%s, `Chief Housing Officer`=%s, Title=%s, `Email Address`=%s, `Mailing Address`=%s, `Address 2`=%s, Phone=%s WHERE id=%s",
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['College'], "text"),
                       GetSQLValueString($_POST['Location'], "text"),
                       GetSQLValueString($_POST['Chief_Housing_Officer'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Email_Address'], "text"),
                       GetSQLValueString($_POST['Mailing_Address'], "text"),
                       GetSQLValueString($_POST['Address_2'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Directory, $Directory);
  $Result1 = mysql_query($updateSQL, $Directory) or die(mysql_error());
}

$colname_rsEditCHO = "-1";
if (isset($_GET['recordID'])) {
  $colname_rsEditCHO = (get_magic_quotes_gpc()) ? $_GET['recordID'] : addslashes($_GET['recordID']);
}
mysql_select_db($database_Directory, $Directory);
$query_rsEditCHO = sprintf("SELECT * FROM cholist WHERE id = %s", GetSQLValueString($colname_rsEditCHO, "int"));
$rsEditCHO = mysql_query($query_rsEditCHO, $Directory) or die(mysql_error());
$row_rsEditCHO = mysql_fetch_assoc($rsEditCHO);
$totalRows_rsEditCHO = mysql_num_rows($rsEditCHO);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CHO Edit</title>
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="pageInformation">
	<?php if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {?>

<p class="homepageBlocks">CHO UPDATED</p>

	<?php }?>
	
	<p><form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="400" border="0" align="left" cellpadding="5" cellspacing="0">
    <tr valign="baseline">
      <td nowrap align="right"><strong>Chief Housing Officer:</strong></td>
      <td><input type="text" name="Chief_Housing_Officer" value="<?php echo $row_rsEditCHO['Chief Housing Officer']; ?>" size="45"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Title:</strong></td>
      <td><input type="text" name="Title" value="<?php echo $row_rsEditCHO['Title']; ?>" size="45"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>College:</strong></td>
      <td><input type="text" name="College" value="<?php echo $row_rsEditCHO['College']; ?>" size="45"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Email Address:</strong></td>
      <td><input type="text" name="Email_Address" value="<?php echo $row_rsEditCHO['Email Address']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Location:</strong></td>
      <td><input type="text" name="Location" value="<?php echo $row_rsEditCHO['Location']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Address 1:</strong></td>
      <td><input type="text" name="Mailing_Address" value="<?php echo $row_rsEditCHO['Mailing Address']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Address 2:</strong></td>
      <td><input type="text" name="Address_2" value="<?php echo $row_rsEditCHO['Address 2']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>State:</strong></td>
      <td><select name="State" id="State">
        <option value="" selected="selected" <?php if (!(strcmp("", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Choose a State</option>
        <option value="AL" <?php if (!(strcmp("AL", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Alabama</option>
        <option value="AK" <?php if (!(strcmp("AK", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Alaska</option>
        <option value="AZ" <?php if (!(strcmp("AZ", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Arizona</option>
        <option value="AR" <?php if (!(strcmp("AR", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Arkansas</option>
        <option value="CA" <?php if (!(strcmp("CA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>California</option>
        <option value="CO" <?php if (!(strcmp("CO", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Colorado</option>
        <option value="CT" <?php if (!(strcmp("CT", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Connecticut</option>
        <option value="DE" <?php if (!(strcmp("DE", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Delaware</option>
        <option value="DC" <?php if (!(strcmp("DC", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>District Of Columbia</option>
        <option value="FL" <?php if (!(strcmp("FL", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Florida</option>
        <option value="GA" <?php if (!(strcmp("GA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
        <option value="HI" <?php if (!(strcmp("HI", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Hawaii</option>
        <option value="ID" <?php if (!(strcmp("ID", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Idaho</option>
        <option value="IL" <?php if (!(strcmp("IL", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Illinois</option>
        <option value="IN" <?php if (!(strcmp("IN", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Indiana</option>
        <option value="IA" <?php if (!(strcmp("IA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Iowa</option>
        <option value="KS" <?php if (!(strcmp("KS", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Kansas</option>
        <option value="KY" <?php if (!(strcmp("KY", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Kentucky</option>
        <option value="LA" <?php if (!(strcmp("LA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Louisiana</option>
        <option value="ME" <?php if (!(strcmp("ME", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Maine</option>
        <option value="MD" <?php if (!(strcmp("MD", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Maryland</option>
        <option value="MA" <?php if (!(strcmp("MA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Massachusetts</option>
        <option value="MI" <?php if (!(strcmp("MI", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Michigan</option>
        <option value="MN" <?php if (!(strcmp("MN", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Minnesota</option>
        <option value="MS" <?php if (!(strcmp("MS", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Mississippi</option>
        <option value="MO" <?php if (!(strcmp("MO", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Missouri</option>
        <option value="MT" <?php if (!(strcmp("MT", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Montana</option>
        <option value="NE" <?php if (!(strcmp("NE", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Nebraska</option>
        <option value="NV" <?php if (!(strcmp("NV", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Nevada</option>
        <option value="NH" <?php if (!(strcmp("NH", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>New Hampshire</option>
        <option value="NJ" <?php if (!(strcmp("NJ", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>New Jersey</option>
        <option value="NY" <?php if (!(strcmp("NY", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>New York</option>
        <option value="NC" <?php if (!(strcmp("NC", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>North Carolina</option>
        <option value="ND" <?php if (!(strcmp("ND", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>North Dakota</option>
        <option value="OH" <?php if (!(strcmp("OH", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Ohio</option>
        <option value="OK" <?php if (!(strcmp("OK", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Oklahoma</option>
        <option value="OR" <?php if (!(strcmp("OR", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="PA" <?php if (!(strcmp("PA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Pennsylvania</option>
        <option value="OR" <?php if (!(strcmp("OR", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Oregon</option>
        <option value="RI" <?php if (!(strcmp("RI", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Rhode Island</option>
        <option value="SC" <?php if (!(strcmp("SC", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>South Carolina</option>
        <option value="SD" <?php if (!(strcmp("SD", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>South Dakota</option>
        <option value="TN" <?php if (!(strcmp("TN", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Tennessee</option>
        <option value="TX" <?php if (!(strcmp("TX", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Texas</option>
        <option value="UT" <?php if (!(strcmp("UT", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Utah</option>
        <option value="VT" <?php if (!(strcmp("VT", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Vermont</option>
        <option value="VA" <?php if (!(strcmp("VA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Virginia</option>
        <option value="WA" <?php if (!(strcmp("WA", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Washington</option>
        <option value="WV" <?php if (!(strcmp("WV", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>West Virginia</option>
        <option value="WI" <?php if (!(strcmp("WI", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Wisconsin</option>
        <option value="WY" <?php if (!(strcmp("WY", $row_rsEditCHO['State']))) {echo "selected=\"selected\"";} ?>>Wyoming</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Phone:</strong></td>
      <td><input type="text" name="Phone" value="<?php echo $row_rsEditCHO['Phone']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update CHO"></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $row_rsEditCHO['id']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_rsEditCHO['id']; ?>">
</form></p>
      <p class="cleartable"></p>
</div>
<p><input type=button value="Close Window" onClick="javascript:window.close();"></p>
</body>
</html>
<?php
mysql_free_result($rsEditCHO);
?>
