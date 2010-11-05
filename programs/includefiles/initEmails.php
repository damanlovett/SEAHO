<?
/////////////////////////////////////////////////
///////////     Password Update    /////////////

function passwordRequest($firstName,$mailto,$password)
{
// Variables
$subject = "Password Request";

// Header for return address
$headers = 'From: webmaster@seaho.org' . "\r\n" .
   'Reply-To: webmaster@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

<h3>Password Request</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>This email is being sent to you because your password has been requested.  If you did not request for your password to be sent to you please contact the webmaster at webmaster@seaho.org ASAP.  Below is the information, that was requested. </p>

<p>
<strong>user/email: ".$mailto."<br />
password: ".$password."</strong>

</p>
</body>
</html>
";

mail($mailto, $subject, $message,$headers);


}

function emailRecord($Title,$mailto,$emailmessage){
		global $database_programming;
		global $Programming;
		$sent_by = $_SESSION['first_name']." ".$_SESSION['last_name'];

  $insertSQL = sprintf("INSERT INTO email_records (title, sent_by, emailmessage, sent_to) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($Title, "text"),
                       GetSQLValueString($sent_by, "text"),
                       GetSQLValueString($emailmessage, "text"),
                       GetSQLValueString($mailto, "text"));

  mysql_select_db($database_Programming, $Programming);
  $Result1 = mysql_query($insertSQL, $Programming) or die(mysql_error());


}

function presenterEmail($firstName,$subject,$mailto,$Title,$emailmessage)
{

// Header for return address
$headers = 'From: programming@seaho.org' . "\r\n" .
   'Reply-To: programming@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

<h3>Programming Committee Proposal Info</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>
<strong>Program:</strong> ".$Title."</p>
".$emailmessage." 
</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}



function submissionEmail($firstName,$subject,$mailto,$Title)
{

// Header for return address
$headers = 'From: programming@seaho.org' . "\r\n" .
   'Reply-To: programming@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

<h3>Programming Committee Proposal Info</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>
Thank you for submitting <strong>".$Title."</strong>.</p>

<p>This is your confirmation that your program has been entered into the system.  The Program
Committee will contact you about your program.  All emails will be sent to you as the main contact, 
so please share any information from the Program Committee with your co-presenter(s). 
</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}

////////////////////////////////////////////
//////     General Email Form       ////////


function generalEmail($subject,$mailto,$emailmessage)
{

// Header for return address
$headers = 'From: programming@seaho.org' . "\r\n" .
   'Reply-To: programming@seaho.org' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
   
// Header for html email
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// Message Area

$message = "
<html>
<style type='text/css'>
<!--
.boldcolor {
	color: #000099;
	font-weight: bold;
}
.style1 {color: #000099}
-->
</style>
<body>

".$emailmessage." 
</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}

?>
