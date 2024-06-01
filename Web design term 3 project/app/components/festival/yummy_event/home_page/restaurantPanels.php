<!-- Restaurant Panels -->
<section id="restaurants" class="py-8">
    <div class="Union-restaurant">
        <div class="text-container">
            <p class="info-h">Participating Restaurants</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
        <?php foreach ($yummyrestaurants as $restaurant): ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-56 object-cover object-center"
                    src="<?= htmlspecialchars($restaurant->imagePathHomepage) ?>"
                    alt="<?= htmlspecialchars($restaurant->name) ?>">
                <div class="p-4 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-black"><?= htmlspecialchars($restaurant->name) ?></h3>
                    <div class="flex items-center">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <?php if ($i < $restaurant->rating): ?>
                                <i class="fas fa-star rating-star"></i>
                            <?php else: ?>
                                <i class="far fa-star rating-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
                <div class="px-4 pb-4 relative">

                    <p class="text-sm text-black">
                        <?php
                        $allCuisineTypes = explode(';', $restaurant->cuisineTypes);
                        echo implode('<br>', $allCuisineTypes);
                        ?>
                    </p>
                    <a href="/YummyEventRestaurant?restaurantID=<?php echo htmlspecialchars($restaurant->restaurantID) ?>"
                        class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More
                        Info</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>