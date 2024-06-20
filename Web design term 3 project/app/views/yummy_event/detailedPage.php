<?php

use App\Services\YummyService;

$yummyService = new YummyService();

$id = $_GET['restaurantID'];

$yummyreviews = $yummyService->getRestaurantReviews($id);
$yummyDetailPageData = $yummyService->getRestaurantById($id);
$restaurantGallery = $yummyService->getRestaurantImagePathGallery($id);
$restaurantSessionPrices = $yummyService->getRestaurantSession($id);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link rel="stylesheet" href="CSS_files/yummy_event.css">
</head>

<body>

    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <?php
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/top.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantDescription.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantGallery.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantReviews.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantLocation.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/schedule.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/buttons.php';
    ?>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>

</body>

</html>