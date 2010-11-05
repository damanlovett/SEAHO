<?php require_once('../includefiles/init.php'); ?>
<?php require_once('../includefiles/AdminLogin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>Profile</title>
<!-- InstanceEndEditable -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style3 {color: #000099}
-->
</style>
<!-- InstanceEndEditable -->
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- InstanceBeginEditable name="PageTitle" -->Eddie Lovett -  <span class="style3">Profile </span><!-- InstanceEndEditable --></h2>
	
    <!-- InstanceBeginEditable name="PageContent" -->
    <div id="pageInformation">
      <form method="post" name="form1" id="form1">
        <table border="0" cellpadding="5" cellspacing="0">
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>First Name </strong></td>
            <td><input name="textfield" type="text" size="30" />            </td>
            <td>&nbsp;</td>
            <td nowrap="nowrap"><strong>Last Name </strong></td>
            <td><input name="textfield2" type="text" size="35" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>Title</strong></td>
            <td colspan="4" nowrap="nowrap"><input name="textfield5" type="text" value="Assistant Director for Residence Life Department of Univerisity Housing" size="83" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>School</strong></td>
            <td nowrap="nowrap"><input name="textfield3" type="text" size="30" /></td>
            <td>&nbsp;</td>
            <td><strong>Password</strong></td>
            <td><label>
            <input name="textfield42" type="text" size="35" />
            </label></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>Address</strong></td>
            <td nowrap="nowrap"><input name="textfield32" type="text" size="30" /></td>
            <td>&nbsp;</td>
            <td><strong>Email</strong></td>
            <td><input name="textfield4" type="text" size="35" /></td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>City</strong></td>
            <td nowrap="nowrap"><input name="textfield33" type="text" size="30" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr align="left" valign="middle">
            <td nowrap="nowrap"><strong>State</strong></td>
            <td nowrap="nowrap"><select name="state">
              <option value="" selected="selected">Choose a State</option>
              <option value="Alabama">Alabama</option>
              <option value="Alaska">Alaska</option>
              <option value="Arizona">Arizona</option>
              <option value="Arkansas">Arkansas</option>
              <option value="California">California</option>
              <option value="Colorado">Colorado</option>
              <option value="Connecticut">Connecticut</option>
              <option value="Delaware">Delaware</option>
              <option value="District Of Columbia">District Of Columbia</option>
              <option value="Florida">Florida</option>
              <option value="Georgia">Georgia</option>
              <option value="Hawaii">Hawaii</option>
              <option value="Idaho">Idaho</option>
              <option value="Illinois">Illinois</option>
              <option value="Indiana">Indiana</option>
              <option value="Iowa">Iowa</option>
              <option value="Kansas">Kansas</option>
              <option value="Kentucky">Kentucky</option>
              <option value="Louisiana">Louisiana</option>
              <option value="Maine">Maine</option>
              <option value="Maryland">Maryland</option>
              <option value="Massachusetts">Massachusetts</option>
              <option value="Michigan">Michigan</option>
              <option value="Minnesota">Minnesota</option>
              <option value="Mississippi">Mississippi</option>
              <option value="Missouri">Missouri</option>
              <option value="Montana">Montana</option>
              <option value="Nebraska">Nebraska</option>
              <option value="Nevada">Nevada</option>
              <option value="New Hampshire">New Hampshire</option>
              <option value="New Jersey">New Jersey</option>
              <option value="New York">New York</option>
              <option value="North Carolina">North Carolina</option>
              <option value="North Dakota">North Dakota</option>
              <option value="Ohio">Ohio</option>
              <option value="Oklahoma">Oklahoma</option>
              <option value="Oregon">Oregon</option>
              <option value="Pennsylvania">Pennsylvania</option>
              <option value="Oregon">Oregon</option>
              <option value="Rhode Island">Rhode Island</option>
              <option value="South Carolina">South Carolina</option>
              <option value="South Dakota">South Dakota</option>
              <option value="Tennessee">Tennessee</option>
              <option value="Texas">Texas</option>
              <option value="Utah">Utah</option>
              <option value="Vermont">Vermont</option>
              <option value="Virginia">Virginia</option>
              <option value="Washington">Washington</option>
              <option value="West Virginia">West Virginia</option>
              <option value="Wisconsin">Wisconsin</option>
              <option value="Wyoming">Wyoming</option>
            </select>            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label></label></td>
          </tr>
        </table>
        <p>
          <input name="submit" type="submit" value="Update Profile" />
        </p>
      </form>
    </div>
    <table border="0" cellpadding="5" cellspacing="0" class="tableborder">
      <tr>
        <td colspan="6" class="tableTop">&nbsp;</td>
      </tr>
      <tr>
        <th>Position</th>
        <th>&nbsp;</th>
        <th>Group</th>
        <th>&nbsp;</th>
        <th>Email</th>
        <th><div align="center"></div></th>
      </tr>
      <tr  class="tableRowColor">
        <td nowrap="nowrap"><a href="#">Co - Chair Seaho </a> </td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">Govening Council  </td>
        <td>&nbsp;</td>
        <td nowrap="nowrap">cochairseaho@seaho.org </td>
        <td nowrap="nowrap"><div align="center"></div></td>
      </tr>
<tr>
        <td colspan="6" nowrap="nowrap" class="tableBottom">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <!-- InstanceEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
<!-- InstanceEnd --></html>
