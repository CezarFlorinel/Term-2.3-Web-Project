<?php
use App\Services\YummyService;

$yummyService = new YummyService();

   $homepageyummy = $yummyService->getHomepageDataRestaurant();
      
?>

<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap" rel="stylesheet">
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
    <main>
        <div class="start-image-container">
            <div class="start-image-text">
                <h1 class="text-1-h">HAARLEM</h1>
                <h1 class="text-2-h">Festival</h1>
                <h1 class="text-3-h">Yummy Event</h1>
            </div>
        </div>

        <div class="event-info-container">
            <h1 class="event-info-header">27 July - 31 July</h1>
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

        <section id="restaurants" class="py-8">
            <div class="Union-restaurant">
                <div class="text-container">
                    <p class="info-h">Participating Restaurants</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                <!-- Restaurant 1 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/roemer.png" alt="Cafe de Roemer">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Cafe de Roemer</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="far fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 2 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/ratat_res.png" alt="Restaurant Ratatouille">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Restaurant Ratatouille</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="far fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">Seafood<br>French<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 3 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/res_ml.png" alt="Restaurant ML">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Restaurant ML</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 4 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/fris.png" alt="Restaurant Fris">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Restaurant Fris</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">French<br>Dutch<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 5 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/spektakel.png" alt="Cafe Spektakel">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Cafe Spektakel</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="far fa-star rating-star"></i>
                            <i class="far fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 6 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/brinkman.png" alt="Grand Cafe Brinkman">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Grand Cafe Brinkman</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="far fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">International<br>Asian<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 7 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="assets/images/yummy_event/bistro_tour.png" alt="Urban French Bistro Tours">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-black">Urban French Bistro Tours</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                            <i class="fas fa-star rating-star"></i>
                        </div>
                    </div>
                    <div class="px-4 pb-4 relative">
                        <p class="text-sm text-black">Seafood<br>French<br>European</p>
                        <a href="/yummyevent/detailed_page" class="absolute bottom-2 right-4 inline-block bg-blue-200 rounded-lg px-3 py-1 mt-2 text-indigo-500 hover:text-indigo-600 hover:bg-blue-300">More Info</a>
                    </div>
                </div>
                <!-- CTA Section -->
                <div class="md:col-span-3 bg-black text-white p-8 flex flex-col items-center justify-center text-center">
                    <div class="mb-2">
                        <!-- Reduced margin-bottom from mb-4 to mb-2 for less space -->
                        <h1 style="font-size: 35px; font-family: 'Playfair Display', serif; text-align: center; font-weight: bold">Click on "More Info" to make a reservation!</h1>
                    </div>
                    <button class="info-h bg-red-500 hover:bg-red-700 text-white text-align: center; py-2 px-4 rounded">
                        Check festival schedule
                    </button>
                </div>
            </div>
    </section>

            <!-- Special Prices Section -->
            <div class="bg-black py-8">
                <div class="max-w-4xl mx-auto px-4">
                    <h1 style="font-size: 45px; font-family: 'Playfair Display', serif; text-align: center; font-weight: bold">Festival Menus at Special Prices</h1>
                    <div class="bg-yellow-200 p-4 rounded-lg">
                        <table class="table-auto w-full" style="font-family: 'Playfair Display', serif;">
                            <thead>
                                <tr>
                                    <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                        <span class="bg-red-500 px-4 py-2 rounded">Restaurant</span>
                                    </th>
                                    <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                        <span class="bg-red-500 px-4 py-2 rounded">Price</span>
                                    </th>
                                    <th class="text-left text-2xl font-bold py-4 px-4 text-white rounded">
                                        <span class="bg-red-500 px-4 py-2 rounded">Kids price</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-black">
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Cafe De Roemer</td>
                                    <td class="py-2 px-4 border-b border-gray-700">35.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">17.50€</td>
                                </tr>
                                <!-- Repeat rows for each restaurant -->
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Ratatouille</td>
                                    <td class="py-2 px-4 border-b border-gray-700">45.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">22.50€</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Restaurant ML</td>
                                    <td class="py-2 px-4 border-b border-gray-700">45.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">22.50€</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Urban French Bistro</td>
                                    <td class="py-2 px-4 border-b border-gray-700">35.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">17.50€</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Restaurant Fris</td>
                                    <td class="py-2 px-4 border-b border-gray-700">45.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">22.50€</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Grand Cafe Brinkman</td>
                                    <td class="py-2 px-4 border-b border-gray-700">35.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">17.50€</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-700">Spektakel</td>
                                    <td class="py-2 px-4 border-b border-gray-700">35.00€</td>
                                    <td class="py-2 px-4 border-b border-gray-700">17.50€</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-m mt-4">*The Kids price only applies to children that are <span class="font-bold">12 yearls old or younger. </span></p>
                </div>
            </div>
            <!--Map with locations-->
            <div class="bg-black py-8">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="relative text-center">
                        <h2 style="font-size: 45px; font-family: 'Playfair Display', serif; text-align: center; font-weight: bold">Location of Restaurants</h2>
                        <div class="inline-block">
                            <img class="w-full h-auto rounded-lg shadow-lg" src="assets/images/yummy_event/map.png" alt="Placeholder for restaurant location map">
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <footer>

    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>