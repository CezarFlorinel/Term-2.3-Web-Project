<!-- Events Bottom Desc -->
<div class="space-y-10 px-20">
    <!-- Historical Tour -->

    <?php foreach ($eventsWithoutLinks as $event): ?>

        <div
            class="pt-8 lg:pt-12 bg-no-repeat bg-top bg-[size:100%_auto] bg-[url('assets/images/home_page_images/Rectangle.png')]">
            <div class="h-5"></div>
            <div
                class="text-4xl lg:text-5xl font-bold mb-4 text-white bg-black py-4 lg:py-6 font-playfair text-center sm:text-left">
                <?php echo $event->eventTitle ?>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-6">
                <div class="sm:col-span-1">
                    <img src="<?php echo htmlspecialchars($event->imagePath) ?>" alt="Event Picture" class="w-full h-auto">
                </div>
                <div
                    class="sm:col-span-2 text-base lg:text-xl flex items-center justify-center font-imprima text-lg sm:text-2xl text-center sm:text-left px-4 sm:px-0 lg:px-6">
                    <?php echo $event->eventDescription ?>
                </div>
            </div>
        </div>


        <div style="height: 5px;"></div>

    <?php endforeach; ?>
</div>