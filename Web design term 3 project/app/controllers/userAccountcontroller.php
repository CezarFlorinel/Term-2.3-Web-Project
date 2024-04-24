<?php
namespace App\Controllers;


use App\Models\User;
use App\Models\UserRole;
use PDOException;

use App\Services\UserService;


class UserAccountController
{
    public function index() {
        require __DIR__ . '/../views/userAccount.php';
    }
}