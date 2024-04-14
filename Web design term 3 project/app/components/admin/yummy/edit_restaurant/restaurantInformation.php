<!-- Restaurant Table Info Section ------------------------------------------------------- -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl">Restaurant Information</h1>
    <button id="delete-restaurant-btn"
        class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 transition duration-150">DELETE
        RESTAURANT</button>
</div>
<div class="bg-white shadow-md rounded-lg p-6">
    <div id="container-restaurant-info" class="p-4 border-b border-gray-200 flex justify-between items-start"
        data-id="<?php echo htmlspecialchars($_GET['id']); ?>">
        <div>
            <p class="text-2xl text-blue-500">Name of restaurant:</p>
            <p data-type="name" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($restaurant->name); ?>
            </p>
            <p class="text-2xl text-blue-500">Location:</p>
            <p data-type="location" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($restaurant->location); ?>
            </p>
            <p class="text-2xl text-blue-500">Description:</p>
            <p data-type="description" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($restaurant->descriptionTopPart); ?>
            </p>
            <p class="text-2xl text-blue-500">Description Left Side:</p>
            <p data-type="descriptionSideOne" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($restaurant->descriptionSideOne); ?>
            </p>
            <p class="text-2xl text-blue-500">Description Right Side</p>
            <p data-type="descriptionSideTwo" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($restaurant->descriptionSideTwo); ?>
            </p>
            <p class="text-2xl text-blue-500">Number of Seats:</p>
            <input type="number" id="numberSeats" class="text-lg font-semibold text-black-500"
                value="<?php echo htmlspecialchars($restaurant->numberOfSeats); ?>" min="0" readonly>

            <p class="text-2xl text-blue-500">Number of Stars:</p>
            <input type="number" id="numberStars" class="text-lg font-semibold text-black-500"
                value="<?php echo htmlspecialchars($restaurant->rating); ?>" min="0" max="5" readonly>
        </div>

        <button id="edit-restaurant-btn"
            class="edit-restaurant-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
    </div>

    <p class="text-2xl text-blue-500">Cuisine Types:</p>
    <div class="container-cuisine-types flex flex-wrap">
        <?php foreach ($cusineTypes as $type): ?>
            <div class="bg-gray-300 rounded-full m-1 flex items-center">
                <p class="cuisine-type text-lg font-semibold text-black-500 bg-gray-300 rounded-full px-2 py-1 m-1">
                    <?php echo htmlspecialchars($type); ?>
                </p>
                <button
                    class="delete-cuisine-btn py-1 px-2 bg-red-500 text-white rounded-full hover:bg-red-700 transition duration-150">Delete</button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="add-cuisine-container">
        <input type="text" id="new-cuisine-type" placeholder="Enter new cuisine type"
            class="text-lg font-semibold text-black-500 rounded-full px-2 py-1 m-1">
        <button id="add-cuisine-btn"
            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add</button>
    </div>


    <div> <!-- images on the individual page -->
        <p class="text-3xl text-blue-500">Image at the top of the page:</p>
        <div>
            <img id="imageTop" src="<?php echo htmlspecialchars($restaurant->imagePathHomepage); ?>" alt="Image 1"
                class="mt-2" style="width: 200px; height: auto;">
            <input type="file" id="imageTopInput" class="hidden" accept="image/*">
            <button onclick="document.getElementById('imageTopInput').click();"
                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                Image
            </button>
        </div>
        <p class="text-3xl text-blue-500">Image with location:</p>
        <div>
            <img id="imageLocation" src="<?php echo htmlspecialchars($restaurant->imagePathLocation); ?>" alt="Image 1"
                class="mt-2" style="width: 200px; height: auto;">
            <input type="file" id="imageLocationInput" class="hidden" accept="image/*">
            <button onclick="document.getElementById('imageLocationInput').click();"
                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                Image
            </button>
        </div>
        <p class="text-3xl text-blue-500">Image of the chef:</p>
        <div>
            <img id="imageChef" src="<?php echo htmlspecialchars($restaurant->imagePathChef); ?>" alt="Image 1"
                class="mt-2" style="width: 200px; height: auto;">
            <input type="file" id="imageChefInput" class="hidden" accept="image/*">
            <button onclick="document.getElementById('imageChefInput').click();"
                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                Image
            </button>
        </div>
    </div>

</div>