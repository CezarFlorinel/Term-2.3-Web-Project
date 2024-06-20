<div class="form-group">
    <label class="block text-sm font-medium text-gray-700">Type of Ticket</label>
    <div class="flex flex-col sm:flex-row justify-center items-center gap-2">
        <button id="js_familyTicket" data-price="<?php echo $secondHistoryTicket->price; ?>"
            class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 active">Family
            (x4) - <?php $formattedPrice = number_format($secondHistoryTicket->price, 2, '.', '');
            echo htmlspecialchars($formattedPrice); ?>€</button>
        <button id="js_regularTicket" data-price="<?php echo $firstHistoryTicket->price; ?>"
            class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 active">Regular
            - <?php $formattedPrice = number_format($firstHistoryTicket->price, 2, '.', '');
            echo htmlspecialchars($formattedPrice); ?>€</button>
    </div>
</div>