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
    <link rel="stylesheet" href="CSS_files/history_event.css">
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

        <div class="Image">
            <div class="event-info-text-container">
                <p class="event-info-h">Discover the hidden gems of Haarlem's vibrant culinary scene as we bring you a feast for the senses.
                    While Haarlem may not be a global culinary icon, our city is home to a diverse array of restaurants that are sure to
                    captivate your taste buds. Dive into a world of gastronomic delights, where each bite tells a unique story.
                </p>
            </div>
        </div>
        <section id="restaurants" class="py-8">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold text-600">Participating Restaurants</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                <!-- Restaurant 1 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="/yummyevent/detailed_page" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 2 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 3 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 4 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 5 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 6 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- Restaurant 7 -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-56 object-cover object-center" src="https://placehold.co/300x200?text=Cafe+de+Roemer&bg=111111" alt="Placeholder image of Cafe de Roemer">
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
                    <div class="px-4 pb-4">
                        <p class="text-sm text-black">Seafood<br>Dutch<br>European</p>
                        <a href="#" class="text-indigo-500 hover:text-indigo-600">More Info</a>
                    </div>
                </div>
                <!-- CTA Section -->
                <div class="md:col-span-3 bg-black text-white p-8 flex flex-col items-center justify-center text-center">
                    <div class="mb-4">
                        <span class="text-3xl font-bold">Click on "More Info" to make a reservation!</span>
                    </div>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Check festival schedule
                    </button>
                </div>
            </div>

            <!-- Special Prices Section -->
            <div class="bg-black py-8">
                <div class="max-w-4xl mx-auto px-4">
                    <h2 class="text-white text-3xl font-bold text-center mb-6">Festival menus at Special Prices!</h2>
                    <div class="bg-yellow-200 p-4 rounded-lg">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="text-left text-xl font-bold py-2 px-6 bg-red-500 text-white rounded">Restaurant</th>
                                    <th class="text-left text-xl font-bold py-2 px-6 bg-red-500 text-white rounded">Price</th>
                                    <th class="text-left text-xl font-bold py-2 px-4 bg-red-500 text-white rounded">Kids price (-12 y/o)</th>
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
                </div>
            </div>
            <!--Map with locations-->
            <div class="bg-black py-8">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="relative text-center">
                        <h2 class="text-white text-3xl font-bold mb-4">Location of the Restaurants</h2>
                        <div class="inline-block">
                            <img class="w-full h-auto rounded-lg shadow-lg" src="https://placehold.co/700x600" alt="Placeholder for restaurant location map">
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