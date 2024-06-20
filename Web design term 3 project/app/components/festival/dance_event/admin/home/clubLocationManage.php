<h2 class="text-2xl text-center mb-6">Club Location (Venues)</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($clubLocations as $clubLocation):
        $id = htmlspecialchars($clubLocation->clubLocationID);
        $containerId = "js_clubLocationContainer_$id";
        $inputId = "js_clubLocationImageInput_$id";
        $imageId = "js_clubLocationImage_$id";
        ?>
        <div id="<?php echo $containerId; ?>" data-id="<?php echo $id; ?>"
            class="js_clubLocationContainerClass max-w-sm rounded overflow-hidden shadow-lg">
            <img id="<?php echo $imageId; ?>" class="w-full h-48 object-cover"
                src="<?php echo htmlspecialchars($clubLocation->imagePath); ?>" alt="Image Top">
            <div class="px-6 py-4">
                <input type="text" class="js_input_text font-bold text-xl mb-2 hidden"
                    value="<?php echo htmlspecialchars($clubLocation->name); ?>">
                <div id="js_club_current_name_<?php echo $id; ?>" class="font-bold text-xl mb-2 view">
                    <?php echo htmlspecialchars($clubLocation->name); ?>
                </div>
                <input type="text" class="js_input_text text-gray-700 text-base hidden"
                    value="<?php echo htmlspecialchars($clubLocation->location); ?>">
                <p class="text-gray-700 text-base view"><?php echo htmlspecialchars($clubLocation->location); ?>
                </p>
            </div>
            <div class="px-6 py-4">
                <button id="editSaveBtn_<?php echo $id; ?>"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded edit-save-btn">Edit</button>
                <button id="deleteBtn_<?php echo $id; ?>"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-btn">Delete</button>
                <input id="<?php echo $inputId; ?>" type="file" class="hidden" accept="image/*">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="document.getElementById('<?php echo $inputId; ?>').click();">Change Image</button>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Empty Card for Adding New Club Location -->

    <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">

        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Add New Club Location</div>
            <form class="js_add-club-form" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Name" class="w-full rounded-lg py-2 px-3 mb-2 border">
                <input type="text" name="location" placeholder="Location"
                    class="w-full rounded-lg py-2 px-3 mb-2 border">
                <p class="text-sm text-gray-600">Add Image</p>
                <input id="js_inputNewClubImage" type="file" name="image" accept="image/*">
                <button id="js_addClub" type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-2">Add
                    Location</button>
            </form>
        </div>
    </div>
</div>