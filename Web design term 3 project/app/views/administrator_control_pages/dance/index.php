<?php
use App\Services\DanceService;

$danceService = new DanceService();
$imagePathTop = $danceService->getImageHomePage();

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">

            <h1 class="text-3xl text-center mb-6">Dance Home Page</h1>
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



        </div>
    </div>

    <script type="module" src="javascript/Dance/dance_home_admin.js"></script>

</body>

</html>