import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
import { setupImageUploadListener } from '../Reusables/update_image.js';
const errorHandler = new ErrorHandler();

const imageArtistApiUrl = "/api/artistAdminManagement/updateArtistImage";
const containerForArtistImageID = "js_artistInfoIdContainer";
const imageTopColumnName = "ImageTop";
const imageArtistLineupColumnName = "ImageArtistLineupHome";

document.addEventListener("DOMContentLoaded", () => {

    const artistId = document.getElementById('js_artistInfoIdContainer').dataset.id;

    document.getElementById('js_deleteArtistButton').addEventListener('click', function () {
        if (confirm("Are you sure you want to delete this artist?")) {
            deleteArtist(artistId);
        }
    });

    document.getElementById('js_updateArtistNameButton').addEventListener('click', function () {
        updateArtistName(artistId);
    });

    setupImageUploadListener('js_imageTopInput', imageArtistApiUrl, containerForArtistImageID, 'js_imageTop', imageTopColumnName);
    setupImageUploadListener('js_imageArstistLineupInput', imageArtistApiUrl, containerForArtistImageID, 'js_imageArstistLineup', imageArtistLineupColumnName);

    document.getElementById('js_addSpotifyLinkButton').addEventListener('click', function () {
        addSpotifyLink(artistId);
    });

    document.querySelectorAll('.js_deleteSpotifyClass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            deleteSpotifyLink(id);
        });
    });

    document.getElementById('js_addCareerHighlightButton').addEventListener('click', function (event) {
        event.preventDefault();
        addCareerHighlight(artistId);
    });

    document.querySelectorAll('.js_deleteCareerHighlightButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            deleteCareerHighlight(id);
        });
    });

    document.querySelectorAll('.js_updateCareerHighlightButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
            updateCareerHighlight(id);
        });
    });


});

function deleteArtist(artistId) {
    fetch('/api/artistAdminManagement/deleteArtist', {
        method: 'DELETE',
        body: JSON.stringify({ id: artistId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/danceHomeAdmin';
            }
            else {
                errorHandler.showAlert(data.error);
            }
        })
        .catch(error => {
            errorHandler.showAlert(error);
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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('js_artistNameTitle').innerText = newName;
                }
                else {
                    errorHandler.showAlert(data.error);
                }
            })
            .catch(error => {
                errorHandler.showAlert(error);
            });
    }
    else {
        errorHandler.showAlert('Please enter a valid name.');
    }
}

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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
                else {
                    errorHandler.showAlert(data.error);
                }
            })
            .catch(error => {
                errorHandler.showAlert(error);
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`js_spotifyLinkContainer_${id}`).remove();
            }
            else {
                errorHandler.showAlert(data.error);
            }
        })
        .catch(error => {
            errorHandler.showAlert(error);
        });

}

function addCareerHighlight(artistId) {
    const form = document.getElementById('js_addCareerHighlightForm');
    const formData = new FormData(form);
    formData.append('artistID', artistId);

    const fileInput = document.getElementById('js_newImageCarrerHighlightInput');
    if (fileInput.files[0]) {
        formData.append('image', fileInput.files[0]);
    }

    fetch('/api/artistAdminManagement/addCareerHighlight', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
            else {
                errorHandler.showAlert(data.error);
            }
        })
        .catch(error => {
            errorHandler.showAlert(error);
        });

}

function updateCareerHighlight(id) {
    const data = {
        id: id,
        titleYearPeriod: document.getElementById(`js_careerHighlightTitleInput_${id}`).value,
        text: document.getElementById(`js_careerHighlightDescriptionInput_${id}`).value,
    };

    fetch('/api/artistAdminManagement/updateCareerHighlight', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Career highlight updated successfully!');
            }
            else {
                errorHandler.showAlert(data.error);
            }
        })
        .catch(error => {
            errorHandler.showAlert(error);
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`js_carrerHighlightContainer_${id}`).remove();
            }
            else {
                errorHandler.showAlert(data.error);
            }
        })
        .catch(error => {
            errorHandler.showAlert(error);
        });
}
