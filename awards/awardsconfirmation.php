<?php require_once('../Connections/Directory.php'); ?>
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
$query_rsChair = "SELECT team_positions.`position`, team_positions.email, users.first_name, users.last_name, users.school FROM team_positions, users WHERE team_positions.Position LIKE '%Awards and Recognition%'  AND team_positions.user_id = users.user_id";
$rsChair = mysql_query($query_rsChair, $Directory) or die(mysql_error());
$row_rsChair = mysql_fetch_assoc($rsChair);
$totalRows_rsChair = mysql_num_rows($rsChair);

mysql_select_db($database_Directory, $Directory);
$query_rsPageInfo = "SELECT * FROM page_info WHERE page_info.page='Awards' AND page_info.deleted=0";
$rsPageInfo = mysql_query($query_rsPageInfo, $Directory) or die(mysql_error());
$row_rsPageInfo = mysql_fetch_assoc($rsPageInfo);
$totalRows_rsPageInfo = mysql_num_rows($rsPageInfo);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - Information</title>
<!-- InstanceEndEditable -->
<link href="../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='../menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='../menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<div class="adanavigation">Skip to <a href="#content">Content</a> or <a href="#pageNav">Page Navigation</a> or <a href="#siteNav">Site Navigation</a></div>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
<?php require_once('../includefiles/header.inc.php'); ?>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><!-- InstanceBeginEditable name="pageBanner" -->
      <div align="center"><img src="../images/banner/bannerawards.jpg" alt="" width="764" height="95" /></div>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td colspan="2" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td width="182" valign="top" id="contentleftmain"><a name="pageNav" id="pageNav"></a><!-- InstanceBeginEditable name="leftNav" -->
      <?php require_once('../includefiles/awards.inc.php'); ?>

      <!-- InstanceEndEditable --><img src="../images/dropshadowlogo.jpg" alt="Seaho Logo" /></td>
    <td width="582" valign="top" id="contentmain"><a name="content" id="content"></a><!-- InstanceBeginEditable name="mainContent" -->
<h2 align="left"> <?php echo $row_rsPageInfo['header']; ?></h2>
<p align="left"><?php echo $row_rsPageInfo['page_info']; ?> </p>
<strong>The Humanitarian Recognition Award </strong>
<br />
This award recognizes an individual or individuals within SEAHO who has/have gone above and beyond the call of duty for a student in crisis by demonstrating physical effort, spiritual commitment, or act of bravery, determination, and courage. The recipients for this recognition must be a member of SEAHO; have two letters of support from a colleague, supervisor, or persons who they supervise, and a letter from the Chief Housing Officer, Dean of Students, or Assistant/Associate/Vice President for Student Affairs showing support. 
<p align="left"><strong>The SEAHO PEACE Award </strong><br />
The PEACE Award (Providing Educational Advocacy for Cultural Excellence) is presented to a member to honor and recognize outstanding contributions and service to the SEAHO region through advancement of diversity and multiculturalism. Such advancement can be attributed to advocacy, leadership, mentorship, educational initiatives, and programming. The recipient must have been a member of a SEAHO institution for at least one full academic year and will have demonstrated exceptional service in the areas of diversity and multiculturalism on their home campus and/or to SEAHO. </p>
<p><strong> The SEAHO Outstanding Mid-Level Professional Award</strong><br />
This award is presented to a mid-level housing professional who supports and mentors entry level and support staff, works to recruit students and retain colleagues in the field, and creates new strategies for connecting with students and improving the department, while sharing their experiences in the field. This professional is dedicated to working with students, the department or profession. The nominee should be involved in state, regional, or national organizations. Nominees should have served in housing or residence life as a professional for at least 7 years.</p>
<p><strong>The Graduate Student of the Year Award</strong><br />
This award gives special recognition to an individual who, through dedicated service to their home institution, has shown dedication to the profession and the students that they serve.&nbsp; Candidates for the award must be in (at least) their second year of graduate work, and must be employed by the housing department of a SEAHO member institution. </p>
<p><strong>The SEAHO Founders Award </strong>
  <br />
