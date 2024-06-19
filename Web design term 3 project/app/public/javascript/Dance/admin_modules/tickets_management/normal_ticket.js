import { handleApiResponse, checkText } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function updateDanceTicket(ticketId) {
    const data = {
        danceTicketID: ticketId,
        date: document.getElementById('js_date_' + ticketId).value,
        location: document.getElementById('js_location_' + ticketId).value,
        price: document.getElementById('js_price_' + ticketId).value,
        singer: document.getElementById('js_singer_' + ticketId).value,
        maxAvailableTickets: document.getElementById('js_maxTickets_' + ticketId).value,
        sessionType: document.getElementById('js_session_' + ticketId).value,
        startTime: document.getElementById('js_startTime_' + ticketId).value,
        endTime: document.getElementById('js_endTime_' + ticketId).value
    };

    if (!checkText({ date: data.date, location: data.location, singer: data.singer, startTime: data.startTime, endTime: data.endTime })) {
        return;
    }
    if (!checkNumber(data.price) || !checkNumber(data.maxAvailableTickets)) {
        return;
    }

    // Send a PUT request to the server
    fetch('/api/danceManageTickets/updateDanceTicketInformation', {  // Update this path to your actual endpoint URL
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, 'updateDanceTicket', 'normal_ticket.js');
            errorHandler.showAlert('An error occurred while updating the ticket, please try again later!');
        });
}

function deleteDanceTicket(ticketId) {
    // Send a DELETE request to the server
    fetch('/api/danceManageTickets/deleteDanceTicket', {
        method: 'DELETE',
        body: JSON.stringify({ id: ticketId }),
        headers: { 'Content-Type': 'application/json' },
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                document.getElementById(`ticketContainer_${ticketId}`).remove();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteDanceTicket', 'normal_ticket.js');
            errorHandler.showAlert('An error occurred while deleting the ticket, please try again later!');
        });
}

function addNewTicket() {
    const form = document.querySelector('.js_createNewTicketForm');
    const formData = new FormData(form);

    if (!checkText({ date: formData.get('date'), location: formData.get('location'), singer: formData.get('singer'), startTime: formData.get('startTime'), endTime: formData.get('endTime') })) {
        return;
    }
    if (!checkNumber(formData.get('price')) || !checkNumber(formData.get('availableTickets'))) {
        return;
    }

    fetch('/api/danceManageTickets/addDanceTicket', {
        method: 'POST',
        body: formData

    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'addNewTicket', 'normal_ticket.js');
            errorHandler.showAlert('An error occurred while adding the ticket, please try again later!');
        });

}

export { updateDanceTicket, deleteDanceTicket, addNewTicket };