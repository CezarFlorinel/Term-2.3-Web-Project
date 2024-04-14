<!-- Top Part Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Top Part</h1>
<div class="bg-white shadow-md rounded-lg p-6">

    <div id="getTheIdForTopPart" class="p-4 border-b border-gray-200 flex justify-between items-start"
        data-id="<?php echo htmlspecialchars($historyTopPart->informationID); ?>">
        <div>
            <p class="text-3xl text-blue-500">Description of Page:</p>
            <p data-type="descriptionTop" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($historyTopPart->description); ?>
            </p>
            <p class="text-3xl text-blue-500">Subheader of Page:</p>
            <p data-type="subheaderTop" class="text-lg font-semibold editable" contenteditable="false">
                <?php echo htmlspecialchars($historyTopPart->subheader); ?>
            </p>
        </div>
        <button id="edit-top-part-btn"
            class="edit-top-part-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
    </div>

    <div id="carouselImages" class="grid grid-cols-3 gap-4">
        <?php foreach ($arrayWithImagePathsCarousel as $path): ?>
            <div class="relative">
                <img src="<?php echo htmlspecialchars($path); ?>" alt="Image" class="w-full h-auto">
                <button class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1">Delete</button>
            </div>
        <?php endforeach; ?>
        <div class="add-image-container">
            <input type="file" id="imageUploadInputTopPart" class="hidden" accept="image/jpeg, image/png, image/jpg">
            <button id="addImageBtnTopPart" class="bg-green-500 text-white px-4 py-2">Add Image</button>
        </div>
    </div>

</div>