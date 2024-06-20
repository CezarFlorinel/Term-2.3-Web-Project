<?php
use App\Services\DanceService;

$danceService = new DanceService();
$imagePathTop = $danceService->getImageHomePage();
$clubLocations = $danceService->getAllClubLocations();
$artists = $danceService->getAllArtists();

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">


            <h1 class="text-3xl text-center mb-6">Dance Home Page</h1>

            <a href="/danceManageTickets"
                class="my-5 block w-full max-w-xs mx-auto bg-yellow-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">
                Manage Tickets
            </a>

            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/home/topImageManage.php'; ?>

            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/home/clubLocationManage.php'; ?>

            <?php require __DIR__ . '/../../../components/festival/dance_event/admin/home/manageAndCreateArtist.php'; ?>


        </div>
    </div>

    <script type="module" src="javascript/Dance/dance_home_admin.js"></script>


</body>

</html>