<?php 
function moderatorEmail($Title,$ProgramNumber,$modName,$modEmail,$modMessage)
{

//$first = $_POST['firstName'];
//$last = $_POST['lastName'];
//$institution = $_POST['institution'];
//$email = $_POST['email'];
$subject = "Moderator Request";
$mailto = "roger.montiel@emory.edu";
//$mailto = "eddie@lovettcreations.org";

// Header for return address
$headers = 'From: webmaster@seaho.org' . "\r\n" .
   'Reply-To: webmaster@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000066;
	font-weight: bold;
}
-->
</style>
<body>

<p>
You have a request to moderate a program.</p>
<hr />
<p>
Name: ".$modName."<br />
Email: ".$modEmail."</p>

<p>
<strong>".$Title."</strong><br />
Number: ".$ProgramNumber."<br /><br />
<strong>Message:</strong><br />
".$modMessage."
</p>
<hr />
</body>
</html>
";

mail($mailto, $subject, $message,$headers);


}
?>