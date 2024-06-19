import { checkImageSizeAndFileType } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

function uploadImage(image) {
    let formData = new FormData();
    formData.append('image', image);
    formData.append('customPageId', customPageId);

    if (!checkImageSizeAndFileType(image)) {
        return;
    }

    fetch('/api/CustomPages/addImageToCustomPage', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const imgNode = document.createElement('img');
                imgNode.src = data.imageUrl;
                imgNode.setAttribute('data-image-id', data.imageId); // Store image ID as data attribute
                $('#summernote').summernote('insertNode', imgNode);
                let content = $('#summernote').val();
                let title = document.getElementById('title').value;
                saveContent(content, title);
            } else {
                errorHandler.showAlert('Failed to upload image.');
            }
        })
        .catch(error => {
            errorHandler.logError(error, "uploadImage", "manage_images.js");
            errorHandler.showError("An error occurred while uploading the image. Please try again later.");
        });
}

function deleteImage(imageID) {
    fetch('/api/CustomPages/deleteImageFromCustomPage', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: imageID
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Image deleted');
                let content = $('#summernote').val();
                let title = document.getElementById('title').value;
                saveContent(content, title);
            } else {
                errorHandler.showAlert('Failed to delete image.');
            }
        })
        .catch(error => {
            errorHandler.logError(error, "deleteImage", "manage_images.js");
            errorHandler.showError("An error occurred while deleting the image. Please try again later.");
        });
}

export { uploadImage, deleteImage }