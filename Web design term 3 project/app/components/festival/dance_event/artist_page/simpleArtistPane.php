<?php
$date = new DateTime($passedTicket->dateAndTime);
$dayNumber = $date->format('d');
$month = $date->format('M');
$weekday = $date->format('l');
?>
<div class="bg-black rounded-lg shadow-md overflow-hidden col-span-4 md:col-span-1 flex flex-col">
    <div class="text-center py-2">
        <div class="text-4xl sm:text-5xl md:text-6xl font-bold"><?php echo $dayNumber ?></div>
        <div class="text-xl sm:text-2xl"><?php echo $month; ?></div>
        <div class="text-base sm:text-lg mb-2"><?php echo $weekday; ?></div>
        <div class="rounded-lg border">
            <div class="relative">
                <div class="top-0 left-0 w-full h-7 bg-white text-black text-lg font-bold rounded">
                    <?php
                    $startTime = new DateTime($passedTicket->startTime);
                    $endTime = new DateTime($passedTicket->endTime);
                    echo $startTime->format('H:i') . ' - ' . $endTime->add(new DateInterval('PT6H'))->format('H:i');
                    ?>
                </div>
            </div>
            <div class="text-white text-lg font-bold mt-1"><?php echo htmlspecialchars($artist->name) ?></div>
            <img src="<?php echo htmlspecialchars($artist->imageArtistLineupPath) ?>" alt="Man"
                class="w-full h-auto rounded-lg shadow-lg" style="max-width: 100%;">
        </div>
    </div>
    <div class="text-white text-sm mt-0 ml-2"><?php echo htmlspecialchars($passedTicket->location) ?></div>
    <div class="flex items-center mt-1 ml-2">
        <input type="checkbox" id="price_panel1" name="price" value="60.00">
        <label for="price_panel1" class="ml-1 text-white text-m">€ <?php $formattedPrice = number_format($passedTicket->price, 2, '.', '');
        echo htmlspecialchars($formattedPrice); ?></label>
    </div>
</div>