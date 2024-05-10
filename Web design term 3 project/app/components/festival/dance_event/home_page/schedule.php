<!-- Schedule -->
<div class="text-center mb-8">
    <h2 class="text-4xl font-bold">Schedule</h2>
</div>

<div class="flex justify-center gap-4 mb-8">
    <button id="js_allEventsButton"
        class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ALL</button>
    <button id="js_26EventsButton"
        class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">26.07</button>
    <button id="js_27EventsButton"
        class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">27.07</button>
    <button id="js_28EventsButton"
        class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">28.07</button>
</div>

<div id="js_containerForArtistSchedule" class="grid grid-cols-1 md:grid-cols-5 gap-4">

    <?php foreach ($danceTickets as $ticket):
        $imagePathOfArtist = '';
        $singerNameLower = strtolower($ticket->singer);

        foreach ($artists as $artist) {
            $artistNameLower = strtolower($artist->name);
            if (strpos($artistNameLower, $singerNameLower[0]) !== false) {
                $imagePathOfArtist = $artist->imageArtistLineupPath;
            }
        }

        ?>
        <div class="artist-container">
            <img class="w-full h-48 object-cover rounded" src="<?php echo $imagePathOfArtist ?>" alt="Artist">
            <p class="mt-2"><?php echo htmlspecialchars($ticket->singer); ?></p>
            <p class="text-xs"><?php
            $startTime = new DateTime($ticket->startTime);
            $endTime = new DateTime($ticket->endTime);
            echo $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
            ?></p>
            <p class="text-xs"><?php echo strtoupper(htmlspecialchars($ticket->location)); ?></p>
        </div>
    <?php endforeach; ?>
</div>