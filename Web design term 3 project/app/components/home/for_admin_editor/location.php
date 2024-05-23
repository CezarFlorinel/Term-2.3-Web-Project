<!-- Festival Location -->
<?php if ($festivalLocation !== null): ?>
    <div style="height: 60px;"></div>
    <title>Festival Location</title>
    </div>

    <div>
        <div class="right-aligned-text">
            WHERE IS <br> THE FESTIVAL?
        </div>

        <div id="js_containerLocation" data-id="<?php echo htmlspecialchars($festivalLocation->ID) ?>"
            class="festival-location-section flex-col-reverse md:flex-row ">
            <div class="info-box md:w-2/3 pr-14 text-center">
                <p><?php echo $festivalLocation->description ?></p>
                <!-- put save button here instead -->
                <button id="js_saveLocationChanges"
                    class="mt-4 lg:mt-8 bg-red-500 text-white py-2 px-6 lg:px-60 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                    style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">Save
                    Text
                    Changes</button>
            </div>
            <div class="md:w-1/3 h-80 rounded-lg overflow-hidden">
                <img id="js_imageLocation" src="<?php echo $festivalLocation->imagePathLocation ?>"
                    class="h-full object-cover">
                <input id="js_imageLocationInput" type="file" class="hidden">
            </div>
        </div>
    </div>
<?php endif; ?>