<h2 class="text-2xl text-center py-5">Custom Pages Section</h2>

<div class="flex flex-wrap">

    <?php foreach ($customPages as $customPage): ?>
        <div class="w-full sm:w-1/2 md:w-1/3 p-6">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-4">
                    <h3 class="text-2xl font-bold text-center"><?php echo $customPage->title; ?></h3>
                    <div class="flex justify-center space-x-2">
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