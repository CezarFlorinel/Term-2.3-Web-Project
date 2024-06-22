<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

use App\Services\PaymentService;
use App\Services\TicketsService;
use App\Services\HistoryService;
use App\Services\YummyService;
use TCPDF;

class PdfService
{
    private $pdf;
    private $htmlContent = '';
    private $projectRoot;
    private $userId = 2; // TODO: Replace with actual user ID

    public function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->ticketService = new TicketsService();
        $this->historyService = new HistoryService();
        $this->yummyService = new YummyService();
        
        $this->pdf = new TCPDF();
        session_start();
        $this->projectRoot = realpath(__DIR__ . '/../../..');
    }

    public function generatePersonalProgramPdf()
    {
        // Set PDF settings
        $this->setPDFSettings($this->pdf);

        // Fetch and prepare data
        $this->prepareData();

        // Generate HTML content for the PDF
        $this->setHtmlContentForPdf();

        // Write HTML content to PDF
        $this->pdf->writeHTML($this->htmlContent, true, false, true, false, '');

        // Output the PDF to a file or to the browser
        $pdfFilePath = $this->projectRoot . '/app/public/pdf/personal_program_' . $this->userId . '.pdf';
        $this->pdf->Output($pdfFilePath, 'F');

        // Optionally return the file path
        return $pdfFilePath;
    }

    private function setPDFSettings($pdf)
    {
        $pdf->SetCreator('Haarlem Festival Website');
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Personal Program');
        $pdf->SetSubject('Personal Program');
        $pdf->SetKeywords('Personal Program, PDF, Tickets');
        $pdf->AddPage();
    }

    private function prepareData()
    {
        $this->order = $this->paymentService->getOrderByUserId($this->userId);
        $this->orderItems = $this->paymentService->getOrdersItemsByOrderId($this->order->orderID);
        $this->allReservations = $this->yummyService->getReservationsByUserId($this->userId);
        $this->reservations = [];
        $this->paidOrders = $this->paymentService->getPaidOrdersByUserId($this->userId);
        $this->paidOrderItemsAll = [];
        $this->historyFirstRoute = $this->historyService->getFirstHistoryRoute()->locationName;
        $this->danceTicketsForAgenda = [];
        $this->historyTicketsForAgenda = [];
        $this->reservationData = []; // Initialize an array to hold the combined data

        foreach ($this->allReservations as $reservation) {
            if ($reservation->isActive) {
                $this->reservations[] = $reservation;
            }
        }
        foreach ($this->paidOrders as $paidOrder) {
            $paidOrderItems = $this->paymentService->getOrdersItemsByOrderId($paidOrder->orderID);
            $this->paidOrderItemsAll = array_merge($this->paidOrderItemsAll, $paidOrderItems);
        }

        if (strpos($this->historyFirstRoute, "1.") === 0) {
            $this->historyFirstRoute = substr($this->historyFirstRoute, 3);
        }

        foreach ($this->orderItems as $orderItem) {
            $ticket = $this->ticketService->returnTypeOfTicket($orderItem);
            if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
                $this->historyTicketsForAgenda[] = $ticket;
            } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
                $this->danceTicketsForAgenda[] = $ticket;
            }
        }

        foreach ($this->paidOrderItemsAll as $orderItem) {
            $ticket = $this->ticketService->returnTypeOfTicket($orderItem);
            if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
                $this->historyTicketsForAgenda[] = $ticket;
            } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
                $this->danceTicketsForAgenda[] = $ticket;
            }
        }

        foreach ($this->reservations as $key => $reservation) {
            $restaurant = $this->yummyService->getRestaurantById($reservation->restaurantID);
            $session = $this->yummyService->getSessionByRestaurantName($restaurant->name);
            $this->reservationData[$key] = [
                'restaurant_name' => $restaurant->name,
                'session_start_time' => $session->startTime,
                'session_end_time' => $session->endTime,
                'restaurant_location' => $restaurant->location,
                'status_payment' => 'paid',
                'date' => $reservation->date
            ];
        }
    }

    private function setHtmlContentForPdf()
    {
        $this->htmlContent = '<h1>Personal Program</h1><br>';
        
        $this->htmlContent .= '<h2>Dance Tickets</h2>';
        foreach ($this->danceTicketsForAgenda as $ticket) {
            $this->htmlContent .= '<p>' . $ticket->singer . ' Concert on ' . (new DateTime($ticket->dateAndTime))->format('d M Y') . ' at ' . (new DateTime($ticket->startTime))->format('H:i') . ' - ' . (new DateTime($ticket->endTime))->format('H:i') . ' at ' . $ticket->location . '</p>';
        }

        $this->htmlContent .= '<h2>History Tickets</h2>';
        foreach ($this->historyTicketsForAgenda as $ticket) {
            $this->htmlContent .= '<p>' . $ticket->language . ' Tour on ' . (new DateTime($ticket->dateAndTime))->format('d M Y H:i') . ' starting from ' . $this->historyFirstRoute . '</p>';
        }

        $this->htmlContent .= '<h2>Reservations</h2>';
        foreach ($this->reservationData as $reservation) {
            $this->htmlContent .= '<p>' . $reservation['restaurant_name'] . ' on ' . $reservation['date'] . ' from ' . $reservation['session_start_time'] . ' to ' . $reservation['session_end_time'] . ' at ' . $reservation['restaurant_location'] . '</p>';
        }
    }
}
