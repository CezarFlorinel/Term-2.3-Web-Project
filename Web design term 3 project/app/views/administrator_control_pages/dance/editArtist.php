<?php
use App\Services\DanceService;


$danceService = new DanceService();
$artist = $danceService->getArtistById($_GET['artistID']);
$artistSpotifyLinks = $danceService->getArtistSpotifyLinks($_GET['artistID']);
$careerHighlights = $danceService->getCareerHighlightsByArtistID($_GET['artistID']);

?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
        </div>
    </div>

    <script type="module" src="javascript/Dance/manage_dance_artist.js"></script>

</body>

</html>