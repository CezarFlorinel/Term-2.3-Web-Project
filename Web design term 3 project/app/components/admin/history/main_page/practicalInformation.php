<!-- Practical Information Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Practical Information Section</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
        <div class="p-4 border-b border-gray-200 flex justify-between items-start"
            data-id="<?php echo htmlspecialchars($practicalInformation->informationID); ?>">
            <div>
                <p>Q:</p>
                <p class="text-lg font-semibold editable" contenteditable="false">
                    <?php echo htmlspecialchars($practicalInformation->question); ?>
                </p>
                <p>A:</p>
                <p class="mt-2 editable" contenteditable="false">
                    <?php echo htmlspecialchars($practicalInformation->answer); ?>
                </p>
            </div>
            <div class="flex items-start">
                <!-- Edit Button -->
                <button
                    class="edit-practical-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                <!-- Delete Button -->
                <button
                    class="delete-practical-btn ml-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
            </div>
        </div>
    <?php endforeach; ?>

    <div id="addForm" class="hidden p-4 bg-gray-100 border border-gray-200 rounded-lg">
        <h2 class="text-lg mb-2">Add New Practical Information:</h2>
        <div>
            <label for="newQuestion">Question:</label>
            <input type="text" id="newQuestion" class="block w-full p-2 mt-1 mb-2">
            <label for="newAnswer">Answer:</label>
            <textarea id="newAnswer" class="block w-full p-2 mt-1 mb-2"></textarea>
            <button id="submitNewInfo"
                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Submit</button>
        </div>
    </div>

    <!-- Add Button -->
    <div class="p-4">
        <button
            class="add-practical-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add
            +</button>
    </div>
</div>
</div>