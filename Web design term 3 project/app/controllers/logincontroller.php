<?php
namespace App\Controllers;

use App\Services\UserService;


session_start();
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

    // login and sign up needed here
    public function register()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function logout()
    {
        session_destroy();

        $redirectTo = '/home';
        header("Location: $redirectTo");
        exit();
    }
}