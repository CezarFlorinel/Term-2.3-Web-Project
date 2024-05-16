<div class="event-info-container">
    <h1 class="event-info-header">Tour Departures Timetable</h1>
</div>

<div class="timetables-grid-container">

    <?php foreach ($historyTourDeparturesTimetables as $timetable): ?>
        <?php
        // Convert string date to PHP DateTime object
        $dateObject = new DateTime($timetable->date);

        $day = $dateObject->format('d');
        $month = $dateObject->format('M');
        $dayOfWeek = $dateObject->format('l'); // Full name of the day of the week
        ?>
        <div class="timetable-day">
            <h1 class="timetable-day-header">
                <?php echo htmlspecialchars($day); ?>
            </h1>
            <p class="timetable-day-text1">
                <?php echo htmlspecialchars($month); ?>
            </p>
            <p class="timetable-day-text2">
                <?php echo htmlspecialchars($dayOfWeek); ?>
            </p>
        </div>
    <?php endforeach; ?>



    <?php foreach ($historyTours as $index => $tour): ?>
        <div class="timetable-booking-item" id="booking-item-<?php echo $index; ?>">
            <div class="initial-content">
                <p class="timetable-booking-text">Time:
                    <?php echo htmlspecialchars((new DateTime($tour->startTime))->format('H:i')); ?>
                </p>
                <?php if ($tour->englishTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">English Tours</p>
                        <?php for ($i = 0; $i < $tour->englishTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="English Tour">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                <?php if ($tour->dutchTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">Dutch Tours</p>
                        <?php for ($i = 0; $i < $tour->dutchTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/download 3.png" alt="Dutch Tour">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
                <?php if ($tour->chineseTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">Chinese Tours</p>
                        <?php for ($i = 0; $i < $tour->chineseTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/download 5.png" alt="Chinese Tour">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="button" class="btn3" data-booking-id="<?php echo $index; ?>">Book</button>
        </div>
    <?php endforeach; ?>


</div>