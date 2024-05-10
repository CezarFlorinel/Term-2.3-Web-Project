<!-- Panel 2 -->
<?php if (count($concertsWithTripleArtist) > 0):
    $ticket = $concertsWithTripleArtist[0];
    $date = new DateTime($ticket->dateAndTime);
    $dayNumber = $date->format('d');
    $month = $date->format('M');
    $weekday = $date->format('l');
    $artistsName = $artists = explode('/', $ticket->singer);
    $artists = [];
    foreach ($artistsName as $artistName) {
        $artists[] = $danceService->getArtistByName(trim($artistName));
    }
    ?>
    <div class="bg-black rounded-lg shadow-md overflow-hidden col-span-4 md:col-span-3 flex flex-col">
        <div class="text-center py-2">
            <div class="text-4xl sm:text-5xl md:text-6xl font-bold"><?php echo $dayNumber; ?></div>
            <div class="text-xl sm:text-2xl"><?php echo $month; ?></div>
            <div class="text-base sm:text-lg mb-2"><?php echo $weekday; ?></div>
            <div class="rounded-lg border">
                <div class="relative">
                    <div class="top-0 left-0 w-full h-7 bg-white text-black text-lg font-bold rounded">
                        <?php
                        $startTime = new DateTime($ticket->startTime);
                        $endTime = new DateTime($ticket->endTime);
                        echo $startTime->format('H:i') . ' - ' . $endTime->add(new DateInterval('PT6H'))->format('H:i');
                        ?>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <?php foreach ($artists as $artist): ?>
                        <div class="text-white
                                            text-lg font-bold mt-1 text-center">
                            <?php echo htmlspecialchars($artist->name); ?>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($artists as $artist): ?>
                        <img src="<?php echo htmlspecialchars($artist->imageArtistLineupPath); ?>"
                            alt="<?php echo htmlspecialchars($artist->name); ?>" class="w-full h-auto rounded-lg shadow-lg"
                            style="max-width: 100%;">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="text-white text-sm mt-0 ml-2"><?php echo htmlspecialchars($ticket->location) ?>
        </div>
        <div class="flex items-center mt-1 ml-2">
            <input type="checkbox" id="price_panel2" name="price">
            <label for="price_panel2" class="ml-1 text-white text-m">€ <?php $formattedPrice = number_format($ticket->price, 2, '.', '');
            echo htmlspecialchars($formattedPrice); ?></label>
        </div>
    </div>
<?php endif; ?>
<!-- Panel 3 -->