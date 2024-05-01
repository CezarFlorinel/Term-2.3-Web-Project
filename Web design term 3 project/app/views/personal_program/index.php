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

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">
    <?php include __DIR__ . '/../header.php'; ?>
    <div class="flex flex-col flex-grow">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl mx-auto p-8">
                <div class="flex flex-col" style="font-family: 'Playfair Display', serif;">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-5xl font-bold">Your Personal Program</h1>
                        <button
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Change View
                        </button>
                    </div>
                    <div class="flex items-center mt-4">
                        <p class="mr-4 text-2xl" style="font-family: 'Playfair Display', serif;">Share your personal
                            program on:
                        </p>
                        <!-- Icons with Playfair Display font -->
                        <a href="https://facebook.com" target="_blank">
                            <img src="assets\images\Logos\Facebook-W.png" alt="Facebook" class="mr-2">
                        </a>
                        <a href="https://linkedin.com" target="_blank">
                            <img src="assets\images\Logos\Linkdin-W.png" alt="LinkedIn" class="mr-2">
                        </a>
                        <a href="https://instagram.com" target="_blank">
                            <img src="assets\images\Logos\Instagram-W.png" alt="Instagram" class="mr-2">
                        </a>
                        <a target="_blank">
                            <img src="assets\images\Logos\H.png" alt="Haarlem" class="mr-2">
                        </a>
                        <!-- Additional social media icons here -->
                    </div>
                </div>

                <div style="height: 20px;"></div>
                <h1 class="text-4xl font-bold">Your Cart</h1>
                <div style="height: 20px;"></div>

                <!-- Headings Section -->
                <div class="flex justify-between px-4 mb-2" style="font-family: Playfair Display;">
                    <div class="w-1/4 font-bold">Event</div>
                    <div class="w-1/4 font-bold">Time</div>
                    <div class="w-1/4 font-bold">Location</div>
                    <div class="w-1/6 font-bold">Quantity</div>
                    <div class="w-1/12 text-right font-bold">Price</div>
                </div>
                <div class="w-full border-t border-gray-400"></div>

                <div style="height: 20px;"></div>
                <!-- White Square Section -->
                <div class="bg-white text-black rounded-lg py-4 px-6 text-sm">
                    <!-- Items List -->
                    <div class="space-y-4">
                        <!-- Item Rows -->
                        <!-- Repeat this structure for each item, replace with actual data -->
                        <?php
                        end($orderItems);
                        $lastKey = key($orderItems);
                        reset($orderItems);
                        ?>
                        <?php foreach ($orderItems as $key => $orderItem): ?>
                            <?php $itemsTotal++;
                            $ticket = $ticketsService->returnTypeOfTicket($orderItem); ?>

                            <?php if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket'): ?>
                                <?php require __DIR__ . '/../../components/personal_program/historyTicketDisplay.php'; ?>
                            <?php elseif (get_class($ticket) == 'App\Models\Tickets\DanceTicket'): ?>
                                <?php require __DIR__ . '/../../components/personal_program/danceTicketDisplay.php'; ?>
                            <?php else: ?>
                                <?php require __DIR__ . '/../../components/personal_program/dancePassDisplay.php'; ?>
                            <?php endif; ?>

                            <?php if ($key !== $lastKey): // Check if not the last item        ?>
                                <div class="border-t border-gray-400"></div><!-- Divider Line, remove for last in array -->
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>

                    <div class="pt-4 mt-4 border-t border-gray-500 flex justify-between items-center text-xl font-bold">
                        <div id="js_total-items" data-id-total-items="<?php echo $itemsTotal; ?>"> You have
                            <?php echo $itemsTotal; ?> items in total
                        </div>
                        <div id="js_total-price"
                            data-id-total-price="<?php echo $formattedSubtotal = number_format($totalPrice, 2, '.', ''); ?>">
                            Total
                            <?php echo $formattedSubtotal = number_format($totalPrice, 2, '.', ''); ?>€
                        </div>
                    </div>

                </div>
                <div class="mt-10 flex justify-end gap-4">

                    <a href="/payment">
                        <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Purchase All Tickets
                        </button>
                    </a>


                    <button id="js_purchase-selected-tickets"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Purchase Selected Tickets
                    </button>
                </div>

                <div style="height: 20px;"></div>
                <h1 class="text-4xl font-bold">Your Purchased Reservations</h1>
                <div style="height: 20px;"></div>

                <!-- Headings Section -->
                <div class="flex justify-between px-4 mb-2" style="font-family: Playfair Display;">
                    <div class="w-1/4 font-bold">Event</div>
                    <div class="w-1/4 font-bold">Time</div>
                    <div class="w-1/4 font-bold">Location</div>
                    <div class="w-2/12 font-bold">Quantity</div>
                    <div class="w-1/12 text-right font-bold">Price</div>
                </div>
                <div class="w-full border-t border-gray-400"></div>

                <div style="height: 20px;"></div>

                <div class="bg-white text-black rounded-lg py-4 px-6 text-sm">
                    <!-- Items List -->
                    <div class="space-y-4">
                        <?php
                        $displayCheckBoxAndQuantityButtons = true;
                        $orderItems = $paidOrderItemsAll;
                        $itemsTotal = 0;
                        $totalPrice = 0;
                        end($orderItems);
                        $lastKey = key($orderItems);
                        reset($orderItems);
                        ?>
                        <?php foreach ($orderItems as $key => $orderItem): ?>
                            <?php $itemsTotal++;
                            $ticket = $ticketsService->returnTypeOfTicket($orderItem); ?>

                            <?php if (get_class($ticket) == 'App\Models\Tickets\HistoryTicket'): ?>
                                <?php require __DIR__ . '/../../components/personal_program/historyTicketDisplay.php'; ?>
                            <?php elseif (get_class($ticket) == 'App\Models\Tickets\DanceTicket'): ?>
                                <?php require __DIR__ . '/../../components/personal_program/danceTicketDisplay.php'; ?>
                            <?php else: ?>
                                <?php require __DIR__ . '/../../components/personal_program/dancePassDisplay.php'; ?>
                            <?php endif; ?>

                            <?php if (!empty($reservations)): ?>
                                <div class="border-t border-gray-400"></div>
                            <?php elseif ($key !== $lastKey): ?>
                                <div class="border-t border-gray-400"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <!-- The Reservations -->
                        <?php
                        end($reservations);
                        $lastKeyReservations = key($reservations);
                        reset($reservations);
                        ?>

                        <?php foreach ($reservations as $key => $reservation): ?>
                            <?php
                            $restaurant = $yummyService->getRestaurantById($reservation->restaurantID);
                            $session = $yummyService->getSessionByRestaurantName($restaurant->name);
                            require __DIR__ . '/../../components/personal_program/yummyReservationDisplay.php';
                            ?>
                            <?php if ($key !== $lastKeyReservations): ?>
                                <div class="border-t border-gray-400"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div
                            class="pt-4 mt-4 border-t border-gray-700 flex justify-between items-center text-xl font-bold">
                            <div> You have <?php echo $itemsTotal; ?> items in total</div>
                            <div>Total
                                <?php echo $formattedSubtotal = number_format($totalPrice, 2, '.', ''); ?>€
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include __DIR__ . '/../footer.php'; ?>

        <script>
            document.querySelectorAll('.increment, .decrement').forEach(button => {
                button.addEventListener('click', function (e) {
                    const itemId = this.dataset.itemId;
                    const isIncrement = this.classList.contains('increment');
                    const input = document.querySelector(`input[data-item-id="${itemId}"]`);
                    let currentQuantity = parseInt(input.value);
                    currentQuantity = isIncrement ? currentQuantity + 1 : (currentQuantity > 1 ? currentQuantity - 1 : 1);
                    input.value = currentQuantity;  // Update the input field

                    console.log('Current quantity:', currentQuantity);
                    console.log('Item ID:', itemId);


                    // Update subtotal and total on the server
                    fetch('/api/PersonalProgramListView/updateQuantityAndTotals', {
                        method: 'PATCH',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            quantity: currentQuantity,
                            orderItemID: itemId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);  // delete after no use
                            document.querySelector(`#subtotal-${itemId}`).textContent = `${data.subtotal}€`;
                            document.getElementById('js_total-price').textContent = `Total ${data.totalPrice}€`;
                            document.getElementById('js_total-items').textContent = `You have ${data.totalItems} items in total`;
                        })
                        .catch(error => console.error('Error updating quantity:', error));
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const purchaseSelectedTicketsButton = document.getElementById('js_purchase-selected-tickets');
                purchaseSelectedTicketsButton.addEventListener('click', function () {
                    const selectedCheckboxes = document.querySelectorAll('.js_form-checkbox:checked');
                    const selectedOrderItemIDs = Array.from(selectedCheckboxes).map(checkbox => {
                        return checkbox.closest('[data-type-order-item-id]').getAttribute('data-type-order-item-id');
                    });

                    // don't do anything if no checkboxes are selected, or throw error message

                    console.log('Selected Order Item IDs:', selectedOrderItemIDs);

                    // Purchase selected tickets
                    fetch('/api/PersonalProgramListView/storeSelectedOrderItemsInSession', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            orderItemIDs: selectedOrderItemIDs
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);  // delete after no use
                            // location.reload();
                        })
                        .catch(error => console.error('Error purchasing selected tickets:', error));
                });
            });


        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteOrderItemAPI = '/api/PersonalProgramListView/deleteOrderItem';
                const deleteReservationAPI = '/api/PersonalProgramListView/deleteReservation';
                const deletePaidResText = 'Are you sure you want to delete this reservation ? You will NOT receive a refund, and the ticket will become useless (if applicable) ! You cannot reverse this changes.';
                const deleteUnpaidResText = 'Are you sure you want to delete this reservation?';
                const theDataTypeOrderItem = "data-type-order-item-id";
                const theDataTypeReservation = "data-type-reservation-item-id";

                var deleteIcons = document.querySelectorAll('.js_delete-icon');
                deleteIcons.forEach(function (icon) {
                    var typeOfReservation = icon.dataset.typeOfReservation;
                    if (typeOfReservation === 'res_paid') {
                        showConfirmationPopup(icon, deleteOrderItemAPI, deletePaidResText, theDataTypeOrderItem);
                    }
                    else if (typeOfReservation === 'res_unpaid') {
                        showConfirmationPopup(icon, deleteOrderItemAPI, deleteUnpaidResText, theDataTypeOrderItem);
                    }
                    else if (typeOfReservation === 'restaurant_res') {
                        showConfirmationPopup(icon, deleteReservationAPI, deletePaidResText, theDataTypeReservation);
                    }


                });
            });

            function showConfirmationPopup(icon, API, text, dataType) {
                icon.addEventListener('click', function (event) {
                    var itemId = this.closest(`[${dataType}]`).getAttribute(`${dataType}`);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteItem(itemId, API);
                        }
                    });
                });

            }

            function deleteItem(itemId, API) {
                // Example: send a DELETE request to your server
                fetch(`${API}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ID: itemId
                    })

                }).then(response => response.json())
                    .then(data => {
                        this.location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>





</body>

</html>