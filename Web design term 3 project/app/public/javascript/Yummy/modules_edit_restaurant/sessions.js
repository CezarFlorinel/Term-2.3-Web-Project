import { handleApiResponse, checkText, checkReviewStarNumber, checkNumber } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();


export function saveSession() {
    document.querySelectorAll('.save-session-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.card-container'); // Correctly target the closest card container
            const sessionId = card.getAttribute('data-id');

            const payload = {
                id: sessionId,
                availableSeats: card.querySelector('[data-field="availableSeats"]').value,
                pricesForAdults: card.querySelector('[data-field="pricesForAdults"]').value,
                pricesForChildren: card.querySelector('[data-field="pricesForChildren"]').value,
                reservationFee: card.querySelector('[data-field="reservationFee"]').value,
                startTime: card.querySelector('[data-field="startTime"]').value,
                endTime: card.querySelector('[data-field="endTime"]').value,
            };

            if (!checkSessionData(payload.availableSeats, payload.pricesForAdults, payload.pricesForChildren, payload.reservationFee, payload.startTime, payload.endTime)) {
                return;
            }

            fetch('/api/restaurantIndividualAdmin/updateRestaurantSession', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            })
                .then(handleApiResponse)
                .catch(error => {
                    errorHandler.logError(error, 'saveSession', 'sessions.js');
                    errorHandler.showAlert('An error occurred while updating the session, please try again later!');
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
                    .then(handleApiResponse)
                    .then(data => {
                        if (data.success) {
                            this.closest('.card-container').remove();
                        }
                    })
                    .catch(error => {
                        errorHandler.logError(error, 'deleteSession', 'sessions.js');
                        errorHandler.showAlert('An error occurred while deleting the session, please try again later!');
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

        if (!checkSessionData(payload.availableSeats, payload.pricesForAdults, payload.pricesForChildren, payload.reservationFee, payload.startTime, payload.endTime)) {
            return;
        }

        fetch('/api/restaurantIndividualAdmin/addRestaurantSession', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'createSession', 'sessions.js');
                errorHandler.showAlert('An error occurred while creating the session, please try again later!');
            });
    });
}

function checkSessionData(availableSeats, pricesForAdults, pricesForChildren, reservationFee, startTime, endTime) {
    if (!checkNumber(availableSeats) || !checkNumber(pricesForAdults) || !checkNumber(pricesForChildren) || !checkNumber(reservationFee)) {
        return false;
    }
    else if (!checkText(startTime) || !checkText(endTime)) {
        return false;
    }
    return true;
}
