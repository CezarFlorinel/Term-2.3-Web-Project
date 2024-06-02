<?php
namespace App\Controllers;

class LoginController
{

    function __construct()
    {
       session_start();
    }
    public function index()
    {
        //Check if session is started and user is logged in
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
            header("Location: /userAccount");
            exit();
        } else {
            require_once __DIR__ . '/../views/login/index.php';
            exit();
        }
     }

    
}