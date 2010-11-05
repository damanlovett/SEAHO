<?php
if(!isset($_REQUEST['action'])) {
  include("ImageEditor.php");
  $imageEditor = new ImageEditor("test.jpg", "images/");
  $action = $_REQUEST['action'];
  
  #######################
  // Eddie's sizes
  $w = 200;
  $h = 300;
  $imageEditor->resize($w, $h);

  #####################
  // end of eddie sizes

  if(($action=="resize") && (is_numeric($_REQUEST['width']) && is_numeric($_REQUEST['width']))) {
    if(520<$_REQUEST['width']) $w = 520;
    else $w = $_REQUEST['width'];
    if(300<$_REQUEST['height']) $h = 300;
    else $h = $_REQUEST['height'];
    $imageEditor->resize($w, $h);
  }
  else if(($action=="crop") && ((is_numeric($_REQUEST['x1']) && is_numeric($_REQUEST['y1'])) && (is_numeric($_REQUEST['x2']) && is_numeric($_REQUEST['y2'])))) {
    if($_REQUEST['x2']>520) $w = 520;
    else $w = $_REQUEST['x2'];
    if($_REQUEST['y2']>300) $h = 300;
    else $h = $_REQUEST['y2'];
    $imageEditor->crop($_REQUEST['x1'], $_REQUEST['y1'], $w, $h);
  }
  else if(($action=="addline") && ((is_numeric($_REQUEST['x1']) && is_numeric($_REQUEST['y1'])) && (is_numeric($_REQUEST['x2']) && is_numeric($_REQUEST['y2'])))) {

    
    $imageEditor->addLine($_REQUEST['x1'], $_REQUEST['y1'], $_REQUEST['x2'], $_REQUEST['y2'], Array(0, 0, 0));
  }
  else if(($action=="addtext") && ((is_numeric($_REQUEST['x1']) && is_numeric($_REQUEST['y1'])))) {
    $imageEditor->addText($_REQUEST['str'], $_REQUEST['x1'], $_REQUEST['y1'], Array(0, 0, 0));
  }
  else if(($action=="addshadow") && ((is_numeric($_REQUEST['x1']) && is_numeric($_REQUEST['y1'])))) {
    $imageEditor->setFont("/home/virtual/site50/fst/var/www/html/test/ARIBLK.TTF");
    $imageEditor->shadowText($_REQUEST['str'], $_REQUEST['x1'], $_REQUEST['y1'], Array(255, 255, 255), Array(0, 0, 0));
  }
  $imageEditor->outputImage();
}
else {
Header("Location: http://evoluted.net/archives/000011.php");
}
?>