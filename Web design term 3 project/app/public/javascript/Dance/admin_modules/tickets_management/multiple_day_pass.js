import { handleApiResponse, checkNumber } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

export function updateMultipleDaysPass(id) {
    const data = {
        dancePassID: id,
        price: document.getElementById('js_multipleDaysPassPrice_' + id).value,
        maxPasses: document.getElementById('js_multipleDaysPassMaxAvailable_' + id).value,
    };

    if (!checkNumber(data.price) || !checkNumber(data.maxPasses)) {
        return;
    }

    fetch('/api/danceManageTickets/updateMultipleDaysDancePassInformation', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, 'updateMultipleDaysPass', 'multiple_day_pass.js');
            errorHandler.showAlert('An error occurred while updating the multiple days pass, please try again later!');
        });
}
