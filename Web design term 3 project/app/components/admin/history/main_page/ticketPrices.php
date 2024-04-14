<!-- Ticket Prices Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Ticket Prices</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <?php foreach ($historyTickets as $ticket): ?>
        <div id="getTheIdForTicketPrice" class="p-4 border-b border-gray-200 flex justify-between items-start"
            data-id="<?php echo htmlspecialchars($ticket->informationID); ?>">
            <div>
                <p>Title:</p>
                <p class="text-lg font-semibold editable" contenteditable="false">
                    <?php echo htmlspecialchars($ticket->ticketType); ?>
                <p>Prices:</p>
                <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($ticket->price); ?>"
                    class="text-lg font-semibold editable-price" contenteditable="false" readonly style="width: 100%;">
                <p>Description:</p>
                <p class="text-lg font-semibold editable" contenteditable="false">
                    <?php echo htmlspecialchars($ticket->description); ?>
                </p>
                <div>
                    <img id="imageTicketPrice" src="<?php echo htmlspecialchars($ticket->imagePath); ?>" alt="Image 1"
                        class="mt-2" style="width: 200px; height: auto;">
                    <input type="file" id="imageTicketPriceInput" class="hidden" accept="image/*">
                    <button onclick="document.getElementById('imageTicketPriceInput').click();"
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                        Image</button>
                </div>
            </div>
            <button
                class="edit-ticket-prices-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
        </div>
    <?php endforeach; ?>

</div>