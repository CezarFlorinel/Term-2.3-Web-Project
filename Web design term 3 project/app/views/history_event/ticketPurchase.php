<?php

use App\Services\HistoryService;
use App\Services\PaymentService;

$historyService = new HistoryService();
$paymentService = new PaymentService();

$usedID = 1; // this is the ID of the user that is currently logged in, to be replaced with the actual ID of the user
$order = $paymentService->getOrderByUserId($usedID);

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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Tour Ticket Booking</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="CSS_files/ticket_purchase_history.css">
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <div class="main-container">
        <div class="header-text">
            <h1>Book Ticket – History Tour</h1>
            <p>Embark on a captivating journey through Haarlem's rich tapestry of history!
                Join our immersive tour,<br> where tales of the past come alive in English,
                Dutch, and Chinese, offering a truly multilingual exploration of this enchanting city.</p>
        </div>

        <div class="content mx-auto max-w-4xl p-4 flex flex-col md:flex-row items-center justify-center gap-4">
            <div class="image-section w-full md:w-1/2 flex justify-center items-center mb-4 md:mb-0 order-1 md:order-1">
                <img src="assets/images/history_event/history_ticket_purchase/Church-HistoryTicket.png" alt="Saint Bavo"
                    class="max-w-full h-auto">
            </div>

            <div class="booking-form w-full md:w-1/2 grid gap-4 order-2 md:order-2">
                <div class="form-group flag-icons flex justify-center items-center gap-2">
                    <label class="block text-sm font-medium text-gray-700">Selected Language</label>
                    <div class="flex">
                        <img id="js_en_option" src="assets/images/elements/UK-flag-small.png" alt="English"
                            class="w-6 h-6">
                        <img id="js_nl_option" src="assets/images/elements/download 3.png" alt="Dutch" class="w-6 h-6">
                        <img id="js_cn_option" src="assets/images/elements/download 5.png" alt="Chinese"
                            class="w-6 h-6">
                    </div>
                </div>
                <div id="js_dates" class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <div class="button-group flex justify-center items-center gap-2" id="date-group">
                        <button id="js_date25"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 active"
                            disabled>25</button>
                        <button id="js_date26"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 active"
                            disabled>26</button>
                        <button id="js_date27"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 active"
                            disabled>27</button>
                        <button id="js_date28"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 active"
                            disabled>28</button>
                    </div>
                </div>
                <div id="js_startingTime" class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Starting Time</label>
                    <div class="button-group flex justify-center items-center gap-2" id="time-group">
                        <button
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 active"
                            disabled>10:00</button>
                        <button
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 active"
                            disabled>13:00</button>
                        <button
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 active"
                            disabled>16:00</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Type of Ticket</label>
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-2">
                        <button id="js_familyTicket" data-price="<?php echo $secondHistoryTicket->price; ?>"
                            class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 active">Family
                            (x4) - <?php $formattedPrice = number_format($secondHistoryTicket->price, 2, '.', '');
                            echo htmlspecialchars($formattedPrice); ?>€</button>
                        <button id="js_regularTicket" data-price="<?php echo $firstHistoryTicket->price; ?>"
                            class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 active">Regular
                            - <?php $formattedPrice = number_format($firstHistoryTicket->price, 2, '.', '');
                            echo htmlspecialchars($formattedPrice); ?>€</button>
                    </div>
                </div>
                <div class="form-group number-input flex justify-center items-center gap-2">
                    <label for="number-of-tickets" class="block text-sm font-medium text-gray-700">Number of
                        Tickets</label>
                    <button id="js_minusQuantityButton" type="button"
                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none">-</button>
                    <input type="number" id="js_number-of-tickets" value="0"
                        class="w-16 text-center rounded border-gray-300" disabled>
                    <button id="js_addQuantityButton" type="button"
                        class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none">+</button>
                </div>
                <div class="total-container flex justify-center items-center">
                    <label class="text-sm font-medium text-gray-700">Total:</label>
                    <span id="js_totalPrice" class="ml-2 font-semibold">0.00€</span>
                </div>
                <button id="js_addToCartButton"
                    class="submit-btn mx-auto px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">Add
                    to Cart</button>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        const tours = <?php echo json_encode($toursWithDates); ?>;
        console.log(tours);
        const order = <?php echo json_encode($order); ?>;
    </script>
    <script type="module" src="javascript/History/ticket_purchase_history.js"></script>


    <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>