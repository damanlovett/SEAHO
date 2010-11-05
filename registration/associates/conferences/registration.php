<?php require_once('../../includefiles/initAssociates.php'); ?>
<?php $_SESSION['conference_id'] = $_GET['recordID'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/second.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SEAHO</title>
<!-- InstanceEndEditable -->
<link href="../../../stylesheets/mainsheet.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<link href="../../styles/cmsMain.css" rel="stylesheet" type="text/css" />
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
      <h1>New Registration</h1>
      <p><?php echo $_SESSION['conference_id'];?></p>
<p><?php echo $_SESSION['display_name'];?></p>
      <!-- InstanceEndEditable --></td>
  </tr>
  <?php require_once('../../../includefiles/footer.inc.php'); ?>
</table>
</body>
<!-- InstanceEnd --></html>
