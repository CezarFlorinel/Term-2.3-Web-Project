<?php


use App\Services\YummyService;

$yummyService = new YummyService();
$homepageyummy = $yummyService->getHomepageDataRestaurant();
$yummyrestaurants = $yummyService->getAllRestaurants();

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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="CSS_files/yummy_event.css">

    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }
    </style>
</head>

<body>

    <?php
    include __DIR__ . '/../../components/festival/yummy_event/home_page/top.php';
    require __DIR__ . '/../../components/festival/yummy_event/home_page/restaurantPanels.php';
    include __DIR__ . '/../../components/festival/yummy_event/home_page/menuPrices.php';
    include __DIR__ . '/../../components/festival/yummy_event/home_page/mapWithLocations.php';
    ?>

</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>