<?php
use App\Services\DanceService;
use App\Services\TicketsService;

$ticketService = new TicketsService();
$danceService = new DanceService();

$imagePathTop = $danceService->getImageHomePage()->imagePath;
$clubLocations = $danceService->getAllClubLocations();
$artists = $danceService->getAllArtists();

$danceTickets = $ticketService->getAllDanceTickets();
$dancePasses = $ticketService->getAllDancePasses();

$oneDayPasses = [];
$multipleDayPasses = [];

foreach ($dancePasses as $pass) {
    if ($pass->allDayPass == false) {
        $oneDayPasses[] = $pass;
    } else {
        $multipleDayPasses[] = $pass; // usually only one pass, can be extended to hold more passes
    }
}

?>




<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="CSS_files/dance_event.css">


    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }

        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
    <main>
        <div class="start-image-container"
            style="background-image: url('../<?php echo htmlspecialchars($imagePathTop) ?>'); background-size: cover; background-position: center; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
            <div class="start-image-text">
                <h1 class="text-1-h">HAARLEM</h1>
                <h1 class="text-2-h">Festival</h1>
                <h1 class="text-3-h">Dance Event</h1>
            </div>
        </div>

        <div class="bg-black py-8 ">
            <div class="max-w-6xl mx-auto px-4">

                <?php include __DIR__ . '/../../components/festival/dance_event/home_page/artistLineup.php'; ?>

                <div class="bg-black text-white py-8">
                    <?php include __DIR__ . '/../../components/festival/dance_event/home_page/clubLocations.php'; ?>
                    <?php include __DIR__ . '/../../components/festival/dance_event/home_page/schedule.php'; ?>
                </div>

                <?php include __DIR__ . '/../../components/festival/dance_event/home_page/passes.php'; ?>

                <!-- Ticket Section -->
                <div id="ticket-section" class="flex justify-between items-center mb-2 mt-12">
                    <h2 class="text-3xl font-bold">Select Your Ticket:</h2>
                </div>
                <section class="bg-black rounded-lg py-8">
                    <div class="max-w-7xl mx-auto px-4">
                        <div class="flex flex-wrap -mx-4">
                            <!-- Flex Container for both sections -->
                            <div class="flex flex-wrap w-full">
                                <!-- Sidebar: Filter Section -->
                                <div class="w-full lg:w-1/3 px-4 mb-6 lg:mb-0">
                                    <div class="bg-black p-6 shadow-lg rounded-lg border border-blue-900">
                                        <h3 class="text-xl font-bold mb-4">Filter Tickets</h3>
                                        <!-- Artists Filter -->
                                        <div class="mb-4 relative">
                                            <label class="block font-bold text-white mb-2 mt-8"
                                                for="artists">Artists</label>
                                            <div class="mt-1 relative">
                                                <select id="artists"
                                                    class="form-select block w-full pl-3 pr-10 py-2 border border-gray-300 shadow-sm rounded-md appearance-none bg-white"
                                                    onchange="this.style.color='black'">
                                                    <option class="text-black" value="">All Artists</option>
                                                    <?php foreach ($artists as $artist): ?>
                                                        <option class="text-black">
                                                            <?php echo htmlspecialchars($artist->name); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date Filter -->
                                        <div class="mb-4">
                                            <label class="block font-bold text-white mb-2 mt-8">DATE</label>
                                            <div class="bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                                <label class="inline-flex items-center">
                                                    <input id="js_filter26DateTickets" type="checkbox"
                                                        class="form-checkbox" name="date[]" value="26.07">
                                                    <span class="ml-2"> Friday 26 July</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input id="js_filter27DateTickets" type="checkbox"
                                                        class="form-checkbox" name="date[]" value="27.07">
                                                    <span class="ml-2">Saturday 27 July</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input id="js_filter28DateTickets" type="checkbox"
                                                        class="form-checkbox" name="date[]" value="28.07">
                                                    <span class="ml-2">Sunday 28 July</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Location Filter -->
                                        <div class="mb-4">
                                            <label class="block font-bold text-white mb-2 mt-8">LOCATION</label>
                                            <div class="bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                                <?php foreach ($clubLocations as $clubLocation): ?>
                                                    <label class="inline-flex items-center">
                                                        <input
                                                            id="js-filterLocation_<?php echo htmlspecialchars($clubLocation->name) ?>"
                                                            type="checkbox" class="form-checkbox" name="location[]"
                                                            value="<?php echo htmlspecialchars($clubLocation->name); ?>">
                                                        <span
                                                            class="ml-2"><?php echo htmlspecialchars($clubLocation->name); ?></span>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <!-- Available Tickets Filter -->
                                        <div
                                            class="mb-8 mt-8 bg-gray-900 flex flex-col space-y-2 border border-blue-900">
                                            <label class="inline-flex items-center">
                                                <input id="js_filterAvailableTickets" type="checkbox"
                                                    class="form-checkbox" name="available" value="1">
                                                <span class="ml-2">Show only available tickets</span>
                                            </label>
                                        </div>

                                        <button id="js_resetFiltersButton"
                                            class="bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg w-full">Reset
                                            all filters</button>
                                    </div>
                                </div>

                                <!-- Ticket Display adjusted for responsive and scalable display -->
                                <div id="js_ticketDisplayContainer"
                                    class="w-full lg:w-2/3 px-4 max-h-[800px] overflow-auto space-y-4 p-4 border border-blue-900">

                                    <!-- Ticket 2 -->
                                    <div
                                        class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                                        <div class="flex-1 mb-4">
                                            <div class="text-2xl font-bold mb-2 text-center lg:text-left">
                                                Nicky Romero / Afrojack
                                            </div>
                                            <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                                                <div class="text-center">
                                                    <div class="font-semibold">Location</div>
                                                    <div>📍 LICHTFABRIEK</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Date & Time</div>
                                                    <div>26 JUL - FRIDAY</div>
                                                    <div>20:00 - 04:00</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Session</div>
                                                    <div>Back 2 Back</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="font-semibold">Price</div>
                                                    <div>€ 75,00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end items-center space-x-2">
                                            <button
                                                class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-minus text-white text-xs"></i>
                                            </button>
                                            <span>1</span>
                                            <button
                                                class="bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <i class="fas fa-plus text-white text-xs"></i>
                                            </button>
                                            <button
                                                class="bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add ticket to cart
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            </section>

        </div>
    </main>

    <script type="text/javascript">
        const clubLocations = <?php echo json_encode($clubLocations); ?>;
        const artists = <?php echo json_encode($artists); ?>;
        const danceTickets = <?php echo json_encode($danceTickets); ?>;
    </script>
    <script type="module" src="javascript/Dance/festival_general_page.js"></script>

</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>