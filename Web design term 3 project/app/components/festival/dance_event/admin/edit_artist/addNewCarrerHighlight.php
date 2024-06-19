<!-- Empty Card for Adding New Career Highlight -->
<div class="bg-white shadow-lg rounded-lg p-6">
    <form id="js_addCareerHighlightForm" method="post" enctype="multipart/form-data">
        <h2 class="text-2xl text-center mb-6">Add New Career Highlight</h2>
        <!-- Title -->
        <label for="titleAndYearPeriod" class="block text-sm font-medium text-gray-700">Title and
            Year/Period</label>
        <input type="text" class="text-2xl font-bold mb-4 p-2 w-full border-2 border-gray-300 rounded"
            placeholder="Enter title year/period" name="titleAndYearPeriod">

        <!-- Description -->
        <label for="text" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea class="p-2 w-full border-2 border-gray-300 rounded mb-4" rows="6" placeholder="Enter description"
            name="text"></textarea>

        <!-- Image Display and Upload -->
        <div>
            <label for="text" class="block text-sm font-medium text-gray-700">Image</label>
            <img id="js_newImagePreview" src="#" alt="Career Highlight Image" class="mt-2 hidden"
                style="width: auto; height: 200px;"> <!-- Initially hidden -->
            <input type="file" id="js_newImageCarrerHighlightInput" class="hidden" accept="image/*"
                onchange="document.getElementById('js_newImagePreview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('js_newImagePreview').classList.remove('hidden');">
            <button type="button" onclick="document.getElementById('js_newImageCarrerHighlightInput').click();"
                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Upload
                Image</button>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4 mt-4">
            <button type="submit" id="js_addCareerHighlightButton"
                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Create</button>
        </div>
    </form>
</div>