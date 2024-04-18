<?php
namespace App\Controllers;

class UserEditAdminController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/users/editUsers.php';
    }
}