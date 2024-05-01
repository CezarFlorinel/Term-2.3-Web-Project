<?php

namespace App\Api\Controllers;

use App\Utilities\ErrorHandlerMethod;
use App\Services\PaymentService;
use App\Services\TicketsService;


class PersonalProgramListViewController
{
    private $paymentService;
    private $ticketsService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->ticketsService = new TicketsService();
    }

    public function storeSelectedOrderItemsInSession()
    {
        try {
            session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['orderItemIDs'])) {
                    $orderItemIDs = $input['orderItemIDs'];

                    if ($this->checkIfTheseAreAllTicketsInOrder($orderItemIDs) == false) {
                        $_SESSION['orderItemIDs'] = $orderItemIDs;
                    }

                    echo json_encode(['success' => true, 'message' => 'Order item stored successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function deleteOrderItem()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['ID'])) {
                    $orderItemID = filter_var($input['ID'], FILTER_VALIDATE_INT);

                    // Delete the order item
                    $this->paymentService->deleteOrderItemByID($orderItemID);

                    echo json_encode(['success' => true, 'message' => 'Order item deleted successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }

    public function deleteReservation()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['ID'])) {
                    $reservationID = filter_var($input['ID'], FILTER_VALIDATE_INT);

                    // Delete the reservation
                    $this->paymentService->deleteReservationByID($reservationID);

                    echo json_encode(['success' => true, 'message' => 'Reservation deleted successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }

    }
    public function updateQuantityAndTotals()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['orderItemID'], $input['quantity'])) {
                    $orderItemID = filter_var($input['orderItemID'], FILTER_VALIDATE_INT);
                    $quantity = filter_var($input['quantity'], FILTER_VALIDATE_INT);

                    // Update the order item quantity
                    $this->paymentService->updateOrderItemQuantity($orderItemID, $quantity);
                    $orderItem = $this->paymentService->getOrderItemByID($orderItemID);

                    // Recalculate subtotal for the updated item

                    $subtotal = $this->returnSubtotal($orderItem);
                    $totals = $this->calculateTotals($orderItem);

                    $totalItems = $totals[1];
                    $totalPrice = $totals[0];

                    echo json_encode([
                        'success' => true,
                        'message' => 'Quantity updated successfully',
                        'subtotal' => number_format($subtotal, 2, '.', ''),
                        'totalPrice' => number_format($totalPrice, 2, '.', ''),
                        'totalItems' => $totalItems
                    ]);

                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
            } else {
                http_response_code(405);
                echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
    }

    private function returnSubtotal($orderItem): int
    {
        $subtotal = 0;
        try {
            $ticket = $this->ticketsService->returnTypeOfTicket($orderItem);
            if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
                $price = $this->ticketsService->getHistoryTicketPriceByType($ticket->typeOfTicket); // store the price
                $quantityOfTicket = $orderItem->quantity;
                $subtotal = $quantityOfTicket * $price;

            } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
                $price = $ticket->price;
                $quantityOfTicket = $orderItem->quantity;
                $subtotal = $quantityOfTicket * $price;

            } else {
                $price = $ticket->price;
                $quantityOfTicket = $orderItem->quantity;
                $subtotal = $quantityOfTicket * $price;

            }
        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
        return $subtotal;

    }

    private function calculateTotals($orderItem): array
    {
        $totalPrice = 0;
        $totalItems = 0;
        $totals = [];
        try {

            $order = $this->paymentService->getOrderByOrderItem($orderItem->orderItemID);
            $orderItems = $this->paymentService->getOrdersItemsByOrderId($order->orderID);

            foreach ($orderItems as $orderItem) {
                $ticket = $this->ticketsService->returnTypeOfTicket($orderItem);

                if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
                    $price = $this->ticketsService->getHistoryTicketPriceByType($ticket->typeOfTicket); // store the price
                    $quantityOfTicket = $orderItem->quantity;
                    $totalItems += $quantityOfTicket;
                    $subtotal = $quantityOfTicket * $price;
                    $totalPrice += $subtotal;


                } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
                    $price = $ticket->price;
                    $quantityOfTicket = $orderItem->quantity;
                    $totalItems += $quantityOfTicket;
                    $subtotal = $quantityOfTicket * $price;
                    $totalPrice += $subtotal;

                } else {
                    $price = $ticket->price;
                    $quantityOfTicket = $orderItem->quantity;
                    $totalItems += $quantityOfTicket;
                    $subtotal = $quantityOfTicket * $price;
                    $totalPrice += $subtotal;

                }

            }

            $totals = [$totalPrice, $totalItems];


        } catch (\Exception $e) {
            ErrorHandlerMethod::handleErrorApiController($e);
        }
        return $totals;
    }

    private function checkIfTheseAreAllTicketsInOrder($arrayIDs): bool
    {
        $order = $this->paymentService->getOrderByOrderItem($arrayIDs[0]);
        $orderItems = $this->paymentService->getOrdersItemsByOrderId($order->orderID);
        $count = 0;

        foreach ($orderItems as $orderItem) {
            foreach ($arrayIDs as $id) {
                if ($orderItem->orderItemID == $id) {
                    $count++;
                }
            }
        }

        if ($count == count($orderItems)) {
            return true;
        }
        return false;

    }




}