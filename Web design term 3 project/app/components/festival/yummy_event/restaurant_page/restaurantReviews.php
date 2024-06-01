<!-- Ratings and Reviews -->
<div class="mt-12">
    <div class="text-center text-5xl font-bold pt-12 pb-8">
        <h1 style="font-size: 50px; font-family: 'Playfair Display', serif; text-align: Center; font-weight: bold">
            Ratings & Reviews</h1>
    </div>
    <?php
    // Fetch reviews for the current restaurant
    $currentRestaurantReviews = $yummyService->getRestaurantReviews($yummyDetailPageData->restaurantID);
    ?>
    <div class="flex flex-wrap justify-center gap-8">
        <?php foreach ($currentRestaurantReviews as $review): ?>
            <div class="flex flex-col items-center space-y-4">
                <div class="flex">
                    <?php for ($i = 0; $i < $review->numberOfStars; $i++): ?>
                        <i class="fas fa-star text-yellow-400"></i>
                    <?php endfor; ?>
                    <?php for ($i = $review->numberOfStars; $i < 5; $i++): ?>
                        <i class="fas fa-star text-gray-300"></i>
                    <?php endfor; ?>
                </div>
                <div class="bg-gray-100 p-3 rounded">
                    <p class="text-lg text-gray-800 font-semibold"><?= htmlspecialchars($review->description) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>