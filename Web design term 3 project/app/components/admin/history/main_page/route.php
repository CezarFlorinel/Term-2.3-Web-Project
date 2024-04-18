 <!-- Route Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Route</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyRoutes as $route): ?>
                    <div id="getTheIdForRoutes" class="p-4 border-b border-gray-200 flex justify-between items-start"
                        data-id="<?php echo htmlspecialchars($route->informationID); ?>">
                        <div>
                            <p class="text-3xl text-blue-500">Location Name:</p>
                            <p data-type="locationName" class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($route->locationName); ?>

                            <p class="text-3xl text-blue-500">Location Description:</p>
                            <p data-type="locationDescription" class="text-lg font-semibold editable"
                                contenteditable="false">
                                <?php echo htmlspecialchars($route->locationDescription); ?>
                            </p>

                            <p class="text-3xl text-blue-500">Wheelchair Support:</p>
                            <div class="wheelchair-support-display">
                                <?php if ($route->wheelchairSupport): ?>
                                    <span class="checkmark text-4xl">&#10003;</span>
                                <?php else: ?>
                                    <span class="checkmark text-4xl">&#10060;</span>
                                <?php endif; ?>
                            </div>
                            <!-- Hidden checkbox for editing -->
                            <div class="wheelchair-support-edit">
                                <p> Checkbox for wheelchair support:</p>
                                <input type="checkbox" class="wheelchair-support-checkbox transform scale-125" disabled
                                    <?php echo htmlspecialchars($route->wheelchairSupport) ? 'checked' : ''; ?>>
                            </div>

                            <div>
                                <img id="imageTourPlace" src="<?php echo htmlspecialchars($route->locationImagePath); ?>"
                                    alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                                <input type="file" id="imageTourPlaceInput" class="hidden" accept="image/*">
                                <button onclick="document.getElementById('imageTourPlaceInput').click();"
                                    class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                    Image</button>
                            </div>
                        </div>
                        <button
                            class="edit-tour-place-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                    </div>
                <?php endforeach; ?>

            </div>