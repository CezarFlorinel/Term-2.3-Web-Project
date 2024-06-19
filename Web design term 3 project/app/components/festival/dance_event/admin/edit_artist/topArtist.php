<div class="bg-white shadow-md rounded-lg p-6">
    <div id="js_artistInfoIdContainer" data-id="<?php echo htmlspecialchars($artist->artistID); ?>">

        <h2 class="text-xl">Top Image of Artist Page</h2>
        <h3>(add an image with high width and quality)</h3>
        <img id="js_imageTop" src="<?php echo htmlspecialchars($artist->imageTopPath); ?>" alt="Image Top" class="mt-2"
            style="width: 200px; height: auto;">
        <input type="file" id="js_imageTopInput" class="hidden" accept="image/*">
        <button onclick="document.getElementById('js_imageTopInput').click();"
            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
            Image</button>

        <h2 class="text-xl">Image for Artist Lineup</h2>
        <h3>(add an image with high height)</h3>
        <img id="js_imageArstistLineup" src="<?php echo htmlspecialchars($artist->imageArtistLineupPath); ?>"
            alt="Image Top" class="mt-2" style="width: auto; height: 200px;">
        <input type="file" id="js_imageArstistLineupInput" class="hidden" accept="image/*">
        <button onclick="document.getElementById('js_imageArstistLineupInput').click();"
            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
            Image</button>

        <h2 class="text-xl">Artist Name</h2>
        <input type="text" id="js_artistNameInput" value="<?php echo htmlspecialchars($artist->name); ?>"
            class="mt-2 w-full border-2 border-gray-300 p-2 rounded-lg">
        <button id="js_updateArtistNameButton"
            class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Update
            Artist Name</button>
    </div>

</div>