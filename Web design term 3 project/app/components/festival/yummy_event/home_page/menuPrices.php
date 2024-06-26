<section>
    <!-- Special Prices Section -->
    <div class="bg-black py-8">
        <div class="max-w-4xl mx-auto px-4">
            <h1 style="font-size: 45px; font-family: 'Playfair Display', serif; text-align: center; font-weight: bold">
                Festival Menus at Special Prices</h1>
            <div class="bg-yellow-200 p-4 rounded-lg">
                <table class="table-auto w-full" style="font-family: 'Playfair Display', serif;">
                    <thead>
                        <tr>
                            <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                <span class="bg-red-500 px-4 py-2 rounded">Restaurant</span>
                            </th>
                            <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                <span class="bg-red-500 px-4 py-2 rounded">Price</span>
                            </th>
                            <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                <span class="bg-red-500 px-4 py-2 rounded">Kids price</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-black">
                        <?php foreach ($yummyrestaurants as $restaurant): ?>
                            <?php
                            // Fetch session prices for each restaurant
                            $sessions = $yummyService->getRestaurantSession($restaurant->restaurantID);
                            $firstSession = $sessions[0]; ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-700">
                                    <?= htmlspecialchars($restaurant->name) ?>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-700">
                                    <?= $formattedSubtotal = number_format($firstSession->pricesForAdults, 2, '.', ''); ?>€
                                </td>
                                <td class="py-2 px-4 border-b border-gray-700">
                                    <?= $formattedSubtotal = number_format($firstSession->pricesForChildren, 2, '.', ''); ?>€
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
            <p class="text-m mt-4">*The Kids price only applies to children that are <span class="font-bold">12
                    years old or younger.</span></p>
        </div>
    </div>
</section>