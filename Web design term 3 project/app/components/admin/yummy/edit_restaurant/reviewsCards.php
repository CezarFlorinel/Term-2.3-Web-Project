<!-- Reviews Info Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Restaurant Reviews</h1>
<div class="flex flex-wrap -mx-4"> <!-- Container for the cards -->
    <?php foreach ($reviews as $review): ?>
        <div class="review-container p-4 md:w-1/2 lg:w-1/3" data-id="<?php echo htmlspecialchars($review->id); ?>">
            <!-- Each card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6"> <!-- Card styling -->
                <div class="mb-4">Review Text:
                    <div class="review-output bg-gray-200 p-2 rounded w-full" data-field="reviewText">
                        <?php echo nl2br(htmlspecialchars($review->description)); ?>
                    </div>
                </div>
                <div class="mb-4">Rating:
                    <div class="review-output bg-gray-200 p-2 rounded" data-field="rating">
                        <?php echo htmlspecialchars($review->numberOfStars); ?> / 5
                    </div>
                </div>

                <button
                    class="delete-review-btn py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150"
                    data-session-id="<?php echo htmlspecialchars($review->id); ?>">Delete</button>

            </div>
        </div>
    <?php endforeach; ?>

    <div class="card-container p-4 md:w-1/2 lg:w-1/3">
        <div class="add-review-container bg-white shadow-md rounded-lg overflow-hidden p-6">
            <h2 class="text-xl font-semibold mb-2">Add New Review</h2>
            <div class="mb-4">Review Text:
                <textarea class="new-review-input bg-gray-200 p-2 rounded w-full" data-field="reviewText"
                    rows="4"></textarea>
            </div>
            <div class="mb-4">Rating:
                <input type="number" min="1" max="5" class="new-review-input bg-gray-200 p-2 rounded" value=""
                    data-field="rating">
            </div>
            <button
                class="create-review-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Create
                New Review</button>
        </div>
    </div>

</div>