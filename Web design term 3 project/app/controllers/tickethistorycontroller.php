<?php
namespace App\Controllers;

class TicketHistoryController
{
    public function index()
    {
        require __DIR__ . '/../views/history_event/personal_program.php';
    }
}