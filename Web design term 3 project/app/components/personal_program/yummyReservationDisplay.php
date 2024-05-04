<div class="flex justify-between items-center" style="font-family: imprima"
    data-type-reservation-item-id="<?php echo $reservation->ID ?>">

    <!-- Image and info section -->
    <div class="flex flex-col sm:flex-row items-center">
        <img src="assets/images/yummy_event/bistro_tour.png" alt="Event" class="w-20 h-20 mr-2">
        <span><?php echo htmlspecialchars($restaurant->name) ?></span>
    </div>

    <!-- Date and time section -->
    <div>
        <?php
        $startDateTime = new DateTime($session->startTime);
        $endDateTime = new DateTime($session->endTime);
        $output = $startDateTime->format('d M') . '<br>' . $startDateTime->format('H:i') . '-' . $endDateTime->format('H:i');
        echo $output;
        ?>
    </div>

    <!-- Restaurant Location -->
    <div>
        <?php echo htmlspecialchars($restaurant->location); ?>
    </div>

    <!-- Quantity section -->
    <div class="flex items-center">
        <span><?php
        $numberOfPersons = $reservation->numberOfAdults + $reservation->numberOfChildren;
        $itemsTotal += $numberOfPersons;
        echo htmlspecialchars($numberOfPersons);
        ?> persons</span>
    </div>

    <div class="flex flex-col items-center">
        <div class="flex items-center mt-[-26px]">
            <img src="assets/images/Logos/bin.png" data-type-of-reservation="restaurant_res" alt="Delete"
                class="js_delete-icon w-5 h-5 ml-2">
        </div>
        <div style="height: 20px;"></div>
        <div class="text-sm text-gray-500">
            --€
        </div>
    </div>
</div>