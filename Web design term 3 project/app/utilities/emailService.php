<?php

namespace App\Utilities;

use App\Utilities\SessionManager;
use App\Services\UserService;
use App\Utilities\ErrorHandlerMethod;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $userService;
    private static function configureMailer()
    {

        $mail = new PHPMailer(true);
        require '../config/emailconfig.php';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $emailAddress;
        $mail->Password = $key;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        return $mail;
    }
    public static function sendEmail($email, $subject, $body)
    {
        try {
            $mail = self::configureMailer(); // Configure PHPMailer
            // Set email content
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->isHTML(true);

            // Send email
            $mail->send();
        } catch (Exception $e) {
            // Handle error
            // You can log the error or throw a custom exception
        }
    }
}