<?php

namespace App\Api\Controllers;

use App\Services\UserService;
use App\Models\User\User;
use App\Models\User\UserRole;

class UserController
{
    private $userService;

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

    public function logIn()
    {
        session_start();
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE); //convert JSON into array

        if (isset($input['email']) && isset($input['password'])) {
            $email = $input['email'];
            $password = $input['password'];
            // $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new User($this->userService->getByEmail($email));

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userEmail'] = $user->getEmail();
                $_SESSION['userName'] = $user->getName();
                $_SESSION['userRole'] = $user->getUserRole();

                if ($user->getUserRole() == 'Member') {
                    $redirectTo = '/';
                } else if ($user->getUserRole() == 'Employee') {
                    $redirectTo = '/employee';
                } else {
                    $redirectTo = '/admin';
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