<h2 class="text-2xl text-center mb-6">One Day Passes</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($oneDayPasses as $pass):
        $id = htmlspecialchars($pass->passesID);
        $date = new DateTime($pass->date);
        $formattedDate = $date->format('Y-m-d');
        $price = htmlspecialchars($pass->price);
        $maxPasses = htmlspecialchars($pass->maxOneDayPasses);

        ?>

        <div id="passContainer_<?php echo $id; ?>" class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

            <div class="px-6 py-4">
                <p>Date</p>
                <input id="js_passOneDayDate_<?php echo $id; ?>" type="date" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    value="<?php echo $formattedDate; ?>">
                <p>Price</p>
                <input id="js_passOneDayPrice_<?php echo $id; ?>" type="number"
                    class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Enter price" name="price"
                    value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                <p>Number of Maximum Available Passes</p>
                <input id="js_passOneDayMaxPassesAvailable_<?php echo $id; ?>" type="number"
                    class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Available Tickets"
                    value="<?php echo $maxPasses; ?>">

                <button id="js_buttonSaveOneDayPass_<?php echo $id; ?>"
                    class="js_buttonSaveOneDayPass bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                <button id="js_buttonDeleteOneDayPass_<?php echo $id; ?>"
                    class="js_buttonDeleteOneDayPass bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- Empty Card for Adding New One Day Pass -->

    <div class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

        <div class="px-6 py-4">
            <form class="js_createOneDayPassForm" method="post">
                <p>Date</p>
                <input type="date" name="date" class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="YYYY-MM-DD">
                <p>Price</p>
                <input type="number" name="price" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Enter price" step="0.01">
                <p>Number of Maximum Available Passes</p>
                <input type="number" name="maxPasses" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Max Passes">
                <button type="submit" id="js_buttonAddOneDayPass"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add New
                    Pass</button>
            </form>
        </div>
    </div>
</div>