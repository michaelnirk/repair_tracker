<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//require_once 'PHPMailer/PHPMailerAutoload.php';
require 'vendor/autoload.php';

function sendMail($to, $from, $subject, $body){
    $mail = new PHPMailer();
    
    $mail->IsSMTP(); // enable SMTP
    $mail->isHTML(true);//enable HTML
	$mail->SMTPDebug = 4;  // debugging: 1 = errors and messages, 2 = messages only
    //
	//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    
    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    
    
    //Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';
    
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587; 
    
    //Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';
    
    //Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET,
        ]
    );
    
    //Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => CLIENT_ID,
                'clientSecret' => CLIENT_SECRET,
                'refreshToken' => REFRESH_TOKEN,
                'userName' => GMAIL_USER_NAME,
            ]
        )
    );
    $mail->CharSet = 'utf-8';
	$mail->SetFrom($from);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
//		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
//		$error = 'Message sent!';
		return true;
	}

}

