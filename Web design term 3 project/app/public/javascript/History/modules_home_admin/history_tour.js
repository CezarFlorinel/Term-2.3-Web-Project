import { handleApiResponse, checkText, checkNumber } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();


function updateHistoryTour(id, startTime, englishTour, dutchTour, chineseTour) {
    fetch("/api/historyadmin/updateHistoryTour", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            startTime: startTime,
            englishTour: englishTour,
            dutchTour: dutchTour,
            chineseTour: chineseTour,
        }),
    })
        .then(handleApiResponse)
        .catch((error) => {
            errorHandler.logError(error, "updateHistoryTour", "history_tour.js");
            errorHandler.showError("An error occurred while updating the tour.");
        });
}

function editTour() {
    document.querySelectorAll('.edit-tour-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const container = this.closest('div[data-id]');
            const editableTextElements = container.querySelectorAll('.editable');
            const editableInputElements = container.querySelectorAll('.tour-editable, .editable-time'); // Added .editable-time for time inputs
            const isEditing = container.getAttribute('data-editing');
            const id = container.getAttribute('data-id');

            if (isEditing === 'true') {
                // Switch off editing and update information
                editableTextElements.forEach(el => {
                    el.contentEditable = 'false';
                });
                editableInputElements.forEach(el => {
                    el.readOnly = true; // Use readOnly for input elements
                });
                this.textContent = 'Edit';
                container.removeAttribute('data-editing');

                // Collecting all updated fields
                let startTime = container.querySelector('input[type="time"]').value;
                let englishTour = container.querySelector('input[name="englishTour"]').value;
                let dutchTour = container.querySelector('input[name="dutchTour"]').value;
                let chineseTour = container.querySelector('input[name="chineseTour"]').value;

                updateHistoryTour(id, startTime, englishTour, dutchTour, chineseTour);
            } else {
                // Enable editing
                editableTextElements.forEach(el => {
                    el.contentEditable = 'true';
                });
                editableInputElements.forEach(el => {
                    el.readOnly = false; // Allow editing of input fields
                });
                this.textContent = 'Save';
                container.setAttribute('data-editing', 'true');
            }
        });
    });

}

function editTourPlace() {
    document.querySelectorAll(".edit-tour-place-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = this.closest('div[data-id]');
            const id = container.getAttribute('data-id');
            const locationNameElement = container.querySelector('.editable[data-type="locationName"]');
            const locationDescriptionElement = container.querySelector('.editable[data-type="locationDescription"]');
            const wheelchairSupportCheckbox = container.querySelector('.wheelchair-support-checkbox');
            const isEditing = container.hasAttribute('data-editing');

            if (isEditing) {
                // Save the data
                const locationName = locationNameElement.innerText;
                const locationDescription = locationDescriptionElement.innerText;
                const wheelchairSupport = wheelchairSupportCheckbox.checked;

                fetchUpdateHistoryRouteInformation(id, locationName, locationDescription, wheelchairSupport);

                // Toggle editing mode off
                this.textContent = 'Edit';
                locationNameElement.contentEditable = 'false';
                locationDescriptionElement.contentEditable = 'false';
                wheelchairSupportCheckbox.disabled = true;
                container.removeAttribute('data-editing');
            } else {
                // Toggle editing mode on
                this.textContent = 'Save';
                locationNameElement.contentEditable = 'true';
                locationDescriptionElement.contentEditable = 'true';
                wheelchairSupportCheckbox.disabled = false;
                container.setAttribute('data-editing', 'true');
            }
        });
    });
}

function fetchUpdateHistoryRouteInformation(id, locationName, locationDescription, wheelchairSupport) {

    if (!checkText({ locationName, locationDescription })) {
        return;
    }

    fetch('/api/historyadmin/updateHistoryRouteInformation', {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            informationID: id,
            locationName: locationName,
            locationDescription: locationDescription,
            wheelchairSupport: wheelchairSupport
        }),
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.message) {
                alert(data.message);
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'fetchUpdateHistoryRouteInformation', 'history_tour.js');
            errorHandler.showError('An error occurred while updating the tour place.');
        });

}

function handleEditableFields(button, updateFunction) {
    const container = button.closest("div[data-id]");
    const editableElements = container.querySelectorAll(".editable");
    const isEditing = container.getAttribute("data-editing");
    const id = container.getAttribute("data-id");

    if (isEditing === "true") {
        // Switch off editing and update information
        editableElements.forEach((el) => {
            el.contentEditable = false;
        });
        button.textContent = "Edit";
        container.removeAttribute("data-editing");
        const content = editableElements[0].innerText;
        updateFunction(id, content);
    } else {
        // Enable editing
        editableElements.forEach((el) => {
            el.contentEditable = true;
        });
        button.textContent = "Save";
        container.setAttribute("data-editing", "true");
    }
}

function updateHistoryStartingPointDescription(id, description) {

    if (!checkText({ description })) {
        return;
    }

    fetch("/api/historyadmin/updateHistoryTourStartingPointDescription", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            description: description,
        }),
    })
        .then(handleApiResponse)
        .catch((error) => {
            errorHandler.logError(error, "updateHistoryStartingPointDescription", "history_tour.js");
            errorHandler.showError("An error occurred while updating the starting point description.");
        });
}

function updateHistoryTourDeparturesTimetable(id, date) {

    if (!date) {
        errorHandler.showError("Please enter a date");
        return;
    }

    fetch("/api/historyadmin/updateHistoryTourDeparturesTimetable", {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            date: date,
        }),
    })
        .then(handleApiResponse)
        .catch((error) => {
            errorHandler.logError(error, "updateHistoryTourDeparturesTimetable", "history_tour.js");
            errorHandler.showError("An error occurred while updating the tour departure timetable.");
        });
}

function editDeparture() {
    document.querySelectorAll(".edit-departure-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let container = this.closest("div[data-id]");
            let dateInput = container.querySelector(".date-editable");
            let isEditing = container.hasAttribute("data-editing");

            if (isEditing) {
                // Save changes
                dateInput.setAttribute("readonly", true);
                this.textContent = "Edit";
                container.removeAttribute("data-editing");
                let id = container.getAttribute("data-id");
                let date = dateInput.value;
                updateHistoryTourDeparturesTimetable(id, date);
            } else {
                // Enable editing
                dateInput.removeAttribute("readonly");
                this.textContent = "Save";
                container.setAttribute("data-editing", "true");
            }
        });
    });
}


export { editDeparture, editTour, editTourPlace, handleEditableFields, updateHistoryStartingPointDescription, updateHistoryTourDeparturesTimetable };