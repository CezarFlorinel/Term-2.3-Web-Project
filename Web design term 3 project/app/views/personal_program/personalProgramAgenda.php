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
$userId = 1; // Replace with actual user ID
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <link rel="stylesheet" href="CSS_files/agenda_view.css">
</head>

<body class="bg-black text-white flex flex-col min-h-screen">




    <?php include __DIR__ . '/../header.php'; ?>
    <div class="flex flex-col flex-grow">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl mx-auto p-8">

                <?php require __DIR__ . '/../../components/personal_program/shareLinks.php'; ?>

                <div id='calendar'></div>

                <?php require __DIR__ . '/../../components/personal_program/displayUnpurchasedReservations.php'; ?>


                <div class="mt-10 flex justify-end gap-4">
                    <a href="/personalProgramListView">
                        <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Purchase All Tickets
                        </button>
                    </a>
                </div>

            </div>
        </div>
        <?php include __DIR__ . '/../footer.php'; ?>
    </div>

    <script type="text/javascript">
        const reservations = <?php echo json_encode($reservationData); ?>;
        console.log(reservations);
        const danceTicketsForAgenda = <?php echo json_encode($danceTicketsForAgenda); ?>;
        console.log(danceTicketsForAgenda);
        const historyTicketsForAgenda = <?php echo json_encode($historyTicketsForAgenda); ?>;
        console.log(historyTicketsForAgenda);
        const historyFirstRoute = <?php echo json_encode($historyFirstRoute); ?>;
        console.log(historyFirstRoute);
    </script>

    <script type="module" src="javascript/Personal_Program/personal_program_agenda_view.js"></script>
    <script type="module" src="javascript/Personal_Program/personal_program_listview.js"></script>

</body>

</html>