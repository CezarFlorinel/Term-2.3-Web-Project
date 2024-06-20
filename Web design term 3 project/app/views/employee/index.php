<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-black text-white">

    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <section class="flex flex-col items-center justify-center min-h-screen mt-12">
        <h1 class="text-center text-white text-3xl font-bold mb-2">Scan your QR code below!</h1>
        <div class="container mx-auto flex flex-col items-center justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg bg-white text-black">
                    <div class="card-body p-8">
                        <div class="flex justify-center mb-4">
                            <video id="video" class="w-80 h-52 border border-gray-300"></video>
                        </div>
                        <div class="text-center mt-4">
                            <button id="startButton"
                                class="bg-blue-800 text-white py-4 px-8 rounded-lg text-lg transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105">
                                Start Scanning
                            </button>
                            <button id="stopButton"
                                class="bg-red-900 text-white py-4 px-8 rounded-lg text-lg transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105">
                                Stop Scanning
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-4 flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="card border border-gray-200 shadow-lg rounded-lg bg-white text-black">
                    <div class="card-body p-8" id="ticketInfoCard">
                    </div>
                </div>
            </div>
        </div>
        <script type="module" src="/../javascript/Employee/employee_view.js"></script>
        <script src="https://unpkg.com/@zxing/library@latest"></script>
    </section>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>
</body>

</html>