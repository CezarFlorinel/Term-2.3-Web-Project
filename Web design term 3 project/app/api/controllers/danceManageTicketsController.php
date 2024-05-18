<?php
namespace App\Api\Controllers;

use App\Services\TicketsService;
use App\Utilities\ErrorHandlerMethod;
use App\Services\PaymentService;
use Exception;

class DanceManageTicketsController
{
    private $ticketsService;
    private $paymentService;

    const DEFAULT_TYPE = "DanceFestival";

    public function __construct()
    {
        $this->ticketsService = new TicketsService();
        $this->paymentService = new PaymentService();
    }

    public function updateDanceTicketInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['danceTicketID'], $input['date'], $input['location'], $input['price'], $input['singer'], $input['maxAvailableTickets'], $input['sessionType'], $input['startTime'], $input['endTime'])) {
                    $danceTicketID = filter_var($input['danceTicketID'], FILTER_VALIDATE_INT);
                    $date = $input['date'];
                    $location = $input['location'];
                    $price = $input['price'];
                    $singer = $input['singer'];
                    $maxAvailableTickets = $input['maxAvailableTickets'];
                    $sessionType = $input['sessionType'];
                    $startTime = $input['startTime'];
                    $endTime = $input['endTime'];

                    $this->ticketsService->editDanceTickets($danceTicketID, $date, $location, $price, $singer, $maxAvailableTickets, $sessionType, $startTime, $endTime);

                    echo json_encode(['success' => true, 'message' => 'Ticket updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function deleteDanceTicket()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $this->ticketsService->deleteDanceTickets($id);

                    echo json_encode(['success' => true, 'message' => 'Ticket deleted successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required id']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function addDanceTicket()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['date'], $_POST['location'], $_POST['price'], $_POST['singer'], $_POST['availableTickets'], $_POST['sessionType'], $_POST['startTime'], $_POST['endTime'])) {
                    $date = $_POST['date'];
                    $location = $_POST['location'];
                    $price = $_POST['price'];
                    $singer = $_POST['singer'];
                    $maxAvailableTickets = $_POST['availableTickets'];
                    $sessionType = $_POST['sessionType'];
                    $startTime = $_POST['startTime'];
                    $endTime = $_POST['endTime'];

                    $this->ticketsService->addDanceTicket($date, $location, $price, $singer, $maxAvailableTickets, $sessionType, $startTime, $endTime);

                    echo json_encode(['success' => true, 'message' => 'Ticket created successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function deleteDancePass()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['id'])) {
                    $id = filter_var($input['id'], FILTER_VALIDATE_INT);

                    $this->ticketsService->deleteDancePasses($id);

                    echo json_encode(['success' => true, 'message' => 'Ticket deleted successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required id']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function addDancePass()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['price'], $_POST['date'], $_POST['maxPasses'])) {
                    $price = $_POST['price'];
                    $date = $_POST['date'];
                    $maxPasses = $_POST['maxPasses'];

                    $this->ticketsService->addDancePasses($price, $date, false, $maxPasses);

                    echo json_encode(['success' => true, 'message' => 'Pass created successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function updateOneDayDancePassInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['dancePassID'], $input['price'], $input['date'], $input['maxPasses'])) {
                    $dancePassID = filter_var($input['dancePassID'], FILTER_VALIDATE_INT);
                    $price = $input['price'];
                    $date = $input['date'];
                    $maxPasses = $input['maxPasses'];

                    $this->ticketsService->editDancePasses($dancePassID, $price, $date, false, $maxPasses, null);

                    echo json_encode(['success' => true, 'message' => 'Pass updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function updateMultipleDaysDancePassInformation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PUT") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['dancePassID'], $input['price'], $input['maxPasses'])) {
                    $dancePassID = filter_var($input['dancePassID'], FILTER_VALIDATE_INT);
                    $price = $input['price'];
                    $maxPasses = $input['maxPasses'];

                    $this->ticketsService->editDancePasses($dancePassID, $price, null, true, null, $maxPasses);

                    echo json_encode(['success' => true, 'message' => 'Club updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function orderTicket()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST['orderID'], $_POST['ticketID'], $_POST['quantity'])) {
                    $orderID = filter_var($_POST['orderID'], FILTER_VALIDATE_INT);
                    $ticketID = filter_var($_POST['ticketID'], FILTER_VALIDATE_INT);
                    $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);

                    $this->paymentService->createNewOrderItem($quantity, self::DEFAULT_TYPE, $orderID, null, $ticketID);

                    echo json_encode(['success' => true, 'message' => 'Ticket ordered successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }

        } catch (Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }



}