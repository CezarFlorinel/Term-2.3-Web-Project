<?php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require __DIR__ . '/../views/home/index.php';
    }

    public function __construct()
    {
        session_start();
    }
}