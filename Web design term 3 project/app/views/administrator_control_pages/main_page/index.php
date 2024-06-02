<?php
use App\Services\CustomPageService;

$customPageService = new CustomPageService();

$customPages = $customPageService->getAllCustomPages();

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">
            <h1 class="text-3xl text-center py-5">Welcome to the admin control panel</h1>

            <h2 class="text-2xl text-center py-5">Custom Pages Section</h2>

            <div class="flex flex-wrap">

                <?php foreach ($customPages as $customPage): ?>
                    <div class="w-1/3 p-6">
                        <div class="bg-white rounded-lg shadow-md">
                            <div class="p-4">
                                <h3 class="text-2xl font-bold text-center"><?php echo $customPage->title; ?></h3>
                                <div class="flex justify-center">
                                    <a href="/CustomPages?id=<?php echo htmlspecialchars($customPage->customPageID); ?>"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                    <a href="/MainPageAdmin/deleteCustomPage?id=<?php echo htmlspecialchars($customPage->customPageID); ?>"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <div>
                <form action="/MainPageAdmin/createCustomPage" method="POST"
                    class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter the title"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
                        custom page</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>