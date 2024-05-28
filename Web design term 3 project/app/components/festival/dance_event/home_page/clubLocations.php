<div class="max-w-8xl mx-auto px-4">
    <!-- Club Locations -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-white text-4xl font-bold">Club Locations</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-8">
        <?php foreach ($clubLocations as $clubLocation): ?>
            <div class="js-club-container_<?php echo htmlspecialchars($clubLocation->clubLocationID) ?>">
                <img class="w-full h-48 object-cover rounded"
                    src="<?php echo htmlspecialchars($clubLocation->imagePath); ?>"
                    alt="<?php echo htmlspecialchars($clubLocation->name); ?>">
                <p class="mt-2"><?php echo strtoupper(htmlspecialchars($clubLocation->name)); ?></p>
                <p class="text-xs"><?php echo htmlspecialchars($clubLocation->location); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>