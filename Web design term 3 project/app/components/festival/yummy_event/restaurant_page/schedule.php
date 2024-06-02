<section class="container mx-auto px-4 py-8 flex flex-col items-center" style="font-family: 'Playfair Display', serif;">
    <h1 style="font-size: 52px; text-align: Left; font-weight: bold">Schedule and Timeslots</h1>
    <?php
    // Fetch session prices for the current restaurant
    $restaurantSessionPrices = $yummyService->getRestaurantSession($yummyDetailPageData->restaurantID);
    ?>
    <p class="text-2xl mb-6">This restaurant has <span
            class="font-bold underline"><?= count($restaurantSessionPrices) ?>
            sessions</span>, each session has a <span class="font-bold underline">duration of 2 hours</span>.
        Each session has a <span class="font-bold text-yellow-400">price of
            <?= number_format($restaurantSessionPrices[0]->pricesForAdults, 2, '.', '') ?>€</span>, children
        <span class="font-bold text-yellow-400">under 12 years old</span> have a price of <span
            class="font-bold text-yellow-400"><?= number_format($restaurantSessionPrices[0]->pricesForChildren, 2, '.', '') ?>€</span>.
    </p>
    <div class="bg-white text-black p-6 rounded-lg inline-flex justify-between items-center relative"
        style="width: 400px; min-height: 200px;">
        <div>
            <?php foreach ($restaurantSessionPrices as $key => $session): ?>
                <div class="mb-4">
                    <h3 class="font-bold text-xl">Session <?= $key + 1 ?>:</h3>
                    <?php
                    // Format start and end time
                    $startTime = date('H:i', strtotime($session->startTime));
                    $endTime = date('H:i', strtotime($session->endTime));
                    ?>
                    <p><?= $startTime ?> – <?= $endTime ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <img src="assets/images/elements/clock.png" alt="Clock" class="absolute top-0 right-0 h-32 w-32 mt-2 mr-2">
    </div>
    <p class="text-xl mt-4">*There is a reservation fee of <span class="font-bold">10,00€</span> - however this
        will be deducted from the final check upon visiting the restaurant.</p>
</section>