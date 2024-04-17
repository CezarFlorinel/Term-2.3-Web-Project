<?php
namespace App\Controllers;

class HistoryEventController
{
    public function index()
    {
        require __DIR__ . '/../views/history_event/ticketPurchase.php';
    }
}