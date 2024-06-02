<?php
use App\Services\TicketsService;
use App\Services\DanceService;

$ticketService = new TicketsService();
$danceService = new DanceService();
$danceTickets = $ticketService->getAllDanceTickets();
$dancePasses = $ticketService->getAllDancePasses();
$locations = $danceService->getAllClubLocationStrings();

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


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">
            <h1 class="text-3xl text-center mb-6">Dance Tickets & Passes Management</h1>

            <h2 class="text-2xl text-center mb-6">Tickets</h2>

            <p class="bg-white shadow-lg mb-3 text-center text-red-600">Please note that when editing/creating new
                tickets, you need to
                properly
                write the name of the artist. <br> For adding more artists use " / " to separate them </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($danceTickets as $ticket):
                    $id = htmlspecialchars($ticket->D_TicketID);
                    $date = htmlspecialchars($ticket->dateAndTime);
                    $location = htmlspecialchars($ticket->location);
                    $price = htmlspecialchars($ticket->price);
                    $singer = htmlspecialchars($ticket->singer);
                    $availableTickets = htmlspecialchars($ticket->totalQuantityOfAvailableTickets);
                    $sessionType = htmlspecialchars($ticket->sessionType);
                    $startTime = new DateTime($ticket->startTime);
                    $endTime = new DateTime($ticket->endTime);
                    ?>

                    <div id="ticketContainer_<?php echo $id; ?>"
                        class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

                        <div class="px-6 py-4">
                            <p>Date</p>
                            <input id="js_date_<?php echo $id; ?>" type="date"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" value="<?php echo $date; ?>">

                            <p>Location</p>
                            <select id="js_location_<?php echo $id; ?>" class="w-full rounded-lg py-2 px-3 mb-2 border">
                                <?php foreach ($locations as $loc): ?>
                                    <option value="<?php echo htmlspecialchars($loc); ?>" <?php if ($loc == $location)
                                           echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($loc); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <p>Price</p>
                            <input id="js_price_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Enter price" name="price"
                                value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                            <p>Singer/s</p>
                            <input id="js_singer_<?php echo $id; ?>" type=" text"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Singer"
                                value="<?php echo $singer; ?>">
                            <p>Number of Available Tickets</p>
                            <input id="js_maxTickets_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Available Tickets"
                                value="<?php echo $availableTickets; ?>">
                            <p>Session Type</p>
                            <input id="js_session_<?php echo $id; ?>" type="text"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Session Type"
                                value="<?php echo $sessionType; ?>">
                            <p>Start Time</p>
                            <input id="js_startTime_<?php echo $id; ?>" type="time"
                                class="w-full rounded-lg py-2 px-3 mb-2 border"
                                value="<?php echo $startTime->format('H:i'); ?>">
                            <p>End Time</p>
                            <input id="js_endTime_<?php echo $id; ?>" type="time"
                                class="w-full rounded-lg py-2 px-3 mb-2 border"
                                value="<?php echo $endTime->format('H:i'); ?>">
                            <button id="js_buttonSave_<?php echo $id; ?>"
                                class="js_buttonSave bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <button id="js_buttonDelete_<?php echo $id; ?>"
                                class="js_buttonDelete bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class=" bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

                    <div class="px-6 py-4">
                        <form class="js_createNewTicketForm" method="post">
                            <p>Date</p>
                            <input type="date" name="date" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="YYYY-MM-DD" required>

                            <p>Location</p>
                            <select name="location" class="w-full rounded-lg py-2 px-3 mb-2 border" required>
                                <?php foreach ($locations as $loc): ?>
                                    <option value="<?php echo htmlspecialchars($loc); ?>">
                                        <?php echo htmlspecialchars($loc); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <p>Price</p>
                            <input type="number" name="price" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Enter price" step="0.01" required>

                            <p>Singer/s</p>

                            <input type="text" name="singer" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Singer" required>

                            <p>Number of Available Tickets</p>
                            <input type="number" name="availableTickets" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Available Tickets" required>

                            <p>Session Type</p>
                            <input type="text" name="sessionType" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Session Type" required>

                            <p>Start Time</p>
                            <input type="time" name="startTime" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="HH:MM" required>

                            <p>End Time</p>
                            <input type="time" name="endTime" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="HH:MM" required>

                            <button type="submit" id="js_buttonAddTicket"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add Ticket
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl text-center mb-6">One Day Passes</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($oneDayPasses as $pass):
                    $id = htmlspecialchars($pass->passesID);
                    $date = new DateTime($pass->date);
                    $formattedDate = $date->format('Y-m-d');
                    $price = htmlspecialchars($pass->price);
                    $maxPasses = htmlspecialchars($pass->maxOneDayPasses);

                    ?>

                    <div id="passContainer_<?php echo $id; ?>"
                        class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

                        <div class="px-6 py-4">
                            <p>Date</p>
                            <input id="js_passOneDayDate_<?php echo $id; ?>" type="date"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" value="<?php echo $formattedDate; ?>">
                            <p>Price</p>
                            <input id="js_passOneDayPrice_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Enter price" name="price"
                                value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                            <p>Number of Available Passes</p>
                            <input id="js_passOneDayMaxPassesAvailable_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Available Tickets"
                                value="<?php echo $maxPasses; ?>">

                            <button id="js_buttonSaveOneDayPass_<?php echo $id; ?>"
                                class="js_buttonSaveOneDayPass bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                            <button id="js_buttonDeleteOneDayPass_<?php echo $id; ?>"
                                class="js_buttonDeleteOneDayPass bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Empty Card for Adding New One Day Pass -->

                <div class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

                    <div class="px-6 py-4">
                        <form class="js_createOneDayPassForm" method="post">
                            <p>Date</p>
                            <input type="date" name="date" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="YYYY-MM-DD">
                            <p>Price</p>
                            <input type="number" name="price" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Enter price" step="0.01">
                            <p>Number of Available Passes</p>
                            <input type="number" name="maxPasses" class="w-full rounded-lg py-2 px-3 mb-2 border"
                                placeholder="Max Passes">
                            <button type="submit" id="js_buttonAddOneDayPass"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add New
                                Pass</button>
                        </form>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl text-center mb-6">Multiple Days Pass</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($multipleDayPasses as $pass):
                    $id = htmlspecialchars($pass->passesID);
                    $price = htmlspecialchars($pass->price);
                    $maxPasses = htmlspecialchars($pass->maxAllDayPasses);

                    ?>

                    <div id="passContainer_<?php echo $id; ?>"
                        class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

                        <div class="px-6 py-4">
                            <p>Price</p>
                            <input id="js_multipleDaysPassPrice_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Enter price" name="price"
                                value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                            <p>Number of Available Passes</p>
                            <input id="js_multipleDaysPassMaxAvailable_<?php echo $id; ?>" type="number"
                                class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Available Tickets"
                                value="<?php echo $maxPasses; ?>">
                            <button id="js_buttonSaveMultipleDaysPass_<?php echo $id; ?>"
                                class="js_buttonSaveMultipleDaysPass bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <script type="module" src="javascript/Dance/manage_dance_tickets.js"></script>

</body>

</html>