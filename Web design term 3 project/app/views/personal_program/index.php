<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Playfair Display', serif;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
        }

        .item-row {
            font-family: imprima;
        }

        .negative-margin {
            margin-top: -26px;
        }

        .item-container {
            height: 20px;
        }

        .text-gray-500 {
            color: #6B7280;
        }

        .border-custom {
            border-color: #4B5563;
        }

        .event-header {
           /* Adjust as needed */
        }

        .time-header {
            margin-left: 8rem;
        }

        @media screen and (max-width: 630px) {
            .time-header {
                margin-left: 0.5rem; /* Adjust as needed for phone screens */
            }
        }

        .location-header {
            margin-right: 0.5rem;
            margin-left: 2rem;
        }

        .quantity-header {
            margin-right: 1rem;
        }

        .price-header {
            margin-right: 0.5rem;
        }

        .event-title {
        width: 70px; /* Adjust as needed */
        word-wrap: break-word;
        /* margin-right: */
        }

        .event-time {
            width: 50px; /* Adjust as needed */
            word-wrap: break-word;
            align: center;
            margin-right: 0.5rem; 
            margin-left: 0.5rem;
        }

        .starting-point {
            width: 80px; /* Adjust as needed */
            word-wrap: break-word;
            word-break: break-word;
            align: center;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }
        .button-container {
            width: 60px; /* Adjust as needed */
            word-wrap: break-word;
            align: center;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .price {
            width: 50px; /* Adjust as needed */
            word-wrap: break-word;
            align: center;
        }
    </style>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">
    <?php include __DIR__ . '/../header.php'; ?>
    <div class="flex flex-col flex-grow">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl mx-auto p-8">
                <div class="flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-5xl font-bold section-title">Your Personal Program</h1>
                        <button
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Change View
                        </button>
                    </div>
                    <div class="flex items-center mt-4">
                        <p class="mr-4 text-2xl section-title">Share your personal program on:</p>
                        <a href="https://facebook.com" target="_blank">
                            <img src="assets/images/Logos/Facebook-W.png" alt="Facebook" class="mr-2">
                        </a>
                        <a href="https://linkedin.com" target="_blank">
                            <img src="assets/images/Logos/Linkdin-W.png" alt="LinkedIn" class="mr-2">
                        </a>
                        <a href="https://instagram.com" target="_blank">
                            <img src="assets/images/Logos/Instagram-W.png" alt="Instagram" class="mr-2">
                        </a>
                        <a target="_blank">
                            <img src="assets/images/Logos/H.png" alt="Haarlem" class="mr-2">
                        </a>
                    </div>
                </div>

                <div class="item-container"></div>
                <h1 class="text-4xl font-bold">Your Cart</h1>
                <div class="item-container"></div>

                <!-- Headings Section -->
                <div class="flex justify-between px-4 mb-2 section-title">
                    <div class="font-bold event-header">Event</div>
                    <div class="font-bold time-header">Time</div>
                    <div class="font-bold location-header">Location</div>
                    <div class="font-bold quantity-header">Quantity</div>
                    <div class="text-right font-bold price-header">Price</div>
                </div>

                <div class="w-full border-t border-gray-400"></div>

                <div class="item-container"></div>
                <!-- White Square Section -->
                <div class="bg-white text-black rounded-lg py-4 px-6 text-sm">
                    <!-- Items List -->
                    <div class="space-y-4">
                        <!-- Item Rows -->
                        <!-- Repeat this structure for each item, replace with actual data -->
                                            <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">English Tour and english tour</span>
                        </div>
                        <div class="event-time" style="">25 Jul 10:00-12:30</div>
                        <div class="starting-point" style="">Starting Point Near Church Of Saint</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">250€</div>
                    </div>

                    </div>


                        <div class="border-t border-gray-400"></div>

                        <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">Dance Pass</span>
                        </div>
                        <div class="event-time">27 Jul</div>
                        <div class="starting-point">Multiple</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">250€</div>
                    </div>

                    </div>

                        <div class="border-t border-gray-400"></div>

                        <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">Hardwell/BOmbeu/Bambino Concert
                            </span>
                        </div>
                        <div class="event-time">25 Jul 20:00-21:00</div>
                        <div class="starting-point">Openluchtheater Club</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">250€</div>
                    </div>
                        </div>

                        <!-- Repeat End -->
                    </div>
                    <div class="pt-4 mt-4 border-t border-custom flex justify-between items-center text-xl font-bold">
                        <div>You have 6 items in total</div>
                        <div>Total 145.00€</div>
                    </div>
                </div>
                <div class="mt-10 flex justify-end gap-4">
                    <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Purchase All Tickets
                    </button>
                    <button class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Purchase Selected Tickets
                    </button>
                </div>

                <div class="item-container"></div>
                <h1 class="text-4xl font-bold">Your Purchased Reservations</h1>
                <div class="item-container"></div>

                <!-- Headings Section -->
                <div class="flex justify-between px-4 mb-2 section-title">
                    <div class="font-bold event-header">Event</div>
                    <div class="font-bold time-header">Time</div>
                    <div class="font-bold location-header">Location</div>
                    <div class="font-bold quantity-header">Quantity</div>
                    <div class="text-right font-bold price-header">Price</div>
                </div>
                <div class="w-full border-t border-gray-400"></div>

                <div class="item-container"></div>

                <div class="bg-white text-black rounded-lg py-4 px-6 text-sm">
                    <!-- Items List -->
                    <div class="space-y-4">
                        <!-- Item Rows -->
                        <!-- Repeat this structure for each item, replace with actual data -->
                        <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">Singerman Concert
                            </span>
                        </div>
                        <div class="event-time">25 Jul 21:00-4:00</div>
                        <div class="starting-point">Patronaat Club Club</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="flex items-center negative-margin" style="flex-shrink: 0;">
                            <input type="checkbox" class="form-checkbox h-6 w-6 text-gray-600" style="flex-shrink: 0;">
                            <img src="assets/images/Logos/bin.png" alt="Delete" class="w-6 h-6 ml-2" style="flex-shrink: 0;">
                        </div>
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">200€</div>
                    </div>
                        </div>

                        <div class="border-t border-gray-400"></div>

                        <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">Ratatouille Food & Wines
                            </span>
                        </div>
                        <div class="event-time">02 Jun 17:00-18:30</div>
                        <div class="starting-point">Spaarne 96, 2011 CL Haarlem</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="flex items-center negative-margin" style="flex-shrink: 0;">
                            <input type="checkbox" class="form-checkbox h-6 w-6 text-gray-600" style="flex-shrink: 0;">
                            <img src="assets/images/Logos/bin.png" alt="Delete" class="w-6 h-6 ml-2" style="flex-shrink: 0;">
                        </div>
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">--€</div>
                    </div>
                        </div>

                        <div class="border-t border-gray-400"></div>

                        <div class="flex justify-between items-center item-row">
                        <div class="flex flex-col sm:flex-row items-center">
                            <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                            <span class="event-title">Ratatouille Food & Wines
                            </span>
                        </div>
                        <div class="event-time">02 Jun 17:00-18:30</div>
                        <div class="starting-point">Spaarne 96, 2011 CL Haarlem</div>
                        <div class="flex items-center button-container">
                            <button class="px-1 py-0.5 text-xs border">-</button>
                            <input type="text" class="w-6 h-6 text-xs text-center border-t border-b" value="1">
                            <button class="px-1 py-0.5 text-xs border">+</button>
                        </div>
                        <div class="flex flex-col items-center" style="margin-left: 1rem; margin-right:0.5rem">
                        <div class="flex items-center negative-margin" style="flex-shrink: 0;">
                            <input type="checkbox" class="form-checkbox h-6 w-6 text-gray-600" style="flex-shrink: 0;">
                            <img src="assets/images/Logos/bin.png" alt="Delete" class="w-6 h-6 ml-2" style="flex-shrink: 0;">
                        </div>
                        <div class="item-container"></div>
                        <div class="text-sm text-gray-500 price">--€</div>
                    </div>
                        </div>
                        <!-- Repeat End -->
                        <div class="pt-4 mt-4 border-t border-custom flex justify-between items-center text-xl font-bold">
                            <div>You have 6 items in total</div>
                            <div>Total 145.00€</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>
