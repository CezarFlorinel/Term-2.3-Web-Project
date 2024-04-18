<?php
namespace App\Controllers;

class UserAddAdminController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/users/addUsers.php';
    }
}