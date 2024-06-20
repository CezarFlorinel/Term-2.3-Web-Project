<?php
use App\Services\YummyService;

$yummyService = new YummyService();
$homepageyummy = $yummyService->getHomepageDataRestaurant();
$yummyrestaurants = $yummyService->getAllRestaurants();
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link rel="stylesheet" href="CSS_files/yummy_event.css">
    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }
    </style>
</head>

<body>

    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <?php
    include __DIR__ . '/../../components/festival/yummy_event/home_page/top.php';
    require __DIR__ . '/../../components/festival/yummy_event/home_page/restaurantPanels.php';
    include __DIR__ . '/../../components/festival/yummy_event/home_page/menuPrices.php';
    include __DIR__ . '/../../components/festival/yummy_event/home_page/mapWithLocations.php';
    ?>

</body>

</html>

<?php include __DIR__ . '/../../components/general/footer.php'; ?>