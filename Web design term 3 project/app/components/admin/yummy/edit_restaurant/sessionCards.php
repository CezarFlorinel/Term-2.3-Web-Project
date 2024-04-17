<!-- Session Cards Info Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Restaurant Sessions</h1>
<div class="flex flex-wrap -mx-4"> <!-- Container for the cards -->
    <?php foreach ($sessions as $session): ?>
        <div class="card-container p-4 md:w-1/2 lg:w-1/3" data-id="<?php echo htmlspecialchars($session->sessionID); ?>">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6"> <!-- Card styling -->
                <h2 class="text-xl font-semibold mb-2">Session ID:
                    <?php echo htmlspecialchars($session->sessionID); ?>
                </h2>
                <div class="mb-4">Available Seats:
                    <input type="number" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars($session->availableSeats); ?>" data-field="availableSeats">
                </div>
                <div class="mb-4">Prices for Adults: €
                    <input type="text" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars($session->pricesForAdults); ?>" data-field="pricesForAdults">
                </div>
                <div class="mb-4">Prices for Children: €
                    <input type="text" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars($session->pricesForChildren); ?>" data-field="pricesForChildren">
                </div>
                <div class="mb-4">Reservation Fee: €
                    <input type="text" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars($session->reservationFee); ?>" data-field="reservationFee">
                </div>
                <div class="mb-4">Start Time:
                    <input type="time" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars(substr($session->startTime, 0, 5)); ?>" data-field="startTime">
                </div>
                <div class="mb-4">End Time:
                    <input type="time" class="session-input bg-gray-200 p-2 rounded"
                        value="<?php echo htmlspecialchars(substr($session->endTime, 0, 5)); ?>" data-field="endTime">
                </div>
                <!-- Save and Delete buttons -->
                <div class="flex justify-between">
                    <button
                        class="save-session-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Save</button>
                    <button
                        class="delete-session-btn py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150"
                        data-session-id="<?php echo htmlspecialchars($session->sessionID); ?>">Delete</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="card-container p-4 md:w-1/2 lg:w-1/3">
        <div class="add-session-container bg-white shadow-md rounded-lg overflow-hidden p-6">
            <h2 class="text-xl font-semibold mb-2">Add New Session</h2>
            <!-- New Session fields -->
            <div class="mb-4">Available Seats:
                <input type="number" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="availableSeats">
            </div>
            <div class="mb-4">Prices for Adults: €
                <input type="text" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="pricesForAdults">
            </div>
            <div class="mb-4">Prices for Children: €
                <input type="text" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="pricesForChildren">
            </div>
            <div class="mb-4">Reservation Fee: €
                <input type="text" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="reservationFee">
            </div>
            <div class="mb-4">Start Time:
                <input type="time" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="startTime">
            </div>
            <div class="mb-4">End Time:
                <input type="time" class="new-session-input bg-gray-200 p-2 rounded" data-new-field="endTime">
            </div>
            <button
                class="create-session-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Create
                New Session</button>
        </div>
    </div>
</div>