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

        <div class="flex-grow p-6">


            <h1 class="text-3xl text-center mb-6">Dance Home Page</h1>

            <a href="manage_tickets.php"
                class="my-5 block w-full max-w-xs mx-auto bg-yellow-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center transition duration-150">
                Manage Tickets
            </a>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div>
                    <h2 class="text-xl">Top Image of Dance Home</h2>
                    <img id="imageTop" src="<?php echo htmlspecialchars($imagePathTop->imagePath); ?>" alt="Image Top"
                        class="mt-2" style="width: 200px; height: auto;">
                    <input type="file" id="imageTopInput" class="hidden" accept="image/*">
                    <button onclick="document.getElementById('imageTopInput').click();"
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                        Image</button>
                </div>
            </div>



            <h2 class="text-2xl text-center mb-6">Club Location (Venues)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($clubLocations as $clubLocation): ?>
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full h-48 object-cover"
                            src="<?php echo htmlspecialchars($clubLocation->imagePath); ?>" alt="Image Top">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?php echo htmlspecialchars($clubLocation->name); ?></div>
                            <p class="text-gray-700 text-base"><?php echo htmlspecialchars($clubLocation->location); ?></p>
                        </div>
                        <div class="px-6 py-4">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                onclick="editClubLocation(<?php echo htmlspecialchars($clubLocation->clubLocationID); ?>)">Edit</button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                onclick="deleteClubLocation(<?php echo htmlspecialchars($clubLocation->clubLocationID); ?>)">Delete</button>
                            <input type="file" class="hidden" accept="image/*">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded "
                                onclick="this.previousElementSibling.click();">Change Image</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Empty Card for Adding New Club Location -->
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Add New Club Location</div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="text" name="name" placeholder="Name"
                                class="w-full rounded-lg py-2 px-3 mb-2 border">
                            <input type="text" name="location" placeholder="Location"
                                class="w-full rounded-lg py-2 px-3 mb-2 border">
                            <input type="file" name="image" accept="image/*" class="hidden">
                            <button type="button" onclick="this.nextElementSibling.click();"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload
                                Image</button>
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">Add
                                Location</button>
                        </form>
                    </div>
                </div>
            </div>



            <h2 class="text-2xl text-center mb-6">Manage Artists</h2>
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($artists as $artist): ?>
                    <li>
                        <a href="another_page.php?artistID=<?php echo $artist->artistID; // redirect to the page, change the link ?>"
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

        </div>
    </div>

    <script type="module" src="javascript/Dance/dance_home_admin.js"></script>

</body>

</html>