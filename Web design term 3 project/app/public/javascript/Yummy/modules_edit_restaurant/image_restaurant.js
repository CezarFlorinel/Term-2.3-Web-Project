import { handleApiResponse, checkImageSizeAndFileType } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();


export function deleteImageFunction() {
    const imageId = this.getAttribute('data-image-id');
    const imagePath = this.getAttribute('data-image-path');

    if (confirm('Are you sure you want to delete this image?')) {
        fetch('/api/restaurantIndividualAdmin/deleteImageGallery', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: imageId, imagePath: imagePath }),
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    this.closest('.relative').remove();
                    errorHandler.showAlert('Image deleted successfully', { title: 'Success', icon: 'success' });
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'deleteImageFunction', 'image_restaurant.js');
                errorHandler.showAlert('An error occurred while deleting the image, please try again later!');
            });
    }
}

export function impageUploadGallery() {
    document.getElementById('imageUploadGallery').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);

            const restaurantContainer = document.getElementById("container-restaurant-info");
            const id = restaurantContainer.getAttribute('data-id');
            formData.append('restaurantID', id);  // Add restaurant ID to formData

            if (!checkImageSizeAndFileType(this.files[0])) {
                return;
            }

            const apiEndpoint = '/api/restaurantIndividualAdmin/addRestaurantImagePathGallery';

            fetch(apiEndpoint, {
                method: 'POST',
                body: formData,
            })
                .then(handleApiResponse)
                .then(data => {
                    if (data.success) {
                        const imagesGallery = document.getElementById('imagesGallery');
                        const newImageDiv = document.createElement('div');
                        newImageDiv.className = 'relative';
                        newImageDiv.innerHTML = `
                        <img src="${data.imageUrl}" alt="Uploaded Image" class="w-full h-auto">
                        <button class="delete-image-btn absolute top-0 right-0 bg-red-500 text-white px-2 py-1"
                        data-image-id="${data.imageId}" data-image-path="${data.imageUrl}">Delete</button>`;
                        imagesGallery.appendChild(newImageDiv);

                        // Attach event listener for deletion to the new delete button
                        newImageDiv.querySelector('.delete-image-btn').addEventListener('click', deleteImageFunction);

                        errorHandler.showAlert('Image uploaded successfully', { title: 'Success', icon: 'success' });
                    }
                })
                .catch(error => {
                    errorHandler.logError(error, 'impageUploadGallery', 'image_restaurant.js');
                    errorHandler.showAlert('An error occurred while uploading the image, please try again later!');
                });

            // Clear the input after upload for potential subsequent uploads
            this.value = '';
        }
    });
}