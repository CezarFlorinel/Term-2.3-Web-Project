<div class="bg-white shadow-md rounded-lg p-6">
    <div id="js_dance-info-id" data-id="<?php echo htmlspecialchars($imagePathTop->imageHomePageID); ?>">
        <h2 class="text-xl">Top Image of Dance Home</h2>
        <img id="imageTop" src="<?php echo htmlspecialchars($imagePathTop->imagePath); ?>" alt="Image Top" class="mt-2"
            style="width: 200px; height: auto;">
        <input type="file" id="imageTopInput" class="hidden" accept="image/*">
        <button onclick="document.getElementById('imageTopInput').click();"
            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
            Image</button>
    </div>
</div>