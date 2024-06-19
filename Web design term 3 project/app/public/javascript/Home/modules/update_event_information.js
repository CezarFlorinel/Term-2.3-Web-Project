import { handleApiResponse, checkText } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


function updateEventInformation() {
    $('.save-button').on('click', function () {
        let container = $(this).closest('.event-container');
        let eventID = container.data('id'); // changed from data-id
        let title = container.find('.event-title').val();
        let description = container.find('.event-description').val();
        let link = container.find('.event-link').val();

        let data = {
            id: eventID,
            description: description,
            link: link,
            subtitle: title
        };

        if (!checkText({ title, description, link })) {
            return;
        }

        fetch('/api/homeManagement/updateEventInformation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, "updateEventInformation", "update_event_information.js");
                errorHandler.showError("An error occurred while updating the event information. Please try again later.");
            });
    });


}

function updateBottomEventInformation() {
    $('.js_saveButtonBottomPartEvents').on('click', function () {
        let container = $(this).closest('.js_bottomEventContainer');
        let eventID = container.data('id'); // changed from data-id
        let title = container.find('.js_bottomEventTitle').val();
        let description = container.find('.js_bottomEventDescription').val();

        let data = {
            id: eventID,
            description: description,
            subtitle: title
        };

        if (!checkText({ title, description })) {
            return;
        }

        fetch('/api/homeManagement/updateEventInformation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, "updateBottomEventInformation", "update_event_information.js");
                errorHandler.showError("An error occurred while updating the event information. Please try again later.");
            });
    });


}

export { updateEventInformation, updateBottomEventInformation };