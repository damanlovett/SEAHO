<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SEAHO Home Page</title>
<link href="stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.seahodroplogo {
	background-image: url(images/seahodroplogo.jpg);
	background-repeat: no-repeat;
	height: 90px;
	width: 240px;
	background-position: center center;
}


-->
</style>

</head>

<body>
<!-- DO NOT MOVE! The following AllWebMenus code must always be placed right AFTER the BODY tag-->
<!-- ******** BEGIN ALLWEBMENUS CODE FOR mainnav ******** -->
<span id='xawmMenuPathImg-mainnav' style='position:absolute;top:-50px;left:0px'><img name='awmMenuPathImg-mainnav' id='awmMenuPathImg-mainnav' src='./menu/awmmenupath.gif' alt=''></span>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [4]', awmBN='626'; awmAltUrl='';</script>
<script charset='UTF-8' src='./menu/mainnav.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR mainnav ******** -->
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0" class="textheader">
  <tr>
    <td colspan="3" align="right" bgcolor="#FFFFFF" class="header"><div align="right">| <a href="#">Home</a> | <a href="http://seaho.org/admin/login.php">Login</a> | <a href="https://webmailer.perfora.net/">Webmail</a> | <a href="/search/index.php">Search</a> | <a href="http://lovettcreations.org/support/">Support</a> |</div>    </td>
  </tr>
  <tr>
    <td colspan="3" valign="middle" bgcolor="#FFFFFF" class="topnav"><span id='awmAnchor-mainnav'>&nbsp;</span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center"><?php 
$folder=opendir("images/homebanners/"); 
while ($file = readdir($folder)) 
	$names[count($names)] = $file; 
closedir($folder);
sort($names);
$tempvar=0;
for ($i=0;$names[$i];$i++){
	$ext=strtolower(substr($names[$i],-4));
	if ($ext==".jpg"||$ext==".gif"||$ext=="jpeg"||$ext==".png"){$names1[$tempvar]=$names[$i];$tempvar++;}
}
srand ((double) microtime() * 10000000);
$rand_keys = array_rand ($names1, 2);
$xmImg="images/homebanners/".$names1[$rand_keys[0]]; 
$dimensions = GetImageSize($xmImg); 
if (isset($pic)){header ("Location: $xmImg");}
else {echo "<img src=\"$xmImg\" $dimensions[3]>";}
?>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" class="texttop">&nbsp;</td>
</tr>
  <tr>
    <td height="331" valign="top" id="contentleft"><?php require_once('includefiles/importantlinks.inc.php'); ?>

    </td>
    <td valign="top" id="contentmiddle"><br />
      <p> <img src="images/logo2011.jpg" alt="2011 Logo" width="146" height="91" align="left" />
    <strong>SEAHO 2011</strong><br />
     <p>General information is ready.</p>
     <p>Conference Information<br /> 
       <ul>
       	<li><a href="http://seaho.org/cws/index.php?subj=10">Seaho 2011 Homepage</a></li>
        <li><a href="http://seaho.org/registration/delegate/index.php">Conference Registration</a></li>
        <li><a href="http://seaho.org/registration/associates/index.php">Associate Registration</a></li>
        <li><a href="http://seaho.org/cws/index.php?page=44">Associate Information</a></li>
        <li><a href="http://seaho.org/cws/index.php?page=46">Exhibiter Kit</a></li>
        <li><strong><a href="http://placement.seaho.org">SEAHO Placement Center</a></strong></li>
        <li><a href="/pdfs/SEAHO_2011_PBook_FINAL.pdf">Conference Program Book </a><span class="smallBoldRed">NEW</span></li>
        <li><a href="/pdfs/ConferenceCoordinatorApplication.docx">Conference Coordinator Application</a><span class="smallBoldRed">NEW</span></li>
