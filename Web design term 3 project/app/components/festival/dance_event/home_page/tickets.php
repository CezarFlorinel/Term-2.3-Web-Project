<section class="bg-black rounded-lg py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <!-- Flex Container for both sections -->
            <div class="flex flex-wrap w-full">
                <!-- Sidebar: Filter Section -->
                <div class="w-full lg:w-1/3 px-4 mb-6 lg:mb-0">
                    <div class="bg-black p-6 shadow-lg rounded-lg border border-blue-900">
                        <h3 class="text-xl font-bold mb-4">Filter Tickets</h3>
                        <!-- Artists Filter -->
                        <?php require __DIR__ . '/ticketFilterOptions.php/byArtist.php'; ?>

                        <!-- Date Filter -->
                        <?php require __DIR__ . '/ticketFilterOptions.php/byDate.php'; ?>

                        <!-- Location Filter -->
                        <?php require __DIR__ . '/ticketFilterOptions.php/byLocation.php'; ?>

                        <button id="js_resetFiltersButton"
                            class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg w-full">Reset
                            all filters</button>
                    </div>
                </div>

                <!-- Ticket Display adjusted for responsive and scalable display -->
                <div id="js_ticketDisplayContainer"
                    class="w-full lg:w-2/3 px-4 max-h-[800px] overflow-auto space-y-4 p-4 border border-blue-900">

                    <?php foreach ($danceTickets as $ticket): ?>
                        <div id="js_ticketDanceContainer_<?php echo htmlspecialchars($ticket->D_TicketID); ?>"
                            class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                            <div class="flex-1 mb-4">
                                <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                    <?php echo htmlspecialchars($ticket->singer); ?>
                                </div>
                                <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                    <div class="text-center">
                                        <div class="font-semibold">Location</div>
                                        <div>📍 <?php echo htmlspecialchars($ticket->location); ?></div>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold">Date & Time</div>
                                        <div>
                                            <?php $date = new DateTime($dateString);
                                            $displayDate = $date->format('d M - l');
                                            echo strtoupper($displayDate); ?>
                                        </div>
                                        <div><?php
                                        $startTime = new DateTime($ticket->startTime);
                                        $endTime = new DateTime($ticket->endTime);
                                        echo $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
                                        ?></div>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold">Session</div>
                                        <div><?php echo htmlspecialchars($ticket->sessionType) ?></div>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold">Price</div>
                                        <div>€ <?php $formattedPrice = number_format($ticket->price, 2, '.', '');
                                        echo htmlspecialchars($formattedPrice); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end items-center space-x-2">
                                <button
                                    class="js_decreaseTicketQuantityButton bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-minus text-white text-xs"></i>
                                </button>
                                <span class="js_ticketQuantity">1</span>
                                <button
                                    class="js_increaseTicketQuantityButton bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus text-white text-xs"></i>
                                </button>
                                <button data-ticket-id="<?php echo htmlspecialchars($ticket->D_TicketID); ?>"
                                    data-order-id="<?php echo htmlspecialchars($order->orderID); ?>"
                                    class=" js_addTicketToCartButton bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Add ticket to cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>

            </div>
        </div>
    </div>
</section>