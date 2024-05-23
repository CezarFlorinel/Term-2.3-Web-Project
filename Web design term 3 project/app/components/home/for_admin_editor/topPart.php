<?php if ($homePageDetails !== null): ?>

    <div id="js_containerTopPart" data-id="<?php echo htmlspecialchars($homePageDetails->ID) ?>"
        class="start-image-container"
        style="background-image: url('<?php echo $homePageDetails->imagePathTop ?>'); background-size: cover; background-position: center; min-height: 110vh; display: flex; flex-direction: column; justify-content: space-between;">
        <input id="js_imageTopInput" type="file" class="event-image-input hidden">
        <div class="start-image-text">
            <div class="word-vertical haarlem absolute" style="margin-left: 120px; margin-top: 30px;">
                <div>H</div>
                <div>A</div>
                <div>A</div>
                <div>R</div>
                <div>L</div>
                <div>E</div>
                <div>M</div>
            </div>
            <div class="word-vertical festival absolute" style="margin-left: 60px; margin-top: 30px;">
                <div>F</div>
                <div>E</div>
                <div>S</div>
                <div>T</div>
                <div>I</div>
                <div>V</div>
                <div>A</div>
                <div>L</div>
            </div>
        </div>
    </div>

    <div>
        <section class="section-bg py-10 px-10">
            <div class="text-center mb-8 text-white">
                <input id="js_titleTopInput" type="text" class="text-6xl font-bold text-white bg-black"
                    value="<?php echo $homePageDetails->title ?>">
                <textarea id="js_descriptionTopInput"
                    class="text-base bg-white font-normal text-black rounded-lg lg:text-white summernote"><?php echo $homePageDetails->description ?></textarea>
            </div>
            <button id="js_saveTopPartBtn"
                class="mt-4 lg:mt-8 bg-red-500 text-white py-2 px-6 lg:px-60 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">Save
                Text
                Changes</button>
            <div class="container mx-auto grid grid-cols-1 gap-4"></div>
        </section>
    </div>

<?php endif; ?>