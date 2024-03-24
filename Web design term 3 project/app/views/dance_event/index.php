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
                            <h2 class="text-4xl font-bold">ALL-ACCESS-PASS</h2>
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

                <!-- Ticket Section -->
                <div class="flex justify-between items-center mb-2 mt-12">
                    <h2 class="text-3xl font-bold">Select Your Ticket:</h2>
                </div>
                <section class="bg-black rounded-lg py-8">
                    <div class="max-w-7xl mx-auto px-4">
                        <div class="flex flex-wrap -mx-4">
                            <!-- Flex Container for both sections -->
                            <div class="flex flex-wrap w-full">
                                <!-- Sidebar: Filter Section -->
                                <div class="w-full lg:w-1/3 px-4 mb-6 lg:mb-0">
                                    <div class="bg-black p-6 shadow-lg rounded-lg border border-blue-900">
                                        <h3 class="text-xl font-bold mb-4">Filter Tickets</h3>
                                        <!-- Artists Filter -->
                                        <div class="mb-4 relative">
                                            <label class="block font-bold text-white mb-2 mt-8" for="artists">Artists</label>
                                            <div class="mt-1 relative">
                                                <select id="artists" class="form-select block w-full pl-3 pr-10 py-2 border border-gray-300 shadow-sm rounded-md appearance-none bg-white" onchange="this.style.color='black'">
                                                    <option value="" disabled selected hidden>All Artists</option>
                                                    <option>Hardwell</option>
                                                    <option>Armin van Buuren</option>
                                                    <option>Martin Garrix</option>
                                                    <option>Tiesto</option>
                                                    <option>Afrojack</option>
                                                    <option>Nicky Romero</option>
                                                    <option>All Artists</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" /></svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date Filter -->
                                        <div class="mb-4">
                                            <label class="block font-bold text-white mb-2 mt-8">DATE</label>
                                            <div class="bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="date[]" value="26.07">
                                                    <span class="ml-2"> Friday 26 July</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="date[]" value="27.07">
                                                    <span class="ml-2">Saturday 27 July</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="date[]" value="28.07">
                                                    <span class="ml-2">Sunday 28 July</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Location Filter -->
                                        <div class="mb-4">
                                            <label class="block font-bold text-white mb-2 mt-8">LOCATION</label>
                                            <div class="bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="location[]" value="Club Ruis">
                                                    <span class="ml-2">Club Ruis</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="location[]" value="XO The club">
                                                    <span class="ml-2">XO The club</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="location[]" value="JopenKerk">
                                                    <span class="ml-2">JopenKerk</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Available Tickets Filter -->
                                        <div class="mb-8 mt-8 bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox" name="available" value="1">
                                                <span class="ml-2">Show only available tickets</span>
                                            </label>
                                        </div>

                                        <button class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg w-full">Reset all filters</button>
                                    </div>
                                </div>

                                <!-- Ticket Display adjusted for responsive and scalable display -->
                                <div class="w-full lg:w-2/3 px-4 max-h-[800px] overflow-auto space-y-4 p-4 border border-blue-900">
                                    <!-- Ticket 1 -->
                                    <div class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Ticket 2 -->
                                    <div class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>📍 LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Ticket 3 -->
                                    <div class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>📍 LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Ticket 4 -->
                                    <div class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Separate row for quantity adjuster and add to cart button, aligned to the right -->
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Ticket 5 -->
                                    <div class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>