<div class="bg-black py-8 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold">ALL-ACCESS-PASS</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Day Passes -->
            <?php foreach ($oneDayPasses as $pass): ?>
                <div class="border border-gray-700 rounded-lg p-4">
                    <h3 class="text-2xl font-bold mb-3"><?php $date = new DateTime($pass->date);
                    echo strtoupper($date->format('l j F')); ?></h3>
                    <ul class="mb-4">
                        <?php foreach ($danceTickets as $ticket):
                            $ticketDate = new DateTime($ticket->dateAndTime);
                            if ($ticketDate == $date): ?>
                                <li><?php echo htmlspecialchars($ticket->singer); ?></li>
                            <?php endif; endforeach; ?>
                    </ul>
                    <div class="flex items
                                    -center justify-between">
                        <span class="text-2xl font-bold">€
                            <?php $formattedPrice = number_format($pass->price, 2, '.', ''); // Format the price to two decimal places
                                echo htmlspecialchars($formattedPrice); ?></span>
                        <button
                            class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            Add to cart
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- All-Access Pass -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-gray-900 p-6 rounded-lg">
            <h3 class="text-3xl font-bold mb-4 md:mb-0">ALL-ACCESS-PASS FOR ALL 3 DAYS!</h3>

            <?php foreach ($multipleDayPasses as $pass): ?>
                <div class="flex items-center">
                    <span class="text-4xl font-bold mr-6">€ <?php $formattedPrice = number_format($pass->price, 2, '.', ''); // Format the price to two decimal places
                        echo htmlspecialchars($formattedPrice); ?></span>
                    <button class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        Add to cart
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            Note: The capacity of the Club sessions is very limited. Availability for All-Access pass
            holders cannot be guaranteed due to safety regulations.
        </p>
    </div>
</div>