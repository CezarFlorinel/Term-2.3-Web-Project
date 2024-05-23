<!-- Mobile Event Section -->
<div style="height: 60px;"></div>

<?php if ($homeGameEventDetails !== null): ?>
    <div id="js_containerGameEvent" data-id="<?php echo htmlspecialchars($homeGameEventDetails->ID) ?>"
        class="event-section flex flex-col ">
        <img id="js_DecorationImage" class="event-image w-1/4 md:w-1/12"
            src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathDecorationLeft) ?>" alt="Image of Dexter">
        <input id="js_DecorationImageInput" type="file" class="hidden">

        <div class="content p-4 flex flex-col">
            <input type="text" id="js_inputGameEventTitle" class="event-title text-5xl font-bold"
                value="<?php echo $homeGameEventDetails->title ?>">
            <input type="text" id="js_inputGameEventSubtitle" class="mobile-event mb-5 text-xl text-sm"
                value="<?php echo $homeGameEventDetails->subTitle ?>">
            <textarea id="js_inputGameEventDescription" class="summernote event-description text-base">
                                                    <?php echo $homeGameEventDetails->description ?>
                                                </textarea>
        </div>

        <img id="js_QrCodeImage" class="qr-code w-1/4 md:w-1/12"
            src="<?php echo htmlspecialchars($homeGameEventDetails->imagePathQRcode) ?>" alt="QR Code">
        <input id="js_QrCodeImageInput" type="file" class="hidden">

        <button id="js_saveGameEventChangesBtn"
            class="mt-4 lg:mt-8 bg-red-500 text-white py-2 px-6 lg:px-60 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
            style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">Save
            Text
            Changes</button>
        <div class="container mx-auto grid grid-cols-1 gap-4"></div>
    </div>
<?php endif; ?>