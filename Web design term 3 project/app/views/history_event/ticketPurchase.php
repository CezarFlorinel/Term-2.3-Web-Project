<?php
require __DIR__ . '/../../components/festival/history_event/ticketPurchase/getData.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival Project</title>
    <link rel="icon" type="image/png" href="/assets/images/Logos/H.png">
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2/dist/purify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="/CSS_files/js_custome_alert.css">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="CSS_files/ticket_purchase_history.css">
    <link rel="stylesheet" href="CSS_files/header.css">
</head>

<body>
    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <div class="all_container">
        <div class="main-container">
            <div class="header-text">
                <h1>Book Ticket – History Tour</h1>
                <p>Embark on a captivating journey through Haarlem's rich tapestry of history!
                    Join our immersive tour,<br> where tales of the past come alive in English,
                    Dutch, and Chinese, offering a truly multilingual exploration of this enchanting city.</p>
            </div>

            <div class="content mx-auto max-w-4xl p-4 flex flex-col md:flex-row items-center justify-center gap-4">
                <div
                    class="image-section w-full md:w-1/2 flex justify-center items-center mb-4 md:mb-0 order-1 md:order-1">
                    <img src="assets/images/history_event/history_ticket_purchase/Church-HistoryTicket.png"
                        alt="Saint Bavo" class="max-w-full h-auto">
                </div>

                <div class="booking-form w-full md:w-1/2 grid gap-4 order-2 md:order-2">

                    <?php require __DIR__ . '/../../components/festival/history_event/ticketPurchase/selectLanguage.php'; ?>
                    <?php require __DIR__ . '/../../components/festival/history_event/ticketPurchase/date.php'; ?>
                    <?php require __DIR__ . '/../../components/festival/history_event/ticketPurchase/time.php'; ?>
                    <?php require __DIR__ . '/../../components/festival/history_event/ticketPurchase/type.php'; ?>
                    <?php require __DIR__ . '/../../components/festival/history_event/ticketPurchase/quantity.php'; ?>

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
            const orderID = <?php echo json_encode($orderID); ?>;
        </script>
        <script type="module" src="javascript/History/ticket_purchase_history.js"></script>
    </div>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>
</body>

</html>