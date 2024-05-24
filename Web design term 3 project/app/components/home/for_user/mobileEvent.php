<!-- Mobile Event Section -->
<div style="height: 60px;"></div>

<?php if ($homeGameEventDetails !== null): ?>
    <div class="event-section flex flex-col md:flex-row items-center md:items-start">
        <img class="event-image w-1/4 md:w-1/12"
            src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathDecorationLeft) ?>" alt="Image of Dexter">

        <div class="content p-4">
            <div class="event-title text-5xl font-bold"><?php echo $homeGameEventDetails->title ?></div>
            <div class="mobile-event mb-5 text-xl text-sm"><?php echo $homeGameEventDetails->subTitle ?></div>
            <div class="event-description text-base">
                <?php echo $homeGameEventDetails->description ?>
            </div>
        </div>

        <img class="qr-code w-1/4 md:w-1/12" src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathQRcode) ?>"
            alt="QR Code">
    </div>
<?php endif; ?>