import { handleApiResponse, checkText } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


export function updateMobileEventInformation() {
    $('#js_saveLocationChanges').on('click', function () {

        let description = $('#js_inputLocationDescription').val();
        const container = document.getElementById('js_containerLocation');
        const id = container.getAttribute('data-id');

        let data = {
            description: description,
            id: id
        };

        if (!checkText({ description })) {
            return;
        }

        fetch('/api/homeManagement/updateHomeFestivalLocation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, "updateMobileEventInformation", "update_mobile_event_info.js");
                errorHandler.showError("An error occurred while updating the location information. Please try again later.");
            });
    });
}
