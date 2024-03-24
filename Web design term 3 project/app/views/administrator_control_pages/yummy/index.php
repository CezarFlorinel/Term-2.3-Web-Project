<?php
use App\Services\YummyService;

$yummyService = new YummyService();
$homepageDataRestaurant = $yummyService->getHomepageDataRestaurant();
$restaurantsNameAndId = $yummyService->getRestaurantsNameAndId();
$restaurantReservations = $yummyService->getAllReservations();

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
            <!-- Top Part Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Top Part</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div id="getTheIdForTopPart" class="p-4 border-b border-gray-200 flex justify-between items-start"
                    data-id="<?php echo htmlspecialchars($homepageDataRestaurant->pageID); ?>">
                    <div>
                        <p class="text-3xl text-blue-500">Description of Page:</p>
                        <p data-type="descriptionTop" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($homepageDataRestaurant->description); ?>
                        </p>
                        <p class="text-3xl text-blue-500">Subheader of Page:</p>
                        <p data-type="subheaderTop" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($homepageDataRestaurant->subheader); ?>
                        </p>
                    </div>
                    <button id="edit-top-part-btn"
                        class="edit-top-part-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                </div>


                <p class="text-3xl text-blue-500">Image Top:</p>
                <div>
                    <img id="imageTop" src="<?php echo htmlspecialchars($homepageDataRestaurant->imagePath); ?>"
                        alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                    <input type="file" id="imageTopInput" class="hidden" accept="image/*">
                    <button onclick="document.getElementById('imageTopInput').click();"
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                        Image</button>
                </div>

                <p class="text-3xl text-blue-500">Image with locations of all resturants:</p>
                <div>
                    <img id="imageLocation"
                        src="<?php echo htmlspecialchars($homepageDataRestaurant->locationsImagePath); ?>" alt="Image 1"
                        class="mt-2" style="width: 200px; height: auto;">
                    <input type="file" id="imageLocationsInput" class="hidden" accept="image/*">
                    <button onclick="document.getElementById('imageLocationsInput').click();"
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                        Image
                    </button>
                </div>
            </div>

            <!-- Reservations Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Reservations</h1>
            <div class="flex flex-wrap -mx-4"> <!-- Container for the cards -->
                <?php foreach ($restaurantReservations as $reservation): ?>
                    <div class="card-container p-4 md:w-1/2 lg:w-1/3">
                        <div class="mb-4">Available Seats:
                            <input type="number" class="session-input bg-gray-200 p-2 rounded"
                                value="<?php echo htmlspecialchars($reservation->numberOfAdults); ?>"
                                data-field="availableSeats">
                        </div>



                    </div>
                <?php endforeach; ?>




            </div>


            <!-- Restaurants Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Restaurants List</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-wrap justify-center">
                    <?php foreach ($restaurantsNameAndId as $restaurant): ?>
                        <div class="m-4">
                            <a
                                href="/restaurantIndividualAdmin?id=<?php echo htmlspecialchars($restaurant['RestaurantID']); ?>">
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


            <!-- Create New Restaurant Section ------------------------------------------------------- -->

            <br>
            <div class="text-center mt-8">
                <a href="/createRestaurant">
                    <button
                        class="inline-flex items-center justify-center py-4 px-8 text-lg bg-orange-500 text-white rounded-lg hover:bg-orange-700 transition duration-150 mt-2 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        Create New Restaurant
                    </button>
                </a>
            </div>

        </div>


    </div>

    <script src="javascript/Yummy/yummy_home_admin.js"></script>

</body>

</html>