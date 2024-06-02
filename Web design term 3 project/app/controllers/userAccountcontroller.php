<?php
namespace App\Controllers;

class UserAccountController
{
    public function index() {
        require __DIR__ . '/../views/user_management_account/userAccount.php';
    }
}