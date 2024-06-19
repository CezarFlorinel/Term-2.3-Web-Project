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
        <!-- Repeat this structure for each item -->
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