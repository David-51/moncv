<?php

use App\Assets\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(!isset($_POST['firstname'], $_POST['lastname'], $_POST['subject'], $_POST['project'], $_POST['email'])){
    Logger::setMessage('Error sending Message, no enough parameters');
    http_response_code(400);
    echo json_encode(['message' => 'No enough parameters']);
    die;
}

echo json_encode(['Message' => $_POST['project']]);
// Configure message to send by mail with phpmailer

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $_ENV['PHPMAILER_SMTP'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $_ENV['PHPMAILER_FROM'];                     //SMTP username
    $mail->Password   = $_ENV['PHPMAILER_PASSWORD'];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = $_ENV['PHPMAILER_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_ENV['PHPMAILER_FROM'], $_ENV['PHPMAILER_USERNAME']);
    $mail->addAddress($_ENV['PHPMAILER_TO'], 'La Guilde');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($_ENV['PHPMAILER_FROM'], $_ENV['PHPMAILER_USERNAME']);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['project'];
    // $mail->AltBody = $_POST['project'];
    
    $mail->send();
    echo 'Message has been sent';
} catch (\Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    Logger::setMessage($mail->ErrorInfo);
}