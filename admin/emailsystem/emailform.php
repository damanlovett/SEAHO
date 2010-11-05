<?php require_once('../../Connections/Directory.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/initEmails.php'); ?>
<?php require_once('../../fckeditor/fckeditor.php'); ?>

<?php


mysql_select_db($database_Directory, $Directory);
$query_rsCat = "SELECT position_id, `position`, team_positions.`delete`, team_positions.`group` FROM team_positions WHERE team_positions.`delete` = 0 GROUP BY team_positions.`group`";
$rsCat = mysql_query($query_rsCat, $Directory) or die(mysql_error());
$row_rsCat = mysql_fetch_assoc($rsCat);
$totalRows_rsCat = mysql_num_rows($rsCat);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Email System Form</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" --><span class="pageHeadSystemAdmin">Email System Form</span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->

    <h3>IMPORTANT: Please note that the system must send a separate email to each recipent,  PLEASE ONLY HIT SUMBIT ONCE. Although it may seem like the system has stalled it may take up to 2 minutes for you to go to the comfirmation page. </h3>
	  <form id="email" name="email" method="post" action="records.php">
  <fieldset>
  <legend></legend>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td width="93%" bgcolor="#F7F7F7"><strong>Subject</strong>
          <input name="title" type="text" id="title" size="45" /></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><strong>Send To</strong>
          <select name="group" id="group">
            <option value="Leadership Team">Leadership Team</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsCat['group']?>"><?php echo $row_rsCat['group']?></option>
            <?php
} while ($row_rsCat = mysql_fetch_assoc($rsCat));
  $rows = mysql_num_rows($rsCat);
  if($rows > 0) {
      mysql_data_seek($rsCat, 0);
	  $row_rsCat = mysql_fetch_assoc($rsCat);
  }
?>
          </select></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><?php
$oFCKeditor = new FCKeditor('emailmessage') ;
$oFCKeditor->BasePath = '/FCKeditor/';
$oFCKeditor->Config['CustomConfigurationsPath'] = '/fckeditor/fckconfigLeader.js' ;
$oFCKeditor->ToolbarSet = 'Leader';
$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '450' ;
$oFCKeditor->Value = 'Default text in editor';
$oFCKeditor->Create() ;
?></td>
      </tr>
      <tr>
        <td bgcolor="#F7F7F7"><input type="submit" name="button" id="button" value="Send Email" /></td>
      </tr>
    </table>
  </fieldset>
  <label for="group"><br />
  <br />
  </label>
  <label for="button"></label>
</form>
<!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCat);
?>
