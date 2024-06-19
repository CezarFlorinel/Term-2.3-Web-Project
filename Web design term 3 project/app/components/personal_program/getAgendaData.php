<?php
session_start();

use App\Services\PaymentService;
use App\Services\TicketsService;
use App\Services\HistoryService;
use App\Services\YummyService;

$paymentService = new PaymentService();
$ticketsService = new TicketsService();
$historyService = new HistoryService();
$yummyService = new YummyService();

$changeViewLink = '/personalProgramListView';
$userId = 2; //TODO: // Replace with actual user ID
$order = $paymentService->getOrderByUserId($userId);
$orderItems = $paymentService->getOrdersItemsByOrderId($order->orderID);
$allReservations = $yummyService->getReservationsByUserId($userId);
$reservations = [];
$displayCheckBoxAndQuantityButtons = false;
$itemsTotal = 0;
$totalPrice = 0;
$arraySelectedTickets = null;
$paidOrders = $paymentService->getPaidOrdersByUserId($userId);
$paidOrderItemsAll = [];
$historyFirstRoute = $historyService->getFirstHistoryRoute()->locationName;
$danceTicketsForAgenda = [];
$historyTicketsForAgenda = [];
$reservationData = []; // Initialize an array to hold the combined data

foreach ($allReservations as $reservation) {
    if ($reservation->isActive) {
        $reservations[] = $reservation;
    }
}
// Loop through each paid order
foreach ($paidOrders as $paidOrder) {
    // Retrieve order items by order ID and merge them into the paidOrderItems array
    $paidOrderItems = $paymentService->getOrdersItemsByOrderId($paidOrder->orderID);
    $paidOrderItemsAll = array_merge($paidOrderItemsAll, $paidOrderItems);
}

if (strpos($historyFirstRoute, "1.") === 0) {
    $historyFirstRoute = substr($historyFirstRoute, 3);
}

foreach ($orderItems as $orderItem) {
    $ticket = $ticketsService->returnTypeOfTicket($orderItem);
    if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
        $historyTicketsForAgenda[] = $ticket;
    } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
        $danceTicketsForAgenda[] = $ticket;
    }
}

foreach ($paidOrderItemsAll as $orderItem) {
    $ticket = $ticketsService->returnTypeOfTicket($orderItem);
    if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
        $historyTicketsForAgenda[] = $ticket;
    } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
        $danceTicketsForAgenda[] = $ticket;
    }
}

foreach ($reservations as $key => $reservation) {
    $restaurant = $yummyService->getRestaurantById($reservation->restaurantID);
    $session = $yummyService->getSessionByRestaurantName($restaurant->name);

    // Create an associative array for each reservation with the desired information
    $reservationData[$key] = [
        'restaurant_name' => $restaurant->name,
        'session_start_time' => $session->startTime,
        'session_end_time' => $session->endTime,
        'restaurant_location' => $restaurant->location,
        'status_payment' => 'paid',
        'date' => $reservation->date
    ];
}
?>