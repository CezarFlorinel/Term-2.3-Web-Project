<div class="flex justify-between items-center">
    <div class="w-1/4 flex-col items-center">
        <img src="assets/images/Payment_event_images/p2.jpg" alt="Event 1" class="w-20 h-20 rounded-full mb-2 text-sm">
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
        <?php echo htmlspecialchars($orderItem->quantity);
        $ticketsReserved = $ticketsService->countMaxPassesReserved($ticket->passesID, $order->orderID);
        $totalQuantityOfAvailableTickets = 0;
        if ($ticket->allDayPass == true) {
            $totalQuantityOfAvailableTickets = $ticket->maxAllDayPasses;
        } else {
            $totalQuantityOfAvailableTickets = $ticket->maxOneDayPasses;
        }
        if ($ticketsReserved + $orderItem->quantity > $totalQuantityOfAvailableTickets) {
            $allowPass = false;
            if ($ticket->date == null)
                $whatTicketCantBeReserved = "The maximum number of passes for the all days dance pass has been reached.";
            else {
                $whatTicketCantBeReserved = "The maximum number of passes for the " . $ticket->date . " dance pass has been reached.";
            }
        }
        ?>
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