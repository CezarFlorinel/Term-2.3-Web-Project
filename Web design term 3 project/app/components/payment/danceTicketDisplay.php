<div class="flex justify-between items-center">
    <div class="w-1/4 flex-col items-center">
        <img src="assets/images/Payment_event_images/p1.jpg" alt="Event 1" class="w-20 h-20 rounded-full mb-2 text-sm">
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
        <?php echo htmlspecialchars($orderItem->quantity);
        $ticketsReserved = $ticketsService->countDanceTicketsReserved($ticket->D_TicketID, $order->orderID);
        $totalQuantityOfAvailableTickets = $ticket->totalQuantityOfAvailableTickets;
        $ninetyPercentOfTotal = $totalQuantityOfAvailableTickets * 0.9;
        $ninetyPercentOfTotal = round($ninetyPercentOfTotal);
        if ($ticketsReserved + $orderItem->quantity > $ninetyPercentOfTotal) {
            $allowDance = false;
            $whatTicketCantBeReserved = "The maximum number of tickets for the " . $ticket->singer . " concert has been reached.";
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