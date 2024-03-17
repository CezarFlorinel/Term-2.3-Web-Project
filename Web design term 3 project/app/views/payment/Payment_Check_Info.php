<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Summary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="CSS_files/payment.css">

</head>
<body class="bg-black text-white flex justify-center items-center min-h-screen">
<div class="scale-container">
    <div class="w-full max-w-4xl mx-auto p-8">
        <!-- Header Section -->
        <div class="flex items-center mb-10" style="text-decoration: underline">
            <img src="assets/images/Payment_event_images/Overview_icon.png" alt="Logo" class="mr-2 w-12 h-12">
            <h1 class="text-3xl font-bold">Overview</h1>
        </div>

        <!-- Headings Section -->
        <div class="flex justify-between px-4 mb-2">
            <div class="w-1/4 font-bold">Event</div>
            <div class="w-1/4 font-bold">Time</div>
            <div class="w-1/4 font-bold">Location</div>
            <div class="w-1/12 font-bold">Quantity</div>
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
                <div class="flex justify-between items-center">
                    <div class="w-1/4 flex items-center">
                        <img src="assets/images/Payment_event_images/Checkinfo1.png" alt="Event 1"
                            class="w-20 h-20 rounded-full mr-2">
                        English Tour
                    </div>
                    <div class="w-1/4">25 Jul<br>10:00-12:30</div>
                    <div class="w-1/4">Starting Point Near<br>Church Of Saint Bavo</div>
                    <div class="w-1/12">1</div>
                    <div class="w-1/12 text-right">17.50€</div>
                </div>

                <div class="w-full border-t border-gray-400"></div>

                <div class="flex justify-between items-center">
                    <div class="w-1/4 flex items-center">
                        <img src="assets/images/Payment_event_images/Checkinfo2.png" alt="Event 1"
                            class="w-20 h-20 rounded-full mr-2">
                        English Tour
                    </div>
                    <div class="w-1/4">27 Jul<br>21:00-02:00</div>
                    <div class="w-1/4">Lichtfabriek<br>Club</div>
                    <div class="w-1/12">1</div>
                    <div class="w-1/12 text-right">70.00€</div>
                </div>

                <div class="w-full border-t border-gray-400"></div>

                <div class="flex justify-between items-center">
                    <div class="w-1/4 flex items-center">
                        <img src="assets/images/Payment_event_images/Checkinfo3.png" alt="Event 1"
                            class="w-20 h-20 rounded-full mr-2">
                        English Tour
                    </div>
                    <div class="w-1/4">27 Jul<br>13:00-15:30</div>
                    <div class="w-1/4">Starting Point Near<br>Church Of Saint Bavo</div>
                    <div class="w-1/12">4</div>
                    <div class="w-1/12 text-right">75.00€</div>
                </div>
                <!-- Repeat End -->
                
            </div>
            
            <!-- Total Line -->
            <div class="pt-4 mt-4 border-t border-gray-300 text-xl font-bold text-center">
                You have 6 items in total
                <div>Total 162.50€</div>
            </div>
        </div>
        
        <div style="height: 80px;"></div>
            <!-- Client and Billing Information Section -->
            <div class="flex justify-between mb-6">
                <!-- Client Details -->
                <div class="w-1/2 pr-4">
                    <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Client Details:</h3>
                    <p>Full Name: Vasile Dracula</p>
                    <p>Email: misterdracula@gmail.com</p>
                    <p>Phone Number: +40786753421</p>
                    <p>Payment Method: IDEal (ING)</p>
                </div>

                <!-- Billing Information -->
                <div class="w-1/2 pl-4">
                    <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Billing Information:</h3>
                    <p>Country: Romania</p>
                    <p>Street: Str. Teiului Nr. 567</p>
                    <p>City: Alexandria</p>
                    <p>County: Teleorman</p>
                    <p>Zip Code: 29874</p>
                </div>
            </div>

            <div style="height: 80px;"></div>
            <!-- Note and Button -->
            <div class="text-center text-sm mb-6">
                Please Check if all details are correct. If they are not, you can always go back using the step bar from the top.
            </div>
            <div class="flex justify-center">
                <button
                class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                NEXT STEP →
                </button>
                </div>
                </div>
                </div>
                </body>
                </html>