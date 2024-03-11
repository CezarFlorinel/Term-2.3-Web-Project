<?php require __DIR__ . '/../../../components/general/getHistoryData.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<head>
    <link rel="stylesheet" href="CSS_files/Admin/history_admin.css">
</head>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
            <!-- Top Part Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Top Part</h1>
            <div class="bg-white shadow-md rounded-lg p-6">

                <div id="getTheIdForTopPart" class="p-4 border-b border-gray-200 flex justify-between items-start"
                    data-id="<?php echo htmlspecialchars($historyTopPart->informationID); ?>">
                    <div>
                        <p class="text-3xl text-blue-500">Description of Page:</p>
                        <p data-type="descriptionTop" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($historyTopPart->description); ?>
                        </p>
                        <p class="text-3xl text-blue-500">Subheader of Page:</p>
                        <p data-type="subheaderTop" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($historyTopPart->subheader); ?>
                        </p>
                    </div>
                    <button id="edit-top-part-btn"
                        class="edit-top-part-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                </div>

                <div id="carouselImages" class="grid grid-cols-3 gap-4">
                    <?php foreach ($arrayWithImagePathsCarousel as $path): ?>
                        <div class="relative">
                            <img src="<?php echo htmlspecialchars($path); ?>" alt="Image" class="w-full h-auto">
                            <button class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1">Delete</button>
                        </div>
                    <?php endforeach; ?>
                    <div class="add-image-container">
                        <input type="file" id="imageUploadInputTopPart" class="hidden"
                            accept="image/jpeg, image/png, image/jpg">
                        <button id="addImageBtnTopPart" class="bg-green-500 text-white px-4 py-2">Add Image</button>
                    </div>
                </div>

            </div>

            <!-- Route Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Route</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyRoutes as $route): ?>
                    <div id="getTheIdForRoutes" class="p-4 border-b border-gray-200 flex justify-between items-start"
                        data-id="<?php echo htmlspecialchars($route->informationID); ?>">
                        <div>
                            <p class="text-3xl text-blue-500">Location Name:</p>
                            <p data-type="locationName" class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($route->locationName); ?>

                            <p class="text-3xl text-blue-500">Location Description:</p>
                            <p data-type="locationDescription" class="text-lg font-semibold editable"
                                contenteditable="false">
                                <?php echo htmlspecialchars($route->locationDescription); ?>
                            </p>

                            <p class="text-3xl text-blue-500">Wheelchair Support:</p>
                            <div class="wheelchair-support-display">
                                <?php if ($route->wheelchairSupport): ?>
                                    <span class="checkmark text-4xl">&#10003;</span>
                                <?php else: ?>
                                    <span class="checkmark text-4xl">&#10060;</span>
                                <?php endif; ?>
                            </div>
                            <!-- Hidden checkbox for editing -->
                            <div class="wheelchair-support-edit">
                                <p> Checkbox for wheelchair support:</p>
                                <input type="checkbox" class="wheelchair-support-checkbox transform scale-125" disabled
                                    <?php echo $route->wheelchairSupport ? 'checked' : ''; ?>>
                            </div>

                            <div>
                                <img id="imageTourPlace" src="<?php echo htmlspecialchars($route->locationImagePath); ?>"
                                    alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                                <input type="file" id="imageTourPlaceInput" class="hidden" accept="image/*">
                                <button onclick="document.getElementById('imageTourPlaceInput').click();"
                                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                    Image</button>
                            </div>
                        </div>
                        <button
                            class="edit-tour-place-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Ticket Prices Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Ticket Prices</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyTickets as $ticket): ?>
                    <div id="getTheIdForTicketPrice" class="p-4 border-b border-gray-200 flex justify-between items-start"
                        data-id="<?php echo htmlspecialchars($ticket->informationID); ?>">
                        <div>
                            <p>Title:</p>
                            <p class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($ticket->ticketType); ?>
                            <p>Prices:</p>
                            <input type="number" step="0.01" name="price"
                                value="<?php echo htmlspecialchars($ticket->price); ?>"
                                class="text-lg font-semibold editable-price" contenteditable="false" readonly
                                style="width: 100%;">
                            <p>Description:</p>
                            <p class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($ticket->description); ?>
                            </p>
                            <div>
                                <img id="imageTicketPrice" src="<?php echo htmlspecialchars($ticket->imagePath); ?>"
                                    alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                                <input type="file" id="imageTicketPriceInput" class="hidden" accept="image/*">
                                <button onclick="document.getElementById('imageTicketPriceInput').click();"
                                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                    Image</button>
                            </div>
                        </div>
                        <button
                            class="edit-ticket-prices-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Tour Departures Timetable Section -->
            <h1 class=" text-3xl text-center mb-6">Tour Departures Timetable</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyTourDeparturesTimetables as $timetable): ?>
                    <div class="p-4 border-b border-gray-200"
                        data-id="<?php echo htmlspecialchars($timetable->informationID); ?>">
                        <div>
                            <p>Date:</p>
                            <input type="date" class="date-editable text-lg font-semibold"
                                value="<?php echo htmlspecialchars($timetable->date); ?>" readonly>
                            <button
                                class="edit-departure-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                        </div>
                        <div class="tour-times">
                            <?php $toursForThisDate = array_filter($historyTours, function ($tour) use ($timetable) {
                                return $tour->departure == $timetable->informationID;
                            });
                            foreach ($toursForThisDate as $tour): ?>
                                <div class="tour-info tour-details p-4"
                                    data-id="<?php echo htmlspecialchars($tour->informationID); ?>">
                                    <div class="time-details">
                                        <p>Start Time:
                                            <input type="time" name="startTime"
                                                value="<?php echo htmlspecialchars(date('H:i', strtotime($tour->startTime))); ?>"
                                                class="editable-time" readonly>
                                        </p>
                                    </div>
                                    <div class="language-tours">
                                        <p>English: <input type="number" name="englishTour" min="1" max="3"
                                                value="<?php echo htmlspecialchars($tour->englishTour); ?>"
                                                class="tour-editable"></p>
                                        <p>Dutch: <input type="number" name="dutchTour" min="1" max="3"
                                                value="<?php echo htmlspecialchars($tour->dutchTour); ?>" class="tour-editable">
                                        </p>
                                        <p>Chinese: <input type="number" name="chineseTour" min="1" max="3"
                                                value="<?php echo htmlspecialchars($tour->chineseTour); ?>"
                                                class="tour-editable"></p>
                                    </div>
                                    <button
                                        class="edit-tour-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Starting Point Of The Tour Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Starting Point Of The Tour</h1>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div id="getTheIdForTourStart" class="p-4 border-b border-gray-200 flex justify-between items-start"
                    data-id="<?php echo htmlspecialchars($historyTourStartingPoints->informationID); ?>">
                    <div>
                        <p>Description:</p>
                        <p class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($historyTourStartingPoints->description); ?>
                        </p>
                        <div>
                            <img id="image1"
                                src="<?php echo htmlspecialchars($historyTourStartingPoints->mainImagePath); ?>"
                                alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                            <input type="file" id="image1Input" class="hidden" accept="image/*">
                            <button onclick="document.getElementById('image1Input').click();"
                                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                Image 1</button>
                        </div>
                        <div>
                            <img id="image2"
                                src="<?php echo htmlspecialchars($historyTourStartingPoints->secondaryImagePath); ?>"
                                alt="Image 2" class="mt-2" style="width: 200px; height: auto;">
                            <input type="file" id="image2Input" class="hidden" accept="image/*">
                            <button onclick="document.getElementById('image2Input').click();"
                                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                Image 2</button>
                        </div>
                    </div>
                    <button
                        class="edit-tour-starting-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                </div>
            </div>

            <!-- Practical Information Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Practical Information Section</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
                    <div class="p-4 border-b border-gray-200 flex justify-between items-start"
                        data-id="<?php echo htmlspecialchars($practicalInformation->informationID); ?>">
                        <div>
                            <p>Q:</p>
                            <p class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($practicalInformation->question); ?>
                            </p>
                            <p>A:</p>
                            <p class="mt-2 editable" contenteditable="false">
                                <?php echo htmlspecialchars($practicalInformation->answer); ?>
                            </p>
                        </div>
                        <div class="flex items-start">
                            <!-- Edit Button -->
                            <button
                                class="edit-practical-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                            <!-- Delete Button -->
                            <button
                                class="delete-practical-btn ml-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div id="addForm" class="hidden p-4 bg-gray-100 border border-gray-200 rounded-lg">
                    <h2 class="text-lg mb-2">Add New Practical Information:</h2>
                    <div>
                        <label for="newQuestion">Question:</label>
                        <input type="text" id="newQuestion" class="block w-full p-2 mt-1 mb-2">
                        <label for="newAnswer">Answer:</label>
                        <textarea id="newAnswer" class="block w-full p-2 mt-1 mb-2"></textarea>
                        <button id="submitNewInfo"
                            class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Submit</button>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="p-4">
                    <button
                        class="add-practical-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add
                        +</button>
                </div>
            </div>
        </div>

    </div>

    <script src="javascript/History/admin_part.js"></script>
</body>


</html>