<html>
<head>

  <title><?php echo $title_for_layout?></title>
<?php echo $html->css(array('cake.generic','cake.lccm'));?>
</head>
<?php $session->flash()?>
<body>
    <div id="container">
       <div id="content">
         <?php echo $content_for_layout;?>
       </div>
     </div> 
</body>
</html>