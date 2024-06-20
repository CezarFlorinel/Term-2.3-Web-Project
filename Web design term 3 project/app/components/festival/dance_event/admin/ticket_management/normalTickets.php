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

        <div id="ticketContainer_<?php echo $id; ?>" class="bg-yellow-100 max-w-sm rounded overflow-hidden shadow-lg">

            <div class="px-6 py-4">
                <p>Date</p>
                <input id="js_date_<?php echo $id; ?>" type="date" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    value="<?php echo $date; ?>">

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
                <input id="js_price_<?php echo $id; ?>" type="number" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Enter price" name="price" value="<?php echo number_format((float) $price, 2, '.', ''); ?>">

                <p>Singer/s</p>
                <input id="js_singer_<?php echo $id; ?>" type=" text" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Singer" value="<?php echo $singer; ?>">
                <p>Number of Available Tickets</p>
                <input id="js_maxTickets_<?php echo $id; ?>" type="number" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Available Tickets" value="<?php echo $availableTickets; ?>">
                <p>Session Type</p>
                <input id="js_session_<?php echo $id; ?>" type="text" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Session Type" value="<?php echo $sessionType; ?>">
                <p>Start Time</p>
                <input id="js_startTime_<?php echo $id; ?>" type="time" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    value="<?php echo $startTime->format('H:i'); ?>">
                <p>End Time</p>
                <input id="js_endTime_<?php echo $id; ?>" type="time" class="w-full rounded-lg py-2 px-3 mb-2 border"
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
                <input type="date" name="date" class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="YYYY-MM-DD"
                    required>

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

                <input type="text" name="singer" class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="Singer"
                    required>

                <p>Number of Available Tickets</p>
                <input type="number" name="availableTickets" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Available Tickets" required>

                <p>Session Type</p>
                <input type="text" name="sessionType" class="w-full rounded-lg py-2 px-3 mb-2 border"
                    placeholder="Session Type" required>

                <p>Start Time</p>
                <input type="time" name="startTime" class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="HH:MM"
                    required>

                <p>End Time</p>
                <input type="time" name="endTime" class="w-full rounded-lg py-2 px-3 mb-2 border" placeholder="HH:MM"
                    required>

                <button type="submit" id="js_buttonAddTicket"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Add Ticket
                </button>
            </form>
        </div>
    </div>
</div>