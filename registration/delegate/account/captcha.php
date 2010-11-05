<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php
$len=(isset($_GET['len']) && $_GET['len']!="")?(($_GET['len']>14)?14:(($_GET['len']<3)?3:$_GET['len'])):5;
$encript = md5(microtime() * mktime());
$passcode = substr(strtoupper($encript),0,$len);
$ext="png";

$image_file="";
$is_image=false;
if(isset($_GET['image_file']) && file_exists($_GET['image_file'])){
	$pos = strrpos($_GET['image_file'], ".");
	$ext = substr($_GET['image_file'], $pos + 1);
	if(strtoupper($ext)=="PNG"){
		$captcha = imagecreatefrompng($_GET['image_file']);
	}else if(strtoupper($ext)=="GIF"){
		$captcha = imagecreatefromgif($_GET['image_file']);
	}else if(strtoupper($ext)=="JPG" || strtoupper($ext)=="JPEG"){
		$ext="jpeg";
		$captcha = imagecreatefromjpeg($_GET['image_file']);
	}
}
else{
	$captcha = imagecreate(200,28);
	$b1=(isset($_GET['b1']) && $_GET['b1']!="")?$_GET['b1']:233;
	$b2=(isset($_GET['b2']) && $_GET['b2']!="")?$_GET['b2']:235;
	$b3=(isset($_GET['b3']) && $_GET['b3']!="")?$_GET['b3']:235;
	$back_color = imagecolorallocate($captcha,$b1,$b2,$b3);
	imagefilledrectangle ($captcha, 0,0,200,20, $back_color);
}

$t1=(isset($_GET['t1']) && $_GET['t1']!="")?$_GET['t1']:0;
$t2=(isset($_GET['t2']) && $_GET['t2']!="")?$_GET['t2']:0;
$t3=(isset($_GET['t3']) && $_GET['t3']!="")?$_GET['t3']:0;

$text_color = imagecolorallocate($captcha, $t1,$t2,$t3);


imageline($captcha,0,14,imagesx($captcha),19,$text_color);
imageline($captcha,0,20,imagesx($captcha),24,$text_color);

if(@imageloadfont("linecraft_captcha.gdf")){
	$font = imageloadfont("linecraft_captcha.gdf");
	imagestring($captcha, $font, 5, 5, $passcode, $text_color);	
}else{
	imagestring($captcha, 5, 5, 5, $passcode, $text_color);
}
imagestring($captcha, $font, 5, 5, $passcode, $text_color);
header("Content-type: image/".strtolower($ext));
if(strtoupper($ext)=="PNG"){
	imagepng($captcha);
}else if(strtoupper($ext)=="GIF"){
	imagegif($captcha);
}else if(strtoupper($ext)=="JPEG"){
	imagejpeg($captcha);
}
session_start();
$_SESSION['captcha'] = md5($passcode);

?>