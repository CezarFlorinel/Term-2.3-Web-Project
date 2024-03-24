

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


    const createReservationBtn = document.querySelector('.create-new-reservation-btn');
    createReservationBtn.addEventListener('click', () => {
        const form = document.querySelector('.new-reservation-form');
        const formData = new FormData(form);
        const jsonData = {};

        formData.forEach((value, key) => {
            // Special handling for checkboxes since FormData only includes them if they're checked
            if (form.elements[key].type === 'checkbox') {
                jsonData[key] = form.elements[key].checked;
            } else {
                jsonData[key] = value;
            }
        });

        fetch('/api/YummyHomeAdmin/createReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Handle success response
                alert('Reservation created successfully');
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error); // Handle errors
                alert('Error creating reservation');
            });
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




