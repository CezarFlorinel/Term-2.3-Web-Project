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

            <?php include __DIR__ . '/../../../components/admin/yummy/main_page/topImagesAndDescription.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/yummy/main_page/reservations.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/yummy/main_page/restaurantsList.php'; ?>

            <!-- Create New Restaurant Fancy Button ------------------------------------------------------- -->

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