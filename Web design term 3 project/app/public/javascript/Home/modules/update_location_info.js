import { handleApiResponse, checkText } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


export function updateLocationInformation() {
    $('#js_saveGameEventChangesBtn').on('click', function () {
        let title = $('#js_inputGameEventTitle').val();
        let subtitle = $('#js_inputGameEventSubtitle').val();
        let description = $('#js_inputGameEventDescription').val();
        const container = document.getElementById('js_containerGameEvent');
        const id = container.getAttribute('data-id');

        let data = {
            title: title,
            subtitle: subtitle,
            description: description,
            id: id
        };

        if (!checkText({ title, subtitle, description })) {
            return;
        }

        fetch('/api/homeManagement/updateHomeGameEventDetails', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, "updateLocationInformation", "update_location_info.js");
                errorHandler.showError("An error occurred while updating the game event details. Please try again later.");
            });
    });
}