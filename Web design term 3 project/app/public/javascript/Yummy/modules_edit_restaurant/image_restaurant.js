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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.closest('.relative').remove();
                    alert('Image deleted successfully.');
                } else {
                    alert('Failed to delete image: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error deleting the image');
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

            // API endpoint
            const apiEndpoint = '/api/restaurantIndividualAdmin/addRestaurantImagePathGallery';

            fetch(apiEndpoint, {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                    return response.json(); // This parses the JSON body of the response (but can throw if not valid JSON)
                })
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

                        alert('Image uploaded successfully');
                    } else {
                        alert(`Failed to upload image: ${data.error}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while uploading the image');
                });

            // Clear the input after upload for potential subsequent uploads
            this.value = '';
        }
    });
}