This award gives special recognition to an individual who, through dedicated service and initiative to SEAHO, has epitomized the work and endeavors of the founders.&nbsp; Recipients must have actively served in the SEAHO Region as a housing/residence life professional for at least five years; have served on a minimum of two different SEAHO committees or task forces or been a member of the Governing&nbsp;Council; and, have made contributions to SEAHO and the housing/residence life profession that are judged to have been instrumental in furthering the advancement of the organization and the profession it represents. </p>
<p><strong>The James C. Grimm Outstanding New Professional Award </strong><br />
This award is presented to a new professional in Housing/Residence Life who is within his/her first three years of professional-level employment and has demonstrated outstanding performance to his/her campus and profession, therefore demonstrating potential for a successful and effective career in housing. </p>
<p><strong>The SEAHO Service Award </strong>
  <br />
Each year,  all SEAHO member institutions may recognize one person from their institution to receive a SEAHO Service Award.&nbsp; The award offers the institution an opportunity to recognize a staff member who has made a significant contribution to the residence hall students and the housing organization. Please include nominee's name, institution, and address in conjunction with the nominator's address information in the letter/email of nomination. </p>
<p><strong>The Charles W. Beene Memorial Award </strong>
  <br />
This award is presented annually to the individual judged to have contributed most to the success of SEAHO during the previous year. Nominations should state what the nominee has done in support of SEAHO. </p>
<p align="left"><strong>SEAHO CONFERENCE FEE WAIVER SCHOLARSHIP </strong></p>

<p><em>Eligibility </em>: </p>
<p>&#149;&nbsp; Eligibility shall be limited to: new or renewing professionals (first through third years), or entry-level persons, or interns and graduate students. </p>
<p>&#149;&nbsp; Related conditions: ideally, there will be one scholarship recipient per SEAHO state; recipients should represent both public and private institutions (10 delegates total). </p>
<p><em>Selection Criteria </em>: </p>
<p>&#149;&nbsp; Must have shown personal initiative to pursue a career in student affairs and demonstrated competence. </p>
<p>&#149;&nbsp; Must submit an application to the Awards and Recognition chair by the prescribed deadline. </p>
<p>&#149;&nbsp; Must be able to attend the annual conference and participate in a Peer Mentor Program. </p>
<p>Please submit all Award and Scholarship Applications to the address below. For more information regarding SEAHO Awards and Scholarships, please go to <strong>www.SEAHO.org </strong>. </p>
<?php do { ?>
  <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><p><strong><?php echo $row_rsChair['first_name']; ?>&nbsp;<?php echo $row_rsChair['last_name']; ?>, <?php echo $row_rsChair['school']; ?></strong><br />
          Chair, <?php echo $row_rsChair['position']; ?><br />
          <a href="mailto:recognition@seaho.org">recognition@seaho.org</a><a onclick="return !window.open(this.href,'newemail','height=850, width=750, resizable=no, scrollbars=yes');" href="https://webmailcluster.perfora.net/xml/webmail/mailDetail;jsessionid=11637A90DB6C7992B55E3F67DB660527.TC134a?__frame=_top&amp;__lf=AdresseUebernehmenFlow&amp;__sendingdata=1&amp;resyncFolder.Doit=true&amp;resyncFolder.TreeID=leftNaviTree&amp;createMail.Action=create&amp;createMail.To=recognition@seaho.org&amp;__jumptopage=mailNew&amp;__CMD%5BmailDetail%5D:SELWRP=resyncFolder&amp;__CMD%5BmailDetail%5D:SELWRP=createMail"></a><a href="mailto:<?php echo $row_rsChair['seahoemail']; ?>"></a></p>
          <p>&nbsp;</p></td>
      </tr>
      </table>
  <?php } while ($row_rsChair = mysql_fetch_assoc($rsChair)); ?>
<p align="center"> <?php echo $row_rsPageInfo['footer']; ?></p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsChair);

mysql_free_result($rsPageInfo);
?>
