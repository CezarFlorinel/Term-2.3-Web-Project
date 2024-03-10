<?php
namespace App\Controllers;

class YummyEventController
{
    public function index()
    {
        require __DIR__ . '/../views/yummy_event/reservation_form.php';
    }
}

