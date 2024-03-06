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
    <main class="container mx-auto px-4 py-8">
        <div class="ratatouille-image-container">
        </div>

        <div class="event-info-container">
            <h1 class="event-info-header">Ratatouille Food & Wine</h1>
        </div>

        <div class="Image">
            <div class="event-info-text-container">
                <p class="event-info-h">The successful Michelin restaurant in Haarlem of chef Jozua Jaring is - like Ratatouille -
                    a mix of French cuisine in today's reality with excellent value for money in an accessible environment in Haarlem.
                </p>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <p class="text-xl">
                    Discover exquisite French cuisine at our charming restaurant on Lange Veerstraat. Let our chefs whisk you away to the streets of France with each delightful dish. Indulge in a culinary journey like no other, right here in the heart of the city.
                </p>
                <div class="text-center text-5xl font-bold pt-12 pb-8">
                    Restaurant Gallery
                </div>
                <img src="https://placehold.co/600x400" alt="A dark artistic plate with sophisticated meal arrangement" class="w-full">
            </div>
            <div class="space-y-6">
                <p class="text-xl">
                    Embark on a culinary odyssey with the visionary Chef Josua Jaring, a true artist in the realm of flavors. With a passion that simmers and a creative flair that sizzles, Chef Jaring has carved his niche in the gastronomic world, making each dish a masterpiece.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-12">
                    <img src="https://placehold.co/300x200" alt="An elegant dish beautifully presented on a white plate" class="w-full">
                    <img src="https://placehold.co/300x200" alt="Gourmet food served on a modern plate with garnishing" class="w-full">
                    <img src="https://placehold.co/300x200" alt="A close-up of a delicious culinary creation" class="w-full">
                    <img src="https://placehold.co/300x200" alt="Fine dining dish displayed with artistic food styling" class="w-full">
                </div>
            </div>
        </section>

        <!-- Ratings and Reviews -->
        <div class="mt-12">
            <div class="text-center text-5xl font-bold pt-12 pb-8">
                Ratings & Reviews
            </div>
            <!-- Centered container for ratings -->
            <div class="flex flex-wrap justify-center gap-8">
                <div class="flex flex-col items-center space-y-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-gray-300"></i>
                    </div>
                    <div class="bg-gray-100 p-3 rounded">
                        <p class="text-lg text-gray-800 font-semibold">"Delicious flavours and charming ambience"</p>
                    </div>
                </div>

                <div class="flex flex-col items-center space-y-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-gray-300"></i>
                    </div>
                    <div class="bg-gray-100 p-3 rounded">
                        <p class="text-lg text-gray-800 font-semibold">“Elegance and gastronomy unite in this French gem”</p>
                    </div>
                </div>

                <div class="flex flex-col items-center space-y-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-gray-300"></i>
                    </div>
                    <div class="bg-gray-100 p-3 rounded">
                        <p class="text-lg text-gray-800 font-semibold">"In the heart of the city, savor an unforgettable French experience crafted by talented chefs!"</p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-4">
                    <div class="flex">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-gray-300"></i>
                    </div>
                    <div class="bg-gray-100 p-3 rounded">
                        <p class="text-lg text-gray-800 font-semibold">“Blends French magic into every dish. A truly unforgettable experience for those seeking an authentic taste”</p>
                    </div>
                </div>
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

        <section class="container mx-auto px-4 py-8">
            <h2 class="text-5xl font-bold text-center mb-10">Schedule and Timeslots</h2>
            <div class="text-center">
                <p class="text-2xl mb-4">This restaurant has <span class="font-bold underline">3 sessions</span>, each session has a <span class="font-bold underline">duration of 2 hours</span>. Each session has a <span class="font-bold text-yellow-400">price of 45,00€</span>, children <span class="font-bold text-yellow-400">under 12 years old</span> have a price of <span class="font-bold text-yellow-400">22,50€</span>.</p>
                <div class="bg-white text-black p-6 rounded-lg inline-block">
                    <div class="mb-4">
                        <h3 class="font-bold text-xl">Session 1:</h3>
                        <p>17:00 – 19:00</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="font-bold text-xl">Session 2:</h3>
                        <p>19:00 – 21:00</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-xl">Session 3:</h3>
                        <p>21:00 – 23:00</p>
                    </div>
                </div>
                <p class="text-xl mt-4">*There is a reservation fee of <span class="font-bold">10,00€</span> - however this will be deducted from the final check upon visiting the restaurant.</p>
            </div>
        </section>

        <div class="mt-12">
            <button class="bg-[#B0E3FF] hover:bg-[#a3d2e2] text-black font-bold py-2 px-4 rounded">
                Make a Reservation
            </button>
        </div>



    </main>
    <footer>
    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>