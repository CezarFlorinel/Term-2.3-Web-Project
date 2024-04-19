<!-- Starting Point Of The Tour Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Starting Point Of The Tour</h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <div id="getTheIdForTourStart" class="p-4 border-b border-gray-200 flex justify-between items-start"
        data-id="<?php echo htmlspecialchars($historyTourStartingPoints->informationID); ?>">
        <div>
            <p>Description:</p>
            <p class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($historyTourStartingPoints->description); ?>
            </p>
            <div>
                <img id="image1" src="<?php echo htmlspecialchars($historyTourStartingPoints->mainImagePath); ?>"
                    alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                <input type="file" id="image1Input" class="hidden" accept="image/*">
                <button onclick="document.getElementById('image1Input').click();"
                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                    Image 1</button>
            </div>
            <div>
                <img id="image2" src="<?php echo htmlspecialchars($historyTourStartingPoints->secondaryImagePath); ?>"
                    alt="Image 2" class="mt-2" style="width: 200px; height: auto;">
                <input type="file" id="image2Input" class="hidden" accept="image/*">
                <button onclick="document.getElementById('image2Input').click();"
                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                    Image 2</button>
            </div>
        </div>
        <button
            class="edit-tour-starting-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
    </div>
</div>