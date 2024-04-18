<!-- Reservations Section ------------------------------------------------------- -->
<h1 class="text-3xl text-center mb-6">Reservations</h1>
<div class="flex flex-wrap -mx-4"> <!-- container for the cards -->
    <?php foreach ($restaurantReservations as $reservation): ?>
        <?php $sessions = $yummyService->getRestaurantSession($reservation->restaurantID) ?>
        <div class="card-container p-4 md:w-1/2 lg:w-1/3">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form class="reservation-form">

                    <div class="mb-4">
                        <p>Restaurant Name:
                            <?php foreach ($restaurantsNameAndId as $restaurant) {
                                if ($restaurant['RestaurantID'] == $reservation->restaurantID) {
                                    echo htmlspecialchars($restaurant['Name']);
                                }
                            } ?>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p>Session Time: <span class="sessionTimeText">
                            </span></p>
                        Session:
                        <select class="sessionDropdown reservation-input bg-gray-200 p-2 rounded" data-field="session"
                            name="session" data-sessions='<?php echo json_encode($sessions); ?>'>
                            <?php foreach ($sessions as $session): ?>
                                <option value="<?php echo trim(htmlspecialchars($session->sessionID)); ?>" <?php echo $session->sessionID == $reservation->session ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($session->sessionID); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="mb-4">First Name:
                        <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->firstName); ?>" data-field="firstName"
                            name="firstName">
                    </div>
                    <div class="mb-4">Last Name:
                        <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->lastName); ?>" data-field="lastName"
                            name="lastName">
                    </div>
                    <div class="mb-4">Email:
                        <input type="email" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->email); ?>" data-field="email" name="email">
                    </div>
                    <div class="mb-4">Phone Number:
                        <input type="text" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->phoneNumber); ?>" data-field="phoneNumber"
                            name="phoneNumber">
                    </div>

                    <div class="mb-4">Number Of Adults:
                        <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->numberOfAdults); ?>"
                            data-field="numberOfAdults" name="numberOfAdults">
                    </div>
                    <div class="mb-4">Number Of Children:
                        <input type="number" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->numberOfChildren); ?>"
                            data-field="numberOfChildren" name="numberOfChildren">
                    </div>
                    <div class="mb-4">Comment:
                        <textarea class="reservation-input bg-gray-200 p-2 rounded" data-field="comment"
                            name="comment"><?php echo htmlspecialchars($reservation->comment); ?></textarea>
                    </div>

                    <div class="mb-4">Date:
                        <input type="date" class="reservation-input bg-gray-200 p-2 rounded"
                            value="<?php echo htmlspecialchars($reservation->date); ?>" data-field="date" name="date">
                    </div>
                    <div class="mb-4">
                        <p class="activeCheckboxParagraph">Is Reservation Active:</p>
                        <input type="checkbox" class="reservation-input large-checkbox" <?php echo htmlspecialchars($reservation->isActive) ? 'checked' : ''; ?> data-field="active" name="active">
                    </div>

                    <input type="hidden" name="reservationId" value="<?php echo htmlspecialchars($reservation->ID); ?>">
                    <button type="button"
                        class="save-reservation-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Save</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Add New Reservation Card -->
    <?php include __DIR__ . '/createReservationCard.php'; ?>

</div>