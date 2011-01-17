<?php 
$mailto = 'web@seaho1965.org';
$mailfrom = 'webmaster@seaho1965.org';
$nominator = $_POST['Nominator'];
$email = $_POST['email'];
$comfirmMessage = "Thanks, ".$speaker." for your registration!\n\n";
$comfirmMessage .= "You will recieve confirmation within 48 hours\n";
$comfirmMessage .= "that your registration was accepted.";

$subject = 'Human Award Nomination';
$message = "Leon, ".$nominator." has submitted a Human Award Nomination.\n";
$message .= "You can log into the SEAHO.or website.\n\n";
$message .= "There email is ".$email." .";
mail($mailto, $subject, $message);

header("Location: thanks.php"); Break;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
