<?php include __DIR__ . '/../header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-black text-white flex justify-center items-center min-h-screen">
    <div class="w-full max-w-4xl mx-auto p-8">
    
    <div class="flex flex-col" style="font-family: 'Playfair Display', serif;">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-5xl font-bold">Your Personal Program</h1>
        <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
            Change View
        </button>
    </div>
    <div class="flex items-center mt-4">
        <p class="mr-4 text-2xl" style="font-family: 'Playfair Display', serif;">Share your personal program on:</p>
        <!-- Icons with Playfair Display font -->
        <a href="https://facebook.com" target="_blank">
            <img src="assets\images\Logos\Facebook-W.png" alt="Facebook" class="mr-2">
        </a>
        <a href="https://linkedin.com" target="_blank">
            <img src="assets\images\Logos\Linkdin-W.png" alt="LinkedIn" class="mr-2">
        </a>
        <a href="https://instagram.com" target="_blank">
            <img src="assets\images\Logos\Instagram-W.png" alt="Instagram" class="mr-2">
        </a>
        <a target="_blank">
            <img src="assets\images\Logos\H.png" alt="Haarlem" class="mr-2">
        </a>
        <!-- Additional social media icons here -->
    </div>
</div>

<div style="height: 20px;"></div>
<h1 class="text-4xl font-bold">Your Cart</h1>
<div style="height: 20px;"></div>

        <!-- Headings Section -->
        <div class="flex justify-between px-4 mb-2 text-xl" style="font-family: Playfair Display;">
            <div class="w-1/4 font-bold">Event</div>
            <div class="w-1/4 font-bold">Time</div>
            <div class="w-1/4 font-bold">Location</div>
            <div class="w-2/12 font-bold">Quantity</div>
            <div class="w-1/12 text-right font-bold">Price</div>
        </div>
        <div class="w-full border-t border-gray-400"></div>

        <div style="height: 20px;"></div>
        <!-- White Square Section -->
        <div class="bg-white text-black rounded-lg py-4 px-6">
            <!-- Items List -->
            <div class="space-y-4">
                <!-- Item Rows -->
                <!-- Repeat this structure for each item, replace with actual data -->
                <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>English <br> Tour</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
                <button class="px-2 py-1 border">-</button>
                <input type="text" class="w-8 text-center border-t border-b" value="1">
                <button class="px-2 py-1 border">+</button>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-500">--€</div>
            </div>
        </div>

        <div class="border-t border-gray-400"></div>

        <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets/images/Payment_event_images/Checkinfo2.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>Tiësto <br> Concert</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
                <button class="px-2 py-1 border">-</button>
                <input type="text" class="w-8 text-center border-t border-b" value="1">
                <button class="px-2 py-1 border">+</button>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-500">--€</div>
            </div>
        </div>

        <div class="border-t border-gray-400"></div>

        <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>English <br> Tour</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
                <button class="px-2 py-1 border">-</button>
                <input type="text" class="w-8 text-center border-t border-b" value="4">
                <button class="px-2 py-1 border">+</button>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600">
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-700">--€</div>
            </div>
        </div>
    
                <!-- Repeat End --> 
            </div>
                <div class="pt-4 mt-4 border-t border-gray-500 flex justify-between items-center text-xl font-bold">
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

<div style="height: 20px;"></div>
<h1 class="text-4xl font-bold">Your Purchased Reservations</h1>
<div style="height: 20px;"></div>

<!-- Headings Section -->
<div class="flex justify-between px-4 mb-2 text-xl" style="font-family: Playfair Display;">
            <div class="w-1/4 font-bold">Event</div>
            <div class="w-1/4 font-bold">Time</div>
            <div class="w-1/4 font-bold">Location</div>
            <div class="w-2/12 font-bold">Quantity</div>
            <div class="w-1/12 text-right font-bold">Price</div>
        </div>
        <div class="w-full border-t border-gray-400"></div>

        <div style="height: 20px;"></div>

<div class="bg-white text-black rounded-lg py-4 px-6">
            <!-- Items List -->
            <div class="space-y-4">
                <!-- Item Rows -->
                <!-- Repeat this structure for each item, replace with actual data -->
                <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>Dutch <br> Tour</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
            <div>4</div>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <!-- <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"> -->
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-500">--€</div>
            </div>
        </div>

        <div class="border-t border-gray-400"></div>

        <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets\images\Payment_event_images\Hardwell-returns-to-Ushuaia-Ibiza-2016 1.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>Hardwell <br> Concert</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
            <div>1</div>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <!-- <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"> -->
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-500">--€</div>
            </div>
        </div>

        <div class="border-t border-gray-400"></div>

        <div class="flex justify-between items-center" style="font-family: imprima">
            <div class="flex items-center">
                <img src="assets\images\Payment_event_images\Multiple-Artists-Concert.png" alt="Event 1" class="w-20 h-20 mr-2">
                <span>Multiple <br> Artists <br> Concert</span>
            </div>
            <div>25 Jul<br>10:00-12:30</div>
            <div>Starting Point Near<br>Church Of Saint Bavo</div>
            <div class="flex items-center">
            <div>1</div>
            </div>
            <div class="flex flex-col items-center">
                <div class="flex items-center mt-[-8px]"> <!-- This negative margin pulls the checkbox and bin icon up -->
                    <!-- <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"> -->
                    <img src="assets/images/Logos/bin.png" alt="Delete" class="w-5 h-5 ml-2">
                </div>
                <div class="text-sm text-gray-500">--€</div>
            </div>
        </div>
                <!-- Repeat End --> 
                <div class="pt-4 mt-4 border-t border-gray-700 flex justify-between items-center text-xl font-bold">
            <div>You have 6 items in total</div>
            <div>Total 145.00€</div>
            </div>
                </body>
                </html>
                <?php include __DIR__ . '/../footer.php'; ?>
                