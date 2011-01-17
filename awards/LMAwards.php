<?php require_once('../Connections/Awards.php'); ?>
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

$colname_rsWinners = "-1";
if (isset($_GET['award_year'])) {
  $colname_rsWinners = $_GET['award_year'];
}
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
<title>Awards - LM Awards</title>
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
<h2>Awards, Scholarships, and Resolutions</h2>
<p><a href="2004awards.php">2004   Recipients</a> / <a href="2005awards.php">2005   Recipients</a> / <a href="2006awards.php">2006   Recipients</a></p>
<ul>
  <li><a href="#CBMS">Charles W. Beene Memorial Service Award</a><br />
  </li>
  <li><a href="#SFA">SEAHO Founders Award<br />
  </a></li>
  <li><a href="#humanitarian">The Humanitarian Recognition Award </a><br />
  </li>
  <li><a href="#NewPro">James. C. Grimm Outstanding New Professional Award<br />
  
  </a></li>
  <li><a href="#MidPro">SEAHO Mid Level Professional Award</a><br />
  </li>
  <li><a href="#Peace">The SEAHO PEACE Award</a><br />
  </li>
  <li><a href="#Grad">SEAHO Outstanding Graduate Student Award</a><br />
  </li>
  <li><a href="#Article">SEAHO Report Feature Article of the Year Award</a><br />
  </li>
  <li><a href="#Service">SEAHO Service Awards</a><br />
  </li>
  <li><a href="../pdfs/SEAHOfeewaiverapplication2006.pdf">SEAHO Conference Fee Waiver Scholarship </a><br />
  </li>
  <li>Educational Program Grants <br />
  </li>
  <li><a href="#Resolutions">    SEAHO Resolution of Appreciation</a></li>
</ul>
<hr />
<p><b><a name="CBMS" id="CBMS"></a>CHARLES W. BEENE MEMORIAL SERVICE 
  AWARD</b></p>
<p>At the 1982 SEAHO Conference, the Charles Beene Memorial Service Award was 
  established in memory of Charles Beene, Director of Housing at the University 
  of Mississippi. This award is presented annually to the individual who is judged 
  to have contributed most to the success of SEAHO during the previous year. Nominations 
  should state what the nominee has done in support of SEAHO and include the completed 
  Awards and Recognition Nomination Form.</p>
<p>Past recipients of the Charles W. Beene Memorial Service Award are:</p>
<p>
2009              <strong>Ralphel Smith</strong>, University of Georgia<br />

2008              <strong>Gay Perez</strong>, University of North Carolina-Chapel Hill<br />

2007<strong> Heidi LeCount</strong>, Meredith College<br />

2006              <strong>Steve Stauffer</strong>, University of Kentucky<br />

2005              <strong>Lisa Diekow</strong>, University of Florida & Bob Morton, Georgia Tech<br />

2004              <strong>Tom Kane</strong>, University of South Florida<br />

2003              <strong>Frank Fleming</strong>, University of North Carolina-Charlotte<br />

2002              K<strong>athy Schnolis</strong>, University of Florida<br />

2001<strong> Vera Jackson</strong>, Jackson State University<br />

2000              <strong>Tierza Watts</strong>, University of North Carolina-Wilmington<br />

1999              <strong>Norb Dunke</strong>l, University of Florida<br />

1998              <strong>Tim Coley</strong>, Mercer University<br />

1997              <strong>Gretchen Koehler-Shepley</strong>, University of South Carolina<br />

1996              <strong>Cindy Cassens</strong>, Winthrop University<br />

1995              <strong>Melanie McClellan</strong>, Mississippi State University<br />

1994              <strong>Dick Merritt</strong>, Auburn University at Montgomery<br />

1993              <strong>Gary Kimble</strong>, University of Southern Mississippi<br />

1992              <strong>Tony Cawthon</strong>, Clemson University<br />

1991              <strong>Paula Hulick</strong>, Murray State University<br />

1990              <strong>Gene Luna</strong>, University of Georgia<br />

1989              <strong>Phil Howard</strong>, Clemson University<br />

1988              <strong>Robert Kievtz</strong>, University of Southern Mississippi<br />

1987              <strong>James Grimm</strong>, University of Florida<br />

