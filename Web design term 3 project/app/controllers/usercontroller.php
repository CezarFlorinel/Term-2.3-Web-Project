<?php

use App\Services\UserService;
use App\Models\User;

session_start();
class UserController
{
    private UserService $userService;
    function __construct()
    {
        $userService = new UserService();
    }

    public function index()
    {
        $this->checkUserRole('/../views/user/index.php');
    }

    public function addUser()
    {
        $email=($_POST['email']);
        $password=($_POST['password']);
        // password_hash($_POST['password']);
        $name=($_POST['name']);
        $role=($_POST['Member']);
        $registrationDate = ($_POST[(new \DateTime())->format('Y-m-d')]);
        $user = new User($email, password_hash($password, PASSWORD_DEFAULT), $name, $role, $registrationDate);
        $this->userService->createUser($user);
    }

    public function edit()
    {
        $this->checkUserRole('/../views/user/edit.php');
    }

    private function checkUserRole(string $path)
    {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['user_role_id'] == 2) {
                require __DIR__ . $path;
            } else {
                http_response_code(403);
                echo 'Forbidden';
                exit();
            }
        } else {
            http_response_code(404);
            echo 'Not Found';
            exit();
        }
    }


}