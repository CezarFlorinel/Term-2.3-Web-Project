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



$historyFirstRoute = $historyService->getFirstHistoryRoute();
$danceTicketsForAgenda = [];
$historyTicketsForAgenda = [];



// if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket') {
//     $historyTicketsForAgenda[] = $ticket;
// } else if (get_class($ticket) == 'App\Models\Tickets\DanceTicket') {
//     $danceTicketsForAgenda = $ticket;
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">

    <style>
        .fc-event.restaurant {
            background-color: #FFE662;
            color: white;
        }

        .fc-event.dance {
            background-color: #8FADC6;
            color: white;
        }

        .fc-event.history {
            background-color: #FF9A9D;
            color: white;
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            color: black;
        }

        .fc-event:hover {
            transform: scale(1.1);
            z-index: 100;
            border-color: #ff0000;
            background-color: red;
            height: 200px;
        }

        .fc-event .fc-event-title-container {
            display: flex;
            flex-direction: column;

        }

        .fc-event b {
            font-size: 16px;
            /* Title font size */
        }

        .fc-event div {
            font-size: 12px;
            /* Details font size */
        }

        .fc-event {
            height: 100%;
            /* Make the event fill the entire slot */
            overflow: hidden;
            /* Optional: Prevent content from spilling out */
        }
    </style>


    <?php include __DIR__ . '/../header.php'; ?>
    <div class="flex flex-col flex-grow">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl mx-auto p-8">

                <div id='calendar'></div>

                <?php require __DIR__ . '/../../components/personal_program/shareLinks.php'; ?>

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
        const reservations = <?php echo json_encode($reservations); ?>;
        console.log(reservations);
        const danceTicketsForAgenda = <?php echo json_encode($danceTicketsForAgenda); ?>;
        console.log(danceTicketsForAgenda);
        const historyTicketsForAgenda = <?php echo json_encode($historyTicketsForAgenda); ?>;
        console.log(historyTicketsForAgenda);
    </script>

    <script type="module" src="javascript/Personal_Program/personal_program_agenda_view.js"></script>
    <script type="module" src="javascript/Personal_Program/personal_program_listview.js"></script>

</body>

</html>