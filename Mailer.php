<?php

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    function GetPHPMailer(EmailEnvelope $emailEnvelope)
    {
        $mail = new PHPMailer();

        $emailUser = getenv('PHP_MAILER_USER');
        $emailPassword = getenv('PHP_MAILER_PASWORD');
        $emailPort = getenv('PHP_MAILER_PORT');

        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $emailUser;
        $mail->Password = $emailPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $emailPort;

        $mail->setFrom($emailUser, $emailEnvelope->getSender());
        foreach ($emailEnvelope->getAddresses() as $address) {
            $mail->addAddress($address);
        }
        unset($address);


        $mail->isHTML(true);
        $mail->Subject = $emailEnvelope->getSubject();
        $mail->Body = $emailEnvelope->getBody();

        return $mail;
    }
}
