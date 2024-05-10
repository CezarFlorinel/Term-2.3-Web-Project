<?php
use App\Services\DanceService;


$danceService = new DanceService();
$artist = $danceService->getArtistById($_GET['artistID']);
$artistSpotifyLinks = $danceService->getArtistSpotifyLinks($_GET['artistID']);
$careerHighlights = $danceService->getCareerHighlightsByArtistID($_GET['artistID']);
$concerts = $danceService->getConcertsByArtistName($artist->name);

?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">

            <h1 class="text-3xl text-center mb-6">Artist Management</h1>
            <h1 id="js_artistNameTitle" class="text-2xl text-center mb-6"><?php echo htmlspecialchars($artist->name) ?>
            </h1>

            <button id="js_deleteArtistButton"
                class="my-5 block w-full max-w-xs mx-auto bg-red-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">Delete
                Artist</button>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div id="js_artistInfoIdContainer" data-id="<?php echo htmlspecialchars($artist->artistID); ?>">

                    <h2 class="text-xl">Top Image of Artist Page</h2>
                    <h3>(add an image with high width and quality)</h3>
                    <img id="js_imageTop" src="<?php echo htmlspecialchars($artist->imageTopPath); ?>" alt="Image Top"
                        class="mt-2" style="width: 200px; height: auto;">
                    <input type="file" id="js_imageTopInput" class="hidden" accept="image/*">
                    <button onclick="document.getElementById('js_imageTopInput').click();"
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                        Image</button>

                    <h2 class="text-xl">Image for Artist Lineup</h2>
                    <h3>(add an image with high height)</h3>
                    <img id="js_imageArstistLineup"
                        src="<?php echo htmlspecialchars($artist->imageArtistLineupPath); ?>" alt="Image Top"
                        class="mt-2" style="width: auto; height: 200px;">
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

            <h2 class="text-2xl text-center mb-6 my-5">Career Highlights</h2>
            <div class="max-w-4xl mx-auto p-5">

                <?php foreach ($careerHighlights as $careerHighlight):
                    $id = htmlspecialchars($careerHighlight->careerHighlightsID);
                    ?>
                    <div id="js_carrerHighlightContainer_<?php echo $id ?>" class="bg-white shadow-lg rounded-lg p-6">
                        <!-- Title -->
                        <input id="js_careerHighlightTitleInput_<?php echo $id ?>" type="text"
                            class="text-2xl font-bold mb-4 p-2 w-full border-2 border-gray-300 rounded"
                            placeholder="Enter title here"
                            value="<?php echo htmlspecialchars($careerHighlight->titleYearPeriod) ?>">

                        <!-- Description -->
                        <textarea id="js_careerHighlightDescriptionInput_<?php echo $id ?>"
                            class="p-2 w-full border-2 border-gray-300 rounded mb-4" rows="6"
                            placeholder="Enter description here"><?php echo htmlspecialchars($careerHighlight->Text) ?></textarea>

                        <!-- Image Display and Upload -->
                        <div>
                            <img id="js_imageArtistCarrerHighlight_<?php echo $id ?>"
                                src="<?php echo htmlspecialchars($careerHighlight->imagePath); ?>" alt="Image Top"
                                class="mt-2" style="width: auto; height: 200px;">
                            <input type="file" id="js_imageArtistCarrerInput_<?php echo $id ?>" class="hidden"
                                accept="image/*">
                            <button
                                onclick="document.getElementById('js_imageArtistCarrerInput_<?php echo $id ?>').click();"
                                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
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
                        <textarea class="p-2 w-full border-2 border-gray-300 rounded mb-4" rows="6"
                            placeholder="Enter description" name="text"></textarea>

                        <!-- Image Display and Upload -->
                        <div>
                            <label for="text" class="block text-sm font-medium text-gray-700">Image</label>
                            <img id="js_newImagePreview" src="#" alt="Career Highlight Image" class="mt-2 hidden"
                                style="width: auto; height: 200px;"> <!-- Initially hidden -->
                            <input type="file" id="js_newImageCarrerHighlightInput" class="hidden" accept="image/*"
                                onchange="document.getElementById('js_newImagePreview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('js_newImagePreview').classList.remove('hidden');">
                            <button type="button"
                                onclick="document.getElementById('js_newImageCarrerHighlightInput').click();"
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
            </div>

            <h2 class="text-2xl text-center mb-6">Concerts</h2>
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($concerts as $concert): ?>
                    <li
                        class="block bg-white hover:bg-gray-100 border border-gray-200 rounded-lg p-4 transition duration-150">
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800">
                                <?php $date = htmlspecialchars($concert->dateAndTime);
                                $formattedDate = new DateTime($date);
                                echo $formattedDate->format('d M Y') ?>
                            </p>
                            <p class="text-sm text-gray-600">Club: <?php echo htmlspecialchars($concert->location); ?></p>
                        </div>

                    </li>
                <?php endforeach; ?>
            </ul>

            <h2 class="text-green-700 my-5 text-2xl text-center mb-6">Here you can manage the concerts to which
                the singer
                participates.</h2>
            <a href="/danceManageTickets"
                class="my-5 block w-full max-w-xs mx-auto bg-yellow-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">
                Manage Tickets
            </a>

        </div>

        <script type="module" src="javascript/Dance/manage_dance_artist.js"></script>

</body>

</html>