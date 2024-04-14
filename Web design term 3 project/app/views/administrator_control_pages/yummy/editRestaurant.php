<?php
use App\Services\YummyService;

$yummyService = new YummyService();
$restaurant = $yummyService->getRestaurantById($_GET['id']);
$reviews = $yummyService->getRestaurantReviews($_GET['id']);
$gallery = $yummyService->getRestaurantImagePathGallery($_GET['id']);
$sessions = $yummyService->getRestaurantSession($_GET['id']);

$cusineTypes = explode(";", $restaurant->cuisineTypes);

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

            <?php include __DIR__ . '/../../../components/admin/yummy/edit_restaurant/restaurantInformation.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/yummy/edit_restaurant/sessionCards.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/yummy/edit_restaurant/reviewsCards.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/yummy/edit_restaurant/gallerySection.php'; ?>
        </div>

        <script type="module" src="javascript/Yummy/edit_restaurant_admin.js"></script>

</body>

</html>