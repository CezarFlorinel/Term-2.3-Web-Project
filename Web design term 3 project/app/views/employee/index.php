<?php
include __DIR__ . '/../header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg">
                    <div class="card-body p-6">
                        <h1 class="card-title text-center text-2xl font-bold mb-4">QR Code Scanner</h1>
                        <div class="text-center">
                            <video id="video" class="w-72 h-48 border border-gray-300"></video>
                        </div>
                        <div class="text-center mt-3">
                            <button id="startButton" class="btn bg-blue-500 text-white py-2 px-4 rounded">Start
                                Scanning</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-6">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg">
                    <div class="card-body p-6" id="ticketInfoCard">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="/../javascript/Employee/employee_view.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
</body>

</html>
