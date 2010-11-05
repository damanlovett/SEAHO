<?php require_once('../../Connections/Programming.php'); ?>
<?php require_once('../includefiles/init.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>LCCM Home Page</title>

<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
<link href="../styles/table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#pageInformation {
	background-color: #FFFFFF;
	border: 1px solid #999999;
	padding-top: 3px;
	padding-right: 3px;
	padding-bottom: 7px;
	padding-left: 3px;
	margin-bottom: 20px;
	margin-top: 20px;
}
-->
</style>
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="mainContentHome">
  <div id="mainText">
<div id="pageInformation">	
	  <table border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td valign="top"><img src="../images/PHreview.jpg" alt="review" width="65" height="51" /></td>
          <td width="40%" align="left" valign="top" class="homepageTitles"><a href="myprograms/index.php" class="homepageTitles">Review Programs</a><br />
          View and vote on the programs that were assigned to you for review. </td>
          <td align="center" valign="top"><div align="center"></div>
          <img src="../images/imgPHUser.jpg" alt="Users" width="60" height="51" /></td>
          <td width="40%" align="left" valign="top" class="homepageTitles"><a href="account/index.php" class="homepageTitles">My Account </a><br />
            View and update your account information. This area includes your password information.</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td width="40%" align="left" valign="top" class="homepageTitles">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td width="40%" align="left" valign="top" class="homepageTitles">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><img src="../images/PHprogramsStatus.jpg" alt="programstatus" width="60" height="60" /></td>
          <td width="40%" align="left" valign="top" class="homepageTitles"> <a href="listings/index.php" class="homepageTitles">Program Status </a><br />
View the status of each program. The status is assigned by the Program Chairperson. </td>
          <td align="center" valign="top"><div align="center"></div>
          <img src="../images/PHprograms.jpg" alt="programs" width="65" height="51" /></td>
          <td width="40%" align="left" valign="top" class="homepageTitles"><a href="listings/index.php" class="homepageTitles">Program List </a><br />
            View all programs that were submitted. </td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td width="40%" align="left" valign="top" class="homepageTitles">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td width="40%" align="left" valign="top" class="homepageTitles">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><img src="../images/PHreports.jpg" alt="reports" width="60" height="60" /></td>
          <td width="40%" align="left" valign="top" class="homepageTitles"><a href="reports/">Reports</a><br />
View and download all reports. So reports my be for administrators only. </td>
          <td align="center" valign="top"><div align="center"></div>
		  <?php if($_SESSION['access']!=3){?>
          <img src="../images/PHadministration.jpg" alt="admin" width="60" height="60" />
		  <?php }?>
		  </td>
          <td width="40%" align="left" valign="top" class="homepageTitles">
		  <?php if($_SESSION['access']!=3){?>
		  <p><a href="account/" class="homepageTitles">Administration</a><br />
          Manage the LCCM system. This section includes all administrative areas, and is only available to members with the administrative status.</p>          
		  <?php }?>
		  </td>
        </tr>
      </table>
	</div></p>
  </div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
</html>
