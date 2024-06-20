import { handleApiResponse, checkText, checkImageSizeAndFileType } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

export function addArtist() {
    const form = document.getElementById('js_add-artist-form');
    const formData = new FormData(form);

    if (!checkText({ name: formData.get('name') })) {
        return;
    }

    const fileInputTop = document.getElementById('js_imageTopArtistInput');
    const fileInputLineup = document.getElementById('js_imageLineupInput');
    if (fileInputTop.files[0]) {

        if (!checkImageSizeAndFileType(fileInputTop.files[0])) {
            return;
        }
        formData.append('imageTop', fileInputTop.files[0]);
    }
    if (fileInputLineup.files[0]) {
        if (!checkImageSizeAndFileType(fileInputLineup.files[0])) {
            return;
        }
        formData.append('imageArtistLineup', fileInputLineup.files[0]);
    }

    fetch('/api/danceHomeAdmin/addArtist', {
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
            errorHandler.logError(error, 'addArtist', 'dance_home_admin.js');
            errorHandler.showAlert('An error occurred while creating the artist, please try again later!');
        });

}