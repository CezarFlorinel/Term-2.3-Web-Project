<div class="start-image-container" id="carousel">
    <div class="start-image-text">
        <h1 class="text-1-h">HAARLEM</h1>
        <h1 class="text-2-h">Festival</h1>
        <h1 class="text-3-h">A Stroll Through History</h1>
    </div>
    <div class="arrows-images-container">
        <img class="start-image-arrow" id="arrow-left" src="assets/images/elements/arrow-left 1.png" alt="Previous">
        <img class="start-image-arrow" id="arrow-right" src="assets/images/elements/arrow-right 1.png" alt="Next">
    </div>
</div>

<?php
if ($historyTopPart !== null): ?>
    <div class="event-info-container">
        <h1 class="event-info-header">
            <?php echo htmlspecialchars($historyTopPart->subheader); ?>
        </h1>
        <img class="sound-icon" src="assets/images/elements/Vector.png" alt="Read Aloud" id="read-aloud-button">
    </div>

    <div class="back-image">
        <div class="event-info-text-container">
            <p class="event-info-h" id="text-to-read">
                <?php echo htmlspecialchars($historyTopPart->description); ?>
            </p>
        </div>
    </div>
<?php endif; ?>