<?php
 
// Grab our config settings
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
 
// Grab the FreakMailer class
require_once($_SERVER['DOCUMENT_ROOT'].'/phpmailer/MailClass.inc');
 
// instantiate the class
$mailer = new FreakMailer();
 
// Set the subject
$mailer->Subject = $_GET['subject'];
 
// Body
//$mailer->Body = 'This is a test of my mail system!';
 
// Adding HTML email ( eddie )
$htmlBody = $_GET['emailmessage'];
 
$mailer->Body = $htmlBody;
$mailer->isHTML(true);
 

// New From Address ( eddie )
$mailer->FromName = 'Da Man Lovett';
$mailer->From = 'daman@lovettcreations.org';
 
// Add an address to send to.
$mailer->AddAddress('eddie_lovett@ncsu.edu', 'Eddie Lovett');
 
// Add CC ( eddie )
$mailer->AddCC('eddie@lovettcreations.org', 'First Person');
 
// Add BCC ( eddie )
$mailer->AddBCC('recipient2@domain.com', 'Second Person');
 
if(!$mailer->Send())
{
  echo 'There was a problem sending this mail!';
}
else
{
  echo 'Mail sent!';
}
$mailer->ClearAddresses();
$mailer->ClearAttachments();
?>
