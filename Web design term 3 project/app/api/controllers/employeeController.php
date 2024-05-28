<?php

namespace App\Api\Controllers;

use App\Services\TicketsService;
class EmployeeController
{
    private $ticketService;

    function __construct() {
        $this->ticketService = new TicketsService();
    }
    public function handleQRData()
    {
        $ticketID = $_GET['ticketID'] ?? null;

        if(isset($ticketID)) {
            $this->ticketService->scanQRCode($ticketID);
            echo json_encode(['success' => true, 'data' => $ticketID]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'QR code not found']);
        }
    }

    public function getTicketStatus() {

        $ticketID = $_GET['ticketID'] ?? null;
        if(isset($ticketID)) {
            $ticket = $this->ticketService->getQrCodeById($ticketID);
            echo json_encode(['success' => true, 'data' => $ticket]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'QR code not found']);
        }

    }
}