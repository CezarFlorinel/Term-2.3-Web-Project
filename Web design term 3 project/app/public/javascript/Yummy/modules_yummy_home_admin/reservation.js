export function saveReservation() {
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
}

export function createNewReservation() {
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
}