

document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("edit-top-part-btn").addEventListener("click", function () {
        const container = document.getElementById("getTheIdForTopPart");
        const descriptionEl = container.querySelector('[data-type="descriptionTop"]');
        const subheaderEl = container.querySelector('[data-type="subheaderTop"]');

        // Check if we are currently editing
        const isEditing = container.hasAttribute('data-editing');

        if (isEditing) {
            // Currently in edit mode, switch to view mode and save changes
            descriptionEl.contentEditable = 'false';
            subheaderEl.contentEditable = 'false';
            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // Collect data and send it to the server
            const id = container.getAttribute('data-id');
            const description = descriptionEl.innerText;
            const subheader = subheaderEl.innerText;

            fetch('/api/YummyHomeAdmin/updateTopPartInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    pageID: id,
                    description: description,
                    subheader: subheader
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the top part');
                });
        } else {
            // Currently in view mode, switch to edit mode
            descriptionEl.contentEditable = 'true';
            subheaderEl.contentEditable = 'true';
            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });

    document.getElementById('imageTopInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'ImagePath'); // Add this line

            fetch("/api/YummyHomeAdmin/updateHomePageImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageTop").src = data.imageUrl;
                        alert("Image updated successfully.");
                    } else {
                        alert("Image upload failed: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error uploading the image");
                });
        }
    });

    document.getElementById('imageLocationsInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'LocaionsImagePathHomepage');

            fetch("/api/YummyHomeAdmin/updateHomePageImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageLocation").src = data.imageUrl;
                        alert("Image updated successfully.");
                    } else {
                        alert("Image upload failed: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error uploading the image");
                });
        }
    });

    const sessionDropdown = document.getElementById('sessionDropdown');
    if (sessionDropdown) {
        sessionDropdown.addEventListener('change', updateSessionTime);
    }
    updateSessionTime();


    document.querySelectorAll('.save-reservation-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form'); // Find the form element that the button belongs to
            const formData = new FormData(form); // Create FormData object from the form
            const reservationData = {};

            // Convert FormData entries into a regular object for JSON encoding
            for (let [key, value] of formData.entries()) {
                reservationData[key] = value;
            }

            // Convert 'active' field from string to boolean
            reservationData['active'] = formData.get('active') === 'on';

            // Send data to API using fetch
            fetch('/api/YummyHomeAdmin/updateReservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(reservationData),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Handle success response
                    alert('Reservation updated successfully');
                })
                .catch(error => {
                    console.error('Error:', error); // Handle errors
                    alert('Error updating reservation');
                });
        });
    });

    const newRestaurantDropdown = document.getElementById('newRestaurantDropdown');
    const newSessionDropdown = document.getElementById('newSessionDropdown');
    const newSessionTimeText = document.getElementById('newSessionTimeText');

    // This is a placeholder for how sessions might be organized by restaurant
    // In your actual code, this would likely come from a server request
    const sessionsByRestaurant = {
        'Restaurant A': [{ sessionID: '1', startTime: '10:00', endTime: '12:00' }, { sessionID: '2', startTime: '13:00', endTime: '15:00' }],
        'Restaurant B': [{ sessionID: '3', startTime: '11:00', endTime: '14:00' }, { sessionID: '4', startTime: '16:00', endTime: '18:00' }],
        // Add more as necessary
    };

    newRestaurantDropdown.addEventListener('change', function () {
        const selectedRestaurant = this.value;
        const sessions = sessionsByRestaurant[selectedRestaurant] || [];

        newSessionDropdown.innerHTML = ''; // Clear previous sessions
        sessions.forEach(session => {
            const option = document.createElement('option');
            option.value = session.sessionID;
            option.textContent = `${session.startTime} - ${session.endTime}`;
            newSessionDropdown.appendChild(option);
        });

        // Optionally update the session time text if only one session is available
        if (sessions.length === 1) {
            newSessionTimeText.textContent = `${sessions[0].startTime} - ${sessions[0].endTime}`;
        } else {
            newSessionTimeText.textContent = ''; // Clear if multiple or no sessions
        }
    });




});

function updateSessionTime() {
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




