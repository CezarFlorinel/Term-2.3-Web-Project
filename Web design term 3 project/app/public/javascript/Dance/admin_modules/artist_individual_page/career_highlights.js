import { handleApiResponse, checkText } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function addCareerHighlight(artistId) {
    const form = document.getElementById('js_addCareerHighlightForm');
    const formData = new FormData(form);
    formData.append('artistID', artistId);

    const fileInput = document.getElementById('js_newImageCarrerHighlightInput');
    if (fileInput.files[0]) {
        formData.append('image', fileInput.files[0]);
        if (!checkImageSizeAndFileType(fileInput.files[0])) {
            return;
        }
    }
    if (!checkText({ titleAndYearPeriod: formData.get('titleAndYearPeriod'), text: formData.get('text') })) {
        return;
    }

    fetch('/api/artistAdminManagement/addCareerHighlight', {
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
            errorHandler.logError(error, 'addCareerHighlight', 'career_highlights.js');
            errorHandler.showAlert('An error occurred while adding the career highlight, please try again later!');
        });

}

function updateCareerHighlight(id) {
    const data = {
        id: id,
        titleYearPeriod: document.getElementById(`js_careerHighlightTitleInput_${id}`).value,
        text: document.getElementById(`js_careerHighlightDescriptionInput_${id}`).value,
    };

    if (!checkText({ titleAndYearPeriod: data.titleYearPeriod, text: data.text })) {
        return;
    }

    fetch('/api/artistAdminManagement/updateCareerHighlight', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                alert('Career highlight updated successfully!');
            }

        })
        .catch(error => {
            errorHandler.logError(error, 'updateCareerHighlight', 'career_highlights.js');
            errorHandler.showAlert('An error occurred while updating the career highlight, please try again later!');
        });
}

function deleteCareerHighlight(id) {
    fetch('/api/artistAdminManagement/deleteCareerHighlight', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                document.getElementById(`js_carrerHighlightContainer_${id}`).remove();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteCareerHighlight', 'career_highlights.js');
            errorHandler.showAlert('An error occurred while deleting the career highlight, please try again later!');
        });
}

export { addCareerHighlight, updateCareerHighlight, deleteCareerHighlight };