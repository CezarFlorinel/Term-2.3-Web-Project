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

$changeViewLink = '/personalProgramAgendaView';


$userId = $_SESSION['userId'];

if (!$_SESSION['userId']) {
    header('Location: /');
}


$order = $paymentService->getOrderByUserId($userId);
$orderItems = $paymentService->getOrdersItemsByOrderId($order->orderID);

$allReservations = $yummyService->getReservationsByUserId($userId);
$reservations = [];
foreach ($allReservations as $reservation) {
    if ($reservation->isActive) {
        $reservations[] = $reservation;
    }
}

$paidOrders = $paymentService->getPaidOrdersByUserId($userId);
$paidOrderItemsAll = [];

// Loop through each paid order
foreach ($paidOrders as $paidOrder) {
    // Retrieve order items by order ID and merge them into the paidOrderItems array
    $paidOrderItems = $paymentService->getOrdersItemsByOrderId($paidOrder->orderID);
    $paidOrderItemsAll = array_merge($paidOrderItemsAll, $paidOrderItems);
}

$displayCheckBoxAndQuantityButtons = false;
$itemsTotal = 0;
$totalPrice = 0;
$arraySelectedTickets = null;
?>