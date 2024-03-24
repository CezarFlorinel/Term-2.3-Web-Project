
document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("edit-restaurant-btn").addEventListener("click", function () {
        const container = document.getElementById("container-restaurant-info");
        const nameEl = container.querySelector('[data-type="name"]');
        const locationEl = container.querySelector('[data-type="location"]');
        const descriptionEl = container.querySelector('[data-type="description"]');
        const descriptionSideOneEl = container.querySelector('[data-type="descriptionSideOne"]');
        const descriptionSideTwoEl = container.querySelector('[data-type="descriptionSideTwo"]');
        const numberSeatsEl = document.getElementById("numberSeats");
        const numberStarsEl = document.getElementById("numberStars");

        // Check if we are currently editing
        const isEditing = container.hasAttribute('data-editing');

        if (isEditing) {
            // Currently in edit mode, switch to view mode and save changes
            nameEl.contentEditable = 'false';
            locationEl.contentEditable = 'false';
            descriptionEl.contentEditable = 'false';
            descriptionSideOneEl.contentEditable = 'false';
            descriptionSideTwoEl.contentEditable = 'false';
            numberSeatsEl.readOnly = true;
            numberStarsEl.readOnly = true;

            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // Collect data and send it to the server
            const id = container.getAttribute('data-id');
            const name = nameEl.innerText;
            const location = locationEl.innerText;
            const description = descriptionEl.innerText;
            const descriptionSideOne = descriptionSideOneEl.innerText;
            const descriptionSideTwo = descriptionSideTwoEl.innerText;
            const numberOfSeats = numberSeatsEl.value;
            const rating = numberStarsEl.value;

            fetch('/api/restaurantIndividualAdmin/updateRestaurantInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    restaurantID: id,
                    name: name,
                    location: location,
                    descriptionTopPart: description,
                    descriptionSideOne: descriptionSideOne,
                    descriptionSideTwo: descriptionSideTwo,
                    numberOfSeats: numberOfSeats,
                    rating: rating
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the restaurant information');
                });
        } else {
            // Currently in view mode, switch to edit mode
            nameEl.contentEditable = 'true';
            locationEl.contentEditable = 'true';
            descriptionEl.contentEditable = 'true';
            descriptionSideOneEl.contentEditable = 'true';
            descriptionSideTwoEl.contentEditable = 'true';
            numberSeatsEl.readOnly = false;
            numberStarsEl.readOnly = false;

            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });

    initializeCuisineTypes();

    document.querySelectorAll('.delete-cuisine-btn').forEach(button => {
        button.addEventListener('click', function () {
            const type = this.previousElementSibling.textContent;
            deleteCuisineType(type);
        });
    });

    const addButton = document.getElementById('add-cuisine-btn');
    addButton.addEventListener('click', function () {
        const newTypeInput = document.getElementById('new-cuisine-type');
        const newType = newTypeInput.value.trim(); // Get the new type from the input field and trim any whitespace
        addCuisineType(newType);
        newTypeInput.value = ''; // Clear the input field after adding
    });

    document.getElementById('imageTopInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const container = document.getElementById("container-restaurant-info");
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = container.getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'ImagePathHomepage');

            fetch("/api/restaurantIndividualAdmin/updateRestaurantImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageTop").src = data.imageUrl;
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

    document.getElementById('imageLocationInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const container = document.getElementById("container-restaurant-info");
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = container.getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'ImagePathLocation');

            fetch("/api/restaurantIndividualAdmin/updateRestaurantImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageLocation").src = data.imageUrl;
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

    document.getElementById('imageChefInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const container = document.getElementById("container-restaurant-info");
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = container.getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'ImagePathChef');

            fetch("/api/restaurantIndividualAdmin/updateRestaurantImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageChef").src = data.imageUrl;
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

    document.querySelectorAll('.save-session-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.card-container'); // Correctly target the closest card container
            const sessionId = card.getAttribute('data-id');
            // Gather data from all fields...
            const payload = {
                id: sessionId,
                availableSeats: card.querySelector('[data-field="availableSeats"]').value,
                pricesForAdults: card.querySelector('[data-field="pricesForAdults"]').value,
                pricesForChildren: card.querySelector('[data-field="pricesForChildren"]').value,
                reservationFee: card.querySelector('[data-field="reservationFee"]').value,
                startTime: card.querySelector('[data-field="startTime"]').value,
                endTime: card.querySelector('[data-field="endTime"]').value,
            };
            // Post payload to server...
            console.log('Saving session', payload);
            // Add fetch() call to send data to  your API here...

            fetch('/api/restaurantIndividualAdmin/updateRestaurantSession', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Assuming your server expects JSON
                },
                body: JSON.stringify(payload),
            })
                .then(response => response.json())
                .then(data => {
                    alert('Session updated successfully.');
                    console.log('Success:', data); // You can remove or modify this line based on your needs
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error updating the session');
                });


        });
    });

    document.querySelectorAll('.delete-session-btn').forEach(button => {
        button.addEventListener('click', function () {
            const card = this.closest('.card-container');
            const sessionId = card.getAttribute('data-id');
            const confirmation = confirm('Are you sure you want to delete this session?');

            if (confirmation) {
                fetch('/api/restaurantIndividualAdmin/deleteRestaurantSession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: sessionId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Session deleted successfully.');
                        console.log('Delete successful:', data); // Again, adjust as needed
                        this.closest('.card-container').remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error deleting the session');
                    });
            }
        });
    });

    const createBtn = document.querySelector('.create-session-btn');
    createBtn.addEventListener('click', function () {
        const container = this.closest('.add-session-container');
        const containerForRestaurant = document.getElementById("container-restaurant-info");
        const id = containerForRestaurant.getAttribute('data-id');
        const payload = {
            restaurantID: id,
            availableSeats: container.querySelector('[data-new-field="availableSeats"]').value,
            pricesForAdults: container.querySelector('[data-new-field="pricesForAdults"]').value,
            pricesForChildren: container.querySelector('[data-new-field="pricesForChildren"]').value,
            reservationFee: container.querySelector('[data-new-field="reservationFee"]').value,
            startTime: container.querySelector('[data-new-field="startTime"]').value,
            endTime: container.querySelector('[data-new-field="endTime"]').value,
        };

        fetch('/api/restaurantIndividualAdmin/addRestaurantSession', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        })
            .then(response => response.json())
            .then(data => {
                alert('New session created successfully.');
                console.log('Success:', data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error creating the new session');
            });
    });

    document.querySelectorAll('.delete-review-btn').forEach(button => {
        button.addEventListener('click', function () {
            const review = this.closest('.review-container');
            const reviewId = review.getAttribute('data-id');
            const confirmation = confirm('Are you sure you want to delete this review?');

            if (confirmation) {
                fetch('/api/restaurantIndividualAdmin/deleteReview', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: reviewId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Review deleted successfully.');
                        console.log('Delete successful:', data);
                        this.closest('.review-container').remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error deleting the Review');
                    });
            }
        });
    });

    const createReviewBtn = document.querySelector('.create-review-btn');
    createReviewBtn.addEventListener('click', function () {
        // Assuming your new review form is within a container that can be uniquely identified
        const container = this.closest('.add-review-container');
        const reviewText = container.querySelector('[data-field="reviewText"]').value;
        const reviewRating = container.querySelector('[data-field="rating"]').value;
        const restaurantContainer = document.getElementById("container-restaurant-info");
        const restaurantID = restaurantContainer.getAttribute('data-id');

        const payload = {
            restaurantID: restaurantID,
            reviewText: reviewText,
            rating: reviewRating,
        };

        fetch('/api/restaurantIndividualAdmin/addReview', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        })
            .then(response => response.json())
            .then(data => {
                alert('Review created successfully.');
                console.log('Success:', data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error creating the review');
            });
    });


    document.querySelectorAll('.delete-image-btn').forEach(button => {
        button.addEventListener('click', deleteImageFunction);
    });


    document.getElementById('imageUploadGallery').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);

            // Assume you have a hidden input or another element containing restaurant ID
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
                    console.log('Raw response:', response); // Log the raw response
                    return response.json(); // This parses the JSON body of the response (but can throw if not valid JSON)
                })
                .then(data => {
                    console.log('Parsed data:', data); // Log the parsed data
                    if (data.success) {
                        // Add the uploaded image to the gallery
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

    document.getElementById('delete-restaurant-btn').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this restaurant?')) {
            const container = document.getElementById("container-restaurant-info");
            const id = container.getAttribute('data-id');

            fetch('/api/restaurantIndividualAdmin/deleteRestaurant', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Restaurant deleted successfully.');
                        window.location.href = '/yummyHomeAdmin';
                    } else {
                        alert('Failed to delete restaurant: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error deleting the restaurant');
                });
        }
    });

});


