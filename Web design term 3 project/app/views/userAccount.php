<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>



<!-- <body class="bg-gray-200">
    <?php include __DIR__ . '/header.php'; ?>

    <section class="flex justify-center items-center h-screen bg-black">
        <h1>this is the user account</h1>
    </section>


</body> -->

<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- User Profile -->
            <div class="md:col-span-1 bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">User Profile</h2>
                    <!-- User's picture -->
                    <img src="user.jpg" alt="User" class="w-12 h-12 rounded-full">
                </div>
                <!-- Personal information -->
                <div>
                    <p class="text-gray-600 mb-2"><strong>Name:</strong> John Doe</p>
                    <p class="text-gray-600 mb-2"><strong>Email:</strong> john@example.com</p>
                    <p class="text-gray-600 mb-2"><strong>Phone:</strong> +1234567890</p>
                    <p class="text-gray-600 mb-2"><strong>Address:</strong> 123 Street, City, Country</p>
                </div>
                <!-- Edit button -->
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Edit Profile</button>
            </div>
            <!-- User Actions -->
            <div class="md:col-span-2 bg-white shadow-md rounded-lg p-4">
                <h2 class="text-lg font-semibold mb-4">Actions</h2>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <li>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md w-full hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Change Password</button>
                    </li>
                    <li>
                        <button class="bg-red-500 text-white px-4 py-2 rounded-md w-full hover:bg-red-600 focus:outline-none focus:bg-red-600">Delete Account</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
<?php include __DIR__ . '/footer.php'; ?>