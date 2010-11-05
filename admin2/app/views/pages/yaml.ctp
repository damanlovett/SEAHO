<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>jQuery Datepicker</title>
        <?php //echo $html->css('cake.generic'); ?>
        <?php echo $html->css('my_layout'); ?>
        <?php echo $html->css('basemod'); ?>
        <!--[if lte IE 7]>
        <?php echo $html->css('patch_my_layout'); ?>
        <![endif]-->
        <?php echo $javascript->link('jquery-1.3.2.min', false);?>
        <?php echo $javascript->link('jquery-ui-1.7.1.custom.min', false);?>
        <?php echo $javascript->link('sliding_effect',false);?>
        <?php echo $javascript->link('orUI', false);?>
	</head>
	<body>
  <div class="page_margins">
    <div id="border-top">
      <div id="edge-tl"></div>
      <div id="edge-tr"></div>
    </div>
    <div class="page">
      <div id="header">
        <div id="topnav">
          <!-- start: skip link navigation -->
          <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
          <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
          <!-- end: skip link navigation --><a href="#">Login</a> | <a href="#">Contact</a> | <a href="#">Imprint</a>
        </div>
      </div>
      <div id="nav">
        <!-- skiplink anchor: navigation -->
        <a id="navigation" name="navigation"></a>
        <div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul>
            <li class="active"><strong>Button 1</strong></li>
            <li><a href="#">Button 2</a></li>
            <li><a href="#">Button 3</a></li>
            <li><a href="#">Button 4</a></li>
            <li><a href="#">Button 5</a></li>
          </ul>
        </div>
      </div>
      <div id="main">
        <div id="col1">
          <div id="col1_content" class="clearfix">
            <!-- add your content here -->
          </div>
        </div>
        <div id="col3">
          <div id="col3_content" class="clearfix">
            <!-- add your content here -->
          </div>
          <!-- IE Column Clearing -->
          <div id="ie_clearing"> &#160; </div>
        </div>
      </div>
      <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
    </div>
    <div id="border-bottom">
      <div id="edge-bl"></div>
      <div id="edge-br"></div>
    </div>
  </div>
</body>
</html>