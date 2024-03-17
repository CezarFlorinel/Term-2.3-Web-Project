<?php
use App\Services\YummyService;

$yummyService = new YummyService();

$homepageDataRestaurant = $yummyService->getHomepageDataRestaurant();


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
        </div>

    </div>




    <script src="javascript/Yummy/yummy_home_admin.js"></script>


</body>

</html>