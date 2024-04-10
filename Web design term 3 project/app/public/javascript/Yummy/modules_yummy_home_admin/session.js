export function displaySession() {
    const restaurantDropdown = document.getElementById('newRestaurantDropdown');
    const newSessionDropdown = document.getElementById('newSessionDropdown');
    const sessionTimeContent = document.getElementById('sessionTimeContent');

    restaurantDropdown.addEventListener('change', function () {
        const restaurantName = this.value; // Assuming the value is the restaurant name
        fetch(`/api/YummyHomeAdmin/getSessionByRestaurantName?name=${encodeURIComponent(restaurantName)}`)
            .then(response => response.json())
            .then(data => {
                // Assuming 'data' is an array of sessions for the selected restaurant
                newSessionDropdown.innerHTML = ''; // Clear existing options
                sessionTimeContent.textContent = 'Session Time: '; // Reset session time content
                data.forEach(session => {
                    const option = document.createElement('option');
                    option.value = session.sessionID;
                    option.textContent = `${session.sessionID}`; // Display session ID in dropdown
                    newSessionDropdown.appendChild(option);
                });

                // Update session times upon selecting a new session
                newSessionDropdown.onchange = () => {
                    const selectedSession = data.find(s => s.sessionID == newSessionDropdown.value);
                    if (selectedSession) {
                        const startTime = selectedSession.startTime.substring(0, 5); // Format startTime to HH:MM
                        const endTime = selectedSession.endTime.substring(0, 5); // Format endTime to HH:MM
                        sessionTimeContent.textContent = `Session Time: ${startTime} - ${endTime}`; // Update text content
                    }
                };

                // Trigger change to update times for the first session if exists
                if (newSessionDropdown.options.length > 0) {
                    newSessionDropdown.dispatchEvent(new Event('change'));
                }
            })
            .catch(error => {
                console.error('Error fetching sessions:', error);
                newSessionDropdown.innerHTML = '<option>Error loading sessions</option>';
            });
    });
}



export function updateSessionTime() {
    const sessionDataElement = document.getElementById('sessionData');
    const sessions = JSON.parse(sessionDataElement.textContent || sessionDataElement.innerText);
    const selectedSessionId = document.getElementById('sessionDropdown').value;
    const session = sessions.find(s => s.sessionID == selectedSessionId);
    if (session) {
        const formattedStartTime = session.startTime.substring(0, 5);
        const formattedEndTime = session.endTime.substring(0, 5);
        document.getElementById('sessionTimeText').textContent = `${formattedStartTime} - ${formattedEndTime}`;
    }
}
