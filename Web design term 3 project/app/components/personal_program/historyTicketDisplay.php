<div class="flex justify-between items-center" style="font-family: imprima">
    <!-- Image and tour info section -->
    <div class="flex flex-col sm:flex-row items-center">
        <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event" class="w-20 h-20 mr-2">
        <span><?php echo htmlspecialchars($ticket->language) ?> <br> Tour</span>
    </div>

    <!-- Date and time section -->
    <div>
        <?php
        $ticket->dateAndTime;
        $startDateTime = new DateTime($ticket->dateAndTime);
        $endDateTime = clone $startDateTime;
        $endDateTime->add(new DateInterval('PT2H30M'));
        $output = $startDateTime->format('d M') . '<br>' . $startDateTime->format('H:i') . '-' . $endDateTime->format('H:i');
        echo $output;
        ?>
    </div>

    <!-- Starting point section -->
    <div>Starting Point <br> Near
        <?php
        $historyFirstRoute = $historyService->getFirstHistoryRoute();
        $string = $historyFirstRoute->locationName;
        if (strpos($string, "1.") === 0) {
            $string = substr($string, 3);
        }
        echo htmlspecialchars($string)
            ?>
    </div>

    <!-- Quantity control section -->
    <div class="flex items-center">
        <button class="px-1 py-0.5 text-xs border">-</button>
        <input type="text" class="w-6 h-6 text-xs text-center border-t border-b"
            value="<?php echo htmlspecialchars($orderItem->quantity); ?>">
        <button class="px-1 py-0.5 text-xs border">+</button>
    </div>

    <!-- Checkbox and price calculation section -->
    <div class="flex flex-col items-center">
        <div class="flex items-center mt-[-26px]">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
            <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
        </div>
        <div style="height: 20px;"></div>
        <div class="text-sm text-gray-500">
            <?php
            $price = $ticketsService->getHistoryTicketPriceByType($ticket->typeOfTicket);
            $quantityOfTicket = $orderItem->quantity;
            $subtotal = $quantityOfTicket * $price;
            $totalPrice += $subtotal;
            $formattedSubtotal = number_format($subtotal, 2, '.', '');
            echo htmlspecialchars($formattedSubtotal);
            ?>€
        </div>
    </div>
</div>