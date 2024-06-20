import { handleApiResponse, checkText, checkImageSizeAndFileType } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function toggleEditSave(button, id) {
    const container = document.getElementById(`js_clubLocationContainer_${id}`);
    const inputs = container.querySelectorAll('.js_input_text ');
    const views = container.querySelectorAll('.view');

    if (button.textContent === "Edit") {
        // Switch to edit mode
        inputs.forEach(input => input.classList.remove('hidden'));
        views.forEach(view => view.classList.add('hidden'));
        button.textContent = "Save";
    } else {
        let currentName = document.getElementById(`js_club_current_name_${id}`).textContent;
        currentName = currentName.trim();
        const newName = inputs[0].value;
        const location = inputs[1].value;
        if (!checkText({ newName, location })) {
            return;
        }

        fetch('/api/danceHomeAdmin/updateClubLocation', {
            method: 'PUT',
            body: JSON.stringify({ clubLocationID: id, name: newName, location: location, currentName: currentName }),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    // Update the view
                    views[0].textContent = newName;
                    document.getElementById(`js_club_current_name_${id}`).textContent = newName;
                    views[1].textContent = location;
                    inputs.forEach(input => input.classList.add('hidden'));
                    views.forEach(view => view.classList.remove('hidden'));
                    button.textContent = "Edit";
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'toggleEditSave', 'club_location.js');
                errorHandler.showAlert('An error occurred while updating the club location, please try again later!');
            });
    }
}

function deleteClubLocation(id) {
    fetch('/api/danceHomeAdmin/deleteClubLocation', {
        method: 'DELETE',
        body: JSON.stringify({ id: id })
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                document.getElementById(`js_clubLocationContainer_${id}`).remove();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteClubLocation', 'club_location.js');
            errorHandler.showAlert('An error occurred while deleting the club location, please try again later!');
        });
}

function createClubLocation() {
    const form = document.querySelector('.js_add-club-form');
    const formData = new FormData(form);

    // handle file input separately
    const fileInput = document.getElementById('js_inputNewClubImage');

    if (!checkText({ name: formData.get('name'), location: formData.get('location') })) {
        return;
    }
    if (fileInput.files[0]) {
        if (!checkImageSizeAndFileType(fileInput.files[0])) {
            return;
        }
        formData.append('image', fileInput.files[0]);
    }

    fetch('/api/danceHomeAdmin/addClubLocation', {
        method: 'POST',
        body: formData,
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'createClubLocation', 'club_location.js');
            errorHandler.showAlert('An error occurred while creating the club location, please try again later!');
        });

    return false; // Prevent traditional form submission

}


export { createClubLocation, deleteClubLocation, toggleEditSave };