function deleteImageFunction() {
    const imageId = this.getAttribute('data-image-id');
    const imagePath = this.getAttribute('data-image-path');

    if (confirm('Are you sure you want to delete this image?')) {
        fetch('/api/restaurantIndividualAdmin/deleteImageGallery', {
            method: 'POST',
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

let cuisineTypes = []; // will hold the current state of cuisine types

function initializeCuisineTypes() {
    // Populate the initial cuisineTypes array from the HTML
    document.querySelectorAll('.cuisine-type').forEach(element => {
        cuisineTypes.push(element.textContent);
    });
}

function updateCuisineDisplay() {
    const container = document.querySelector('.container-cuisine-types');
    container.innerHTML = '';
    cuisineTypes.forEach(type => {
        const typeElement = document.createElement('div');
        typeElement.className = 'bg-gray-300 rounded-full m-1 flex items-center';
        typeElement.innerHTML = `
            <p class="text-lg font-semibold text-black-500 bg-gray-300 rounded-full px-2 py-1 m-1 cuisine-type">${type}</p>
            <button onclick="deleteCuisineType('${type}')" class="py-1 px-2 bg-red-500 text-white rounded-full hover:bg-red-700 transition duration-150">Delete</button>
        `;
        container.appendChild(typeElement);
    });
}

function addCuisineType(newType) {
    if (newType && !cuisineTypes.includes(newType)) {
        console.log('Adding new type:', newType);
        cuisineTypes.push(newType);
        for (let i = 0; i < cuisineTypes.length; i++) {
            console.log(cuisineTypes[i]);
        }
        updateCuisineDisplay();
        sendCuisineUpdate();
    }
}

function deleteCuisineType(cuisineType) {
    const index = cuisineTypes.indexOf(cuisineType);
    if (index > -1) {
        cuisineTypes.splice(index, 1);
        updateCuisineDisplay();
        sendCuisineUpdate();
    }
}

function sendCuisineUpdate() {
    const container = document.getElementById("container-restaurant-info");
    const id = container.getAttribute('data-id');

    let trimmedCuisineTypes = cuisineTypes.map(type => type.trim());
    let cuisineString = trimmedCuisineTypes.join(';');

    const data = JSON.stringify({
        restaurantID: id,
        cuisineTypes: cuisineString
    });

    fetch('/api/restaurantIndividualAdmin/updateRestaurantCuisineTypes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(response => response.json())
        .then(data => console.log('Success:', data))
        .catch((error) => {
            console.error('Error:', error);
        });
}