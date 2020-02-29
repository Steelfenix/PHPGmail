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


        print("test");
        foreach ($emailEnvelope->getAttachments() as $fileAttachment) {
            $file_encoded = base64_encode(file_get_contents($fileAttachment));
            $mail->addAttachment(
                $file_encoded,
                "application/text",
                "TestFile.txt",
                "attachment"
            );
        }
        unset($fileAttachment);

        return $mail;
    }

    function GetSendGrid(EmailEnvelope $emailEnvelope)
    {
        $email = new \SendGrid\Mail\Mail();
        $emailUser = getenv('PHP_MAILER_USER');

        $email->setFrom($emailUser, 'No Responder');
        $email->setSubject($emailEnvelope->getSubject());

        foreach ($emailEnvelope->getAddresses() as $address) {
            $email->addTo($address, $address);
        }

        $email->addContent("text/html", $emailEnvelope->getBody());

        foreach ($emailEnvelope->getAttachments() as $fileAttachment) {
            $file_encoded = base64_encode(file_get_contents($fileAttachment));
            $email->addAttachment(
                $file_encoded,
                "application/text",
                "TestFile.txt",
                "attachment"
            );
        }
        unset($fileAttachment);

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        return $sendgrid->send($email);
    }
}