</ul>
    </p>        
      <p>Governing Council Conference Documents<br />
        <ul>
            <li><a href="http://seaho.org/pdf/2011SEAHOOfficerElections.pdf">SEAHO Officer Elections</a></li>
            <li><a href="http://seaho.org/pdf/ConferenceHostingGuideChangesOct10.pdf">Conference Hosting Guide Changes</a></li>
            <li><a href="http://seaho.org/pdf/GCNew10-18-10.pdf">New Governing Council</a></li>
            <li><a href="http://seaho.org/pdf/LeadershipManualChangesOct10.pdf">Leadership Manual Changes Oct 10</a></li>
            <li><a href="http://seaho.org/pdf/SEAHOConstitution11_11_10.pdf">SEAHO Constitution 11/11/10</a></li>
            <li class="hideDiv"><p>Download all 4 documents:<br /> <a href="http://seaho.org/pdf/GCDocuments2011.zip">Govern Council Documents</a></p></li>
            <li><a href="http://seaho.org/pdf/CommitteeStateRepsEditorApplication.docx">Committee State Reps Editor Application</a>&nbsp;<span class="smallBoldRed">NEW</span></li>
            <li><a href="http://seaho.org/pdf/FeatureArticlesEditorApplication.doc">Feature Articles Editor Application</a>&nbsp;<span class="smallBoldRed">NEW</span></li>
            <li><a href="http://seaho.org/pdf/SponsorshipCoordinatorApplication.doc">Sponsorship Coordinator Application</a>&nbsp;<span class="smallBoldRed">NEW</span></li>
       </ul>
      </p>
     <p>Also check out - Programs: <br />
     <a href="http://seaho.org/cws/index.php?page=36">General Program Information</a>
     </p>
     <hr />
      <p><strong><img src="images/imgSEAHOreport.jpg" alt="Seaho report" width="75" height="75" align="left" />SEAHO Report</strong><br />
      Looking for great articles and resources from around the SEAHO  region? &nbsp;Then check out the SEAHO <br />
      <a href="seahoreports/index.php">Report on-line</a>. 
      <hr />
      <strong>ACUHO-I Foundation Cabinet</strong><br />
The ACUHO-I Foundation requests that each regional affiliate appoint a member to&nbsp;serve as a Regional Representative to&nbsp;the Foundation Cabinet.&nbsp;&nbsp; [ <a href="acuho/">Full Story</a> ]</p>      
      <div class="seahodroplogo">      </div>
      </td>
    <td valign="top" id="contentright">

       <div class="hideDiv"><p><br />
      <img src="images/imgreliLogo2009.jpg" alt="Reli" width="200" height="64" vspace="10" align="center" class="noimgborder" /></p>
      <p><strong>RELI Info</strong><br />
        <!--The <a href="reli/formApplication.php">RELI Application</a> is now available. -->
        <a href="reli/index.php">RELI 2010 Information</a> is now available. The timeline for applications will be: </p>
      <ul>
        <li>Applications     Open &ndash; <span class="smallBoldRed">NOW</span></li>
        <li>Application     Deadline &ndash; March 12th, 5:00pm EST</li>
        <li>Successful     Applicants Notified &ndash; April 1st</li>
      </ul>
      <hr /></div>
      

      <p><strong><img src="images/imginvolve.jpg" alt="Involvement" width="75" height="75" align="left" />Involvement Info </strong><br />
      The Involvement Fair at the annual conference gives you an opportunity to learn about SEAHO committees. Please visit the fair at the conference and learn more about what SEAHO has to offer you. </p>
      <!--<p>If you are unable to visit the Involvement Fair, you may complete 
        any   Involvement Form included in the conference packet, printed in the 
        SEAHO Report or by completing a printable form on the SEAHO website.      </p>-->
      <p>If you   are unsure where your talents best fit in SEAHO, or if you 
        have questions   about SEAHO, please contact any <a href="involvement/leadership_team.php">Governing Council </a>member 
      and/or your State   Representative. </p>
<br/>
        </td></tr>
  <tr>
    <td colspan="3" class="footer">| <a href="#">Home</a> | <a href="history/">History</a> | <a href="conference/">Conferences</a> | <a href="associates/">Associates</a> | <a href="leadership/">Leadership</a> | <a href="awards/">Awards</a> | <a href="involvement/">Involvement</a> | <a href="http://lovettcreations.org/lcsupport/">Support</a> | <br />
    Copyright &copy; <?php echo date('Y'); ?> Site designed by <a href="http://lovettcreations.org">LovettCreations.org</a>. All Rights Reserved </td>
  </tr>
</table>
  <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6621405-2");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
