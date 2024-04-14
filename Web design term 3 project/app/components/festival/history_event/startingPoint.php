<!-- ------------------------------- -->
<div class="event-info-container">
    <h1 class="event-info-header">Starting Point Of The Tour</h1>
</div>

<div class="map-container">
    <img class="starting-point-image" src="<?php echo htmlspecialchars($historyTourStartingPoints->mainImagePath); ?>"
        alt="History Event">
    <div class="map-info-container">
        <p class="map-info-text">
            <?php echo htmlspecialchars($historyTourStartingPoints->description); ?>
        </p>
        <img class="map-info-image"
            src="<?php echo htmlspecialchars($historyTourStartingPoints->secondaryImagePath); ?>" alt="History Event">
    </div>
</div>