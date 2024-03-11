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
    <link rel="stylesheet" href="CSS_files/dance_event.css">


    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }
        
        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
    <main>
        <div class="start-image-container">
            <div class="start-image-text">
                <h1 class="text-1-h">HAARLEM</h1>
                <h1 class="text-2-h">Festival</h1>
                <h1 class="text-3-h">Dance Event</h1>
            </div>
        </div>

        <div class="bg-black py-8 ">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-white text-3xl font-bold ">Artists lineup</h2>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Get your ticket now!
                    </button>
                </div>
                <!-- Artist Lineup -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/hardwell-pp.png" alt="Hardwell">
                        <p class="text-center text-white mt-2">Hardwell</p>
                    </div>

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/armin-buren.png" alt="Armin van Buuren">
                        <p class="text-center text-white mt-2">Armin van Buuren</p>
                    </div>

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/tiesto.png" alt="Tiesto">
                        <p class="text-center text-white mt-2">Tiesto</p>
                    </div>

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/martin.png" alt="Martin Garrix">
                        <p class="text-center text-white mt-2">Martin Garrix</p>
                    </div>

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/nicky.png" alt="Nicky Romero">
                        <p class="text-center text-white mt-2">Nicky Romero</p>
                    </div>

                    <div class="artist-container">
                        <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/afrojack.png" alt="Afrojack">
                        <p class="text-center text-white mt-2">Afrojack</p>
                    </div>

                </div>
                <div class="text-center mt-6">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        See the events schedule
                    </button>
                </div>

                <div class="bg-black text-white py-8">
                    <div class="max-w-8xl mx-auto px-4">
                        <!-- Club Locations -->
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-white text-4xl font-bold">Club Locations</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-8">
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/club-ruis.png" alt="Club Ruis">
                                <p class="mt-2">CLUB RUIS</p>
                                <p class="text-xs">Smedestraat 31, 2011 RE Haarlem</p>
                            </div>
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/openlucht.png" alt="Caprera Openluchttheater">
                                <p class="mt-2">OPENLUCHTTHEATER</p>
                                <p class="text-xs">Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal</p>
                            </div>
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/jopen-kerk.png" alt="JOPEN-KERK">
                                <p class="mt-2">JOPEN-KERK</p>
                                <p class="text-xs">Gedempte Voldersgracht 2, 2011 WD Haarlem</p>
                            </div>
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/licht-fabriek.png" alt="LICHT FABRIEK">
                                <p class="mt-2">LICHT FABRIEK</p>
                                <p class="text-xs">Minckelersweg 2, 2031 EM Haarlem</p>
                            </div>
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/club-stalker.png" alt="CLUB STALKER">
                                <p class="mt-2">CLUB STALKER</p>
                                <p class="text-xs">Kromme Elleboogsteeg 20, 2011 TS Haarlem</p>
                            </div>
                            <div class="club-container">
                                <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/xo-club.png" alt="XO THE CLUB">
                                <p class="mt-2">XO THE CLUB</p>
                                <p class="text-xs">Grote Markt 8, 2011 RD Haarlem</p>
                            </div>
                        </div>
                    </div>
                    <!-- Schedule -->
                    <div class="text-center mb-8">
                        <h2 class="text-4xl font-bold">Schedule</h2>
                    </div>
                    <div class="flex justify-center gap-4 mb-8">
                        <button class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">ALL</button>
                        <button class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">26.07</button>
                        <button class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">27.07</button>
                        <button class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">28.07</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- Placeholder for Artists -->
                        <div class="artist-container">
                            <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/nicky.png" alt="Nicky Romero + Afrojack">
                            <p class="mt-2">NICKY ROMERO + AFROJACK</p>
                            <p class="text-xs">22:00 - 04:00</p>
                            <p class="text-xs">LICHTFABRIEK</p>
                        </div>
                        <div class="artist-container">
                            <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/tiesto.png" alt="Tiesto">
                            <p class="mt-2">TIESTO</p>
                            <p class="text-xs">22:00 - 23:30</p>
                            <p class="text-xs">CLUB STALKER </p>
                        </div>
                        <div class="artist-container">
                            <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/profile-hardwell.png" alt="Hardwell">
                            <p class="mt-2">HARDWELL</p>
                            <p class="text-xs">23:00 - 00:30</p>
                            <p class="text-xs">JOPENKERK</p>
                        </div>
                        <div class="artist-container">
                            <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/armin-buren.png" alt="Armin+van+Buren">
                            <p class="mt-2">ARMIN VAN BUREN</p>
                            <p class="text-xs">22:00 - 23:30</p>
                            <p class="text-xs">KO THE CLUB</p>
                        </div>
                        <div class="artist-container">
                            <img class="w-full h-48 object-cover rounded" src="assets/images/dance_event/martin.png" alt="Martin Garrix">
                            <p class="mt-2">MARTIN GARRIX</p>
                            <p class="text-xs">22:00 - 23:30</p>
                            <p class="text-xs">CLUB RUIS</p>
                        </div>
                        <!-- Additional artist placeholders... -->
                    </div>
                </div>
                <div class="bg-black py-8 text-white">
                    <div class="max-w-7xl mx-auto px-4">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-5xl font-bold">ALL-ACCESS-PASS</h2>
                            <button class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                                Buy your ticket
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <!-- Day Passes -->
                            <!-- Friday Pass -->
                            <div class="border border-gray-700 rounded-lg p-4">
                                <h3 class="text-2xl font-bold mb-3">FRIDAY 26 JULY</h3>
                                <ul class="mb-4">
                                    <li>Afrojack B2B Nicky Romero</li>
                                    <li>Tiësto</li>
                                    <li>Hardwell</li>
                                    <li>Armin van Buuren</li>
                                    <li>Martin Garrix</li>
                                </ul>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold">€ 125,00</span>
                                    <button class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                            <!-- Saturday Pass -->
                            <div class="border border-gray-700 rounded-lg p-4">
                                <h3 class="text-2xl font-bold mb-3">Saturday 27 JULY</h3>
                                <ul class="mb-4">
                                    <li>Harwell B2B Martin Garrix B2B Armin van Buuren</li>
                                    <li>Tiësto</li>
                                    <li>Afrojack</li>
                                    <li>Nicky Romero</li>
                                </ul>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold">€ 150,00</span>
                                    <button class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                            <!-- Sunday Pass -->
                            <div class="border border-gray-700 rounded-lg p-4">
                                <h3 class="text-2xl font-bold mb-3">Sunday 28 JULY</h3>
                                <ul class="mb-4">
                                    <li>Afrojack B2B Nicky Romero</li>
                                    <li>Tiësto</li>
                                    <li>Hardwell</li>
                                    <li>Armin van Buuren</li>
                                    <li>Martin Garrix</li>
                                </ul>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold">€ 150,00</span>
                                    <button class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- All-Access Pass -->
                        <div class="flex flex-col md:flex-row justify-between items-center bg-gray-900 p-6 rounded-lg">
                            <h3 class="text-3xl font-bold mb-4 md:mb-0">ALL-ACCESS-PASS FOR ALL 3 DAYS!</h3>
                            <div class="flex items-center">
                                <span class="text-4xl font-bold mr-6">€ 250,00</span>
                                <button class="flex items-center bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 3v18h18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3 3l18 18" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    Add to cart
                                </button>
                            </div>
                        </div>

                        <p class="text-center text-gray-500 text-xs mt-6">
                            Note: The capacity of the Club sessions is very limited. Availability for All-Access pass holders cannot be guaranteed due to safety regulations.
                        </p>
                    </div>
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
