<!-- ------------------------------- -->
<div class="event-info-container">
    <h1 class="event-info-header">Route</h1>
</div>


<div class="container-route">
    <img class="route-image" src="<?php echo htmlspecialchars($firstHistoryRoute->mainImagePath); ?>"
        alt="History Event">

    <div id="overlayInfo" class="overlay-info" style="display: none;">
        <img id="overlayImage" class="detail-image" alt="Detail Image">
        <p id="overlayText" class="detail-text">Some information about the location</p>
    </div>

    <div class="route-info-container">
        <h1 class="route-info-header">LOCATIONS WE ARE EXPLORING:</h1>

        <?php foreach ($historyRoutes as $historyRoute): ?>
            <div class="route-text-info" data-image-url="<?php echo htmlspecialchars($historyRoute->locationImagePath); ?>"
                data-info-text="<?php echo htmlspecialchars($historyRoute->locationDescription); ?>">

                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">
                    <?php echo htmlspecialchars($historyRoute->locationName); ?>
                </p>
                <?php if ($historyRoute->wheelchairSupport): ?>
                    <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png" alt="History Event">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="The-button">
    <a href="/personalProgramAgendaView"> <button type="button" class="btn1">Check Festival Schedule</button>
    </a>
</div>