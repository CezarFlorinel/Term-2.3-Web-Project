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

<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="CSS_files/yummy_event.css">
    <link rel="stylesheet" href="CSS_files/ratings_reviews.css">

    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }
    </style>
</head>

<body>
    <?php
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/top.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantDescription.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantGallery.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantReviews.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/restaurantLocation.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/schedule.php';
    include __DIR__ . '/../../components/festival/yummy_event/restaurant_page/buttons.php';
    ?>
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>