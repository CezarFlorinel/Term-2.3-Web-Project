<?php
namespace App\Controllers;

require __DIR__ . '/../../app/vendor/autoload.php';

use App\Services\PaymentService;
use App\Services\TicketsService;
use App\Services\HistoryService;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Utilities\ErrorHandlerMethod;
use App\Utilities\SessionManager;
use App\Utilities\HandleDataCheck;
use TCPDF;
use DateTime;
use DateInterval;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class PaymentSuccessController
{
    private $paymentMethod = null;
    private $paymentService;
    private $ticketService;
    private $historyService;
    private $order;
    private $pdf;
    private $pdfWithTickets;
    private $clientName = '';
    private $clientEmail = '';
    private $htmlContent = '';
    private $projectRoot;
    private $sessionManager;


    private $userId = 1; // to be changed for login
    public function __construct()
    {
        $this->sessionManager = new SessionManager();
        $this->paymentService = new PaymentService();
        $this->ticketService = new TicketsService();
        $this->historyService = new HistoryService();
        $this->pdf = new TCPDF();
        $this->pdfWithTickets = new TCPDF();
        session_start();
        $this->getPaymentMethod();
        $this->updateOrderStatus();
        $this->makeTickets();
        $this->projectRoot = realpath(__DIR__ . '/../../..');
    }

    public function index()
    {
        require __DIR__ . '/../views/payment/payment_success.php';
    }

    private function getPaymentMethod()
    {
        try {
            require_once '../config/secrets.php';
            \Stripe\Stripe::setApiKey($stripeSecretKey);
            $sessionId = $_GET['session_id'] ?? null;
            if ($sessionId) {
                try {
                    $session = \Stripe\Checkout\Session::retrieve($sessionId);
                    $paymentIntentId = $session->payment_intent;

                    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
                    $paymentMethodId = $paymentIntent->payment_method;

                    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
                    $this->paymentMethod = $paymentMethod->type;


                } catch (\Exception $e) {
                    ErrorHandlerMethod::handleErrorController("Error in the Stripe API: " . $e, $this->sessionManager, '/Payment');
                }
            } else {
                $this->sessionManager->setError("Session ID is missing.");
                header('Location: /Payment');
                exit();
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController("Error in the Payment Method: " . $e, $this->sessionManager, '/Payment');
        }
    }
    private function updateOrderStatus()
    {
        try {
            $this->order = $this->paymentService->getOrderByUserId($this->userId);

            if (isset($_SESSION['orderItemIDs'])) {  // used for the case when the user has unselected items in the cart
                $this->paymentService->setTheNewOrderForUnpaidOrderItems($_SESSION['orderItemIDs'], $this->userId, $this->order->orderID);
            }

            $this->paymentService->updateOrderStatus($this->order->orderID, 'Complete', $this->paymentMethod, $_SESSION['totalPrice']);
            $this->addInvoiceInDB();
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');
        }
    }

    private function addInvoiceInDB()
    {
        try {
            $customerData = $_SESSION['customerData'];
            $total = $_SESSION['totalPrice'];
            $totalVAT = $_SESSION['totalVAT'];
            $invoiceDate = date('Y-m-d H:i:s');
            $paymentDate = date('Y-m-d H:i:s');
            $customerAddress = $customerData['address'] . ',' . $customerData['extraAddress'] . ', ' . $customerData['city'] . ', ' . $customerData['county'] . ', ' . $customerData['zip'] . ', ' . $customerData['country'];
            $this->paymentService->addInvoiceInDB($this->order->orderID, $invoiceDate, $customerData['name'], $customerData['phoneNumber'], $customerAddress, $customerData['email'], $totalVAT, $total, $paymentDate);
            $this->generatePDFInvoice();
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');
        }
    }

    private function generatePDFInvoice()
    {
        try {
            $invoice = $this->paymentService->getInvoiceByOrderId($this->order->orderID);
            $orderItems = $this->paymentService->getOrdersItemsByOrderId($this->order->orderID);
            $quantity = $_SESSION['itemsTotal'];
            $this->clientName = $invoice->clientName;
            $this->clientEmail = $invoice->email;

            $this->setPDFSettings($this->pdf);

            $this->setHtmlContentForInvoice($invoice, $orderItems, $quantity, $this->htmlContent);

            $this->pdf->writeHTML($this->htmlContent, true, false, true, false, '');

            $pdfFilePath = $this->projectRoot . '/app/public/pdf/' . $this->order->orderID . '.pdf';
            // Adjust the path as needed
            $this->pdf->Output($pdfFilePath, 'F');

            $this->sendEmail($pdfFilePath, $this->clientEmail, $this->clientName, false);

        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');

        }
    }

    private function setPDFSettings($pdf)
    {
        $pdf->SetCreator('Haarlem Festival Website');
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Invoice for Tickets');
        $pdf->SetSubject('Invoice for Tickets');
        $pdf->SetKeywords('Invoice, PDF, Tickets');
        $pdf->AddPage();
    }

    private function setHtmlContentForInvoice($invoice, $orderItems, $quantity, $htmlContent)
    {
        $this->htmlContent = '<h1>Invoice for Tickets</h1>';
        $this->htmlContent .= '<br>';
        $this->htmlContent .= '<h2>Invoice number: ' . $invoice->invoiceID . '</h2>';
        $this->htmlContent .= '<h2>Invoice date: ' . $invoice->invoiceDate . '</h2>';
        $this->htmlContent .= '<h2>Payment date: ' . $invoice->paymentDate . '</h2>';
        $this->htmlContent .= '<br>';
        $this->htmlContent = '<h1>Customer Data</h1>';
        $this->htmlContent .= '<h2>Client name: ' . $invoice->clientName . '</h2>';
        $this->htmlContent .= '<h2>Client address: ' . $invoice->address . '</h2>';
        $this->htmlContent .= '<h2>Client phone number: ' . $invoice->phoneNumber . '</h2>';
        $this->htmlContent .= '<h2>Client email: ' . $invoice->email . '</h2>';
        $this->htmlContent .= '<br>';
        $this->htmlContent = '<h1>Products Prices </h1>';
        foreach ($orderItems as $orderItem) {
            $ticket = $this->ticketService->returnTypeOfTicket($orderItem);
            if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
                $this->fillForTicketHistoryInvoice($ticket, $orderItem);
            } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
                $this->fillForTicketDanceInvoice($ticket, $orderItem);
            } else {
                $this->fillForPassInvoice($ticket, $orderItem);
            }
        }
        $this->htmlContent .= '<h2>Number of products: ' . $quantity . '</h2>';
        $formattedVAT = number_format($invoice->VATamount, 2, '.', '');
        $this->htmlContent .= '<h2>VAT amount: ' . $formattedVAT . '€</h2>';
        $formattedTotal = number_format($invoice->totalAmount, 2, '.', '');
        $this->htmlContent .= '<h2>Total amount: ' . $formattedTotal . '€</h2>';
        $this->htmlContent .= '<br>';
        $this->htmlContent .= '<h1>Thank you for your purchase!</h1>';
        $this->htmlContent .= '<p>You should receive the tickets in a short time, if you have questions, please contact us.</p>';
    }

    private function fillForTicketHistoryInvoice($ticket, $orderItem): void
    {
        $this->htmlContent .= '<h2>History ' . $ticket->language . 'Tour</h2>';

        $ticket->dateAndTime;
        $startDateTime = new DateTime($ticket->dateAndTime);
        $endDateTime = clone $startDateTime;
        $endDateTime->add(new DateInterval('PT2H30M'));
        $output = $startDateTime->format('d M') . '<br>' . $startDateTime->format('H:i') . '-' . $endDateTime->format('H:i');
        $this->htmlContent .= '<p>Date and time: ' . $output . '</p>';

        $historyFirstRoute = $this->historyService->getFirstHistoryRoute();
        $string = $historyFirstRoute->locationName;
        if (strpos($string, "1.") === 0) {
            $string = substr($string, 3);
        }
        $this->htmlContent .= '<p>Starting location: Starting Point Near' . $string . '<p>';

        $this->htmlContent .= '<p>Quantity: ' . $orderItem->quantity . '<p>';

        $price = $this->ticketService->getHistoryTicketPriceByType($ticket->typeOfTicket);
        $quantityOfTicket = $orderItem->quantity;
        $subtotal = $quantityOfTicket * $price;
        $formattedSubtotal = number_format($subtotal, 2, '.', '');
        $this->htmlContent .= '<p>Subtotal: ' . $formattedSubtotal . '€<p>';

    }

    private function fillForTicketDanceInvoice($ticket, $orderItem): void
    {
        $this->htmlContent .= '<h2>' . $ticket->singer . 'Concert</h2>';

        $ticket->dateAndTime;
        $ticket->startTime;
        $ticket->endTime;
        $date = new DateTime($ticket->dateAndTime);
        $formattedDate = $date->format('d M');
        $startTime = new DateTime($ticket->startTime);
        $formattedStartTime = $startTime->format('H:i');
        $endTime = new DateTime($ticket->endTime);
        $formattedEndTime = $endTime->format('H:i');
        $this->htmlContent .= '<p>Date: ' . $formattedDate . '</p>';
        $this->htmlContent .= '<p>Time: ' . $formattedStartTime . '-' . $formattedEndTime . '</p>';
        $this->htmlContent .= '<p>Location: ' . $ticket->location . '</p>';
        $this->htmlContent .= '<p>Quantity: ' . $orderItem->quantity . '</p>';
        $price = $ticket->price;
        $quantityOfTicket = $orderItem->quantity;
        $subtotal = $quantityOfTicket * $price;
        $formattedSubtotal = number_format($subtotal, 2, '.', '');
        $this->htmlContent .= '<p>Subtotal: ' . $formattedSubtotal . '€<p>';

    }

    private function fillForPassInvoice($ticket, $orderItem): void
    {
        $this->htmlContent .= '<h2>Dance Pass</h2>';
        if ($ticket->date != null) {
            $dateOfPass = new DateTime($ticket->date);
            $formattedDate = $dateOfPass->format('d M');
            $this->htmlContent .= '<p>Date: ' . $formattedDate . '</p>';
        } else {
            $this->htmlContent .= '<p>Date: ' . 'All days' . '</p>';
        }
        $this->htmlContent .= '<p>Location: Multiple</p>';
        $this->htmlContent .= '<p>Quantity: ' . $orderItem->quantity . '</p>';
        $price = $ticket->price;
        $quantityOfTicket = $orderItem->quantity;
        $subtotal = $quantityOfTicket * $price;
        $formattedSubtotal = number_format($subtotal, 2, '.', '');
        $this->htmlContent .= '<p>Subtotal: ' . $formattedSubtotal . '€</p>';
    }

    private function sendEmail($pdfFilePath, $email, $name, $typeOfMailTickets)
    {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        require '../config/emailconfig.php';

        try {
            // Server settings for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $emailAddress;
            $mail->Password = $key; // Replace with your Gmail password or App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($emailAddress, 'Team Haarlem'); // Replace 'Your Name' with your name
            $mail->addAddress($email, $name); // Add a recipient

            // Attach the PDF file
            $mail->addAttachment($pdfFilePath);

            // Email content
            $mail->isHTML(true);
            if ($typeOfMailTickets) {
                $mail->Subject = 'Hello ' . $name . ', here are your tickets for the Haarlem Festival!';
            } else {
                $mail->Subject = 'Hello ' . $name . ', here is your invoice for the Haarlem Festival!';
            }

            $mail->Body = $this->setEmailBody($typeOfMailTickets);
            $mail->AltBody = $this->setMailAltBody($typeOfMailTickets);


            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->SMTPDebug = 0;

            // Send the email
            $mail->send();
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');
        }
        unlink($pdfFilePath);

    }

    private function setEmailBody($boolTicketsSet)
    {
        $name = $this->clientName;
        $stringSet = '';
        $stringSetOpposite = '';
        if ($boolTicketsSet) {
            $stringSet = 'tickets';
            $stringSetOpposite = 'invoice';
        } else {
            $stringSet = 'invoice';
            $stringSetOpposite = 'tickets';
        }

        // HTML email body
        $body = '
             <html>
             <head>
             <title>Haarlem Festival Invoice</title>
             </head>
             <body>
             <p>Hello ' . htmlspecialchars($name) . ',</p>
             <p>Thank you for your purchase with Haarlem Festival! Attached to this email, you will find your ' . $stringSet . '.</p>
            <p>Please keep an eye on your inbox, as your ' . $stringSetOpposite . ' will be sent in a separate email. We hope you have a fantastic time enjoying the events you have chosen.</p>
            <p>Should you have any questions or require further assistance, feel free to contact us.</p>
            <p>Best regards,<br>The Haarlem Festival Team</p>
            </body>
            </html>';

        return $body;



    }

    private function setMailAltBody($boolTicketsSet)
    {
        $name = $this->clientName;
        $stringSet = '';
        $stringSetOpposite = '';
        if ($boolTicketsSet) {
            $stringSet = 'tickets';
            $stringSetOpposite = 'invoice';
        } else {
            $stringSet = 'invoice';
            $stringSetOpposite = 'tickets';
        }

        // Plain text email body (for email clients that do not render HTML)
        $altBody = 'Hello ' . $name . ",\n\n" .
            "Thank you for your purchase with Haarlem Festival! Attached to this email, you will find your " . $stringSet . ".\n" .
            "Please keep an eye on your inbox, as your " . $stringSetOpposite . " will be sent in a separate email. We hope you have a fantastic time enjoying the events you have chosen.\n" .
            "Should you have any questions or require further assistance, feel free to contact us.\n\n" .
            "Best regards,\nThe Haarlem Festival Team";


        return $altBody;
    }

    private function makeTickets()
    {
        $this->addTicketToDB();
        $this->generateQRCodeTicket();
    }

    private function addTicketToDB()
    {
        try {
            $defaultScanned = false;
            $orderItems = $this->paymentService->getOrdersItemsByOrderId($this->order->orderID);
            foreach ($orderItems as $orderItem) {
                $quantity = $orderItem->quantity;
                for ($i = 0; $i < $quantity; $i++) {
                    $this->ticketService->addQRTicketToDB($this->userId, $orderItem->orderItemID, date('Y-m-d H:i:s'), $defaultScanned);
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');

        }
    }

    private function generateQRCodeTicket()
    {
        try {

            $this->setPdfForTickets();
            $tickets = $this->ticketService->getQRTickets($this->order->orderID);
            foreach ($tickets as $ticket) {

                $qrCode = new QrCode($ticket->ticketID);

                // set size and margin
                $qrCode->setSize(300);
                $qrCode->setMargin(10);
                // Create a QR code writer instance
                $writer = new PngWriter();

                $pngFilePath = $this->projectRoot . '/app/public/png_QR/' . $ticket->ticketID . '.png';

                $writer->write($qrCode)->saveToFile($pngFilePath);

                $orderItem = $this->paymentService->getOrderItemByID($ticket->orderItem_FK);
                $ticketType = $this->ticketService->returnTypeOfTicket($orderItem);

                $this->fillHtmlContentForTicketPdf($ticketType);


                $this->pdfWithTickets->writeHTML($this->htmlContent, true, false, true, false, '');
                $this->pdfWithTickets->Image($pngFilePath, 150, $this->pdfWithTickets->GetY() - 55, 50, 0, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
                $this->pdfWithTickets->SetY($this->pdfWithTickets->GetY() + 25);
                unlink($pngFilePath);

            }

            $pdfFilePath = $this->projectRoot . '/app/public/pdf/' . $this->order->orderID . '.pdf';
            // Adjust the path as needed
            $this->pdfWithTickets->Output($pdfFilePath, 'F');


            $this->sendEmail($pdfFilePath, $this->clientEmail, $this->clientName, true);

        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');

        }
    }

    private function setPdfForTickets()
    {
        $this->pdfWithTickets->SetCreator('Haarlem Festival Website');
        $this->pdfWithTickets->SetAuthor('Haarlem Festival');
        $this->pdfWithTickets->SetTitle('Invoice for Tickets');
        $this->pdfWithTickets->SetSubject('Tickets');
        $this->pdfWithTickets->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->pdfWithTickets->SetKeywords('Invoice, PDF, Tickets');
        $this->pdfWithTickets->AddPage();
        $this->htmlContent = ''; // to fill with the right content
    }

    private function fillHtmlContentForTicketPdf($ticketType)
    {
        try {
            if (get_class($ticketType) == 'App\Models\Tickets\HistoryTicket') {
                $date = new DateTime($ticketType->dateAndTime);
                $this->htmlContent = $this->generateHTMLForTicketHistory('History ' . $ticketType->language . ' Tour', $date->format('d M Y H:i'), $ticketType->typeOfTicket);
            } else if (get_class($ticketType) == 'App\Models\Tickets\DanceTicket') {
                $date = new DateTime($ticketType->dateAndTime);
                $startTime = new DateTime($ticketType->startTime);
                $endTime = new DateTime($ticketType->endTime);
                $this->htmlContent = $this->generateHTMLForTicketDance($ticketType->singer . ' Concert', $date->format('d M Y'), $startTime->format('H:i'), $endTime->format('H:i'), $ticketType->location);
            } else {
                $date = new DateTime($ticketType->date);
                if ($ticketType->allDayPass == 1) {
                    $this->htmlContent = $this->generateHTMLForPass('Dance Pass', 'All days');
                } else {
                    $this->htmlContent = $this->generateHTMLForPass('Dance Pass', $date->format('d M Y'));
                }
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorController($e, $this->sessionManager, '/Payment');
        }
    }

    private function generateHTMLForTicketDance($eventName, $dateAndTime, $startTime, $endTime, $location)
    {
        $htmlContent = "<div style='border: 1px solid black; padding: 10px; margin-bottom: 10px;'>
                        <h2>{$eventName}</h2>
                        <p>Date and Time: {$dateAndTime} , {$startTime} - {$endTime}</p>
                        <p>Location: {$location}</p>
                        <p>Name: {$this->clientName}</p>
                        </div>";

        return $htmlContent;
    }
    private function generateHTMLForTicketHistory($eventName, $dateAndTime, $typeofTicket)
    {
        $htmlContent = "<div style='border: 1px solid black; padding: 10px; margin-bottom: 10px;'>
                        <h2>{$eventName}</h2>
                        <p>Date and Time: {$dateAndTime}</p>
                        <p>Type of Ticket: {$typeofTicket}</p>
                        <p>Name: {$this->clientName}</p>
                        </div>";

        return $htmlContent;
    }
    private function generateHTMLForPass($eventName, $dateAndTime)
    {
        $htmlContent = "<div style='border: 1px solid black; padding: 10px; margin-bottom: 10px;'>
                        <h2>{$eventName}</h2>  
                        <p>Date and Time: {$dateAndTime}</p>
                        <p>Location: Multiple</p>
                        <p>Name: {$this->clientName}</p>
                        </div>";

        return $htmlContent;
    }






}