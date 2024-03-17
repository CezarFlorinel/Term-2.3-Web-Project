<?php
namespace App\Controllers;

class YummyHomeAdminController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/yummy/index.php';
    }
}