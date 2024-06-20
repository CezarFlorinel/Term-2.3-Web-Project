import { handleApiResponse, checkText } from '../../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function addSpotifyLink(artistId) {
    const newLink = document.getElementById('js_spotifyLinkInput').value;

    if (checkText(newLink)) {
        fetch('/api/artistAdminManagement/addSpotifyLink', {
            method: 'POST',
            body: JSON.stringify({ artistID: artistId, spotifyLink: newLink }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'addSpotifyLink', 'spotify_link.js');
                errorHandler.showAlert('An error occurred while adding the Spotify link, please try again later!');
            });
    }
    else {
        errorHandler.showAlert('Please enter a valid link.');
    }
}

function deleteSpotifyLink(id) {

    fetch('/api/artistAdminManagement/deleteSpotifyLink', {
        method: 'DELETE',
        body: JSON.stringify({ id: id }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(handleApiResponse)
        .then(data => {
            if (data.success) {
                document.getElementById(`js_spotifyLinkContainer_${id}`).remove();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteSpotifyLink', 'spotify_link.js');
            errorHandler.showAlert('An error occurred while deleting the Spotify link, please try again later!');
        });

}

export { addSpotifyLink, deleteSpotifyLink };