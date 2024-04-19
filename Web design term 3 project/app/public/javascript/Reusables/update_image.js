import { checkImageSizeAndFileType, handleApiResponse } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

export function setupImageUploadListener(inputId, api, containerName, imageElementId = '', columnName = '') {
    let element = null;
    if (typeof inputId === 'string') {
        element = document.getElementById(inputId);
    } else {
        element = inputId;
    }
    element.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const container = typeof containerName === 'string' ? document.getElementById(containerName) : containerName;
            const formData = new FormData();
            formData.append('image', this.files[0]);
            formData.append('id', container.getAttribute('data-id'));

            if (columnName) { formData.append('columnName', columnName); }
            if (!checkImageSizeAndFileType(this.files[0])) { return; }

            fetch(api, {
                method: "POST",
                body: formData,
            })
                .then(handleApiResponse)
                .then(data => {
                    if (data.success) {
                        if (imageElementId) {
                            document.getElementById(imageElementId).src = data.imageUrl;
                        }
                        else {
                            updateImageCarousel(data.imageUrl);
                            this.value = ''; // Clear the input field after image upload
                        }
                        errorHandler.showAlert('Image updated successfully.', { title: 'Success', icon: 'success' });
                    }
                })
                .catch((error) => {
                    errorHandler.logError(error, 'setupImageUploadListener', 'update_image.js');
                    errorHandler.showAlert('An error occured, please try again later!');
                });
        }
    });
}

function updateImageCarousel(imageUrl) {
    const gallery = document.getElementById("carouselImages");
    const newImgDiv = document.createElement('div');
    newImgDiv.className = 'relative';
    newImgDiv.innerHTML = `
                        <img src="${imageUrl}" alt="Uploaded Image" class="w-full h-auto">
                        <button class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1">Delete</button>`;
    gallery.appendChild(newImgDiv); // Add new image to the gallery
}