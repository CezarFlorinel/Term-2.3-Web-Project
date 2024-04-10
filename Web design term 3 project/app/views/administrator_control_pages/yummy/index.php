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

<head>
    <link rel="stylesheet" href="CSS_files/Admin/homepage_yummy_admin.css">
</head>


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
                    <?php $sessions = $yummyService->getRestaurantSession($reservation->restaurantID) ?>
                    <div class="card-container p-4 md:w-1/2 lg:w-1/3">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6"> <!-- Card styling -->
                            <form class="reservation-form">

                                <div class="mb-4">
                                    <p>Restaurant Name:
                                        <?php foreach ($restaurantsNameAndId as $restaurant) {
                                            if ($restaurant['RestaurantID'] == $reservation->restaurantID) {
                                                echo htmlspecialchars($restaurant['Name']);
                                            }
                                        } ?>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <p>Session Time: <span id="sessionTimeText">
                                        </span></p>
                                    Session:
                                    <select class="reservation-input bg-gray-200 p-2 rounded" data-field="session"
                                        name="session" id="sessionDropdown">
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?php echo htmlspecialchars($session->sessionID); ?>" <?php echo $session->sessionID == $reservation->session ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($session->sessionID); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-4">First Name:
                                    <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->firstName); ?>"
                                        data-field="firstName" name="firstName">
                                </div>
                                <div class="mb-4">Last Name:
                                    <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->lastName); ?>"
                                        data-field="lastName" name="lastName">
                                </div>
                                <div class="mb-4">Email:
                                    <input type="email" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->email); ?>" data-field="email"
                                        name="email">
                                </div>
                                <div class="mb-4">Phone Number:
                                    <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->phoneNumber); ?>"
                                        data-field="phoneNumber" name="phoneNumber">
                                </div>

                                <div class="mb-4">Number Of Adults:
                                    <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->numberOfAdults); ?>"
                                        data-field="numberOfAdults" name="numberOfAdults">
                                </div>
                                <div class="mb-4">Number Of Children:
                                    <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->numberOfChildren); ?>"
                                        data-field="numberOfChildren" name="numberOfChildren">
                                </div>
                                <div class="mb-4">Comment:
                                    <textarea class="reservation-input bg-gray-200 p-2 rounded" data-field="comment"
                                        name="comment"><?php echo htmlspecialchars($reservation->comment); ?></textarea>
                                </div>

                                <div class="mb-4">Date:
                                    <input type="date" class="reservation-input bg-gray-200 p-2 rounded"
                                        value="<?php echo htmlspecialchars($reservation->date); ?>" data-field="date"
                                        name="date">
                                </div>
                                <div class="mb-4">
                                    <p class="activeCheckboxParagraph">Is Reservation Active:</p>
                                    <input type="checkbox" class="reservation-input large-checkbox" <?php echo $reservation->isActive ? 'checked' : ''; ?> data-field="active" name="active">
                                </div>

                                <input type="hidden" name="reservationId" value="<?php echo $reservation->ID; ?>">
                                <button type="button"
                                    class="save-reservation-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Save</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Add New Reservation Card -->
                <div class="card-container p-4 md:w-1/2 lg:w-1/3">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                        <form class="new-reservation-form">

                            <div class="mb-4">
                                <label for="newRestaurantDropdown">Restaurant Name:</label>
                                <select class="reservation-input bg-gray-200 p-2 rounded" name="restaurantName"
                                    id="newRestaurantDropdown">
                                    <option value="">Select a Restaurant</option>
                                    <?php foreach ($restaurantsNameAndId as $restaurant): ?>
                                        <option value="<?php echo htmlspecialchars($restaurant['Name']); ?>">
                                            <?php echo htmlspecialchars($restaurant['Name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <p id="sessionTimeContent">Session Time:</p>
                                Session:
                                <select class="reservation-input bg-gray-200 p-2 rounded" name="session"
                                    id="newSessionDropdown">
                                    <!-- Sessions will be loaded here based on selected restaurant -->
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="newFirstName">First Name:</label>
                                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="firstName"
                                    id="newFirstName">
                            </div>
                            <div class="mb-4">
                                <label for="newLastName">Last Name:</label>
                                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="lastName"
                                    id="newLastName">
                            </div>
                            <div class="mb-4">
                                <label for="newEmail">Email:</label>
                                <input type="email" class="reservation-input bg-gray-200 p-2 rounded" name="email"
                                    id="newEmail">
                            </div>
                            <div class="mb-4">
                                <label for="newPhoneNumber">Phone Number:</label>
                                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="phoneNumber"
                                    id="newPhoneNumber">
                            </div>
                            <div class="mb-4">
                                <label for="newDate">Date:</label>
                                <input type="date" class="reservation-input bg-gray-200 p-2 rounded" name="date"
                                    id="newDate">
                            </div>
                            <div class="mb-4">
                                <label for="newNumberOfAdults">Number Of Adults:</label>
                                <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                                    name="numberOfAdults" id="newNumberOfAdults">
                            </div>
                            <div class="mb-4">
                                <label for="newNumberOfChildren">Number Of Children:</label>
                                <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                                    name="numberOfChildren" id="newNumberOfChildren">
                            </div>
                            <div class="mb-4">
                                <label for="newComment">Comment:</label>
                                <textarea class="reservation-input bg-gray-200 p-2 rounded" name="comment"
                                    id="newComment"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="newActive">Is Reservation Active:</label>
                                <input type="checkbox" class="reservation-input large-checkbox" name="active"
                                    id="newActive">
                            </div>

                            <button type="button"
                                class="create-new-reservation-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Create
                                New Reservation</button>
                        </form>
                    </div>
                </div>
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

    <script type="application/json" id="sessionData">
    <?php echo json_encode($sessions); ?>
    </script>

    <script type="module" src="javascript/Yummy/yummy_home_admin.js"></script>

</body>

</html>