1986              <strong>James Bowles</strong>, University of Tennessee-Knoxville<br />

1985              <strong>Gary Schwarzmueller</strong>, Georgia Tech<br />

1984              <strong>Robert Stewart</strong>, University of South Carolina<br />

1983              <strong>Doris Collins</strong>, Louisiana State University</p>
<hr />
<p><a name="SFA" id="SFA"></a><b>THE SEAHO FOUNDERS AWARD</b></p>
<p>This award gives special recognition to an individual within the Association 
  who through dedicated service and initiative to SEAHO has epitomized the work 
  and endeavors of the founders of the Southeastern Association of Housing Officers 
  such as Harold Riker, Edith McCollum, John Storey, Donald R. Moore, and Raymond 
  C. King. Nominations may be submitted by any housing/residence life professional 
  who is an active SEAHO member. Each nomination should be supported by two letters 
  of recommendation.</p>
<p>Individuals submitting supporting letters of recommendation may not be from 
  the same institution as the person who made the nomination or from the nominee's 
  own institution.</p>
<p> Criteria for the award are as follows. A nominee:</p>
<ol>
  <li>Must have actively served in the SEAHO region as a housing/residence life 
    professional for at least five years.<br />
  </li>
  <li>Must have served on a minimum of two different SEAHO committees or task 
    forces or have been a member of the Governing Council.<br />
  </li>
  <li>Must have made contributions to SEAHO and housing/residence life profession 
    that are judged to have been instrumental in furthering the advancement of 
    the organization and the profession it represents.</li>
</ol>
<p>Past recipients of the SEAHO Founders Award are:</p>
<p>
2009              <strong>Deb Boykin</strong>, College of William & Mary<br />

2008              <strong>Vickie Hawkins</strong>, Georgia Southern University<br />

2007              <strong>Lorinda Krhut</strong>, University of Mississippi<br />

2006              <strong>Paul Jahr</strong>, Georgia College & State University<br />

2005              <strong>Verna Howell</strong>, Clemson University<br />

2004              <strong>Rita Moser</strong>, Florida State University<br />
2003              <strong>Ruth Ann Harney-Howard</strong>, Morehead State University<br />
2002              <strong>Shannon Staten</strong>, University of Louisville<br />
2001              <strong>Gary Kimble</strong>, University of Southern Mississippi<br />
2000              <strong>Bill Foster</strong>, Mississippi State University<br />
1999              <strong>Jackie Simpson</strong>, University of North Carolina-Charlotte<br />

1998<strong> Gene Luna</strong>, University of South Carolina<br />
1997              <strong>James Grubb</strong>, University of Tennessee-Knoxville<br />
1996              <strong>Doris Collins</strong>, Louisiana State University<br />
1995              <strong>Don Moore</strong>, Emory University<br />
1994              <strong>Ray King</strong>, University of South Florida<br />
1993              <strong>James Grimm</strong>, University of Florida<br />
1992              <strong>Gary Schwarzmueller</strong>, Georgia Tech University</p>
<hr />
<p><b><a name="humanitarian" id="humanitarian"></a>THE HUMANITARIAN RECOGNITION AWARD</b></p>
<p align="left">This award recognizes an individual or individuals within SEAHO who has/have gone above and beyond the call of duty for a student in crisis by demonstrating physical effort, spiritual commitment, or act of bravery, determination, and courage. The recipients for this recognition must be a member of SEAHO; have two letters of support from a colleague, supervisor, or persons who they supervise, and a letter from the Chief Housing Officer, Dean of Students, or Assistant/Associate/Vice President for Student Affairs showing support. </p>
<p>Past recipients of the Humanitarian Recognition Award are: </p>
<p>2009 <strong>Anna Villareal</strong>, Florida State University<br />
  2008 <strong>Residence Life</strong><strong> Staff</strong>, Virginia Tech<br />
  2007 <strong>Ellen Jones</strong> &amp; <strong>Ashley Sieman</strong>, University of North Carolina-Chapel Hill<br />
  2006 <strong>Housing Staff</strong>, Tulane University<br />
  2005 <strong>Kim Fugate</strong>, <strong>Joe Munson</strong>, and <strong>Meggen Sixby</strong>, University of Florida<br />
  2004 <strong>Joline Esterling</strong>, University of Southern Mississippi &amp; <strong>Miguel Hernandez</strong>, Appalachian State University</p>
