<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo 'No arguments Provided!';
	return false;
   }

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Create the email and send the message
$to = 'allochory@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = 'Website Contact Form:  $name';
$email_body = 'You have received a new message from your website contact form.\r\n\r\n Here are the details:\r\n\r\nName: $name\r\n\r\nEmail: $email_address\r\n\r\nPhone: $phone\r\n\r\nMessage:\r\n$message';
$headers = 'From: contact@allochory.org\r\n'; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= 'Reply-To: $email_address';
// mail($to,$email_subject,$email_body,$headers);
// Use sendgrid to send the email

$url = 'https://api.sendgrid.com/';
$user = 'allochory'
$pass = 'sorbonne2015'
$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'to'        => $to,
    'subject'   => 'Contact Form Submission',
    'html'      => $message,
    'text'      => $message,
    'from'      => 'allochory@gmail.com',
);
$request = $url.'api/mail.send.json'
// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);
return true;
?>
