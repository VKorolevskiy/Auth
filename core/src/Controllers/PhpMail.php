<?php

namespace App\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Vesp\Controllers\Controller;
use PHPMailer\PHPMailer\Exception;
class PhpMail extends Controller
{

    public static function composeEmail($email, $fullname, $messages, $subject)
    {

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host = getenv('APP_SMTP_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = getenv('APP_SMTP_USERNAME');
            $mail->Password = getenv('APP_SMTP_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom(getenv('APP_SMTP_USERNAME'), getenv('APP_NAME'));
            $mail->addAddress($email, $fullname);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $messages;
            $mail->Send();


        } catch (Exception $e) {
            return back()->with('error','Message could not be sent.');
        }

    }

}
