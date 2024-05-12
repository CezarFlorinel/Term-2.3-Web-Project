<?php
namespace App\Controllers;


use App\Models\User;
use App\Models\UserRole;
use PDOException;

use App\Services\UserService;




class LoginController
{

    function __construct()
    {
       session_start();
    }
    public function index()
    {
        //Check if session is started and user is logged in
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['userId'])) {
            header("Location: /userAccount");
            exit();
        } else {
            require_once __DIR__ . '/../views/login/index.php';
            exit();
        }
     }

    
}