<hr />
<p><b><a name="NewPro" id="NewPro"></a>JAMES C. GRIMM OUTSTANDING NEW 
PROFESSIONAL IN HOUSING/RESIDENCE LIFE AWARD</b></p>
<p>This award is to be presented to a new professional in Housing/Residence Life 
  who is within his/her first three years of professional-level employment and 
  has demonstrated outstanding performance in that position to his/her campus 
  and profession, therefore demonstrating potential for successful and effective 
  career in housing.</p>
<p>Past recipients of the James C. Grimm Outstanding New Professional Award are:</p>
<p>
2009              <strong>Jen Gresley</strong>, University of Florida & Shane Tedder, University of Kentucky<br />

2008              <strong>Alaina Krebs</strong>, University of North Carolina-Chapel Hill<br />

2007              <strong>Eddie Seavers</strong>, Christopher Newport University<br />

2006              <strong>Robert Davis</strong>, University of Alabama<br />

2005              <strong>Jasmine Johnson</strong>, University of Florida<br />

2004<strong> Ryan Winget</strong>, East Carolina University<br />
2003              <strong>Melissa McDonald</strong>, James Madison University<br />
2002              <strong>Chris Moody</strong>, University of North Carolina-Chapel Hill<br />
2001              <strong>Stephanie Sue Helmers</strong>, University of North Carolina-Wilmington<br />
2000              <strong>Jeff Novak</strong>, East Carolina University<br />
1999              <strong>Gregg Dodd</strong>, Coastal Carolina University<br />
1998              <strong>Janice Gerweck</strong>, University of Florida<br />
1997              <strong>Julie McMahon</strong>, Murray State University<br />
1996              <strong>David Blackburn</strong>, University of North Carolina-Charlotte<br />
1995              <strong>Marnie Volkenant</strong>, University of Southern Mississippi<br />
1994              <strong>Diane Porter</strong>, University of Florida<br />
1993              <strong>Terry Flippo</strong>, Clemson University<br />
1992              <strong>Sara Hoover</strong>, Birmingham Southern College</p>
<hr />
<strong><a name="MidPro" id="MidPro"></a>SEAHO Outstanding Mid-Level Professional Award</strong>
<p>This award is presented to a mid-level housing professional who supports and mentors entry level and support staff, works to recruit students and retain colleagues in the field, and creates new strategies for connecting with students and improving the department, while sharing their experiences in the field. This professional is dedicated to working with students, the department or profession. The nominee should be involved in state, regional, or national organizations. Nominees should have served in housing or residence life as a professional for at least 7 years.</p>
<p>Past recipients of the  Outstanding Mid-Level Professional Award are:</p>
<p>
2009              <strong>Holly Hallmann</strong>, University of Alabama<br />

2008              <strong>Andrew Fink</strong>, University of South Carolina<br />

2007              <strong>Jerry Adams</strong>, University of Tennessee<br />

2006              <strong>Melissa Jones</strong>, Virginia Commonwealth University<br />

2005              <strong>Joe Boehman</strong>, University of North Carolina-Chapel Hill</p>
<p></p>
<hr />
<br />
<strong><a name="Peace" id="Peace"></a>THE SEAHO PEACE AWARD </strong>
<p>The SEAHO PEACE Award was established in 2002 and first presented at the annual 
  conference in 2003. The PEACE Award (Providing Educational Advocacy for Cultural 
  Excellence) is presented annually at the SEAHO conference to a member of a SEAHO 
  institution to honor and recognize outstanding contributions and service to 
  the SEAHO region through advancement of diversity and multiculturalism. Such 
  advancement can be attributed to advocacy, leadership, mentorship, educational 
  initiatives, and programming. The recipient must have been a member of a SEAHO 
  institution for at least one full academic year and will have demonstrated exceptional 
  service in the areas of diversity and multiculturalism on their home campus 
  and/or to SEAHO. Examples include:</p>
