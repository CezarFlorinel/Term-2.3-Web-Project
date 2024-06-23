<?php
session_start();

use App\Services\PaymentService;
use App\Services\TicketsService;
use App\Services\HistoryService;

$paymentService = new PaymentService();
$ticketsService = new TicketsService();
$historyService = new HistoryService();

$customerData = $_SESSION['customerData'];

$userID = null;

if (isset($_SESSION['userId'])) {
    $userID = $_SESSION['userId'];
} else {
    header('Location: /login');
}


$order = $paymentService->getOrderByUserId($userID);

if (isset($_SESSION['orderItemIDs'])) {
    $orderItems = [];
    foreach ($_SESSION['orderItemIDs'] as $orderItemID) {
        $orderItems[] = $paymentService->getOrderItemByID($orderItemID);
    }
} else {
    $orderItems = $paymentService->getOrdersItemsByOrderId($order->orderID);
}

$entireTotal = 0;
$itemsTotal = 0;
$totalVAT = 0;
$allowHistory = true;
$allowDance = true;
$allowPass = true;
$whatTicketCantBeReserved = "";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link rel="stylesheet" href="CSS_files/payment.css">
</head>

<body class="bg-black text-white">

    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-4xl mx-auto p-8">
            <!-- Header Section -->
            <div class="flex items-center mb-10" style="text-decoration: underline">
                <img src="assets/images/Payment_event_images/Overview_icon.png" alt="Logo" class="mr-2 w-12 h-12">
                <h1 class="text-3xl font-bold">Overview</h1>
            </div>

            <!-- Headings Section -->
            <div class="flex justify-between px-4 mb-2">
                <div class="w-1/4 font-bold text-sm">Event</div>
                <div class="w-1/4 font-bold text-sm">Time</div>
                <div class="w-1/4 font-bold text-sm">Location</div>
                <div class="w-1/6 font-bold text-sm">Quantity</div>
                <div class="w-1/12 text-right font-bold text-sm">Price</div>
            </div>
            <div class="w-full border-t border-gray-400"></div>

            <div style="height: 20px;"></div>
            <div class="bg-white text-black rounded-lg py-4 px-6">

                <!-- Items List -->
                <div class="space-y-4">
                    <?php
                    end($orderItems);
                    $lastKey = key($orderItems);
                    reset($orderItems);
                    ?>
                    <?php foreach ($orderItems as $key => $orderItem): ?>
                        <?php $itemsTotal++;
                        $ticket = $ticketsService->returnTypeOfTicket($orderItem); ?>

                        <?php if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket'): ?>
                            <?php require __DIR__ . '/../../components/payment/historyTicketDisplay.php'; ?>
                        <?php elseif (get_class($ticket) == 'App\Models\Tickets\DanceTicket'): ?>
                            <?php require __DIR__ . '/../../components/payment/danceTicketDisplay.php'; ?>
                        <?php else: ?>
                            <?php require __DIR__ . '/../../components/payment/dancePassDisplay.php'; ?>
                        <?php endif; ?>

                        <?php if ($key !== $lastKey): // Check if not the last item        ?>
                            <div class="w-full border-t border-gray-400"></div> <!-- Divider Line, remove for last in array -->
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Total Line -->
                <div class="pt-4 mt-4 border-t border-gray-300 text-xl font-bold text-center">
                    You have
                    <?php echo $itemsTotal;
                    $_SESSION['itemsTotal'] = $itemsTotal; ?> items in total

                    <div>Total VAT:
                        <?php $_SESSION['totalVAT'] = $totalVAT;
                        echo $formattedSubtotal = number_format($totalVAT, 2, '.', ''); ?>€
                    </div>
                    <div>Total
                        <?php $_SESSION['totalPrice'] = $entireTotal;
                        echo $formattedSubtotal = number_format($entireTotal, 2, '.', ''); ?>€
                    </div>

                </div>
            </div>

            <div style="height: 80px;"></div>

            <!-- Client and Billing Information Section -->
            <?php require __DIR__ . '/../../components/payment/clientBillingInfoDisplay.php'; ?>

            <div style="height: 80px;"></div>
            <!-- Note and Button -->
            <div class="text-center text-sm mb-6">
                Please Check if all details are correct. If they are not, you can always go back using the button below.
            </div>

            <button type="button" class="button-back" onclick="window.history.back();">&larr; Go Back</button>

            <?php if ($allowHistory && $allowDance && $allowPass): ?>
                <div class="flex justify-center">
                    <a href="Payment/redirectToCheckout">
                        <button
                            class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                            NEXT STEP →
                        </button>
                    </a>
                </div>
            <?php else: ?>
                <div class="flex justify-center">
                    <?php echo '<p class="text-red-500">There was an error with your order.' . $whatTicketCantBeReserved . '</p>' ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>

</body>

</html>