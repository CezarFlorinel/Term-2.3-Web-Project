<?php
namespace App\Controllers;

class MainPageAdminController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/main_page/index.php';
    }
}