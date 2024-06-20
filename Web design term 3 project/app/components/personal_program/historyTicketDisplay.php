<div class="flex justify-between items-center" style="font-family: imprima"
    data-type-order-item-id="<?php echo $orderItem->orderItemID ?>">

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
        <?php if ($displayCheckBoxAndQuantityButtons == false): ?>
            <button class="px-1 py-0.5 text-xs border decrement"
                data-item-id="<?php echo $orderItem->orderItemID; ?>">-</button>
            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b quantity"
                data-item-id="<?php echo $orderItem->orderItemID; ?>"
                value="<?php echo htmlspecialchars($orderItem->quantity); ?>" disabled>
            <button class="px-1 py-0.5 text-xs border increment"
                data-item-id="<?php echo $orderItem->orderItemID; ?>">+</button>
        <?php else: ?>
            <span><?php echo htmlspecialchars($orderItem->quantity); ?></span>
        <?php endif; ?>
    </div>


    <!-- Checkbox and price calculation section -->
    <div class="flex flex-col items-center">
        <div class="flex items-center mt-[-26px]">
            <?php if ($displayCheckBoxAndQuantityButtons == false): ?>
                <input type="checkbox" class="js_form-checkbox h-5 w-5 text-gray-600">
                <img src="assets/images/Logos/bin.png" alt="Delete" data-type-of-reservation="res_unpaid" alt="Delete"
                    class="js_delete-icon w-5 h-5 ml-2">
            <?php else: ?>
                <img src="assets/images/Logos/bin.png" alt="Delete" data-type-of-reservation="res_paid" alt="Delete"
                    class="js_delete-icon w-5 h-5 ml-2">
            <?php endif; ?>

        </div>
        <div style="height: 20px;"></div>
        <div class="text-sm text-gray-500" id="subtotal-<?php echo $orderItem->orderItemID; ?>">
            <?php
            $price = $ticketsService->getHistoryTicketPriceByType($ticket->typeOfTicket); // store the price
            $quantityOfTicket = $orderItem->quantity;
            $itemsTotal += $quantityOfTicket - 1; // because the 1 is already added
            $subtotal = $quantityOfTicket * $price;
            $totalPrice += $subtotal;
            $formattedSubtotal = number_format($subtotal, 2, '.', '');
            echo htmlspecialchars($formattedSubtotal);
            ?>€
        </div>
    </div>
</div>