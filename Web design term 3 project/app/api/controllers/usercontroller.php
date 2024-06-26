<?php

namespace App\Api\Controllers;

use App\Services\UserService;
use App\Models\User\User;
use App\Utilities\EmailService;
use App\Models\User\UserRole;
use App\Utilities\ImageEditor;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\HandleDataCheck;

class UserController
{
    private $userService;
    private $emailService;


    private $filters = [
        'email' => FILTER_SANITIZE_EMAIL,
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'role' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'registrationDate' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ];

    function __construct()
    {
        $this->userService = new UserService();
        $this->emailService = new EmailService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->create();
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET['id'] ?? null;

            if ($id !== null) {
                $this->getById($id);
            } else {
                $this->getAllUsers();
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->update();
        } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->delete();
        }
    }

    public function changePassword()
    {
        session_start();
        $jsonInput = file_get_contents('php://input');
        $input = json_decode($jsonInput, true);

        if (isset($_SESSION['userId'])) {
            $user = new User($this->userService->getById($_SESSION['userId']));

            if (isset($input['oldPassword'])) {
                $oldPassword = $input['oldPassword'];

                if (password_verify($oldPassword, $user->getPassword())) {
                    if (isset($input['newPassword'])) {
                        $newPassword = $input['newPassword'];

                        $this->userService->changePassword($user->getId(), $newPassword);

                        $subject = "Your password has been changed";
                        $body = "<p>Dear " . $user->getName() . ",</p><p>Your password has been changed successfully.<br>If you did not change your password, please contact support immediately.</p><br>Best regards,<br>Team Haarlem";
                        $this->emailService->sendEmailForUpdateUser($user->getEmail(), $user->getName(), $subject, $body);

                        echo json_encode(['success' => true, 'message' => 'Password changed successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'message' => 'Missing new password']);
                        exit();
                    }
                } else {
                    http_response_code(401);
                    echo json_encode(['success' => false, 'message' => 'Invalid current password']);
                    exit();
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Missing input password']);
                exit();
            }
        } else {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit();
        }
    }

    public function logIn()
    {
        session_start();
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE); //convert JSON into array

        if (isset($input['email']) && isset($input['password'])) {
            $email = $input['email'];
            $password = $input['password'];

            $user = new User($this->userService->getByEmail($email));

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userEmail'] = $user->getEmail();
                $_SESSION['userName'] = $user->getName();
                $_SESSION['userRole'] = $user->getUserRole();
                $_SESSION['userProfilePicture'] = $user->getProfilePicture();

                if ($user->getUserRole() == 'Member') {
                    $redirectTo = '/';
                } else if ($user->getUserRole() == 'Employee') {
                    $redirectTo = '/employee';
                } else {
                    $redirectTo = '/mainpageadmin';
                }

                echo json_encode(['success' => true, 'message' => 'Logged in successfully', 'redirectTo' => $redirectTo]);
            } else {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
                exit();
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing email or password']);
            exit();
        }
    }
    public function updateProfilePicture()
    {
        session_start();
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profilePicture'])) {
                $image = $_FILES['profilePicture'];
                $userID = $_SESSION['userId'] ?? null;
                $currentImage = $_SESSION['userProfilePicture'] ?? null;


                if ($userID === null) {
                    http_response_code(401);
                    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
                    exit();
                }

                $imageUrl = ImageEditor::saveImage("assets/images/user_profile_picture/", $image);

                if ($imageUrl !== null) { {
                        $this->userService->updateProfilePicture($userID, $imageUrl);
                        $_SESSION['userProfilePicture'] = $imageUrl;
                        if ($currentImage && $currentImage != $imageUrl) {
                            ImageEditor::deleteImage($currentImage);
                        }
                        echo json_encode(['success' => true, 'message' => "image uploaded successfully"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Invalid file or upload error.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'No file uploaded']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }
    public function Logout()
    {
        session_unset();
        session_destroy();

        $redirectTo = '/';

        echo json_encode(['success' => true, 'message' => 'Logged out successfully', 'redirectTo' => $redirectTo]);
        exit();

    }
    public function getAllUsers()
    {
        //implement some kind of protection for methods that should only be accessed by admins
        $users = $this->userService->getAllUsers();
        echo json_encode(['success' => true, 'data' => $users]);
    }
    public function getById($userId)
    {
        $user = $this->userService->getById($userId);

        if ($user) {
            echo json_encode(['success' => true, 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    }
    public function getByEmail($email)
    {
        $user = $this->userService->getByEmail($email);
        if ($user) {
            echo json_encode(['success' => true, 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    }
    private function checkCaptcha($responseKey)
    {
        include __DIR__ . '/../../config/recaptchaKeys.php';

        $userIP = $_SERVER['REMOTE_ADDR'];
        $key = $secretKey;

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = file_get_contents("$url?secret=$key&response=$responseKey&remoteip=$userIP");
        $response = json_decode($response);

        if ($response->success) {
            return true;
        } else {
            return false;
        }
    }
    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data !== null) {

            $sanitizedData = filter_var_array($data, $this->filters, false);

            if ($sanitizedData !== false && !in_array(false, $sanitizedData, true)) {

                $emailExists = $this->userService->checkIfEmailExists($sanitizedData['email']);

                if ($emailExists) {
                    echo json_encode(['success' => false, 'error' => 'Email already exists']);
                    return;
                }

                $captchaResponse = $data['recaptchaToken'];
                if ($captchaResponse === null || !$this->checkCaptcha($captchaResponse)) {
                    if ($captchaResponse === null) {
                        echo json_encode(['success' => false, 'error' => 'Missing captcha']);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Invalid captcha captcha: ' . $captchaResponse]);
                    }
                    return;
                }

                $sanitizedData['password'] = password_hash($sanitizedData['password'], PASSWORD_DEFAULT);
                $user = new User($sanitizedData);

                $this->userService->createUser($user);

                echo json_encode(['success' => true, 'message' => 'User created successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Invalid input data']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }
    }
    public function update()
    {
        session_start();
        $jsonInput = file_get_contents('php://input');
        $data = json_decode($jsonInput, true);

        $userId = $_GET['id'] ?? null;
        //$currentUserId = $_SESSION['userId'] ?? null;

        if ($userId) {
            $existingUser = $this->userService->getById($userId);

            if ($existingUser) {
                if ($data !== null) {
                    $sanitizedData = filter_var_array($data, $this->filters, false);

                    if ($sanitizedData !== false && !in_array(false, $sanitizedData, true)) {
                        $updatedUser = new User($sanitizedData);
                        $updatedUser->setId($userId);

                        $this->userService->update($updatedUser);

                        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
                            $_SESSION['userEmail'] = $updatedUser->getEmail();
                            $_SESSION['userName'] = $updatedUser->getName();
                            $_SESSION['userRole'] = $updatedUser->getUserRole();

                            $subject = "Your profile has been updated";
                            $body = "<p>Dear " . $_SESSION['userName'] . ",</p><p>Your profile information has been updated.<br>If that was you, please ignore this email. If you did not changed your account information, please change your password or get in touch with an administrator.</p><br>Best regards,<br>Team Haarlem";
                            $this->emailService->sendEmailForUpdateUser($_SESSION['userEmail'], $_SESSION['userName'], $subject, $body);
                        }

                        http_response_code(200);
                        echo json_encode(['success' => true, 'message' => 'User updated successfully', 'user' => $updatedUser->toArray()]);
                    } else {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
                }
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'User not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing User ID']);
        }
    }
    public function delete()
    {
        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $existingUser = $this->userService->getById($userId);

            $this->userService->delete($userId);

            if ($existingUser) {
                http_response_code(204);
                echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
                $existingUser = null;
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'User not found or already deleted']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing user ID']);
        }
    }


}
?>