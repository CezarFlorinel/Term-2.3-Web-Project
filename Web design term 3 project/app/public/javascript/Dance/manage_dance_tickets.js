import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('.js_buttonSave').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // Splitting to get the ID part from the button's ID
            updateDanceTicket(id);
        });
    });

    document.querySelectorAll('.js_buttonDelete').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // Splitting to get the ID part from the button's ID
            if (confirm("Are you sure you want to delete this ticket?")) {
                deleteDanceTicket(id);
            }
        });
    });

    document.getElementById('js_buttonAddTicket').addEventListener('click', function () {
        event.preventDefault();
        addNewTicket();
    });

    document.querySelectorAll('.js_buttonSaveOneDayPass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // Splitting to get the ID part from the button's ID
            updateOneDayPass(id);
        });
    });

    document.querySelectorAll('.js_buttonDeleteOneDayPass').forEach(button => { // lol
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // Splitting to get the ID part from the button's ID
            if (confirm("Are you sure you want to delete this One Day Pass?")) {
                deleteOneDayPass(id);
            }
        });
    });

    document.querySelectorAll('.js_buttonSaveMultipleDaysPass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // Splitting to get the ID part from the button's ID
            updateMultipleDaysPass(id);
        });
    });

    document.getElementById('js_buttonAddOneDayPass').addEventListener('click', function () {
        event.preventDefault();
        addOneDayPass();
    });

});

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

    // Send a PUT request to the server
    fetch('/api/danceManageTickets/updateDanceTicketInformation', {  // Update this path to your actual endpoint URL
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Ticket updated successfully!');
            } else {
                alert('Failed to update ticket: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error updating ticket:', error);
            alert('Error updating ticket.');
        });
}

function deleteDanceTicket(ticketId) {
    // Send a DELETE request to the server
    fetch('/api/danceManageTickets/deleteDanceTicket', {
        method: 'DELETE',
        body: JSON.stringify({ id: ticketId }),
        headers: { 'Content-Type': 'application/json' },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Ticket deleted successfully!');
                document.getElementById(`ticketContainer_${ticketId}`).remove();
            } else {
                alert('Failed to delete ticket: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error deleting ticket:', error);
            alert('Error deleting ticket.');
        });
}

function addNewTicket() {
    const form = document.querySelector('.js_createNewTicketForm');
    const formData = new FormData(form);

    fetch('/api/danceManageTickets/addDanceTicket', {
        method: 'POST',
        body: formData

    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Ticket added successfully!');
                location.reload();
            } else {
                alert('Failed to add ticket: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error adding ticket:', error);
            alert('Error adding ticket.');
        });

}

function updateOneDayPass(id) {
    const data = {
        dancePassID: id,
        date: document.getElementById('js_passOneDayDate_' + id).value,
        price: document.getElementById('js_passOneDayPrice_' + id).value,
        maxPasses: document.getElementById('js_passOneDayMaxPassesAvailable_' + id).value,
    };

    fetch('/api/danceManageTickets/updateOneDayDancePassInformation', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('One Day Pass updated successfully!');
            } else {
                alert('Failed to update One Day Pass: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error updating One Day Pass:', error);
            alert('Error updating One Day Pass.');
        });
}

function updateMultipleDaysPass(id) {
    const data = {
        dancePassID: id,
        price: document.getElementById('js_multipleDaysPassPrice_' + id).value,
        maxPasses: document.getElementById('js_multipleDaysPassMaxAvailable_' + id).value,
    };

    fetch('/api/danceManageTickets/updateMultipleDaysDancePassInformation', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Multiple Days Pass updated successfully!');
            } else {
                alert('Failed to update Multiple Days Pass: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error updating Multiple Days Pass:', error);
            alert('Error updating Multiple Days Pass.');
        });
}

function deleteOneDayPass(id) {
    fetch('/api/danceManageTickets/deleteDancePass', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: { 'Content-Type': 'application/json' },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('One Day Pass deleted successfully!');
                document.getElementById(`passContainer_${id}`).remove();
            } else {
                alert('Failed to delete One Day Pass: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error deleting One Day Pass:', error);
            alert('Error deleting One Day Pass.');
        });
}

function addOneDayPass() {
    const form = document.querySelector('.js_createOneDayPassForm');
    const formData = new FormData(form);

    fetch('/api/danceManageTickets/addDancePass', {
        method: 'POST',
        body: formData

    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('One Day Pass added successfully!');
                location.reload();
            } else {
                alert('Failed to add One Day Pass: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error adding One Day Pass:', error);
            alert('Error adding One Day Pass.');
        });
}

