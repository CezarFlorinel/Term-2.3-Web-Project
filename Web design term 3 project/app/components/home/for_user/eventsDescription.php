<!-- Events Description -->
<?php
$colors = ['red', 'blue', 'yellow']; // Define the colors for the first three events
$colorClasses = [
    'red' => 'bg-red-500 hover:bg-red-600 focus:ring-red-500',
    'blue' => 'bg-blue-500 hover:bg-blue-600 focus:ring-blue-500',
    'yellow' => 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-500'
];

$counter = 0;

foreach ($eventsWithLinks as $event):
    $color = $colors[$counter % count($colors)];
    $colorClass = $colorClasses[$color];
    ?>
    <div data-id-event="<?php echo $event->eventID ?>" class="container mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="max-w-7xl mx-auto bg-white p-6 shadow-lg rounded-lg lg:grid lg:grid-cols-3 lg:gap-4 items-center"
            style="max-width: 1300px;">
            <div class="lg:col-span-1 flex justify-center lg:justify-start">
                <img src="<?php echo $event->imagePath ?>" alt="A vibrant event"
                    class="rounded-lg w-1/2 md:w-2/3 lg:w-3/4 max-w-xs md:max-w-xs lg:max-w-sm mx-auto lg:mx-0"
                    style="height: auto;">
            </div>
            <div class="lg:col-span-2">
                <div class="text-center lg:text-left w-full px-4 mt-6 lg:mt-0 lg:px-0">
                    <h3 class="text-2xl font-bold text-gold mt-4"><?php echo $event->eventTitle ?></h3>
                    <p class="text-gray-600 mt-2"><?php echo $event->eventDescription ?></p>
                    <a href="<?php echo $event->linkToRedirect ?>"
                        class="mt-4 lg:mt-8 inline-block <?php echo $colorClass ?> text-white py-2 px-6 lg:px-60 rounded focus:outline-none focus:ring-2 focus:ring-opacity-50"
                        style="display: block; width: fit-content; margin-left: auto; margin-right: auto; text-align: center;">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $counter++;
endforeach;
?>