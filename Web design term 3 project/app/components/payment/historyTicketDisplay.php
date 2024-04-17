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
        <?php echo htmlspecialchars($orderItem->quantity);
        $ticketsReserved = $ticketsService->countHistoryTicketsReserved($ticket->tourID, $ticket->language);
        $maximumTickets = $ticketsService->getMaximumTicketsForHistoryReservation($ticket->language, $ticket->tourID);
        if ($ticketsReserved + $orderItem->quantity > $maximumTickets) {
            $allowHistory = false;
            $whatTicketCantBeReserved = "The maximum number of tickets for the " . $ticket->language . " tour has been reached.";
        }
        ?>
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