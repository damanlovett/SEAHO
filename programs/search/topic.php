<?php require_once('../../Connections/Programming.php'); ?>
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

mysql_select_db($database_Programming, $Programming);
$query_rsProgramsList = "SELECT topic_area.id, topic_area.topic_area FROM topic_area WHERE topic_area.deleted =0 ORDER BY topic_area.topic_area";
$rsProgramsList = mysql_query($query_rsProgramsList, $Programming) or die(mysql_error());
$row_rsProgramsList = mysql_fetch_assoc($rsProgramsList);
$totalRows_rsProgramsList = mysql_num_rows($rsProgramsList);
$colname_rsProgramlist = "-1";
if (isset($_POST['search'])) {
  $colname_rsProgramlist = (get_magic_quotes_gpc()) ? $_POST['search'] : addslashes($_POST['search']);
}
mysql_select_db($database_Programming, $Programming);
$query_rsProgramlist = sprintf("SELECT id, ProgramTitle, `session`, location, FirstName, LastName, ProgramDescription, Status FROM callforprograms WHERE TopicArea = %s AND callforprograms.Status = 'Accepted'", GetSQLValueString($colname_rsProgramlist, "text"));
$rsProgramlist = mysql_query($query_rsProgramlist, $Programming) or die(mysql_error());
$row_rsProgramlist = mysql_fetch_assoc($rsProgramlist);
$totalRows_rsProgramlist = mysql_num_rows($rsProgramlist);
?>
<!DOCTYPE html>
<HTML>
<meta charset="utf-8">
<TITLE>SEAHO 2007 | Program List</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2900.2873" name=GENERATOR>
<link href="../../stylesheets/conferencestyle2007.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
#container #content p {
	line-height: 1.4em;
}
#container #content li {
	line-height: 1.5em;
}
.tableformat {
	border: 1px solid #999999;
}
.tableheader {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	font-size: 10px;
	margin: 0px;
	padding: 5px;
}
.tableheader2 {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	text-align: right;
	padding-right: 10px;
	font-size: 10px;
	margin: 0px;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}
.tableheader2bottom {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CCCCCC;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #FFFFFF;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #FFFFFF;
	text-align: right;
	padding-right: 10px;
	margin: 0px;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}
.tableheaderbottom {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CCCCCC;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #FFFFFF;
	font-size: 10px;
	margin: 0px;
	padding: 5px;
}
.smalltextbutton {
	font-size: 10px;
}
.ProgramTitles {
	color: #000066;
	font-weight: bold;
	background-color: #E4E8F3;
	display: block;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #999999;
	border-bottom-color: #CCCCCC;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 5px;
	margin-left: 0px;
}
.ProgramTitles h4 {
	margin: 0px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	padding: 2px;
	font-size: 12px;
}
.tableformat p {
	padding: 5px;
}
.formFormat {
	background-color: #FFFFFF;
	border: 1px solid #CCCCCC;
}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</HEAD>
<BODY>
<DIV id=container>
<div id=image><img src="http://seaho.org/images/logo2011.jpg" width="146" height="91" alt="logo"><br>
  SEAHO  Program List</div>
<DIV id=content>
<h3>&nbsp;</h3>
<table width="500" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>      <h4>Search Programs </h4>          <input name="Button" type="button" class="smalltextbutton" onClick="MM_goToURL('parent','../programlist.php');return document.MM_returnValue" value="Reset List">          </td>
  </tr>
  <tr>
    <td><form action="session.php" method="post" name="form2">
      <select name="search" class="smalltextbutton" id="label">
        <option selected>Select Session</option>
        <option value="Pre">Pre</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
      </select>
      <input name="Submit" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
  <tr>
  
    <td><form name="form3" method="post" action="topic.php">
      <select name="search" class="smalltextbutton" id="search">
        <option value="N/A" selected>Select Topic</option>

              <?php 
do {  
?>
              <option value="<?php echo $row_rsProgramsList['topic_area']?>" ><?php echo substr($row_rsProgramsList['topic_area'],0,30)?> ... </option>
              <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
      <input name="Submit2" type="submit" class="smalltextbutton" value="Search">
    </form>
            </select>          </td>





</tr>
  <tr>
    <td><form action="title.php" method="post" name="form4">
      <input name="search" type="text" class="smalltextbutton" id="search" value="Enter Title" size="45">
      <input name="Submit3" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
  <tr>
    <td><form action="presenter.php" method="post" name="form5">
      <input name="search" type="text" class="smalltextbutton" id="search" value="Enter Presenter Last Name" size="45">
      <input name="Submit4" type="submit" class="smalltextbutton" value="Search">
    </form>    </td>
  </tr>
</table></P>
<h2>  <?php if(!isset($_POST['search'])) { echo "All Programs"; } else { echo "Search Results for ".$_POST['search']." ";}?>
</h2>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableformat">
  <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><div class="ProgramTitles">
        <h4><?php echo $row_rsProgramlist['ProgramTitle']; ?></h4>
      </div>
        <strong>&nbsp;Presenter:</strong> <?php echo $row_rsProgramlist['FirstName']; ?>&nbsp;<?php echo $row_rsProgramlist['LastName']; ?>
        <p><strong>Description:</strong><br>
          <?php echo substr(($row_rsProgramlist['ProgramDescription']),0,200); ?> [ <a href="../programdetails.php?recordID=<?php echo $row_rsProgramlist['id']; ?>">Full Description</a> ]</p></td>
      </tr>
    <?php } while ($row_rsProgramlist = mysql_fetch_assoc($rsProgramlist)); ?>
</table>
<BR>
</P>
<HR>

<P class=footer>&nbsp;</P>
</DIV>
</DIV>
</BODY></HTML>
<?php
mysql_free_result($rsProgramlist);
?>
