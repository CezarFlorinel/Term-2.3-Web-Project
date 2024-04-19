<div class="card-container p-4 md:w-1/2 lg:w-1/3">
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <form class="new-reservation-form">

            <div class="mb-4">
                <label for="newRestaurantDropdown">Restaurant Name:</label>
                <select class="reservation-input bg-gray-200 p-2 rounded" name="restaurantName"
                    id="newRestaurantDropdown">
                    <option value="">Select a Restaurant</option>
                    <?php foreach ($restaurantsNameAndId as $restaurant): ?>
                        <option value="<?php echo htmlspecialchars($restaurant['Name']); ?>">
                            <?php echo htmlspecialchars($restaurant['Name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <p id="sessionTimeContent">Session Time:</p>
                Session:
                <select class="reservation-input bg-gray-200 p-2 rounded" name="session" id="newSessionDropdown">
                    <!-- Sessions will be loaded here based on selected restaurant -->
                </select>
            </div>

            <div class="mb-4">
                <label for="newFirstName">First Name:</label>
                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="firstName" id="newFirstName">
            </div>
            <div class="mb-4">
                <label for="newLastName">Last Name:</label>
                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="lastName" id="newLastName">
            </div>
            <div class="mb-4">
                <label for="newEmail">Email:</label>
                <input type="email" class="reservation-input bg-gray-200 p-2 rounded" name="email" id="newEmail">
            </div>
            <div class="mb-4">
                <label for="newPhoneNumber">Phone Number:</label>
                <input type="text" class="reservation-input bg-gray-200 p-2 rounded" name="phoneNumber"
                    id="newPhoneNumber">
            </div>
            <div class="mb-4">
                <label for="newDate">Date:</label>
                <input type="date" class="reservation-input bg-gray-200 p-2 rounded" name="date" id="newDate">
            </div>
            <div class="mb-4">
                <label for="newNumberOfAdults">Number Of Adults:</label>
                <input type="number" class="reservation-input bg-gray-200 p-2 rounded" name="numberOfAdults"
                    id="newNumberOfAdults">
            </div>
            <div class="mb-4">
                <label for="newNumberOfChildren">Number Of Children:</label>
                <input type="number" class="reservation-input bg-gray-200 p-2 rounded" name="numberOfChildren"
                    id="newNumberOfChildren">
            </div>
            <div class="mb-4">
                <label for="newComment">Comment:</label>
                <textarea class="reservation-input bg-gray-200 p-2 rounded" name="comment" id="newComment"></textarea>
            </div>
            <div class="mb-4">
                <label for="newActive">Is Reservation Active:</label>
                <input type="checkbox" class="reservation-input large-checkbox" name="active" id="newActive">
            </div>

            <button type="button"
                class="create-new-reservation-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Create
                New Reservation</button>
        </form>
    </div>
</div>