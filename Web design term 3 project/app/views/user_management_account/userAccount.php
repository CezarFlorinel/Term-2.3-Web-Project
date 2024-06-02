<?php
session_start();

if (isset($_SESSION['userEmail']) && isset($_SESSION['userName'])) {
    $email = $_SESSION['userEmail'];
    $name = $_SESSION['userName'];
}
?>

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


<body>

    <?php include __DIR__ . '/../header.php'; ?>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl text-center mb-6">Personal information</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- User Profile -->

            <div class="md:col-span-1 bg-white shadow-md rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">

                    <!-- User's picture -->

                    <img src="user.jpg" alt="User" class="w-12 h-12 rounded-full">
                </div>
                <div>
                    <button type="button" id="changePicture"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Change
                        Picture</button>
                </div>
            </div>

            <!-- Personal information -->

            <div class="md:col-span-2 bg-white shadow-md rounded-lg p-4">
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <li id="personalInfo" class="mt-4">
                        <p id="name" class="text-gray-600 mb-2">
                            <strong>Name:</strong> <span class="name-value"><?php echo $name; ?></span>
                        </p>

                        <p id="email" class="text-gray-600 mb-2">
                            <strong>Email:</strong> <span class="email-value"><?php echo $email; ?></span>
                        </p>

                    </li>
                    <li>
                        <div>
                            <button type="button" id="changePassword"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Change
                                Password</button>
                        </div>
                        <div>
                            <button type="button" id="editProfile"
                                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Edit
                                Profile</button>
                        </div>
                        <div>
                            <button type="button" id="save"
                                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
                                style="display:none;">Save
                            </button>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
        <button type="button" id="logout"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
            Logout</button>
    </div>
</body>

</html>
<script>
    var userId = <?php echo json_encode($_SESSION['userId']); ?>;
</script>
<script type="module" src="javascript/User/userPersonalInformation.js"></script>

<?php include __DIR__ . '/../footer.php'; ?>