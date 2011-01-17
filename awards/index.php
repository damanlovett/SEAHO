<?php require_once('../Connections/Awards.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

$colname_rsWinners = "-1";
if (isset($_GET['award_year'])) {
  $colname_rsWinners = $_GET['award_year'];
}
//$colname_rsWinners = "-1";
//if (isset()) {
//  $colname_rsWinners = (get_magic_quotes_gpc()) ?  : addslashes();
//}
mysql_select_db($database_Awards, $Awards);
$query_rsWinners = sprintf("SELECT awards.award, awards.`year`, nominations.first_name, nominations.last_name, nominations.`position`, nominations.institution FROM awards, nominations WHERE awards.`year`=%s AND awards.award_id=nominations.award_id AND nominations.winner=1", GetSQLValueString($colname_rsWinners, "text"));
$rsWinners = mysql_query($query_rsWinners, $Awards) or die(mysql_error());
$row_rsWinners = mysql_fetch_assoc($rsWinners);
$totalRows_rsWinners = mysql_num_rows($rsWinners);

mysql_select_db($database_Awards, $Awards);
$query_rsAwardYear = "SELECT * FROM awards GROUP BY awards.`year` ORDER BY awards.`year` DESC";
$rsAwardYear = mysql_query($query_rsAwardYear, $Awards) or die(mysql_error());
$row_rsAwardYear = mysql_fetch_assoc($rsAwardYear);
$totalRows_rsAwardYear = mysql_num_rows($rsAwardYear);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - Overview</title>
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
<h2> Awards and Scholarships</h2>
<p><a href="LMAwards.php">Awards and Past Recipients</a> // <a href="award_information.php">Award Nomination Information</a> // <a href="Humanitarian_award_form.php">Nomination For the 
  Humanitarian Recognition Award</a> // <a href="../pdfs/SEAHOfeewaiverapplication2006.pdf">Fee Waiver Scholarship 
    Application</a></p>
<p>All nomination and application materials must be submitted by January 21, 2011. </p>
<p align="left">The Awards and Recognition committee invites the
  SEAHO membership to recognize our region’s best professional and graduate staff 
  members. This is your opportunity to show your appreciation to your peers and 
  colleagues. The following awards will be presented at the annual conference:</p>
<p><b><a name="awards" id="awards"></a>Awards</b></p>
<p align="left"><span class="boldBlueTitle"><b><i>The Humanitarian Recognition Award</i></b></span><b><i><br />
</i></b>This award recognizes an individual or individuals within SEAHO who has/have gone above and beyond the call of duty for a student in crisis by demonstrating physical effort, spiritual commitment, or act of bravery, determination, and courage. The recipients for this recognition must be a member of SEAHO; have two letters of support from a colleague, supervisor, or persons who they supervise, and a letter from the Chief Housing Officer, Dean of Students, or Assistant/Associate/Vice President for Student Affairs showing support. </p>
<p><strong><a name="collaboration" id="collaboration"></a>The Housing and Academic Collaboration Award</strong></p>
<p>The Housing and Academic Collaboration Award was established in 2006  and will be first presented at the annual conference in Savannah,  Georgia in 2008! This award is presented to a housing department that  currently has programs in place where academic affairs are  intentionally involved in on-campus residential communities. The  Housing and Academic Collaboration Award recognizes a program and/or  community that involve collaboration between Housing and Academic  Affairs. The selection criterion is based on the following:</p>
<p>* Providing an outline of academic initiatives and/or ongoing programming <br />
  * Providing a description of the academic initiative and academic outcomes <br />
  * Providing the results of the academic initiative (i.e., success  stories, statistics on academic improvement of residents and retention  rates within the residential community and/or the institution) <br />
* The nomination has to include the housing and academic representative of the program</p>
<p><b><i><a name="Beene" id="Beene"></a><span class="boldBlueTitle">The Charles W. Beene Memorial Award</span><br />
</i></b>SEAHO's first major award, created in 1982, the Charles W. Beene
Memorial Award is presented annually to the individual judged to have
contributed most to the success of SEAHO during the previous year.</p>
<p align="left"><b><i><a name="founders" id="founders"></a><span class="boldBlueTitle">The SEAHO Founders Award</span><br />
</i></b>The Founders Award gives special recognition to an individual
within the Association who, through dedicated service and initiative to SEAHO,
has epitomized the work and endeavors of the founders of the Southeastern
Association of Housing Officers.&nbsp; Recipients for the Founders Award must
meet the following criteria:<br />
<br />
A.&nbsp; Must have actively served in the SEAHO Region as a housing/residence
life professional for at least five years.<br />
B.&nbsp; Must have served on a minimum of two different SEAHO committees or task
forces or been a member of the Governing&nbsp; Council.<br />
C.&nbsp; Must have made contributions to SEAHO and the housing/residence life
profession that are judged to have been instrumental in furthering the
advancement of the organization and the profession it represents.</p>
<p align="left">Each Founders Award nomination should be supported <b> by two
letters of recommendation</b>.&nbsp; Supporting letters of recommendation may not be
from the same institution as the person who made the nomination or from the
nominee's own institution.</p>
<p align="left"><b><i><a name="grimm" id="grimm"></a><span class="boldBlueTitle">The James C. Grimm Outstanding New
Professional Award</span><br />
</i></b>This award&nbsp; is to be presented to a new professional in
Housing/Residence Life who is within his/her first three years of
professional-level employment and has demonstrated outstanding performance to
his/her campus and profession.</p>
<p align="left"><b><i><a name="grad" id="grad"></a><span class="boldBlueTitle">The SEAHO Graduate Student of the
Year Award</span><br />
</i></b>This award gives special recognition to an individual who,
through dedicated service to their home institution, has shown dedication to the
profession and the students that they serve.&nbsp; Candidates for the award must
be in (at least) their second year of graduate work, and must be employed by the
housing department of a SEAHO member institution.</p>
<p align="left"><span class="boldBlueTitle">The SEAHO Outstanding Mid-Level Professional Award</span><em><br />
</em>This award is presented to a mid-level housing professional who supports and mentors entry level and support staff, works to recruit students and retain colleagues in the field, and creates new strategies for connecting with students and improving the department, while sharing their experiences in the field. This professional is dedicated to working with students, the department or profession. The nominee should be involved in state, regional, or national organizations. Nominees should have served in housing or residence life as a professional for at least 7 years.</p>
<p align="left"><a name="service" id="service"></a><span class="boldBlueTitle">The SEAHO Service 
  Award</span><br />
Each year, each SEAHO member institution may recognize one person 
  from their institution to receive a SEAHO Service Award.&nbsp; The award offers 
  the institution an opportunity to recognize a staff member who has made a significant 
contribution to the residence hall students and the housing organization.</p>
<p align="left"><a name="PEACE" id="PEACE"></a><span class="boldBlueTitle">The SEAHO PEACE 
  Award </span>(Providing Educational Advocacy for Cultural Excellence) 
  <br />
  The PEACE Award (Providing Educational Advocacy for Cultural Excellence) is 
  presented annually at the SEAHO conference to a member of a SEAHO institution 
  to honor and recognize outstanding contributions and service to the SEAHO region 
  through advancement of diversity and multiculturalism. Such advancement can 
  be attributed to advocacy, leadership, mentorship, educational initiatives, 
  and programming. The recipient must have been a member of a SEAHO institution 
  for at least one full academic year and will have demonstrated exceptional service 
  in the areas of diversity and multiculturalism on their home campus and/or to 
  SEAHO. Examples include:<br />
  &gt; Encouraging members of underrepresented groups to become involved in the 
  housing profession<br />
  &gt; Promoting a greater understanding of diversity issues (racism, ageism, 
  sexism, gay and lesbian concerns, religious differences, persons with disabilities)<br />
  &gt; Presenting programs on topics of diversity and/or multiculturalism<br />
  &gt; Serving as an ally<br />
  &gt; Mentoring members of underrepresented groups<br />
  &gt; Mentoring young professionals in the area of diversity education<br />
  &gt; Supporting the SEAHO Human Relations Committee<br />
  <br />
  Letters of support from individuals involved in the nominee's work are highly 
  recommended.<br />
</p>
<p align="left"><b><a name="scholarship" id="scholarship"></a>Scholarships </b></p>
<p align="left"><i><b>SEAHO CONFERENCE FEE WAIVER SCHOLARSHIP<br />
</b></i><strong>The deadline is January 21, 2011</strong></p>
<p align="left"><i><b>Program Guidelines</b></i></p>
<ul>
  <li>SEAHO will offer an Annual Conference Fee Waiver Scholarship to up to10 
    delegates. </li>
  <li>Recipient selection is the responsibility of SEAHO.</li>
  <li>The selection process will be supervised by the Awards and Recognition Committee.  </li>
  <li>The Governing Board of SEAHO will establish criteria for eligibility and 
    selection. The criteria are as follows:</li>
</ul>
<p><i><b>Eligibility</b></i></p>
<ol>
  <li>Eligibility shall be limited to: 
    <ol type="a">
      <li> New or renewing professionals (first through third years), or</li>
      <li> Entry level persons, or</li>
      <li>Interns and graduate students</li>
    </ol>
  </li>
  <li>Related Conditions: 
    <ol type="a">
      <li> Ideally, there will be one scholarship recipient per SEAHO state.</li>
    </ol>
  </li>
  <blockquote> 
    <p> Recipients should represent both public and private institutions.</p>
  </blockquote>
</ol>
<p><b>Selection Criteria</b></p>
<p>Successful candidate(s): </p>
<ol type="1">
  <li> Must have shown personal initiative to pursue a career in student affairs 
    and demonstrated competence such as the following: 
    <ol type="a">
      <li> S/he has sought to broaden his/her own base of professional understanding 
        through participation and involvement in other organizations.</li>
      <li> S/he has sought to be a contributing member of the student affairs 
        department by participating in both institutional and departmental committees.      </li>
      <li> S/he has been an outstanding advisor to both students and student groups.</li>
      <li>S/he has sought to broaden his/her own understanding of diverse student 
        needs. </li>
    </ol>
  </li>
  <li> Must submit an application to the Awards and Recognition chair by the prescribed 
    deadline. Applications must include: 
    <ol type="a">
      <li> A letter indicating why he/she is applying.</li>
      <li> A current resume.</li>
      <li> A one page letter of support from his/her Chief Housing or Student 
        Affairs Officer and/or professor</li>
      <li>A completed cover sheet with criteria information.</li>
    </ol>
  </li>
  <li> Must be able to attend the annual conference and participate in a Peer 
    Mentor Program.</li>
  <li> Must be willing to write an account of the conference experience to the 
    SEAHO President following the conclusion of the conference for possible publication.  </li>
</ol>
<p align="left">For more information on awards   and recognition please contact the Chair for the Awards and Recognition   Committee, <?php echo $row_rsChair['first_name']; ?>&nbsp;<?php echo $row_rsChair['last_name']; ?> at (<a href="<?php echo $row_rsChair['user_email']; ?>"><?php echo $row_rsChair['user_email']; ?></a> or <a href="mailto:recognition@seaho.org">recognition@seaho.org</a> ) </p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsWinners);

mysql_free_result($rsAwardYear);

mysql_free_result($rsChair);
?>
