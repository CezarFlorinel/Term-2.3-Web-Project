import { handleApiResponse, checkText, checkNumber } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function saveReservation() {
    document.querySelectorAll('.save-reservation-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form'); // Find the form element that the button belongs to
            const formData = new FormData(form);
            const reservationData = {};
            // Convert FormData entries into a regular object for JSON encoding
            for (let [key, value] of formData.entries()) {
                reservationData[key] = value;
            }
            // Convert 'active' field from string to boolean
            reservationData['active'] = formData.get('active') === 'on';
            if (!checkText(reservationData['firstName'], reservationData['lastName'], reservationData['email'], reservationData['phoneNumber'], reservationData['date'])) {
                return;
            }
            else if (!checkNumber(reservationData['numberOfAdults'], reservationData['numberOfChildren'])) {
                return;
            }


            fetch('/api/YummyHomeAdmin/updateReservation', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(reservationData),
            })
                .then(handleApiResponse)
                .catch((error) => {
                    errorHandler.logError(error, 'saveReservation', 'reservation.js');
                    errorHandler.showAlert('An error occured, please try again later!');
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

        if (!checkText(jsonData['firstName'], jsonData['lastName'], jsonData['email'], jsonData['phoneNumber'], jsonData['date'])) {
            return;
        }
        else if (!checkNumber(jsonData['numberOfAdults'], jsonData['numberOfChildren'])) {
            return;
        }

        fetch('/api/YummyHomeAdmin/createReservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    location.reload();
                    errorHandler.showAlert('Reservation created successfully.', { title: 'Success', icon: 'success' });
                }
            })
            .catch((error) => {
                errorHandler.logError(error, 'createNewReservation', 'reservation.js');
                errorHandler.showAlert('An error occured, please try again later!');
            });
    });
}