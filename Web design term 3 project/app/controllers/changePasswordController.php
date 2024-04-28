<?php
namespace App\Controllers;

use App\Utilities\SessionManager;
use App\Services\UserService;
use App\Utilities\ErrorHandlerMethod;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ChangePasswordController
{

    private $sessionManager;
    private $userService;

    private $starterLink = 'http://localhost/changePassword';

    public function index()
    {
        require __DIR__ . '/../views/user_management_account/changePassword.php';
    }

    public function __construct()
    {
        $this->userService = new UserService();
        $this->sessionManager = new SessionManager();
        session_start();
    }
    public function checkIfEmailExists()
    {
        try {
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/changePassword', $_SERVER['REQUEST_METHOD']);

            if (!isset($_POST['email'])) {
                $this->sessionManager->setError("Please insert your email address");
                header('Location: /changePassword');
                exit;
            }

            $email = $_POST['email'];
            $user = $this->userService->getByEmail($email);

            if ($user == null) {
                $this->sessionManager->setError("The email address does not exist. Please try again.");
                header('Location: /changePassword');
                exit;
            }

            $uniqueKey = $this->generateUniqueKey($user['userID']);
            $link = $this->starterLink . "?userID=" . $user['userID'] . "&secondPhase=true";

            $this->sendEmailWithData($email, $uniqueKey, $link);
            header('Location: /changePassword');
            $this->sessionManager->setSuccess("An email has been sent to you. Please check your email to change your password.");
            exit;

        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/changePassword');
        }

    }

    public function changePassword()
    {

        try {
            ErrorHandlerMethod::serverIsNotPostMethodCheck($this->sessionManager, '/changePassword', $_SERVER['REQUEST_METHOD']);

            $link = $this->starterLink . "?userID=" . $_POST['userID'] . "&secondPhase=true";

            $this->runChecksOnChangePassword($link);

            if ($_POST['newPassword'] === $_POST['confirmPassword']) {
                $this->userService->changePassword($_POST['userID'], $_POST['newPassword']);
                $this->userService->deleteKey($_POST['key']);
                $this->sessionManager->setSuccess("The password has been changed successfully.");
                header('Location: /');
                exit;
            }

        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/changePassword');
        }
    }

    private function runChecksOnChangePassword($link)
    {
        if (!isset($_POST['key']) || !isset($_POST['confirmPassword']) || !isset($_POST['newPassword'])) {
            $this->sessionManager->setError("Please fill in all the fields");
            header('Location: ' . $link);
            exit;
        }

        if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
            $this->sessionManager->setError("The passwords do not match. Please try again.");
            header('Location: ' . $link);
            exit;
        }

        if (strlen($_POST['key']) !== 6 || !ctype_digit($_POST['key']) || !$this->userService->checkIfKeyExists($_POST['key'])) {
            $this->sessionManager->setError("The key is not correct. Please try again.");
            header('Location: ' . $link);
            exit;
        }

        if (strlen($_POST['newPassword']) < 8) {
            $this->sessionManager->setError("The password must be at least 8 characters long.");
            header('Location: ' . $link);
            exit;
        }

    }

    private function sendEmailWithData($email, $keyResetPassword, $link)
    {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        require '../config/emailconfig.php';

        try {
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $emailAddress;
            $mail->Password = $key;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($emailAddress, 'Team Haarlem');
            $mail->addAddress($email, $name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Change your password';
            $mail->Body = 'Please click on the following link to change your password: ' . $link . ' and insert the following key: ' . $keyResetPassword;
            $mail->AltBody = 'Please click on the following link to change your password: ' . $link . ' and insert the following key: ' . $keyResetPassword;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->SMTPDebug = 0;

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/changePassword');
        }
    }

    private function generateUniqueKey(int $userID): int
    {
        $uniqueKey = 0;
        if ($this->userService->returnUserKey($userID) === null) {
            $uniqueKey = $this->userService->insertKeyUnique($userID);
        } else {
            $uniqueKey = $this->userService->returnUserKey($userID);
        }

        return $uniqueKey;
    }
}