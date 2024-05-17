<?php

namespace App\Controllers;

class EmployeeController
{
    public function index()
    {
        require __DIR__ . '/../views/employee/index.php';
    }
}