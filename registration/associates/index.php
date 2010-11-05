<?php require_once('../../Connections/CMS.php'); ?>
<?php

ob_start();
session_start();

// Set access point for system
$_SESSION['accesspoint'] = "CMS";


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

$colname_rsErrorMessage = "-1";
if (isset($_GET['error'])) {
  $colname_rsErrorMessage = $_GET['error'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsErrorMessage = sprintf("SELECT * FROM sys_errors WHERE error_id = %s", GetSQLValueString($colname_rsErrorMessage, "int"));
$rsErrorMessage = mysql_query($query_rsErrorMessage, $CMS) or die(mysql_error());
$row_rsErrorMessage = mysql_fetch_assoc($rsErrorMessage);
$totalRows_rsErrorMessage = mysql_num_rows($rsErrorMessage);

mysql_select_db($database_CMS, $CMS);
$query_rsAssociateList = "SELECT associate.org_name, associate.email, associate.active FROM associate WHERE associate.deleted=0 AND associate.active=1 ORDER BY associate.org_name";
$rsAssociateList = mysql_query($query_rsAssociateList, $CMS) or die(mysql_error());
$row_rsAssociateList = mysql_fetch_assoc($rsAssociateList);
$totalRows_rsAssociateList = mysql_num_rows($rsAssociateList);

mysql_select_db($database_CMS, $CMS);
$query_rsConferenceList = "SELECT conference.conference_name, conference.conference_theme, conference.location, DATE_FORMAT(conference.start_date,'%M %d, %Y') AS start_date, DATE_FORMAT(conference.end_date,'%M %d, %Y') AS end_date, conference.event_type, associate_reg_info.id, associate_reg_info.form_id, associate_reg_info.conference_id, associate_reg_info.accepting_registrations, DATE_FORMAT(associate_reg_info.registration_begins,'%M %d, %Y') AS reg_begins,DATE_FORMAT( associate_reg_info.registration_ends,'%M %d, %Y') AS reg_ends, associate_reg_info.late_registration FROM conference, associate_reg_info WHERE associate_reg_info.conference_id = conference.conference_id AND associate_reg_info.accepting_registrations =1";
$rsConferenceList = mysql_query($query_rsConferenceList, $CMS) or die(mysql_error());
$row_rsConferenceList = mysql_fetch_assoc($rsConferenceList);
$totalRows_rsConferenceList = mysql_num_rows($rsConferenceList);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../styles/cmsMain.css" rel="stylesheet" type="text/css" /><!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
        <?php require_once('../includefiles/headerAssociateHome.php'); ?>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><!-- InstanceBeginEditable name="leftNav" -->
      <fieldset>
      <legend>Important Links</legend>
      <a href="#">Calendar of Events </a><a href="#">Resources</a><a href="#">2007 Conference </a><a href="#">Southern Placement Exchange </a><a href="#">Online Directory </a><a href="#">SEAHO Report </a><a href="#">Resources</a>
      </fieldset>
      <!-- InstanceEndEditable --><img src="../../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><!-- InstanceBeginEditable name="mainContent" -->
      <h3><strong>SEAHO Associate Registration</strong></h3>
      <p> Welcome to the SEAHO's Conference Manager. Please log into the system to view your account. If you do not have an account please visit our <a href="account/new.php">New Associate Account</a> page.</p>
      
      <?php if ($totalRows_rsConferenceList > 0) { // Show if recordset not empty ?>
        <p>Registration is now open for the following Conferences:        </p>
        <?php do { ?>
        <p class="lineHeight"><strong><?php echo $row_rsConferenceList['conference_name']; ?>&nbsp;
	      <?php if(isset($row_rsConferenceList['conference_theme'])) { // Show if there is a theme ?>
	      - &quot;<?php echo $row_rsConferenceList['conference_theme']; ?>&quot;
        
          <?php }?>
        </strong><br />
          <?php echo $row_rsConferenceList['location']; ?>, <?php echo $row_rsConferenceList['start_date']; ?> - <?php echo $row_rsConferenceList['end_date']; ?><br />
        Registration: <?php echo $row_rsConferenceList['reg_begins']; ?> - <?php echo $row_rsConferenceList['reg_ends']; ?></p>
        <?php } while ($row_rsConferenceList = mysql_fetch_assoc($rsConferenceList)); ?>
        <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_rsConferenceList == 0) { // Show if recordset empty ?>
        <p>Currently, there are no Conferences open for Registration</p>
        <?php } // Show if recordset empty ?>
      
        </p>
      <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>

  <tr>
    <td><div id="loginbox">
      <div>
              <div align="center">
                <?php if(isset($_GET['error'])) { echo "<p><span class='denied'>".$row_rsErrorMessage['error_title']."</span></p>";}?>
              </div>
            <form id="login" name="login" method="post" action="/registration/associates/home.php">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tbody>
              <tr>

              <td nowrap="nowrap"><label for="textfield">Email Address:</label></td>
              <td><input name="associateemail" type="text" class="smallbox" id="associateemail" value="" size="40"></td>
            </tr>
            <tr>
              <td nowrap="nowrap"><label for="label">Password:</label></td>
              <td><input name="password" class="smallbox" id="label" size="40" type="password"></td>
            </tr>
            <tr>

              <td>&nbsp;</td>
              <td><input name="Submit" class="smalltextbox" value="Login »»" type="submit">
                <a href="forgot.php">Forgot Password? </a></td>
            </tr>
          </tbody></table>
          </form>
          <script language="JavaScript">
<!--

document.login.associateemail.focus();

//-->
</script>
        </div>

    </div></td>
  </tr>
</tbody></table>
      </p>
      <p><strong>Registered Associates<br />
      </strong>If your organization is listed below, please select the name  of the organization to to retrieve your password.<br />
      </p>
      <form id="form1" name="form1" method="post" action="forgot.php">
        <table border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td><label>Organization Name: </label></td>
            <td><select name="email" id="email">
              <option value="">------------------------</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsAssociateList['email']?>"><?php echo $row_rsAssociateList['org_name']?></option>
              <?php
} while ($row_rsAssociateList = mysql_fetch_assoc($rsAssociateList));
  $rows = mysql_num_rows($rsAssociateList);
  if($rows > 0) {
      mysql_data_seek($rsAssociateList, 0);
	  $row_rsAssociateList = mysql_fetch_assoc($rsAssociateList);
  }
?>
                                    </select></td>
            <td><input type="submit" name="button" id="button" value="Go" /></td>
          </tr>
        </table>
            <label for="button"></label>
      </form>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsAssociateList);

mysql_free_result($rsConferenceList);
?>
