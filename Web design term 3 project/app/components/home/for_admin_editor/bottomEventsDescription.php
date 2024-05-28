<div class="space-y-10 px-20">
    <?php foreach ($eventsWithoutLinks as $event): ?>
        <div id="js_bottomEventContainer_<?php echo htmlspecialchars($event->eventID) ?>"
            data-id="<?php echo htmlspecialchars($event->eventID) ?>"
            class="js_bottomEventContainer pt-8 lg:pt-12 bg-no-repeat bg-top bg-[size:100%_auto] bg-[url('assets/images/home_page_images/Rectangle.png')]">
            <div class="h-5"></div>
            <input type="text"
                class="js_bottomEventTitle text-4xl lg:text-5xl font-bold mb-4 text-white bg-black py-4 lg:py-6 font-playfair text-center sm:text-left"
                value="<?php echo $event->eventTitle ?>">
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-6">
                <div class="sm:col-span-1">
                    <img id="js_bottomEventImage_<?php echo htmlspecialchars($event->eventID) ?>"
                        src="<?php echo htmlspecialchars($event->imagePath) ?>" alt="Event Picture"
                        class="js_bottomEventImage w-full h-auto">
                    <input id="js_bottomEventImageInput_<?php echo htmlspecialchars($event->eventID) ?>" type="file"
                        class="js_bottomEventImageInput hidden">
                </div>
                <textarea
                    class="js_bottomEventDescription summernote sm:col-span-2 text-base lg:text-xl flex items-center justify-center font-imprima text-lg sm:text-2xl text-center sm:text-left px-4 sm:px-0 lg:px-6">
                                                <?php echo htmlspecialchars($event->eventDescription) ?>
                                            </textarea>
            </div>
            <button
                class="js_saveButtonBottomPartEvents mt-4 lg:mt-8 bg-red-500 text-white py-2 px-6 lg:px-60 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">Save
                Text
                Changes</button>
        </div>
        <div style="height: 5px;"></div>
    <?php endforeach; ?>
</div>