import { handleApiResponse, checkText } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function deleteArtist(artistId) {
    fetch('/api/artistAdminManagement/deleteArtist', {
        method: 'DELETE',
        body: JSON.stringify({ id: artistId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                window.location.href = '/danceHomeAdmin';
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteArtist', 'artist.js');
            errorHandler.showAlert('An error occurred while deleting the artist, please try again later!');
        });
}

function updateArtistName(artistId) {
    const newName = document.getElementById('js_artistNameInput').value;

    if (checkText(newName)) {
        fetch('/api/artistAdminManagement/updateArtistName', {
            method: 'PUT',
            body: JSON.stringify({ id: artistId, name: newName }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    document.getElementById('js_artistNameTitle').innerText = newName;
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'updateArtistName', 'artist.js');
                errorHandler.showAlert('An error occurred while updating the artist name, please try again later!');
            });
    }
    else {
        errorHandler.showAlert('Please enter a valid name.');
    }
}

export { deleteArtist, updateArtistName };