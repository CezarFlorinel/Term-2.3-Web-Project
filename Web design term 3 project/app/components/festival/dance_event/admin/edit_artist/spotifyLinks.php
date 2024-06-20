<h2 class="text-2xl text-center mb-6 my-5">Spotify Links</h2>
<p class="text-red-500">If the link is not displayed properly, then it means it's broken.</p>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($artistSpotifyLinks as $spotifyLink):
        $id = htmlspecialchars($spotifyLink->ID);
        $containerId = "js_spotifyLinkContainer_$id";
        ?>
        <div id="<?php echo $containerId; ?>" data-id="<?php echo $id; ?>"
            class="js_spotifyLinkContainerClass p-4 w-full bg-white max-w-sm rounded overflow-hidden shadow-lg">
            <?php echo $spotifyLink->spotifyLink; ?>
            <button id="deleteSpotifyLinkButton_<?php echo $id; ?>"
                class="js_deleteSpotifyClass my-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete
                Link</button>
        </div>
    <?php endforeach; ?>

    <!-- Card for Adding New Spotify Link -->

    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white ">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Add New Spotify Link</div>
            <textarea name="message" id="js_spotifyLinkInput" placeholder="Enter the spotify link here."
                class="js_input_text font-bold  bg-blue-100 p-2 rounded-lg w-full"></textarea>
            <button id="js_addSpotifyLinkButton"
                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Add
                Spotify Link</button>
        </div>
    </div>

</div>