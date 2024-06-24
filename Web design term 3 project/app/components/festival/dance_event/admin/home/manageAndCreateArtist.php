<h2 class="text-2xl text-center mb-6">Manage Artists</h2>
<ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($artists as $artist): ?>
        <li>

            <a href="/artistAdminManagement?artistID=<?php echo $artist->artistID; // redirect to the page, change the link ?>"
                class="block bg-white hover:bg-gray-100 border border-gray-200 rounded-lg p-4 transition duration-150">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-800">
                        <?php echo htmlspecialchars($artist->name); ?>
                    </p>
                    <p class="text-sm text-gray-600">Artist ID: <?php echo $artist->artistID; ?></p>
                </div>
            </a>
        </li>
    <?php endforeach; ?>
</ul>


<h2 class="text-2xl text-center mb-6">Create New Artist</h2>
<div class="bg-white max-w-sm rounded overflow-hidden shadow-lg">
    <p class="text-center text-green-700">After creating the artist, you can select it and complete more
        information about him.</p>
    <div class="px-6 py-4">
        <form id="js_add-artist-form" method="post" enctype="multipart/form-data">
            <label for="text" class="block text-sm font-medium text-gray-700">Artist Name</label>
            <input id="js_inputArtistName" type="text" name="name" placeholder="Name" required
                class="w-full rounded-lg py-2 px-3 mb-2 border">

            <div>

                <label for="text" class="block text-sm font-medium text-gray-700">Image Lineup</label>
                <img id="js_imagePreviewTopArtist" src="#" alt="Top" class="mt-2 hidden"
                    style="width: auto; height: 200px;"> <!-- Initially hidden -->
                <input type="file" id="js_imageTopArtistInput" class="hidden" accept="image/*"
                    onchange="document.getElementById('js_imagePreviewTopArtist').src = window.URL.createObjectURL(this.files[0]); document.getElementById('js_imagePreviewTopArtist').classList.remove('hidden');">
                <button type="button" onclick="document.getElementById('js_imageTopArtistInput').click();"
                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Upload
                    Image</button>
            </div>

            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Image Top</label>
                <img id="js_imagePreviewLineup" src="#" alt="Lineup" class="mt-2 hidden"
                    style="width: auto; height: 200px;"> <!-- Initially hidden -->
                <input type="file" id="js_imageLineupInput" class="hidden" accept="image/*"
                    onchange="document.getElementById('js_imagePreviewLineup').src = window.URL.createObjectURL(this.files[0]); document.getElementById('js_imagePreviewLineup').classList.remove('hidden');">
                <button type="button" onclick="document.getElementById('js_imageLineupInput').click();"
                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Upload
                    Image</button>
            </div>

            <button id="js_addArtistButton" type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-2">Add
                Artist</button>
        </form>
    </div>