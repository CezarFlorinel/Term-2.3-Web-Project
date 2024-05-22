<?php
include __DIR__ . '/../header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <section class="flex flex-col items-center justify-center min-h-8 mt-12">
        <h1 class="text-center text-3xl font-bold mb-2">Scan your QR code below!</h1>
        <div class="container mx-auto flex flex-col items-center justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg">
                    <div class="card-body p-8">
                        <div class="text-center mb-4">
                            <video id="video" class="w-80 h-52 border border-gray-300"></video>
                        </div>
                        <div class="text-center mt-4">
                            <button id="startButton" class="bg-blue-300 text-white py-4 px-8 rounded-lg text-lg">Start Scanning</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-4 flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg">
                    <div class="card-body p-8" id="ticketInfoCard">
                    </div>
                </div>
            </div>
        </div>
        <script type="module" src="/../javascript/Employee/employee_view.js"></script>
        <script src="https://unpkg.com/@zxing/library@latest"></script>
    </section>
</body>

</html>