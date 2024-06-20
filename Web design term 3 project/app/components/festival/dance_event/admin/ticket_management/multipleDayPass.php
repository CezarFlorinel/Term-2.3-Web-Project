<h2 class="text-2xl text-center mb-6">Multiple Days Pass</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($multipleDayPasses as $pass):
        $id = htmlspecialchars($pass->passesID);
        $price = htmlspecialchars($pass->price);
        $maxPasses = htmlspecialchars($pass->maxAllDayPasses);

        ?>

        <div id="passContainer_<?php echo $id; ?>" class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

            <div class="px-6 py-4">
                <p>Price</p>
                <input id="js_multipleDaysPassPrice_<?php echo $id; ?>" type="number"
                    class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Enter price" name="price"
                    value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                <p>Number of Maximum Available Passes</p>
                <input id="js_multipleDaysPassMaxAvailable_<?php echo $id; ?>" type="number"
                    class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Available Tickets"
                    value="<?php echo $maxPasses; ?>">
                <button id="js_buttonSaveMultipleDaysPass_<?php echo $id; ?>"
                    class="js_buttonSaveMultipleDaysPass bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>