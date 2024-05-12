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
    private static function configureMailer() {

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
}