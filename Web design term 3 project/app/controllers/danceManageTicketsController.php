<?php
namespace App\Controllers;

class DanceManageTicketsController
{
    public function index()
    {
        require __DIR__ . '/../views/administrator_control_pages/dance/ticketManagement.php';
    }
}