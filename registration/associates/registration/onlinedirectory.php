<?php require_once('../../../Connections/CMS.php'); ?>
<?php require_once('../../includefiles/initAssociates.php'); ?>

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

$colname_rsRegistrations = "-1";
if (isset($_SESSION['userID'])) {
  $colname_rsRegistrations = $_SESSION['userID'];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistrations = sprintf("SELECT associate_registrations.registration_id, associate_registrations.conference_id, associate_registrations.associate_id, conference.conference_name, conference.start_date, conference.end_date,  associate_registrations.status, conference.viewable FROM associate_registrations, conference WHERE associate_registrations.associate_id = %s AND  associate_registrations.conference_id = conference.conference_id AND associate_registrations.deleted=0", GetSQLValueString($colname_rsRegistrations, "text"));
$rsRegistrations = mysql_query($query_rsRegistrations, $CMS) or die(mysql_error());
$row_rsRegistrations = mysql_fetch_assoc($rsRegistrations);
$totalRows_rsRegistrations = mysql_num_rows($rsRegistrations);

$KTColParam1_rsRegistrationExcel = "0";
if (isset($_GET["recordID"])) {
  $KTColParam1_rsRegistrationExcel = $_GET["recordID"];
}
mysql_select_db($database_CMS, $CMS);
$query_rsRegistrationExcel = sprintf("SELECT delegate.first_name, delegate.last_name, delegate.institution, delegate.title, delegate.email, delegate.phone, delegate_registrations.career_status, delegate_registrations.primary_area, delegate.address, delegate.city, delegate.`state`, delegate.zip FROM (delegate_registrations LEFT JOIN delegate ON delegate.delegate_id=delegate_registrations.delegate_id) WHERE delegate_registrations.conference_id=%s AND delegate_registrations.status='Confirmed'", GetSQLValueString($KTColParam1_rsRegistrationExcel, "text"));
$rsRegistrationExcel = mysql_query($query_rsRegistrationExcel, $CMS) or die(mysql_error());
$row_rsRegistrationExcel = mysql_fetch_assoc($rsRegistrationExcel);
$totalRows_rsRegistrationExcel = mysql_num_rows($rsRegistrationExcel);

//Export to Excel Server Behavior
if (isset($_GET['excel'])&&($_GET['excel']=="yes")){
$lang=(strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'],",")===false)?$_SERVER['HTTP_ACCEPT_LANGUAGE']:substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'],","));
$semi_array=array("af","zh-hk","zh-mo","zh-cn","zh-sg","zh-tw","fr-ch","de-li","de-ch","it-ch","ja","ko","es-do","es-sv","es-gt","es-hn","es-mx","es-ni","es-pa","es-pe","es-pr","sw");
$delim=(in_array($lang,$semi_array) || substr_count($lang,"en")>0)?",":";";
$output="";
$include_hdr="1";
if($include_hdr=="1"){
	$totalColumns_rsRegistrationExcel=mysql_num_fields($rsRegistrationExcel);
	for ($x=0; $x<$totalColumns_rsRegistrationExcel; $x++) {
		if($x==$totalColumns_rsRegistrationExcel-1){$comma="";}else{$comma=$delim;}
		$output = $output.(ereg_replace("_", " ",mysql_field_name($rsRegistrationExcel, $x))).$comma;
	}
	$output = $output."\r\n";
}

do{$fixcomma=array();
    foreach($row_rsRegistrationExcel as $r){array_push($fixcomma,ereg_replace($delim,"¸",$r));}
    $line = join($delim,$fixcomma);
    $line=ereg_replace("\r\n", " ",$line);
    $line = "$line\n";
    $output=$output.$line;}while($row_rsRegistrationExcel = mysql_fetch_assoc($rsRegistrationExcel));
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=delegate_report.csv");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", false);
echo $output;
die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO CMS Home</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
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
        <?php require_once('../../includefiles/headerAssociateHome.php'); ?>
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
      <h1>Delegate Information</h1>
      <p>The use of this data is for the sole   purpose of providing literature to SEAHO delegates prior to and during the   conference. You also agree that you  will not give, sell or otherwise distribute the data   to others outside of your company. </p>
      
      <?php if ($totalRows_rsRegistrations > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
          <tr>
            <td class="tableTop"><?php echo $totalRows_rsRegistrations ?> Registration(s)</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
            <td class="tableTop">&nbsp;</td>
          </tr>
          <tr>
            <th>Conference</th>
            <th>&nbsp;</th>
            <th>Dates</th>
            <th>&nbsp;</th>
            <th>Status</th>
            <th colspan="2">Delegate Information</th>
          </tr>
          <?php do { ?>
              <tr>
                <td class="tablerows"><?php echo $row_rsRegistrations['conference_name']; ?></td>
                <td class="tablerows">&nbsp;</td>
                <td class="tablerows"><?php echo basicDate($row_rsRegistrations['start_date']); ?> - <?php echo basicDate($row_rsRegistrations['end_date']); ?></td>
                <td class="tablerows">&nbsp;</td>
                <td class="tablerows"><?php echo $row_rsRegistrations['status']; ?></td>
                <td colspan="2" valign="middle" class="tablerows"> 
                  &nbsp;
                  <?php if(($row_rsRegistrations['status']=="Confirmed") AND ($row_rsRegistrations['viewable']==1)) {?>
                  <a href="onlinedirectory.php?recordID=<?php echo $row_rsRegistrations['conference_id']; ?>&amp;excel=yes"><img src="../../images/imgdownloadred.gif" alt="download" width="14" height="14" /></a>
                  <?php } ?>                  &nbsp;                </td>
              </tr>
              <?php } while ($row_rsRegistrations = mysql_fetch_assoc($rsRegistrations)); ?>
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
  <?php if ($totalRows_rsRegistrations == 0) { // Show if recordset empty ?>
          <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableDetails">
            <tr>
              <td class="tableTop"><?php echo $totalRows_rsRegistrations ?> Registration(s)</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
              <td class="tableTop">&nbsp;</td>
            </tr>
            <tr>
              <th>Conference</th>
              <th>&nbsp;</th>
              <th>Dates</th>
              <th>&nbsp;</th>
              <th>Status</th>
              <th colspan="2">Directory</th>
            </tr>
            <tr>
              <td colspan="7" class="tablerows">You have no registrations in the system.</td>
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
mysql_free_result($rsRegistrations);

mysql_free_result($rsRegistrationExcel);
?>
