<?php

use App\Services\HistoryService;
use App\Services\PaymentService;

$historyService = new HistoryService();
$paymentService = new PaymentService();


$usedID = null;

if (isset($_SESSION['userId'])) {
    $usedID = $_SESSION['userId'];
} else {
    header('Location: /');
}


$orderID = $paymentService->getOrderByUserId($usedID)->orderID;

$historyTickets = $historyService->getHistoryTicketPrices();
$firstHistoryTicket = $historyTickets[0];
$secondHistoryTicket = $historyTickets[1];


$tours = $historyService->getHistoryTours();
$departures = $historyService->getHistoryTourDeparturesTimetables();

$toursWithDates = [];

foreach ($tours as $tour) {

    $date = null;
    foreach ($departures as $departure) {
        if ($tour->departure == $departure->informationID) {
            $date = $departure->date;
            break;
        }
    }

    $toursWithDates[$tour->informationID] = [
        'id' => $tour->informationID,
        'startTime' => $tour->startTime,
        'englishTour' => $tour->englishTour,
        'dutchTour' => $tour->dutchTour,
        'chineseTour' => $tour->chineseTour,
        'date' => $date
    ];
}

?>