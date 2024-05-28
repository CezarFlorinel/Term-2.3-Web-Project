<div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <?php foreach ($eventsWithLinks as $event): ?>
        <div id="js_containerEvent_<?php echo $event->eventID ?>" data-id="<?php echo $event->eventID ?>"
            class="event-container max-w-7xl mx-auto bg-white p-6 shadow-lg rounded-lg lg:grid lg:grid-cols-3 lg:gap-4 items-center"
            style="max-width: 1300px;">
            <div class="lg:col-span-1 flex justify-center lg:justify-start">
                <img id="js_imageEvent_<?php echo $event->eventID ?>" src="<?php echo $event->imagePath ?>"
                    alt="A vibrant event"
                    class="event-image rounded-lg w-1/2 md:w-2/3 lg:w-3/4 max-w-xs md:max-w-xs lg:max-w-sm mx-auto lg:mx-0"
                    style="height: auto;">
                <input id="js_imageEventInput_<?php echo $event->eventID ?>" type="file" class="event-image-input hidden">
            </div>
            <div class="lg:col-span-2">
                <div class="text-center lg:text-left w-full px-4 mt-6 lg:mt-0 lg:px-0">
                    <input type="text" class="event-title text-2xl font-bold text-black mt-4 form-control w-full"
                        value="<?php echo $event->eventTitle ?>">
                    <textarea class="event-description summernote w-full"><?php echo $event->eventDescription ?></textarea>
                    <input type="text" class="event-link form-control w-full text-gold mt-2"
                        value="<?php echo $event->linkToRedirect ?>">
                    <button
                        class="save-button mt-4 lg:mt-8 bg-red-500 text-white py-2 px-6 lg:px-60 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                        style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">Save
                        Text
                        Changes</button>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</div>