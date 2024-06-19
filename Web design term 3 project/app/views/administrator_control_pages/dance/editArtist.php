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

        <div class="flex-grow p-6 ml-36">


            <h1 class="text-3xl text-center mb-6">Artist Management</h1>
            <h1 id="js_artistNameTitle" class="text-2xl text-center mb-6"><?php echo htmlspecialchars($artist->name) ?>
            </h1>

            <button id="js_deleteArtistButton"
                class="my-5 block w-full max-w-xs mx-auto bg-red-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">Delete
                Artist</button>

            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/edit_artist/topArtist.php'; ?>
            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/edit_artist/spotifyLinks.php'; ?>
            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/edit_artist/carrerHighlights.php'; ?>
            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/edit_artist/concerts.php'; ?>

        </div>

        <script type="module" src="javascript/Dance/manage_dance_artist.js"></script>

</body>

</html>