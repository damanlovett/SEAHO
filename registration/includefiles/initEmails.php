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

//Email Record - email sent information into a database
function emailSystemRecord($Title,$mailto,$emailmessage){
global $database_CMS;
global $CMS;
$sent_by = $_SESSION['display_name'];

$insertSQL = sprintf("INSERT INTO email_records (title, sent_by, emailmessage, sent_to) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($Title, "text"),
                       GetSQLValueString($sent_by, "text"),
                       GetSQLValueString($emailmessage, "text"),
                       GetSQLValueString($mailto, "text"));

mysql_select_db($database_CMS, $CMS);
$Result1 = mysql_query($insertSQL, $CMS) or die(mysql_error());
}


// Password Update - emails the user their password   
function passwordUpdate($firstName,$mailto,$user,$password)
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
<strong>user/email: ".$user."<br />
password: ".$password."</strong>

</p>
</body>
</html>
";

mail($mailto, $subject, $message,$headers);
emailSystemRecord($subject,$mailto,$message);

}

//  Email New Member Information    
function NewMemberEmail($firstName,$mailto,$password)
{
    // Variables
    $subject = "Thanks for Creating a SEAHO Account";

    // Header for return address
    $headers = 'From: no-reply@seaho.org' . "\r\n" .
   'Reply-To: no-reply@seaho.org' . "\r\n" .
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

    <p>Dear ".$firstName."</p>

<p>Welcome to the SEAHO Conference Manager.</p>

<p>Your new account has been created, and is ready for you to access and below you will find your login information.  Your next step is to login to the Conference Management System ( http://seaho.org/registration/associates/ ) and review your profile.  You can also check to see what conferences are currently accepting registrations.  

<br />
<br />If you have any question please let us know.  Thanks and enjoy.
<hr />
<strong>username/email: </strong>".$mailto."<br />
<strong>password: </strong>".$password."</p>
<hr />

</body>
</html>
";

mail($mailto, $subject, $message,$headers);
emailSystemRecord($subject,$mailto,$message);

}

//  Email Registration Information    
function registrationConfirmation($displayName,$mailto,$conference)
{
    // Variables
    $subject = "SEAHO Conference Registration";

    // Header for return address
    $headers = 'From: no-reply@seaho.org' . "\r\n" .
   'Reply-To: no-reply@seaho.org' . "\r\n" .
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

    <h3>Welcome to ".$conference."</h3>
    <hr />

    <p>Dear ".$displayName."</p>

<p>Thank you for your conference registration.  This is your official notification that your registration has been entered into the New Conference Management System.  You can login and review the status of your registration as well as vital conference information.</p>

</body>
</html>
";

mail($mailto, $subject, $message,$headers);
emailSystemRecord($subject,$mailto,$message);

}
//  Email Registration Information    
function registrationConfirmationNEW($displayName,$mailto,$conference,$location,$payto,$checksto,$support)
{
    // Variables
    $subject = $conference." Registration";

    // Header for return address
    $headers = 'From: no-reply@seaho.org' . "\r\n" .
   'Reply-To: no-reply@seaho.org' . "\r\n" .
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

    <h3>Welcome to ".$conference."</h3>
    <hr />

    <p>Dear ".$displayName."</p>

<p>Thank you for registering to attend the ".$conference." Conference to be held in ".$location.". This e-mail message is to confirm receipt of your registration.</p>

<p>As a reminder, ".$checksto." all checks or other correspondence regarding ".$conference." registration should be sent to:  <br /><br />".$payto."</p>

<p>Please allow 3-5 days for processing of your registration payment. Once your payment has been received and credited, you will receive an additional e-mail message confirming payment.</p>

<p>If you have any additional questions or concerns, please feel free to contact the ".$conference." Registration Committee at <br /><br />".$support.".</p>

<p>For additional conference information, check out the SEAHO web site and click on the ".$conference.".</p>

<p>We look forward to seeing you in Willamsburg!</p>

<p>Sincerely,</p>
<p>".$conference." Registration Committee </p>
</body>
</html>
";

mail($mailto, $subject, $message,$headers);
emailSystemRecord($subject,$mailto,$message);

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
	emailSystemRecord($subject,$mailto,$message);

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
emailSystemRecord($subject,$mailto,$message);

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