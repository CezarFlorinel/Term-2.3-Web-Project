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


    public function updateQuantityAndTotals()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                $input = json_decode(file_get_contents('php://input'), true);

                if (isset($input['orderItemID'], $input['quantity'], $input['currentTotalPrice'], $input['currentTotalQuantity'])) {
                    $orderItemID = filter_var($input['orderItemID'], FILTER_VALIDATE_INT);
                    $quantity = filter_var($input['quantity'], FILTER_VALIDATE_INT);
                    $currentTotalPrice = filter_var($input['currentTotalPrice'], FILTER_VALIDATE_FLOAT);
                    $currentTotalQuantity = filter_var($input['currentTotalQuantity'], FILTER_VALIDATE_INT);

                    //error_log(print_r("\n this is orderItemId: " . $orderItemID . "\nquantity: " . $quantity . "\ncurrentTotalPrice: " . $currentTotalPrice . "\ncurrentTotalQuantiy: " . $currentTotalQuantity, true), 3, __DIR__ . '/../../file_with_erros_logs'); // Log the input data

                    // Update the order item quantity
                    $this->paymentService->updateOrderItemQuantity($orderItemID, $quantity);
                    $orderItem = $this->paymentService->getOrderItemByID($orderItemID);

                    // Recalculate subtotal for the updated item

                    $subtotal = $this->returnSubtotal($orderItem);
                    $totalItems = $currentTotalQuantity + $quantity;
                    $totalPrice = $currentTotalPrice + $subtotal;

                    //error_log(print_r("\n subottal PS: " . $subtotal . "\ntotalItems: " . $totalItems . "\n totalPrice: " . $totalPrice, true), 3, __DIR__ . '/../../file_with_erros_logs'); // Log the input data


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


}