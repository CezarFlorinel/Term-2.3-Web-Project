<!-- Tour Departures Timetable Section -->
<h1 class=" text-3xl text-center mb-6">Tour Departures Timetable</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <?php foreach ($historyTourDeparturesTimetables as $timetable): ?>
        <div class="p-4 border-b border-gray-200" data-id="<?php echo htmlspecialchars($timetable->informationID); ?>">
            <div>
                <p>Date:</p>
                <input type="date" class="date-editable text-lg font-semibold"
                    value="<?php echo htmlspecialchars($timetable->date); ?>" readonly>
                <button
                    class="edit-departure-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
            </div>
            <div class="tour-times">
                <?php $toursForThisDate = array_filter($historyTours, function ($tour) use ($timetable) {
                    return $tour->departure == $timetable->informationID;
                });
                foreach ($toursForThisDate as $tour): ?>
                    <div class="tour-info tour-details p-4" data-id="<?php echo htmlspecialchars($tour->informationID); ?>">
                        <div class="time-details">
                            <p>Start Time:
                                <input type="time" name="startTime"
                                    value="<?php echo htmlspecialchars(date('H:i', strtotime($tour->startTime))); ?>"
                                    class="editable-time" readonly>
                            </p>
                        </div>
                        <div class="language-tours">
                            <p>English: <input type="number" name="englishTour" min="1" max="3"
                                    value="<?php echo htmlspecialchars($tour->englishTour); ?>" class="tour-editable"></p>
                            <p>Dutch: <input type="number" name="dutchTour" min="1" max="3"
                                    value="<?php echo htmlspecialchars($tour->dutchTour); ?>" class="tour-editable">
                            </p>
                            <p>Chinese: <input type="number" name="chineseTour" min="1" max="3"
                                    value="<?php echo htmlspecialchars($tour->chineseTour); ?>" class="tour-editable"></p>
                        </div>
                        <button
                            class="edit-tour-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>