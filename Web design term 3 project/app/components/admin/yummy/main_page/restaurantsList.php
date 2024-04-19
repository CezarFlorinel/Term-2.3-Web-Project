<!-- Restaurants Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Restaurants List</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex flex-wrap justify-center">
        <?php foreach ($restaurantsNameAndId as $restaurant): ?>
            <div class="m-4">
                <a href="/restaurantIndividualAdmin?id=<?php echo htmlspecialchars($restaurant['RestaurantID']); ?>">
                    <div class="bg-gray-100 shadow-md rounded-lg p-6">
                        <p class="text-3xl text-blue-500">
                            <?php echo htmlspecialchars($restaurant['Name']); ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>