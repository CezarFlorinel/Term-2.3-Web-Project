<?php
namespace App\Controllers;

class DanceEventController
{
    public function index()
    {
        require __DIR__ . '/../views/dance_event/new_detailed.php';
    }
}