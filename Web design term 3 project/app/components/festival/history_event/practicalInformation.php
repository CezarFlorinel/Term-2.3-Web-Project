<!-- ------------------------------- -->
<div class="event-info-container">
    <h1 class="event-info-header">Practical Information</h1>
</div>

<div class="practical-info-container">
    <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
        <div class="practical-info-item">
            <img class="practical-info-sign toggle-sign" src="assets/images/elements/+ sign.png" alt="Toggle Answer"
                data-toggle="closed">
            <p class="practical-info-text">
                <?php echo htmlspecialchars($practicalInformation->question); ?>
            </p>
        </div>
        <div class="practical-info-answer" style="display:none;">
            <?php echo htmlspecialchars($practicalInformation->answer); ?>
        </div>
    <?php endforeach; ?>
</div>