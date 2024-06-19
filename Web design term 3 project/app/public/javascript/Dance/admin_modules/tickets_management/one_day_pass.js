import { handleApiResponse, checkText, checkNumber } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function updateOneDayPass(id) {
    const data = {
        dancePassID: id,
        date: document.getElementById('js_passOneDayDate_' + id).value,
        price: document.getElementById('js_passOneDayPrice_' + id).value,
        maxPasses: document.getElementById('js_passOneDayMaxPassesAvailable_' + id).value,
    };

    if (!checkText({ date: data.date })) {
        return;
    }
    if (!checkNumber(data.price) || !checkNumber(data.maxPasses)) {
        return;
    }

    fetch('/api/danceManageTickets/updateOneDayDancePassInformation', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, 'updateOneDayPass', 'one_day_pass.js');
            errorHandler.showAlert('An error occurred while updating the One Day Pass, please try again later!');
        });
}


function deleteOneDayPass(id) {
    fetch('/api/danceManageTickets/deleteDancePass', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: { 'Content-Type': 'application/json' },
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                document.getElementById(`passContainer_${id}`).remove();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteOneDayPass', 'one_day_pass.js');
            errorHandler.showAlert('An error occurred while deleting the One Day Pass, please try again later!');
        });
}

function addOneDayPass() {
    const form = document.querySelector('.js_createOneDayPassForm');
    const formData = new FormData(form);

    if (!checkText({ date: formData.get('date') })) {
        return;
    }
    if (!checkNumber(formData.get('price')) || !checkNumber(formData.get('maxPasses'))) {
        return;
    }

    fetch('/api/danceManageTickets/addDancePass', {
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
            errorHandler.logError(error, 'addOneDayPass', 'one_day_pass.js');
            errorHandler.showAlert('An error occurred while adding the One Day Pass, please try again later!');
        });
}

export { updateOneDayPass, deleteOneDayPass, addOneDayPass };