<ul>
  <li>Encouraging members of underrepresented groups to become involved in the 
    housing profession<br />
  </li>
  <li>Promoting a greater understanding of diversity issues (racism, ageism, sexism, 
    gay and lesbian concerns, religious differences, persons with disabilities)<br />
  </li>
  <li>Presenting programs on topics of diversity and/or multiculturalism<br />
  </li>
  <li>Serving as an ally<br />
  </li>
  <li>Mentoring members of underrepresented groups<br />
  </li>
  <li>Mentoring young professionals in the area of diversity education<br />
  </li>
  <li>Supporting the SEAHO Human Relations Committee</li>
</ul>
<p>Letters of support from individuals involved in the nominee's work are highly 
  recommended.</p>
<p>Past recipients of the SEAHO PEACE Award are:</p>
<p>
2009              <strong>Ebony Ebron</strong>, North Carolina State University<br />

2008              <strong>Hassel Morrison</strong>, North Carolina State University<br />

2007              <strong>Khasseem Davis</strong>, George Mason University<br />

2006              <strong>Peter Smith</strong>, Appalachian State University<br />

2005              <strong>Kevin Nunley</strong>, Radford University<br />

2004              <strong>Michael Collins</strong>, Millsaps College<br />
2003              <strong>Christopher Gatesman</strong>, James Madison University</p>
<hr />
<p> <strong><a name="Grad" id="Grad"></a>GRADUATE STUDENT OF THE YEAR AWARD</strong></p>
<p>The SEAHO Graduate Student of the Year Award gives special recognition to an 
  individual who, through dedicated service to their home institution, has shown 
  dedication to the profession and the students that they serve.</p>
<p>Candidates for the award must be in (at least) their second year of graduate 
  work and be employed by a housing department who is a member institution of 
  the SEAHO region.</p>
<p>Past recipients of the SEAHO Graduate Student of the Year Award are:</p>
<p>2009<strong> Bryan Botts</strong>, Clemson University<br />

2008              <strong>Khorey Baker</strong>, University of Memphis<br />

2007              <strong>Amy Zuchlewski</strong>, University of North Florida<br />

2006              <strong>Serena LoConte</strong>, University of Southern Mississippi<br />

2005              <strong>Greg Connel</strong>l, University of Florida<br />

2004              <strong>Camilla Jones</strong>, Clemson University<br />
2003              <strong>Jennifer Paulin</strong>, Virginia Tech<br />
2002              <strong>Dan Oltersdorf</strong>, Florida State University<br />
2001              <strong>Amber Rhoades</strong>, Appalachian State University<br />
2000              <strong>Alvin Sturdivant</strong>, North Carolina State University<br />
1999              <strong>Tammy Wells</strong>, University of South Carolina<br />
 </p>
<hr />
<p> <strong><a name="Article" id="Article"></a>SEAHO REPORT FEATURE ARTICLE 
  OF THE YEAR AWARD</strong></p>
<p>The SEAHO Report Feature Article of the Year Award was established in 2001 
  and first awarded in 2002. The SEAHO Report Editor(s) coordinates the SEAHO 
  Report Feature Article of the Year Award selection. The SEAHO Report Editor(s) 
  should submit copies of the SEAHO Report to each of the SEAHO State Editors. 
  Under the leadership of the SEAHO Report Editor(s), the Committee selects the 
  best feature article from the most recent three (3) issues following each annual 
  conference. The Committee also has the opportunity to name up to two (2) other 
  articles for &quot;Excellent Submission&quot; recognition. The SEAHO Report 
  Editor(s) presents the awards at the annual conference. The Feature Article 
  of the Year Award requests $50 annually to support this award initiative including 
  $30 for the award winning plaque and $20 for &quot;Excellent Submission&quot; 
  plaques.</p>
<p>Past recipients of the SEAHO Report Feature Article of the Year Award are:</p>
<p>2005 Julie Peine, University of Florida<br />
  2004 Dei Allard, Univeristy of North Carolina at Chapel Hill, Bridging the Gap Between Faculty and Residential Life <br />
  2003 Renee Richard Snider, Valdosta State University, Where Have All The Good 
  Candidates Gone?<br />
  2002 K. D. Linkous, Appalachian State University, A.D.V.I.S.O.R. Behavior<br />
  <br />
  <br />
