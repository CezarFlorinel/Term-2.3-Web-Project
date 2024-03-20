<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\UserRole;
use PDOException;

use App\Services\UserService;


//session_start();

class LoginController
{
    private $userService;
    function __construct()
    {
        $this->userService = new UserService();
    }
    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }

    public function register()
    {
        require __DIR__ . '/../views/login/register.php';
    }
  
    // public function createAccount()
    // {
    //     //session_start();

    //     $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     // $role = filter_var($_POST['role'] ?? UserRole::Member, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     // $registrationDate = filter_var($_POST['registrationDate'] ?? (new \DateTime())->format('Y-m-d'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //     if ($this->userService->checkIfEmailExists($email)) {
    //         echo 'email already exist';
    //     } else {
    //         $user = new User($email, $name, $password, UserRole::Member);
    //         try {
    //             $this->userService->createUser($user);
    //             header("Location: /");
    //             exit();
    //         } catch (PDOException $e) {
    //             echo $e;
    //         }
    //     }
    // }
    public function logout()
    {
        session_destroy();

        $redirectTo = '/home';
        header("Location: $redirectTo");
        exit();
    }
}