<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

use App\Services\TicketsService;
use App\Services\HistoryService;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;
use App\Utilities\HandleDataCheck;
use TCPDF;
use DateTime;
use DateInterval;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Endroid\QrCode\Writer\PngWriter;

class PdfService
{
    private $pdf;
    public function __construct()
    {
        $this->sessionManager = new SessionManager();
        $this->ticketService = new TicketsService();
        $this->historyService = new HistoryService();
        
        $this->pdf = new TCPDF();
        session_start();
        $this->projectRoot = realpath(__DIR__ . '/../../..');
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

    private function setHtmlContentForPdf() {

    }
}