<?php
namespace App\Controllers;

class UserController
{
    public function index()
    {
        require __DIR__ . '/../views/login/login.php';
    }
}