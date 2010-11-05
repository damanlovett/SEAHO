<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
  <?php $_POST['timebox'] = $_POST['hour'].":".$_POST['minute']."".$_POST['stamp']?>
<?php if(isset($_POST['Submit'])) {echo $_POST['time_test'];}?>
<form id="form1" name="form1" method="post" action="">
  <select name="hour" id="hour">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
 :  
 
  <select name="minute" id="minute">
    <option value="00">00</option>
    <option value="05">05</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    <option value="25">25</option>
    <option value="30">30</option>
    <option value="35">35</option>
    <option value="40">40</option>
    <option value="45">45</option>
    <option value="50">50</option>
    <option value="55">55</option>
  </select>
  <select name="stamp" id="stamp">
    <option value="am">am</option>
    <option value="pm">pm</option>
  </select>
  <input type="submit" name="Submit" value="Submit" />
</form>
</body>
</html>
