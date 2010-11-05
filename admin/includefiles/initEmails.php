<?
// Magic Quotes - This is the normal magic quotes that Dreamweaver adds to pages with recordsets
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// Email System
function systemEmail($subject,$htmlBody,$mail_to,$mailto_first,$mailto_last){

$mailto_name = $mailto_first." ".$mailto_last;

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/phpmailer/MailClass.inc');

$mailer = new FreakMailer();
$mailer->Subject = $subject;
$mailer->Body = $htmlBody;
$mailer->isHTML(true);
$mailer->FromName = $_SESSION['email'];
$mailer->AddAddress($mail_to, $mailto_name);
$mailer->Send(); 
if(!$mailer->Send())
{
  echo 'There was a problem sending this mail!';
}
else
{
  echo 'Mail sent to '.$mailto_name.'!<br />';
}
$mailer->ClearAddresses();
$mailer->ClearAttachments();

}

// Password Update - emails the user their password   
function passwordUpdate($firstName,$mailto,$password)
{
// Variables
$subject = "SEAHO Password Request";

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

<h3>Password Update</h3>
<hr />

<p>Dear ".$firstName."</p>

<p>This email is being sent to you because a \" Forgot Password \" request has been submitted.  If you did not request for your password to be emailed to you, please contact the webmaster at <a href='webmaster@seaho.org'>webmaster@seaho.org</a>.  Below is the your information.</p>

<p>
<strong>user/email: ".$mailto."<br />
password: ".$password."</strong>

</p>
</body>
</html>
";

mail($mailto, $subject, $message,$headers);


}

//  Email New Member Information    
function NewMemberEmail($firstName,$mailto,$password)
{
    // Variables
    $subject = "Welcome to SEAHO LCCM";

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

    <h3>Welcome to LCCM</h3>
    <hr />

    <p>Dear ".$firstName."</p>

<p>Welcome to the SEAHO LCCM system.  The Lovett Creations Content Manager is your member portal that will allow you access to vital information pertaining to SEAHO.</p>

<p>Your new account has been created, and is ready for you to access.  Below you will find your login information.  Your next step is to login at <a href='http://seaho.org/admin/login.php?user=".$mailto."'>SEAHO LCCM</a>.  If you have any question please let us know.  Thanks and enjoy.
<hr />
<strong>user/email: </strong>".$mailto."<br />
<strong>password: </strong>".$password."</p>
<hr />

</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}

//  Simple Email Notification Form - used to send a simple email
function emailNotification($name,$title,$information,$mailto)
{
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
    <body>
    <p>".$name.",<br />
    <strong>".$title."</strong> has been submitted.  
    The following information was submitted.</p>
    <p>".$information."</p>

    </body>
    </html>
    ";

    mail($mailto, $subject, $message,$headers);

}

//Email Record - email sent information into a database
function emailRecord($Title,$mailto,$emailmessage){
global $database_Directory;
global $Directory;
$sent_by = $_SESSION['display_name'];

$insertSQL = sprintf("INSERT INTO email_records (title, sent_by, emailmessage, sent_to) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($Title, "text"),
                       GetSQLValueString($sent_by, "text"),
                       GetSQLValueString($emailmessage, "text"),
                       GetSQLValueString($mailto, "text"));

mysql_select_db($database_Directory, $Directory);
$Result1 = mysql_query($insertSQL, $Directory) or die(mysql_error());
}

//  General Email Form      
function generalEmail($subject,$mailto,$emailmessage)
{

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

".$emailmessage." 
</body>
</html>
";

mail($mailto, $subject, $message,$headers);

}


// Send Forgot Password information
if (isset($_POST['forgot'])) {
$colname_rsUserInfo = "-1";
if (isset($_POST['forgot'])) {
  $colname_rsUserInfo = $_POST['forgot'];
}

mysql_select_db($database_Directory, $Directory);
$query_rsUserInfo = sprintf("SELECT * FROM users WHERE email = %s AND 'delete' = 0", GetSQLValueString($colname_rsUserInfo, "text"));
$rsUserInfo = mysql_query($query_rsUserInfo, $Directory) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);

//User is not in the system
if($totalRows_rsUserInfo == '0') {
		$errorMessage = "Your email address is not in system";
}

//User is not active
if($row_rsUserInfo['active'] == '0') {
		$errorMessage = "Your account is not active";
}

//User is in the system 
if($totalRows_rsUserInfo == '1') {
		passwordUpdate($row_rsUserInfo['first_name'],$row_rsUserInfo['email'],$row_rsUserInfo['password']);
		$errorMessage = "Your password has been emailed to you.";
}
}
?>