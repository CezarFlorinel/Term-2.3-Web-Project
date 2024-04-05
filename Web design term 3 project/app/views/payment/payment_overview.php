<?php
session_start();

use App\Services\PaymentService;
use App\Services\TicketsService;
use App\Services\HistoryService;

$paymentService = new PaymentService();
$ticketsService = new TicketsService();
$historyService = new HistoryService();

$customerData = $_SESSION['customerData'];
$userID = 1;  // get this from the sesssion as well after login has been done

$order = $paymentService->getOrderByUserId($userID);
$orderItems = $paymentService->getOrdersItemsByOrderId($order->orderID);
$entireTotal = 0;
$itemsTotal = 0;
$totalVAT = 0;
$allowHistory = true;
$allowDance = true;
$allowPass = true;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="CSS_files/payment.css">
</head>

<body class="bg-black text-white">

    <?php include __DIR__ . '/../header.php'; ?>

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
                            <div class="flex justify-between items-center">
                                <div class="w-1/4 flex-col items-center">
                                    <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1"
                                        class="w-20 h-20 rounded-full mb-2 text-sm">
                                    <?php echo htmlspecialchars($ticket->language) . ' Tour' ?>
                                </div>
                                <div class="w-1/4 text-sm">
                                    <?php
                                    $ticket->dateAndTime;
                                    $startDateTime = new DateTime($ticket->dateAndTime);
                                    $endDateTime = clone $startDateTime;
                                    $endDateTime->add(new DateInterval('PT2H30M'));
                                    $output = $startDateTime->format('d M') . '<br>' . $startDateTime->format('H:i') . '-' . $endDateTime->format('H:i');
                                    echo $output;
                                    ?>
                                </div>
                                <div class="w-1/3 text-sm">Starting Point <br> Near
                                    <?php $historyFirstRoute = $historyService->getFirstHistoryRoute();
                                    $string = $historyFirstRoute->locationName;
                                    if (strpos($string, "1.") === 0) {
                                        $string = substr($string, 3);
                                    }
                                    echo htmlspecialchars($string) ?>
                                </div>
                                <div class="w-1/12 text-sm">
                                    <?php echo htmlspecialchars($orderItem->quantity) ?>
                                </div>
                                <div class="w-1/12 text-right text-sm">
                                    <?php $price = $ticketsService->getHistoryTicketPriceByType($ticket->typeOfTicket);
                                    $quantityOfTicket = $orderItem->quantity;
                                    $subtotal = $quantityOfTicket * $price;
                                    $entireTotal += $subtotal;
                                    $totalVAT += $subtotal * (9 / 100);
                                    $formattedSubtotal = number_format($subtotal, 2, '.', '');
                                    echo htmlspecialchars($formattedSubtotal) ?>€
                                </div>
                            </div>

                        <?php elseif (get_class($ticket) == 'App\Models\Tickets\DanceTicket'): ?>

                            <div class="flex justify-between items-center">
                                <div class="w-1/4 flex-col items-center">
                                    <img src="assets/images/Payment_event_images/p1.jpg" alt="Event 1"
                                        class="w-20 h-20 rounded-full mb-2 text-sm">
                                    <?php echo htmlspecialchars($ticket->singer) ?> Concert
                                </div>
                                <?php
                                $ticket->dateAndTime;
                                $ticket->startTime;
                                $ticket->endTime;
                                $date = new DateTime($ticket->dateAndTime);
                                $formattedDate = $date->format('d M');
                                $startTime = new DateTime($ticket->startTime);
                                $formattedStartTime = $startTime->format('H:i');
                                $endTime = new DateTime($ticket->endTime);
                                $formattedEndTime = $endTime->format('H:i');
                                echo "<div class=\"w-1/4 text-sm\">{$formattedDate}<br>{$formattedStartTime}-{$formattedEndTime}</div>"
                                    ?>

                                <div class="w-1/3 text-sm">
                                    <?php echo htmlspecialchars($ticket->location) ?><br>Club
                                </div>
                                <div class="w-1/12 text-sm">
                                    <?php echo htmlspecialchars($orderItem->quantity) ?>
                                </div>
                                <div class="w-1/12 text-right text-sm">
                                    <?php $price = $ticket->price;
                                    $quantityOfTicket = $orderItem->quantity;
                                    $subtotal = $quantityOfTicket * $price;
                                    $entireTotal += $subtotal;
                                    $totalVAT += $subtotal * (21 / 100);
                                    $formattedSubtotal = number_format($subtotal, 2, '.', '');
                                    echo htmlspecialchars($formattedSubtotal) ?>€
                                </div>
                            </div>

                        <?php else: ?> <!-- Add more elseif statements for passes and use else for error  -->
                            <div class="flex justify-between items-center">
                                <div class="w-1/4 flex-col items-center">
                                    <img src="assets/images/Payment_event_images/p2.jpg" alt="Event 1"
                                        class="w-20 h-20 rounded-full mb-2 text-sm">
                                    Dance Pass
                                </div>
                                <div class="w-1/4 text-sm">
                                    <?php if ($ticket->date != null) {
                                        $dateOfPass = new DateTime($ticket->date);
                                        $formattedDate = $dateOfPass->format('d M');
                                        echo htmlspecialchars($formattedDate);
                                    } else
                                        echo "All Days" ?>
                                    </div>
                                    <div class="w-1/3 text-sm">Multiple</div>
                                    <div class="w-1/12 text-sm">
                                    <?php echo htmlspecialchars($orderItem->quantity) ?>
                                </div>
                                <div class="w-1/12 text-right text-sm">
                                    <?php $price = $ticket->price;
                                    $quantityOfTicket = $orderItem->quantity;
                                    $subtotal = $quantityOfTicket * $price;
                                    $entireTotal += $subtotal;
                                    $totalVAT += $subtotal * (21 / 100);
                                    $formattedSubtotal = number_format($subtotal, 2, '.', '');
                                    echo htmlspecialchars($formattedSubtotal) ?>€
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($key !== $lastKey): // Check if not the last item    ?>
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
            <div class="flex justify-between mb-6">
                <!-- Client Details -->
                <div class="w-1/2 pr-4">
                    <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Client Details:</h3>
                    <p>Full Name:
                        <?php echo htmlspecialchars($customerData['name']) ?>
                    </p>
                    <p>Email:
                        <?php echo htmlspecialchars($customerData['email']) ?>
                    </p>
                    <p>Phone Number:
                        <?php echo htmlspecialchars($customerData['phoneNumber']) ?>
                    </p>
                </div>

                <!-- Billing Information -->
                <div class="w-1/2 pl-4">
                    <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Billing Information:</h3>
                    <p>Country:
                        <?php echo htmlspecialchars($customerData['country']) ?>
                    </p>
                    <p>Street:
                        <?php echo htmlspecialchars($customerData['address']) ?>
                    </p>
                    <p>Extra Address:
                        <?php echo htmlspecialchars($customerData['extraAddress']) ?>
                    <p>City:
                        <?php echo htmlspecialchars($customerData['city']) ?>
                    </p>
                    <p>County:
                        <?php echo htmlspecialchars($customerData['county']) ?>
                    </p>
                    <p>Zip Code:
                        <?php echo htmlspecialchars($customerData['zip']) ?>
                    </p>
                </div>
            </div>

            <div style="height: 80px;"></div>
            <!-- Note and Button -->
            <div class="text-center text-sm mb-6">
                Please Check if all details are correct. If they are not, you can always go back using the button below.
            </div>

            <button type="button" class="button-back" onclick="window.history.back();">&larr; Go Back</button>

            <div class="flex justify-center">
                <a href="Payment/redirectToCheckout">
                    <button
                        class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                        NEXT STEP →
                    </button>
                </a>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../footer.php'; ?>

</body>

</html>