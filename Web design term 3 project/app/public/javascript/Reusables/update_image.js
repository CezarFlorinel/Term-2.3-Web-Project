
export function setupImageUploadListener(inputId, api, containerName, imageElementId = '', columnName = '') {
    document.getElementById(inputId).addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const container = typeof containerName === 'string' ? document.getElementById(containerName) : containerName;
            const formData = new FormData();
            formData.append('image', this.files[0]);
            formData.append('id', container.getAttribute('data-id'));

            if (columnName) { formData.append('columnName', columnName); }

            fetch(api, {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (imageElementId) {
                            document.getElementById(imageElementId).src = data.imageUrl;
                        }
                        else {
                            updateImageCarousel(data.imageUrl);
                            this.value = ''; // Clear the input field after image upload
                        }

                        alert("Image updated successfully.");
                    } else {
                        alert("Image upload failed: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error uploading the image");
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