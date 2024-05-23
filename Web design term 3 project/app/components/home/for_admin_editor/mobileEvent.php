<!-- Mobile Event Section -->
<div style="height: 60px;"></div>

<?php if ($homeGameEventDetails !== null): ?>
    <div id="js_containerGameEvent" data-id="<?php echo htmlspecialchars($homeGameEventDetails->ID) ?>"
        class="event-section flex flex-col md:flex-row items-center md:items-start">
        <img id="js_DecorationImage" class="event-image w-1/4 md:w-1/12"
            src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathDecorationLeft) ?>" alt="Image of Dexter">
        <input id="js_DecorationImageInput" type="file" class="hidden">

        <div class="content p-4">
            <div class="event-title text-5xl font-bold"><?php echo $homeGameEventDetails->title ?></div>
            <div class="mobile-event mb-5 text-xl text-sm"><?php echo $homeGameEventDetails->subTitle ?></div>
            <div class="event-description text-base">
                <?php echo $homeGameEventDetails->description ?>
            </div>
        </div>

        <img id="js_QrCodeImage" class="qr-code w-1/4 md:w-1/12"
            src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathQRcode) ?>" alt="QR Code">
        <input id="js_QrCodeImageInput" type="file" class="hidden">
    </div>
<?php endif; ?>