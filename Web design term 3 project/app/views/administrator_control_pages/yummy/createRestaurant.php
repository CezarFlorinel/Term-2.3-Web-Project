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
                <a href="/createRestaurant">
                    <button id="cancel-restaurant-btn"
                        class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 transition duration-150">Cancel</button>
                </a>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-orange-700">You need to fill only a part of the fields, afterwards you can add more in
                    the edit section.</p>

                <form id="create-restaurant-form" enctype="multipart/form-data">
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
                        <input type="number" id="numberStars" name="rating" class="w-full p-2 rounded border" min="0"
                            max="5" required>
                    </div>
                    <div class="mb-4">
                        <label for="cusineType" class="block text-2xl text-blue-500">Cusine Type:</label>
                        <input type="text" id="cusineType" name="cusineType" class="w-full p-2 rounded border" required>
                    </div>

                    <div class="mb-4">
                        <label for="imageTopType" class="block text-2xl text-blue-500">Image Top:</label>
                        <input type="file" id="imageTopInput" class="hidden" accept="image/*">
                        <button onclick="document.getElementById('imageTopInput').click();"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Add
                            Image
                        </button>
                    </div>

                    <div class="mb-4">
                        <label for="imageLocation" class="block text-2xl text-blue-500">Image with location of
                            restaurant:</label>
                        <input type="file" id="imageLocationInput" class="hidden" accept="image/*">
                        <button onclick="document.getElementById('imageLocationInput').click();"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Add
                            Image
                        </button>
                    </div>

                    <div class="mb-4">
                        <label for="imageChef" class="block text-2xl text-blue-500">Image of the chef:</label>
                        <input type="file" id="imageChefInput" class="hidden" accept="image/*">
                        <button onclick="document.getElementById('imageChefInput').click();"
                            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Add
                            Image
                        </button>
                    </div>

                </form>

                <div class="flex justify-center">
                    <button id="create-restaurant-btn"
                        class="py-3 px-8 bg-green-600 text-white rounded hover:bg-green-700 transition duration-150">Create
                        Restaurant</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>