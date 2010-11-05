<?php require_once('../includefiles/init.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable --><!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable --><!-- TemplateParam name="Page Title" type="text" value="MembersPageTitle" -->
<link href="../styles/mainStyle.css" rel="stylesheet" type="text/css" />
<link href="../styles/navLeft.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><?php require_once('../includefiles/userInfo.php'); ?></div>
<div id="sidebar"><?php require_once('../includefiles/navPage.php'); ?></div>
<div id="mainContent">
  <div id="mainText">
    <h2><!-- TemplateBeginEditable name="PageTite" --><span>Page Title</span><!-- TemplateEndEditable --></h2>
	<!-- TemplateBeginEditable name="SectionTitle" -->
	<h3>Section Title</h3>
	<!-- TemplateEndEditable --><!-- TemplateBeginEditable name="PageInformation" -->
	<div id="pageInformation">
	<br />
	  <ul>
	    <li><strong>PageInformation </strong></li>
	    <li><strong>PageInformation</strong></li>
	    <li><strong>PageInformation</strong></li>
      </ul>
	  <hr/>
	<ul>
	  <li>&raquo;&nbsp;<a href="#">PageLink1</a></li>
	  <li>&raquo;&nbsp;<a href="#">PageLink2</a></li>
	  <li>&raquo;&nbsp;<a href="#">PageLink3</a></li>
	  <li>&raquo;&nbsp;<a href="#">PageLink4</a></li>
	  </ul>
	</div>
	<!-- TemplateEndEditable --><!-- TemplateBeginEditable name="PageText" -->
    <p>Content for  id "mainContent" Goes Here...</p>
  <!-- TemplateEndEditable --></div>
</div>
<div id="footer"><?php require_once('../includefiles/footer.php'); ?>
</div>
</body>
</html>
