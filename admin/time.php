<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 

$timeone = 20070521;
$timetwo = 20070522;
$timethree = 20070523;

?>

<p>

Time is <?php echo $timeone;?><br />
Strt is <?php echo strtotime($timeone);?><br />
<br />

Time is <?php echo strtotime($timethree);?> is tomorrow<br />
Time is <?php echo strtotime($timeone);?> is yesterday<br />
Time is <?php echo strtotime($timetwo);?> is today


</p>



</body>
</html>
