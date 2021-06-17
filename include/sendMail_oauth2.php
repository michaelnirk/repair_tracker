<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//require_once 'PHPMailer/PHPMailerAutoload.php';
require 'vendor/autoload.php';

function sendMail(array $to, $subject, $body){
    $mail = new PHPMailer();
    
    $mail->IsSMTP(); // enable SMTP
    $mail->isHTML(true);//enable HTML
	$mail->SMTPDebug = 4;  // debugging: 1 = errors and messages, 2 = messages only
    //
	//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true; 
    
    //Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';
    
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587; 
    
    //Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';
    
    //Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => $_ENV['GMAIL_OAUTH_CLIENT_ID'],
            'clientSecret' => $_ENV['GMAIL_OAUTH_CLIENT_SECRET'],
        ]
    );
    
    //Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $_ENV['GMAIL_OAUTH_CLIENT_ID'],
                'clientSecret' => $_ENV['GMAIL_OAUTH_CLIENT_SECRET'],
                'refreshToken' => $_ENV['GMAIL_OAUTH_REFRESH_TOKEN'],
                'userName' => $_ENV['GMAIL_USER_NAME'],
            ]
        )
    );
    $mail->CharSet = 'utf-8';
	$mail->SetFrom($_ENV['GMAIL_FROM']);
	$mail->Subject = $subject;
	$mail->Body = $body;
    foreach($to as $recipient) {
        $mail->AddAddress($recipient);
    }
	if(!$mail->Send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
//		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
//		$error = 'Message sent!';
		return true;
	}

}

