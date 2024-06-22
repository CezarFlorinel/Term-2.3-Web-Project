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
    private $sessionManager;
    
    public function __construct()
    {
        $this->userService = new UserService();
        $this->sessionManager = new SessionManager();
    }
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
    public function sendEmailForUpdateUser($email, $name, $subject, $body)
    {
        try {

            $mail = self::configureMailer(); // Configure PHPMailer

            // Set email content
            $mail->setFrom($mail->Username, 'Team Haarlem');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->SMTPDebug = 0;

            // Send email
            $mail->send();
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/userAccount');
        }
    }
}