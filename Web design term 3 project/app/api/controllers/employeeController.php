<?php

namespace App\Api\Controllers;

use App\Services\TicketsService;
use App\Services\UserService;

class EmployeeController
{
    private $ticketService;
    private $userService;

    function __construct()
    {
        $this->ticketService = new TicketsService();
        $this->userService = new UserService();
    }
    public function handleQRData()
    {
        $ticketID = $_GET['ticketID'] ?? null;

        if (isset($ticketID)) {
            $this->ticketService->scanQRCode($ticketID);
            echo json_encode(['success' => true, 'data' => $ticketID]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'QR code not found']);
        }
    }

    public function getTicketStatus()
    {

        $ticketID = $_GET['ticketID'] ?? null;
        if (isset($ticketID)) {
            $ticket = $this->ticketService->getQrCodeById($ticketID);
            $isScanned = $ticket->scanned;
            $user = $this->userService->getById($ticket->userId);
            $name = $user['Name'];
            echo json_encode(['success' => true, 'data' => ['Scanned' => $isScanned], 'nameOfUser' => $name]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'QR code not found']);
        }

    }
}