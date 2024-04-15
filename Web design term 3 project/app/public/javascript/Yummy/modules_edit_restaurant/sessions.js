
export function saveSession() {
    document.querySelectorAll('.save-session-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.card-container'); // Correctly target the closest card container
            const sessionId = card.getAttribute('data-id');
            // Gather data from all fields...
            const payload = {
                id: sessionId,
                availableSeats: card.querySelector('[data-field="availableSeats"]').value,
                pricesForAdults: card.querySelector('[data-field="pricesForAdults"]').value,
                pricesForChildren: card.querySelector('[data-field="pricesForChildren"]').value,
                reservationFee: card.querySelector('[data-field="reservationFee"]').value,
                startTime: card.querySelector('[data-field="startTime"]').value,
                endTime: card.querySelector('[data-field="endTime"]').value,
            };
            // Post payload to server...
            console.log('Saving session', payload);
            // Add fetch() call to send data to  your API here...

            fetch('/api/restaurantIndividualAdmin/updateRestaurantSession', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json', // Assuming your server expects JSON
                },
                body: JSON.stringify(payload),
            })
                .then(response => response.json())
                .then(data => {
                    alert('Session updated successfully.');
                    console.log('Success:', data); // You can remove or modify this line based on your needs
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error updating the session');
                });


        });
    });
}

export function deleteSession() {
    document.querySelectorAll('.delete-session-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.card-container');
            const sessionId = card.getAttribute('data-id');
            const confirmation = confirm('Are you sure you want to delete this session?');

            if (confirmation) {
                fetch('/api/restaurantIndividualAdmin/deleteRestaurantSession', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: sessionId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Session deleted successfully.');
                        console.log('Delete successful:', data); // Again, adjust as needed
                        this.closest('.card-container').remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error deleting the session');
                    });
            }
        });
    });
}

export function createSession() {
    const createBtn = document.querySelector('.create-session-btn');
    createBtn.addEventListener('click', function () {
        const container = this.closest('.add-session-container');
        const containerForRestaurant = document.getElementById("container-restaurant-info");
        const id = containerForRestaurant.getAttribute('data-id');
        const payload = {
            restaurantID: id,
            availableSeats: container.querySelector('[data-new-field="availableSeats"]').value,
            pricesForAdults: container.querySelector('[data-new-field="pricesForAdults"]').value,
            pricesForChildren: container.querySelector('[data-new-field="pricesForChildren"]').value,
            reservationFee: container.querySelector('[data-new-field="reservationFee"]').value,
            startTime: container.querySelector('[data-new-field="startTime"]').value,
            endTime: container.querySelector('[data-new-field="endTime"]').value,
        };

        fetch('/api/restaurantIndividualAdmin/addRestaurantSession', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        })
            .then(response => response.json())
            .then(data => {
                alert('New session created successfully.');
                console.log('Success:', data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error creating the new session');
            });
    });
}