import { handleApiResponse } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function displaySession() {
    const restaurantDropdown = document.getElementById('newRestaurantDropdown');
    const newSessionDropdown = document.getElementById('newSessionDropdown');
    const sessionTimeContent = document.getElementById('sessionTimeContent');
    console.log(restaurantDropdown);

    restaurantDropdown.addEventListener('change', function () {
        console.log('restaurantDropdown change event');
        const restaurantName = DOMPurify.sanitize(this.value);
        fetch(`/api/YummyHomeAdmin/getSessionByRestaurantName?name=${encodeURIComponent(restaurantName)}`)
            .then(handleApiResponse)
            .then(data => {
                newSessionDropdown.innerHTML = ''; // Clear existing options
                sessionTimeContent.textContent = 'Session Time: '; // Reset session time content

                if (Array.isArray(data)) {
                    data.forEach(session => {
                        console.log(session);
                        const option = document.createElement('option');
                        option.value = DOMPurify.sanitize(session.sessionID);
                        option.textContent = DOMPurify.sanitize(`${session.sessionID}`); // Display session ID in dropdown
                        newSessionDropdown.appendChild(option);
                    });
                }

                // Update session times upon selecting a new session
                newSessionDropdown.onchange = () => {
                    const selectedSession = data.find(s => s.sessionID == newSessionDropdown.value);
                    if (selectedSession) {
                        const startTime = selectedSession.startTime.substring(0, 5); // Format startTime to HH:MM
                        const endTime = selectedSession.endTime.substring(0, 5);
                        sessionTimeContent.textContent = `Session Time: ${startTime} - ${endTime}`; // Update text content
                    }
                };

                // Trigger change to update times for the first session if exists
                if (newSessionDropdown.options.length > 0) {
                    newSessionDropdown.dispatchEvent(new Event('change'));
                }

            })
            .catch(error => {
                errorHandler.logError(error, 'displaySession', 'modules_yummy_home_admin/session.js');
                errorHandler.showAlert('An error occured, please try again later!');
                newSessionDropdown.innerHTML = '<option>Error loading sessions</option>';
            });
    });
}

export function updateSessionTime(dropdown) {
    try {
        const sessions = JSON.parse(dropdown.getAttribute('data-sessions') || '[]');
        const selectedSessionId = dropdown.value.trim();
        const session = sessions.find(s => s.sessionID == selectedSessionId);

        if (session) {
            const formattedStartTime = session.startTime.substring(0, 5);
            const formattedEndTime = session.endTime.substring(0, 5);
            dropdown.closest('.card-container').querySelector('.sessionTimeText').textContent = `${formattedStartTime} - ${formattedEndTime}`;
        }
    } catch (error) {
        errorHandler.logError(error, 'updateSessionTime', 'modules_yummy_home_admin/session.js');
        errorHandler.showAlert('An error occured, please try again later!');
    }
}
