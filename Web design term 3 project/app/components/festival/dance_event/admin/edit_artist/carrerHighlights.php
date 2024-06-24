<h2 class="text-2xl text-center mb-6 my-5">Career Highlights</h2>
<div class="max-w-4xl mx-auto p-5">

    <?php foreach ($careerHighlights as $careerHighlight):
        $id = htmlspecialchars($careerHighlight->careerHighlightsID);
        ?>
        <div id="js_carrerHighlightContainer_<?php echo $id ?>" data-id="<?php echo $id ?>"
            class="bg-white shadow-lg rounded-lg p-6">
            <!-- Title -->
            <input id="js_careerHighlightTitleInput_<?php echo $id ?>" type="text"
                class="text-2xl font-bold mb-4 p-2 w-full border-2 border-gray-300 rounded" placeholder="Enter title here"
                value="<?php echo htmlspecialchars($careerHighlight->titleYearPeriod) ?>">

            <!-- Description -->
            <textarea id="js_careerHighlightDescriptionInput_<?php echo $id ?>"
                class="p-2 w-full border-2 border-gray-300 rounded mb-4" rows="6"
                placeholder="Enter description here"><?php echo htmlspecialchars($careerHighlight->Text) ?></textarea>

            <!-- Image Display and Upload -->
            <div>
                <img id="js_imageArtistCarrerHighlight_<?php echo $id ?>"
                    src="<?php echo htmlspecialchars($careerHighlight->imagePath); ?>" alt="Image Top" class="mt-2"
                    style="width: auto; height: 200px;">
                <input type="file" id="js_imageArtistCarrerInput_<?php echo $id ?>" class="hidden" accept="image/*">
                <button onclick="document.getElementById('js_imageArtistCarrerInput_<?php echo $id ?>').click();"
                    id="js-chagneImageCareerHighlightButton_<?php echo $id ?>"
                    class="js_changeImageCarrerHighlightButton py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                    Image</button>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4 mt-4">
                <button id="js-updateCareerHighlightButton_<?php echo $id ?>"
                    class="js_updateCareerHighlightButton py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Save</button>
                <button id="js-deleteCareerHighlightButton_<?php echo $id ?>"
                    class="js_deleteCareerHighlightButton py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
            </div>
        </div>
        <br>
    <?php endforeach; ?>

    <?php require __DIR__ . '/addNewCarrerHighlight.php'; ?>
</div>