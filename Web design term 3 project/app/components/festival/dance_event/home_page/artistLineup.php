<div class="flex justify-between items-center mb-6">
    <h2 class="text-white text-3xl font-bold ">Artists lineup</h2>
    <a href="#ticket-section">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Get your ticket now!
            <!-- This button should be let you go down to the page -->
        </button>
    </a>
</div>

<!-- Artist Lineup -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
    <?php foreach ($artists as $artist) : ?>
        <div class="relative group js-artist-container_<?php echo htmlspecialchars($artist->artistID) ?>">
            <a href="/artistFestival?artistID=<?php echo htmlspecialchars($artist->artistID) ?>" class="block">
                <article class="rounded overflow-hidden">
                    <img class="w-full h-48 object-cover transition-opacity duration-300 group-hover:opacity-25" src="<?php echo htmlspecialchars($artist->imageArtistLineupPath); ?>" alt="Image of <?php echo htmlspecialchars($artist->name); ?>">
                    <p class="text-center text-white mt-2"><?php echo htmlspecialchars($artist->name); ?></p>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white border border-white py-2 px-4 rounded">Learn More</span>
                    </div>
                </article>
            </a>
        </div>
    <?php endforeach; ?>
</div>