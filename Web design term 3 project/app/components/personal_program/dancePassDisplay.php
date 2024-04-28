<div class="flex justify-between items-center" style="font-family: imprima">
    <div class="flex flex-col sm:flex-row items-center">
        <img src="assets/images/Payment_event_images/p2.jpg" alt="Event" class="w-20 h-20 mr-2">
        <span>Dance <br> Pass</span>
    </div>

    <div>
        <?php if ($ticket->date != null) {
            $dateOfPass = new DateTime($ticket->date);
            $formattedDate = $dateOfPass->format('d M');
            echo htmlspecialchars($formattedDate);
        } else {
            echo "All Days";
        } ?>
    </div>

    <div>Multiple</div>

    <div class="flex items-center">
        <button class="px-1 py-0.5 text-xs border">-</button>
        <input type="text" class="w-6 h-6 text-xs text-center border-t border-b"
            value="<?php echo htmlspecialchars($orderItem->quantity); ?>">
        <button class="px-1 py-0.5 text-xs border">+</button>
    </div>

    <div class="flex flex-col items-center">
        <div class="flex items-center mt-[-26px]">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
            <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
        </div>
        <div style="height: 20px;"></div>
        <div class="text-sm text-gray-500">
            <?php
            $price = $ticket->price;
            $quantityOfTicket = $orderItem->quantity;
            $subtotal = $quantityOfTicket * $price;
            $totalPrice += $subtotal;
            $formattedSubtotal = number_format($subtotal, 2, '.', '');
            echo htmlspecialchars($formattedSubtotal);
            ?>€
        </div>
    </div>
</div>