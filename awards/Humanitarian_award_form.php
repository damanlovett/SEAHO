<?php require_once('../Connections/Directory.php'); ?>
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

mysql_select_db($database_Directory, $Directory);
$query_rsChair = "SELECT team_positions.`position`, team_positions.email, users.first_name, users.last_name, users.school FROM team_positions, users WHERE team_positions.Position LIKE '%Awards and Recognition%'  AND team_positions.user_id = users.user_id";
$rsChair = mysql_query($query_rsChair, $Directory) or die(mysql_error());
$row_rsChair = mysql_fetch_assoc($rsChair);
$totalRows_rsChair = mysql_num_rows($rsChair);

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
$query_rsAwardYear = "SELECT * FROM awards GROUP BY awards.`year` ORDER BY awards.`year`";
$rsAwardYear = mysql_query($query_rsAwardYear, $Awards) or die(mysql_error());
$row_rsAwardYear = mysql_fetch_assoc($rsAwardYear);
$totalRows_rsAwardYear = mysql_num_rows($rsAwardYear);
?>
<?php require_once('../Connections/Forms.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "humanaward")) {

$mailto = 'presidentelect@seaho.org';
$mailfrom = 'webmaster@seaho.org';
$submitfrom = $_POST['Nominator'];
$email = $_POST['emailnee'];

$subject = 'Humanitarian Award';
$message = "Dear President-Elect, \n\n".$submitfrom." has submitted a Human Award Nomination.\n";
$message .= "You can log into the SEAHO.or website to view the submission.\n";
$message .= "Their email is ".$email." .";
mail($mailto, $subject, $message);

  $insertSQL = sprintf("INSERT INTO humanitarian (nominee, positionnee, addressnee, citynee, statenee, zipnee, institutionnee, phonenee, emailnee, `year`, nominator, `position`, address, city, `state`, zip, institution, phone, email, `date`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nominee'], "text"),
                       GetSQLValueString($_POST['Positionnee'], "text"),
                       GetSQLValueString($_POST['Addressnee'], "text"),
                       GetSQLValueString($_POST['citynee'], "text"),
                       GetSQLValueString($_POST['statenee'], "text"),
                       GetSQLValueString($_POST['zippnee'], "text"),
                       GetSQLValueString($_POST['institutionnee'], "text"),
                       GetSQLValueString($_POST['telephonenee'], "text"),
                       GetSQLValueString($_POST['emailnee'], "text"),
                       GetSQLValueString($_POST['year'], "text"),
                       GetSQLValueString($_POST['Nominator'], "text"),
                       GetSQLValueString($_POST['Position'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['Zip'], "text"),
                       GetSQLValueString($_POST['Institution'], "text"),
                       GetSQLValueString($_POST['Telephone'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['Date'], "text"));

  mysql_select_db($database_Forms, $Forms);
  $Result1 = mysql_query($insertSQL, $Forms) or die(mysql_error());

  $insertGoTo = "../emailnotify/index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Awards - Humanitarian Nomination Form</title>
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
<h2> Humanitarian
Nomination Form</h2>
<table width="100%">
  <tr>
    <td width="100%" colspan="2"><b>Nomination For the Humanitarian 
      Recognition Award </b></td>
  </tr>
  <tr>  </tr>
  <tr>  </tr>
  <tr>  </tr>
</table>
<form action="<?php echo $editFormAction; ?>" id="humanaward" name="humanaward" method="POST">
  <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2" class="squareborder">
    <tr>
      <td align="right" valign="top">
            <div class="leftform">
              <label for="nominee" class="smallform"><strong>
              <input name="year" type="hidden" id="year" value="2006" />
              Name of Nominee: </strong></label>
              <input name="nominee" type="text" class="smallform" id="nominee" size="25" />
            </div>            <div class="leftform">
              <label for="Position" class="smallform"><strong>Position:</strong></label>
              <input name="Positionnee" type="text" class="smallform" id="label" size="25" />
                  </div>
              <div class="leftform">
              <label for="Addressnee" class="smallform"><strong>Address:</strong></label>
              <textarea name="Addressnee" cols="22" rows="5" wrap="virtual" id="label3"></textarea>
              </div>
            <br />          
            <div class="leftform">
              <label for="citynee" class="smallform"><strong>City:</strong></label>
              <input name="citynee" type="text" class="smallform" id="label4" size="25" />
              </div>
            <br />          
            <div class="leftform">
              <label for="statenee" class="smallform"><strong>State:</strong></label>
              <select name="statenee" class="smallform" id="statenee">
                  <option value="" selected="selected">Choose a State</option>
                  <option value="AL">AL</option>
                  <option value="AK">AK</option>
                  <option value="AZ">AZ</option>
                  <option value="AR">AR</option>
                  <option value="CA">CA</option>
                  <option value="CO">CO</option>
                  <option value="CT">CT</option>
                  <option value="DE">DE</option>
                  <option value="DC">DC</option>
                  <option value="FL">FL</option>
                  <option value="GA">GA</option>
                  <option value="HI">HI</option>
                  <option value="ID">ID</option>
                  <option value="IL">IL</option>
                  <option value="IN">IN</option>
                  <option value="IA">IA</option>
                  <option value="KS">KS</option>
                  <option value="KY">KY</option>
                  <option value="LA">LA</option>
                  <option value="ME">ME</option>
                  <option value="MD">MD</option>
                  <option value="MA">MA</option>
                  <option value="MI">MI</option>
                  <option value="MN">MN</option>
                  <option value="MS">MS</option>
                  <option value="MO">MO</option>
                  <option value="MT">MT</option>
                  <option value="NE">NE</option>
                  <option value="NV">NV</option>
                  <option value="NH">NH</option>
                  <option value="NJ">NJ</option>
                  <option value="NY">NY</option>
                  <option value="NC">NC</option>
                  <option value="ND">ND</option>
                  <option value="OH">OH</option>
                  <option value="OK">OK</option>
                  <option value="OR">OR</option>
                  <option value="PA">PA</option>
                  <option value="OR">OR</option>
                  <option value="RI">RI</option>
                  <option value="SC">SC</option>
                  <option value="SD">SD</option>
                  <option value="TN">TN</option>
                  <option value="TX">TX</option>
                  <option value="UT">UT</option>
                  <option value="VT">VT</option>
                  <option value="VA">VA</option>
                  <option value="WA">WA</option>
                  <option value="WV">WV</option>
                  <option value="WI">WI</option>
                  <option value="WY">WY</option>
                </select>
              </div>
            <br />          
            <div class="leftform">
              <label for="zippnee" class="smallform"><strong>Zip:</strong></label>          
              <input name="zippnee" type="text" class="smallform" id="label6" size="25" />
              </div></td>
      <td width="49%" align="right" valign="top"><div class="rightform">
        <label for="zippnee" class="smallform"><strong>Institution:</strong></label>
        <input name="institutionnee" type="text" class="smallform" id="label2" size="25" />
      </div>
          <div class="rightform">
            <label for="telephonenee" class="smallform"><strong>Telephone:</strong></label>
              <input name="telephonenee" type="text" class="smallform" id="label7" size="25" />
          </div>
          <div class="rightform">
            <label for="emailnee" class="smallform"><strong>E-mail:</strong></label>              
            <input name="emailnee" type="text" class="smallform" id="label8" size="25" />
          </div></td>
      </tr>
  </table>
  <br />
  <table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="#F2F2F2" class="squareborder">
    <tr>
      <td width="100%">Please share specifically how the nominee(s) 
        has/have gone above and beyond the call of duty for a student in crisis 
        by demonstrating phiysical effort, sporotual commitment or act of bravery,determination, 
        and courage.&nbsp; (Please attach letters of support from CHO, Dean of Students, 
        Assistant/Associate/Vice President for Student Affairs and two colleagues, 
        supervisors, or supervisees):</td>
    </tr>
    <tr>
      <td width="100%"><label for="label9" class="smallform"></label>
        <div align="center">
          <textarea name="details" cols="50" rows="15" wrap="physical" id="label9"></textarea>
        </div></td>
    </tr>
  </table>
  <br />
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2" class="squareborder">
    <tr>
      <td align="right" valign="top"><div class="leftform">
          <label for="Nominator" class="smallform"><strong>Nominator: </strong></label>
          <input name="Nominator" type="text" class="smallform" id="label5" size="25" />
        </div>
          <div class="leftform">
            <label for="Position" class="smallform"><strong>Position: </strong></label>
            <input name="Position" type="text" class="smallform" id="label13" size="25" />
          </div>
              
          <div align="left"><br />
          </div>
<label for="Address">  <div class="smallform"><strong>Address:</strong></label>
            <textarea name="Address" cols="22" rows="5" wrap="virtual" id="Address"></textarea>
          </div>
        <br />
          <div class="leftform">
            <label for="City" class="smallform"><strong>City:</strong></label>
            <input name="City" type="text" class="smallform" id="label18" size="25" />
          </div>
        <br />
          <div class="leftform">
            <label for="State" class="smallform"><strong>State:</strong></label>
            <select name="State" class="smallform" id="State">
              <option value="" selected="selected">Choose a State</option>
              <option value="AL">AL</option>
              <option value="AK">AK</option>
              <option value="AZ">AZ</option>
              <option value="AR">AR</option>
              <option value="CA">CA</option>
              <option value="CO">CO</option>
              <option value="CT">CT</option>
              <option value="DE">DE</option>
              <option value="DC">DC</option>
              <option value="FL">FL</option>
              <option value="GA">GA</option>
              <option value="HI">HI</option>
              <option value="ID">ID</option>
              <option value="IL">IL</option>
              <option value="IN">IN</option>
              <option value="IA">IA</option>
              <option value="KS">KS</option>
              <option value="KY">KY</option>
              <option value="LA">LA</option>
              <option value="ME">ME</option>
              <option value="MD">MD</option>
              <option value="MA">MA</option>
              <option value="MI">MI</option>
              <option value="MN">MN</option>
              <option value="MS">MS</option>
              <option value="MO">MO</option>
              <option value="MT">MT</option>
              <option value="NE">NE</option>
              <option value="NV">NV</option>
              <option value="NH">NH</option>
              <option value="NJ">NJ</option>
              <option value="NY">NY</option>
              <option value="NC">NC</option>
              <option value="ND">ND</option>
              <option value="OH">OH</option>
              <option value="OK">OK</option>
              <option value="OR">OR</option>
              <option value="PA">PA</option>
              <option value="OR">OR</option>
              <option value="RI">RI</option>
              <option value="SC">SC</option>
              <option value="SD">SD</option>
              <option value="TN">TN</option>
              <option value="TX">TX</option>
              <option value="UT">UT</option>
              <option value="VT">VT</option>
              <option value="VA">VA</option>
              <option value="WA">WA</option>
              <option value="WV">WV</option>
              <option value="WI">WI</option>
              <option value="WY">WY</option>
            </select>
          </div>
        <br />
          <div class="leftform">
            <label for="Zip" class="smallform"><strong>Zip:</strong></label>
            <input name="Zip" type="text" class="smallform" id="label20" size="25" />
        </div></td>
      <td width="49%" align="right" valign="top"><div class="rightform">
          <label for="Institution" class="smallform"><strong>Institution:</strong></label>
          <input name="Institution" type="text" class="smallform" id="label21" size="25" />
        </div>
          <div class="rightform">
            <label for="Telephone" class="smallform"><strong>Telephone:</strong></label>
            <input name="Telephone" type="text" class="smallform" id="label22" size="25" />
          </div>
        <div class="rightform">
            <label for="label23" class="smallform"><strong>Email:</strong></label>
            <input name="email" type="text" class="smallform" id="email" size="25" />
        </div>
		 <div class="rightform">
            <label for="Date" class="smallform"><strong>Date:</strong></label>
            <input name="Date" type="text" class="smallform" id="label23" size="25" />
        </div></td>
    </tr>
  </table>
  <br />
  <label for="Submit"></label>
  <input type="submit" name="Submit" value="Submit Nomination &gt;&gt;" id="Submit" />
  <hr color="#cc3300" />
<input type="hidden" name="MM_insert" value="humanaward">
</form>
<p align="center"><b>If you have any questions you may contact <a href="mailto:<?php echo $row_rsChair['email']; ?>"><?php echo $row_rsChair['first_name']; ?></a><a href="mailto:presidentelect@seaho.org"><?php echo $row_rsChair['last_name']; ?></a>  <?php echo $row_rsChair['position']; ?></b><br />
</p>
<!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../includefiles/footer.inc.php'); ?>
</table>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsChair);

mysql_free_result($rsWinners);

mysql_free_result($rsAwardYear);
?>
