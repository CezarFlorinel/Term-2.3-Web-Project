<?php
use App\Services\YummyService;

$yummyService = new YummyService();
?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>


        <div class="flex-grow p-6">
            <!-- Restaurant Table Info Section ------------------------------------------------------- -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl">Restaurant Information</h1>
                <a href="/yummyHomeAdmin">
                    <button id="cancel-restaurant-btn"
                        class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 transition duration-150">Cancel</button>
                </a>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-orange-700">You need to fill only a part of the fields, afterwards you can add more in
                    the edit section.</p>

                <form action="/createRestaurant/createRestaurant" method="DELETE" id="create-restaurant-form"
                    enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="restaurantName" class="block text-2xl text-blue-500">Name of restaurant:</label>
                        <input type="text" id="restaurantName" name="name" class="w-full p-2 rounded border" required>
                    </div>
                    <div class="mb-4">
                        <label for="restaurantLocation" class="block text-2xl text-blue-500">Location:</label>
                        <input type="text" id="restaurantLocation" name="location" class="w-full p-2 rounded border"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="restaurantDescription" class="block text-2xl text-blue-500">Description:</label>
                        <textarea id="restaurantDescription" name="description" rows="4"
                            class="w-full p-2 rounded border" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="descriptionLeftSide" class="block text-2xl text-blue-500">Description Left
                            Side:</label>
                        <textarea id="descriptionLeftSide" name="descriptionLeft" rows="4"
                            class="w-full p-2 rounded border" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="descriptionRightSide" class="block text-2xl text-blue-500">Description Right
                            Side:</label>
                        <textarea id="descriptionRightSide" name="descriptionRight" rows="4"
                            class="w-full p-2 rounded border" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="numberSeats" class="block text-2xl text-blue-500">Number of Seats:</label>
                        <input type="number" id="numberSeats" name="numberOfSeats" class="w-full p-2 rounded border"
                            min="1" required>
                    </div>
                    <div class="mb-4">
                        <label for="numberStars" class="block text-2xl text-blue-500">Number of Stars:</label>
                        <input type="number" id="numberStars" name="numberOfStars" class="w-full p-2 rounded border"
                            min="0" max="5" required>
                    </div>
                    <div class="mb-4">
                        <label for="cuisineType" class="block text-2xl text-blue-500">Cusine Type:</label>
                        <input type="text" id="cuisineType" name="cuisineType" class="w-full p-2 rounded border"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="imageTopInput" class="block text-2xl text-blue-500">Image Top:</label>
                        <input name="imageTop" type="file" id="imageTopInput" class="hidden" accept="image/*"
                            onchange="updateImageStatus(this, 'imageTopStatus')">
                        <br>
                        <label for="imageTopInput"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2 cursor-pointer">Add
                            Image</label>
                        <span id="imageTopStatus" class="ml-2 text-sm font-semibold"></span>
                    </div>

                    <div class="mb-4">
                        <label for="imageLocationInput" class="block text-2xl text-blue-500">Image with location of
                            restaurant:</label>
                        <input name="imageLocation" type="file" id="imageLocationInput" class="hidden" accept="image/*"
                            onchange="updateImageStatus(this, 'imageLocationStatus')">
                        <br>
                        <label for="imageLocationInput"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2 cursor-pointer">Add
                            Image</label>
                        <span id="imageLocationStatus" class="ml-2 text-sm font-semibold"></span>
                    </div>

                    <div class="mb-4">
                        <label for="imageChefInput" class="block text-2xl text-blue-500">Image of the chef:</label>
                        <input name="imageChef" type="file" id="imageChefInput" class="hidden" accept="image/*"
                            onchange="updateImageStatus(this, 'imageChefStatus')">
                        <br>
                        <label for="imageChefInput"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2 cursor-pointer">Add
                            Image</label>
                        <span id="imageChefStatus" class="ml-2 text-sm font-semibold"></span>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" id="create-restaurant-btn"
                            class="py-3 px-8 bg-green-600 text-white rounded hover:bg-green-700 transition duration-150">Create
                            Restaurant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateImageStatus(input, statusId) {
            var fileName = input.files[0] ? input.files[0].name : ''; // Get the file name if file was selected
            document.getElementById(statusId).textContent = fileName ? 'Selected: ' + fileName : ''; // Update the status text
        }
    </script>

</body>

</html>