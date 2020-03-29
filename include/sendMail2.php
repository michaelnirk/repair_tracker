<?php

//Import PHPMailer classes into the global namespace
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\OAuth;
// Alias the League Google OAuth2 provider class
//use League\OAuth2\Client\Provider\Google;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//require_once 'PHPMailer/PHPMailerAutoload.php';
require 'vendor/autoload.php';

function sendMail2() {
  //Create a new PHPMailer instance
  $mail = new PHPMailer();

//Tell PHPMailer to use SMTP
  $mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
  $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = 'noreply.repairtracker';

//Password to use for SMTP authentication
  $mail->Password = '6O3G42owh*Ou';

//Set who the message is to be sent from
  $mail->setFrom('repairtracker@gmail.com', 'Repair Tracker');

//Set an alternative reply-to address
//  $mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
  $mail->addAddress('nirkules@gmail.com', '');

//Set the subject line
  $mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//  $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

//Replace the plain text body with one created manually
  $mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//  $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
  if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
  }




//
//  $mail = new PHPMailer();
//
//  $mail->IsSMTP(); // enable SMTP
//  $mail->isHTML(true); //enable HTML
//  $mail->SMTPDebug = 4;  // debugging: 1 = errors and messages, 2 = messages only
//  //
//  //Set the encryption system to use - ssl (deprecated) or tls
//  $mail->SMTPSecure = 'tls';
//
//  //Whether to use SMTP authentication
//  $mail->SMTPAuth = true;
//
//
//  $mail->SMTPOptions = array(
//      'ssl' => array(
//          'verify_peer' => false,
//          'verify_peer_name' => false,
//          'allow_self_signed' => true
//      )
//  );
//
//
//
//  //Set AuthType to use XOAUTH2
//  $mail->AuthType = 'XOAUTH2';
//
//  $mail->Host = 'smtp.gmail.com';
//  $mail->Port = 587;
//
//  //Set AuthType to use XOAUTH2
//  $mail->AuthType = 'XOAUTH2';
//
//  //Create a new OAuth2 provider instance
//  $provider = new Google(
//          [
//      'clientId' => CLIENT_ID,
//      'clientSecret' => CLIENT_SECRET,
//          ]
//  );
//
//  //Pass the OAuth provider instance to PHPMailer
//  $mail->setOAuth(
//          new OAuth(
//                  [
//              'provider' => $provider,
//              'clientId' => CLIENT_ID,
//              'clientSecret' => CLIENT_SECRET,
//              'refreshToken' => REFRESH_TOKEN,
//              'userName' => GMAIL_USER_NAME,
//                  ]
//          )
//  );
//  $mail->CharSet = 'utf-8';
//  $mail->SetFrom($from);
//  $mail->Subject = $subject;
//  $mail->Body = $body;
//  $mail->AddAddress($to);
//  if (!$mail->Send()) {
////        echo "Mailer Error: " . $mail->ErrorInfo;
////		$error = 'Mail error: '.$mail->ErrorInfo; 
//    return false;
//  } else {
////		$error = 'Message sent!';
//    return true;
//  }
}
