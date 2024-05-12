<div class="mb-4">
    <label class="block font-bold text-white mb-2 mt-8">LOCATION</label>
    <div class="bg-gray-900 flex flex-col space-y-2 border border-blue-900">
        <?php foreach ($clubLocations as $clubLocation): ?>
            <label class="inline-flex items-center">
                <input id="js-filterLocation_<?php echo htmlspecialchars($clubLocation->name) ?>" type="radio"
                    class="form-radio" name="filter" value="<?php echo htmlspecialchars($clubLocation->name); ?>">
                <span class="ml-2"><?php echo htmlspecialchars($clubLocation->name); ?></span>
            </label>
        <?php endforeach; ?>
    </div>
</div>