</p>
<hr />
<p> <strong><a name="Service" id="Service"></a>SEAHO SERVICE AWARDS:</strong></p>
<p>Each year, each SEAHO member institution may nominate one person from its staff 
  to receive a SEAHO Service Award. The awards are intended to offer the institution 
  an opportunity to recognize a staff person who has made significant contribution 
  to residence hall students and the housing organization.</p>
<hr />
<p> <strong><a name="Fee" id="Fee"></a>SEAHO CONFERENCE FEE WAIVER SCHOLARSHIP</strong></p>
<p>Past recipients of the SEAHO Report Feature Article of the Year Award are:<br />
  <br />
2004  -  Meredith Varner, Kerri Ekberg, Rinardo Reddick, Miguel Hernandez, Tim Martin, Sherry R. Ingram, John P. Stinchon, Deidre Repass, Karl S. Burns, and George Timson. </p>
<ul>
  <li>Conference Fee Waiver<br />
    <ul>
      <li>Each Scholarship recipients will receive free registration for the annual 
        conference. All other cost incurred for travel and lodging are the responsibility 
        of the recipient. If the recipients are announced prior to the conference, 
        the Association may assist the recipients in networking with other delegates 
        to help offset costs, especially if the recipient's home institution does 
        not have other professionals attending the conference.</li>
    </ul>
  </li>
  <li>The Awards and Recognition Chairperson, in conjunction with the Treasurer, 
    will arrange for the fee waiver. </li>
  <li>Acknowledgements<br />
    <ul>
      <li>The Awards and Recognition Chair will provide the names of the recipients 
        to the Host Committee so that Scholarship Winner ribbons can be inserted 
        in the recipients' conference registration packet. The President-Elect 
        will recognize the recipients at one of the meals during the annual conference. 
        Recipients will be asked to stand.</li>
    </ul>
  </li>
  <li>Letter of Congratulations<br />
    <ul>
      <li>An initial notification of congratulations will be sent by the SEAHO 
        President-Elect. Information about the actual Scholarship Fee Waiver reimbursement 
        process should be included in that correspondence.</li>
    </ul>
  </li>
  <li>SEAHO Report<br />
    <ul>
      <li>The Awards and Recognition Chair will provide a list of the recipients 
        for publication in the SEAHO Report.<br />
      </li>
      <li>The recipients will be asked to submit articles to the SEAHO Report 
        outlining their experiences at the conference. These articles should be 
        forwarded directly to the SEAHO Report Editor(s).</li>
    </ul>
  </li>
  <li>Program Guidelines<br />
    <ul>
      <li>SEAHO will offer an Annual Conference Fee Waiver Scholarship to up to 
        10 delegates. <br />
      </li>
      <li>The recipient selection is the responsibility of SEAHO.<br />
      </li>
      <li>The selection process will be supervised by the Awards and Recognition 
        Committee.<br />
      </li>
      <li>The Governing Council of SEAHO will establish criteria for eligibility 
        and selection. The criteria are as follows: 
        <ul>
          <li>Eligibility<br />
            <ul>
              <li>Eligibility shall be limited to:<br />
                1. New or renewing professionals (first through third years), 
                or<br />
                2. Entry level persons, or<br />
              3. Interns and graduate students.</li>
            </ul>
          </li>
          <li>Related conditions<br />
            <ul>
              <li>Ideally, there will be one scholarship recipient per SEAHO State.<br />
              </li>
              <li>Recipients should represent both public and private institutions.</li>
            </ul>
          </li>
          <li>Selection Criteria<br />
            <ul>
              <li>Successful candidate(s):<br />
                1. Must have shown personal initiative to pursue a career in student 
                affairs and demonstrated competence such as the following:<br />
                a) S/he has sought to broaden her/his own base of professional 
                understanding through participation and involvement in other organizations.<br />
                b) S/he has sought to be a contributing member of the student 
                affairs department by participating in both institutional and 
                departmental committees.<br />
                c) S/he has been an outstanding advisor to both students and student 
                groups.<br />
                d) S/he has sought to broaden her/his own understanding of diverse 
              student needs</li>
              <li>Must submit an application to the Awards and Recognition Chair 
                by the publicized deadline. 
                <ul>
                  <li>Application must include:<br />
                    <ul>
                      <li>A letter indicating why he/she is applying.<br />
                      </li>
                      <li>A current resume.<br />
                      </li>
                      <li>A one page letter of support from his/her Chief Housing 
                        or Student Affairs Officer and/or professor.<br />
                      </li>
                      <li>A completed cover sheet with criteria information.<br />
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li> Must be able to attend the Annual Conference and participate 
                in a Peer Mentor Program.</li>
              <li>Must be willing to write an account of the conference experience 
                to the SEAHO President following the conclusion of the conference 
                for possible publication in the SEAHO Report.</li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>
