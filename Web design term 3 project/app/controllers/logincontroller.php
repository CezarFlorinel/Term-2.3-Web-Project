<?php
namespace App\Controllers;


use App\Models\User;
use App\Models\UserRole;
use PDOException;

use App\Services\UserService;


//session_start();

class LoginController
{

    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }

    public function logout()
    {
        session_destroy();

        $redirectTo = '/home';
        header("Location: $redirectTo");
        exit();
    }
}