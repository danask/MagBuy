<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'example@gmail.com'; // your email id
    $mail->Password = 'password'; // your password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
    $mail->setFrom('sendfrom@gmail.com', 'Name');
    $mail->addAddress('sendto@yahoo.com');   // Add a recipient
    $mail->isHTML(true);  // Set email format to HTML

    $bodyContent = '<h1>HeY!,</h1>';
    $bodyContent .= '<p>This is a email that Radhika send you From LocalHost using PHPMailer</p>';
    $mail->Subject = 'Email from Localhost by Radhika';
    $mail->Body    = $bodyContent;
    if(!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}