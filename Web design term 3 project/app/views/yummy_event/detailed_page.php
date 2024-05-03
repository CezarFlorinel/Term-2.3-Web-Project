<?php

use App\Services\YummyService;

$yummyService = new YummyService();

$homepageyummy = $yummyService->getHomepageDataRestaurant();
$yummyrestaurants = $yummyService->getAllRestaurants();
$yummyreviews = $yummyService->getRestaurantReviews($id);
// $yummyDetailPageData = $yummyService->getRestaurantById($id);

?>

<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap" rel="stylesheet">
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
    <div class="ratatouille-image-container">
    </div>
    <main class="container mx-auto px-4 py-8">
        <div class="event-info-container">
            <h1 class="event-info-header">Ratatouille Food & Wine</h1>
        </div>

        <section class="section-bg py-10 px-10">
            <div class="text-center mb-8 text-white">
                <div class="flex items-center justify-center bg-no-repeat bg-center bg-contain h-72 md:h-96 
                            lg:min-h-[300px] px-12 py-10 lg:bg-[url('assets/images/elements/Union.png')]">
                    <p class="text-base font-normal text-white rounded-lg lg:text-black">
                        <?= nl2br(htmlspecialchars($homepageyummy->description)) ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Introductory content with chef's image on the same row -->
        <section class="md:flex md:items-start md:justify-between gap-8">
    <!-- First paragraph -->
    <div class="md:w-1/3 space-y-6 mb-5 mt-5">
        <p class="text-xl">
            <?php htmlspecialchars($yummyDetailPageData->descriptionSideOne); ?>
        </p>
    </div>

    <div class="md:w-1/3 flex justify-center md:justify-start md:px-4">
        <img src="<?php htmlspecialchars($restaurant->imagePathChef); ?>" alt="Chef Josua Jaring" class="rounded-lg">
    </div>

    <div class="md:w-1/3 space-y-6 mt-5 mb-5">
        <p class="text-xl">
            <?php htmlspecialchars($restaurant->descriptionSideTwo); ?>
        </p>
    </div>
</section>

        <!-- Restaurant Gallery section below the introductory content -->
        <div class="mt-12">
            <div class="text-5xl font-bold pt-12 pb-8 text-left">
                <h1 style="font-size: 45px; font-family: 'Playfair Display', serif; text-align: Left; font-weight: bold">Restaurant Gallery</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <img src="https://placehold.co/300x300" alt="An elegant dish beautifully presented on a white plate" class="w-full">
                <img src="https://placehold.co/300x300" alt="Gourmet food served on a modern plate with garnishing" class="w-full">
                <img src="https://placehold.co/300x300" alt="A close-up of a delicious culinary creation" class="w-full">
                <img src="https://placehold.co/300x300" alt="Fine dining dish displayed with artistic food styling" class="w-full">
            </div>
        </div>

        <!-- Ratings and Reviews -->
        <div class="mt-12">
            <div class="text-center text-5xl font-bold pt-12 pb-8">
                <h1 style="font-size: 50px; font-family: 'Playfair Display', serif; text-align: Center; font-weight: bold">Ratings & Reviews</h1>
            </div>
            <?php
            // Fetch reviews for the current restaurant
            $currentRestaurantReviews = $yummyService->getRestaurantReviews($yummyrestaurants[0]->restaurantID);
            ?>
            <div class="flex flex-wrap justify-center gap-8">
                <?php foreach ($currentRestaurantReviews as $review) : ?>
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex">
                            <?php for ($i = 0; $i < $review->numberOfStars; $i++) : ?>
                                <i class="fas fa-star text-yellow-400"></i>
                            <?php endfor; ?>
                            <?php for ($i = $review->numberOfStars; $i < 5; $i++) : ?>
                                <i class="fas fa-star text-gray-300"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="bg-gray-100 p-3 rounded">
                            <p class="text-lg text-gray-800 font-semibold"><?= htmlspecialchars($review->description) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!--Map with location-->
        <div class="bg-black py-8 mt-12">
            <div class="max-w-4xl mx-auto px-4">
                <div class="relative text-center">
                    <div class="inline-block">
                        <img class="w-full h-auto rounded-lg shadow-lg" src="https://placehold.co/700x600" alt="Placeholder for restaurant location map">
                        <p class="mt-2">Spaarne 96, 2011 CL Haarlem</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="container mx-auto px-4 py-8 flex flex-col items-center" style="font-family: 'Playfair Display', serif;">
            <h1 style="font-size: 52px; text-align: Left; font-weight: bold">Schedule and Timeslots</h1>
            <?php foreach ($yummyrestaurants as $restaurant) : ?>
                <?php
                // Fetch session prices for each restaurant
                $sessions = $yummyService->getRestaurantSession($restaurant->restaurantID);
                ?>
                <p class="text-2xl mb-6">This restaurant has <span class="font-bold underline"><?= count($sessions) ?> sessions</span>, each session has a <span class="font-bold underline">duration of 2 hours</span>. Each session has a <span class="font-bold text-yellow-400">price of <?= number_format($sessions[0]->pricesForAdults, 2, '.', '') ?>€</span>, children <span class="font-bold text-yellow-400">under 12 years old</span> have a price of <span class="font-bold text-yellow-400"><?= number_format($sessions[0]->pricesForChildren, 2, '.', '') ?>€</span>.</p>
                <div class="bg-white text-black p-6 rounded-lg inline-flex justify-between items-center relative" style="width: 400px; min-height: 200px;">
                    <div>
                        <?php foreach ($sessions as $key => $session) : ?>
                            <div class="mb-4">
                                <h3 class="font-bold text-xl">Session <?= $key + 1 ?>:</h3>
                                <?php
                                // Format start and end time
                                $startTime = date('H:i', strtotime($session->startTime));
                                $endTime = date('H:i', strtotime($session->endTime));
                                ?>
                                <p><?= $startTime ?> – <?= $endTime ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <img src="assets/images/elements/clock.png" alt="Clock" class="absolute top-0 right-0 h-32 w-32 mt-2 mr-2">
                </div>
                <?php break; // exit the loop after printing once 
                ?>
            <?php endforeach; ?>
            <p class="text-xl mt-4">*There is a reservation fee of <span class="font-bold">10,00€</span> - however this will be deducted from the final check upon visiting the restaurant.</p>
        </section>

        <div class="mt-12 flex justify-between">
            <button class="bg-[#B0E3FF] hover:bg-[#a3d2e2] text-black font-bold py-4 px-8 rounded">
                Back to homepage
            </button>

            <button class="bg-[#B0E3FF] hover:bg-[#a3d2e2] text-black font-bold py-4 px-8 rounded">
                Make a Reservation!
            </button>
        </div>
    </main>
    <footer>
    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>