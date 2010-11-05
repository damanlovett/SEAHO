<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Search callforprograms</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Reviewer Manager Test<!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1">
        <table border="0" cellpadding="3" cellspacing="0">
          <tr valign="baseline">
            <td nowrap align="right"><strong>Program</strong></td>
            <td><select name="programID">
                <?php 
do {  
?>
                <option value="<?php echo $row_rsProgramsList['topic_area']?>" ><?php echo substr($row_rsProgramsList['topic_area'],0,30)?> ... </option>
                <?php
} while ($row_rsProgramsList = mysql_fetch_assoc($rsProgramsList));
?>
              </select>
            </td>
            <td>&nbsp;</td>
            <td><strong>Reviewer</strong></td>
            <td><select name="userID">
                <option>--------</option>
            </select></td>
            <td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Assign" /></td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap><div align="left"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="id" value="" />
        <input type="hidden" name="reviewID" />
      </form>
    </div>
    <table width="400" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="7" class="tableTop">&nbsp;Reviewers:  &nbsp;&nbsp;Programs: </td>
      </tr>
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>Reviews</th>
        <th>&nbsp;</th>
        <th nowrap="nowrap">Read</th>
        <th>&nbsp;</th>
        <th>Votes</th>
      </tr>
      <tr  class="tableRowColor">
        <td nowrap="nowrap"><a href="#">, </a><a href="#"></a> </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td nowrap="nowrap"></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td nowrap="nowrap"></td>
      </tr>
      <tr>
        <td colspan="7" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <div class="WADASearchContainer">
      <form action="callforprograms_Results.php" method="get" name="WADASearchForm" id="WADASearchForm">
        <div class="WADAHeader">Search</div>
        <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
        <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <th class="WADADataTableHeader">ProgramTitle:</th>
            <td class="WADADataTableCell"><input type="text" name="S_ProgramTitle" id="S_ProgramTitle" value="" size="32" /></td>
          </tr>
          <tr>
            <th class="WADADataTableHeader">ProgramNumber:</th>
            <td class="WADADataTableCell"><input type="text" name="S_ProgramNumber" id="S_ProgramNumber" value="" size="32" /></td>
          </tr>
          <tr>
            <th class="WADADataTableHeader">session:</th>
            <td class="WADADataTableCell"><input type="text" name="S_session" id="S_session" value="" size="32" /></td>
          </tr>
          <tr>
            <th class="WADADataTableHeader">location:</th>
            <td class="WADADataTableCell"><input type="text" name="S_location" id="S_location" value="" size="32" /></td>
          </tr>
        </table>
        <div class="WADAHorizLine"><img src="../../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
        <div class="WADAButtonRow">
          <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Search" id="Search" value="Search" alt="Search" src="../../WA_DataAssist/images/Pacifica/Refined_search.gif"  /></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
