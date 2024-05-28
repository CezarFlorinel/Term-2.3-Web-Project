<?php
namespace App\Controllers;

class CustomPagesController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/custom_pages/index.php';
    }
}