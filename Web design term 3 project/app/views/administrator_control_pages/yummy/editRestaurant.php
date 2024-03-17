<?php
use App\Services\YummyService;

$yummyService = new YummyService();
$restaurant = $yummyService->getRestaurantById($_GET['id']);
$reviews = $yummyService->getRestaurantReviews($_GET['id']);
$gallery = $yummyService->getRestaurantImagePathGallery($_GET['id']);
$session = $yummyService->getRestaurantSession($_GET['id']);

$cusineTypes = explode(";", $restaurant->cuisineTyes);

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
            <h1 class="text-5xl font-bold text-center mb-6 text-red-900">
                <?php echo ($restaurant->name); ?>
            </h1>
            <!-- Restaurant Table Info Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Restaurant Information</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div id="container-restaurant-info"
                    class="p-4 border-b border-gray-200 flex justify-between items-start"
                    data-id="<?php echo htmlspecialchars($_GET['id']); ?>">
                    <div>
                        <p class="text-2xl text-blue-500">Name of restaurant:</p>
                        <p data-type="name" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($restaurant->name); ?>
                        </p>
                        <p class="text-2xl text-blue-500">Location:</p>
                        <p data-type="location" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($restaurant->location); ?>
                        </p>
                        <p class="text-2xl text-blue-500">Description:</p>
                        <p data-type="description" class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($restaurant->descriptionTopPart); ?>
                        </p>
                        <p class="text-2xl text-blue-500">Description Left Side:</p>
                        <p data-type="descriptionSideOne" class="text-lg font-semibold editable"
                            contenteditable="false">
                            <?php echo htmlspecialchars($restaurant->descriptionSideOne); ?>
                        </p>
                        <p class="text-2xl text-blue-500">Description Right Side</p>
                        <p data-type="descriptionSideTwo" class="text-lg font-semibold editable"
                            contenteditable="false">
                            <?php echo htmlspecialchars($restaurant->descriptionSideTwo); ?>
                        </p>
                        <p class="text-2xl text-blue-500">Number of Seats:</p>
                        <input type="number" id="numberSeats" class="text-lg font-semibold text-black-500"
                            value="<?php echo htmlspecialchars($restaurant->numberOfSeats); ?>" min="0" readonly>

                        <p class="text-2xl text-blue-500">Number of Stars:</p>
                        <input type="number" id="numberStars" class="text-lg font-semibold text-black-500"
                            value="<?php echo htmlspecialchars($restaurant->rating); ?>" min="0" max="5" readonly>
                    </div>

                    <button id="edit-restaurant-btn"
                        class="edit-restaurant-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                </div>

                <p class="text-2xl text-blue-500">Cuisine Types:</p>
                <div class="flex flex-wrap">
                    <?php foreach ($cusineTypes as $type): ?>
                        <p class="text-lg font-semibold text-black-500 bg-gray-300 rounded-full px-2 py-1 m-1">
                            <?php echo htmlspecialchars($type); ?>
                        </p>
                    <?php endforeach; ?>
                </div>


            </div>
        </div>
    </div>

    <script src="javascript/Yummy/edit_restaurant_admin.js"></script>


</body>

</html>