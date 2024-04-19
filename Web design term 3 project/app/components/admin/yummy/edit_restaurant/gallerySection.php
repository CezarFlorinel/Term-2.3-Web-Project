<!-- Gallery Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Restaurant Gallery</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <div id="imagesGallery" class="grid grid-cols-3 gap-4">
        <?php foreach ($gallery as $image): ?>
            <div class="relative" ?>
                <img src="<?php echo htmlspecialchars($image->imagePath); ?>" alt="Image" class="w-full h-auto">
                <button class="delete-image-btn absolute top-0 right-0 bg-red-500 text-white px-2 py-1"
                    data-image-id="<?php echo htmlspecialchars($image->id); ?>"
                    data-image-path="<?php echo htmlspecialchars($image->imagePath); ?>">Delete</button>
            </div>
        <?php endforeach; ?>
        <div class="add-image-container">
            <input type="file" id="imageUploadGallery" class="hidden"
                accept="image/jpeg, image/png, image/jpg, image/webp">
            <button onclick="document.getElementById('imageUploadGallery').click();" id="addImageBtnGallery"
                class="bg-green-500 text-white px-4 py-2">Add Image</button>
        </div>
    </div>
</div>