<p>APPLICATION FOR SEAHO CONFERENCE 
  <br />
<a href="../pdfs/SEAHOfeewaiverapplication2006.pdf">FEE WAIVER SCHOLARSHIP</a></p>
<p>Please send completed SEAHO Conference Fee Waiver Scholarship Application along 
  with letters of support to:<br />
  Chair, SEAHO Awards and Recognition Committee<br />
</p>
<hr />
<p><strong><a name="EdProgram" id="EdProgram"></a>Educational Program Grants</strong></p>
<hr />
<p>Past recipients of the SEAHO Educational Program Grants are:</p>
<p>2004 <strong>Gary Kimble</strong>, University of Southern Mississippi, &quot;Care Packege&quot;<br />
2004 <strong>Maylen Aldana</strong>, Appalachian State University, &quot;The Power of One&quot;<br />
2004 <strong>Heidi LeCount</strong>, Meredith College, &quot;Pre-Spring Break Beach Party&quot;<br />
2004 <strong>Brad Shuck</strong>, Western Kentucky University, &quot;The Six O'Clock Hour&quot;<br />
2005 <strong>Nora Bugg</strong>, University of Tampa <br />
2005 <strong>Josh Alexander</strong>, University of South Carolina <br />
2005 <strong>Erin Matyak</strong>, Clemson University <br />
2005<strong> Sally Watkins</strong>, University of Georgia <br />
2005 <strong>Ashley Lester</strong>, University of Georgia <br />
2005<strong> Glen Midkiff</strong>, University of Louisville</p>
<hr />
<p><b><a name="Resolutions" id="Resolutions"></a>SEAHO Resolutions of Appreciation</b></p>
<ul>
  <li>Purpose: A form of official recognition by SEAHO, a &quot;Resolution of 
    Appreciation.&quot;</li>
  <li>Goals: <br />
    1. To allow a vehicle for recognizing distinguished leaders in Housing and 
    Residence Life in the southeast who leave the field through retirement, career 
    change, or death.<br />
    2. To publicly honor these individuals at a SEAHO annual conference. <br />
  3. To record the outstanding contributions of these individuals for posterity.</li>
  <li>Process: <br />
    1. Any member of the SEAHO Leadership Team may present a proposed Resolution 
    of Appreciation to the Governing Council for consideration.<br />
    2. The Governing Council must approve a proposed resolution by a simple majority.<br />
    3. Approved resolutions will be read to SEAHO delegates at the annual conference 
    at a time prescribed by the SEAHO president.<br />
    4. Honoree(s) and/or family members may be invited to the annual conference 
  to receive a resolution of appreciation.</li>
</ul>
<hr />
<p><i><b>Resolution of Appreciation</b></i></p>
<p>WHEREAS, [Name] served as a housing/residence life professional with distinction 
  for [#] years, and</p>
<p>WHEREAS, [Name] supported the goals for the Southeastern Association of Housing 
  Officers through [conference attendance, program presentations, offices held, 
  service on committees, etc.], and </p>
<p>WHEREAS, [Name] also promoted the housing/residence life profession through 
  leadership and involvement at the state and national level, and </p>
<p>WHEREAS, [Name's] tenure as a housing/residence life professional was characterized 
  by [list appropriate nouns: e.g., creativity, excellence, caring, resourcefulness, 
  enthusiasm, etc.], and </p>
<p>WHEREAS, [add appropriate personalized accolades as desired],</p>
<p>BE IT THEREFORE RESOLVED that the Governing Council of the Southeastern Association 
  of Housing Officers, on behalf of its membership, wishes to express its sincerest 
  appreciation and highest esteem to [Name] for [his/her] exemplary contributions 
  to our association and our field.</p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsWinners);

mysql_free_result($rsAwardYear);
?>
