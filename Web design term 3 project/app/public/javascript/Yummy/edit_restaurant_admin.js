import { setupImageUploadListener } from '../Reusables/update_image.js';
import { deleteReview, createReview } from './modules_edit_restaurant/review.js';
import { initializeCuisineTypes, addCuisine, deleteCuisineType } from './modules_edit_restaurant/cusine_types.js';
import { saveSession, deleteSession, createSession } from './modules_edit_restaurant/sessions.js';
import { deleteImageFunction, impageUploadGallery } from './modules_edit_restaurant/image_restaurant.js';

const apiUrlForImages = "/api/restaurantIndividualAdmin/updateRestaurantImages";
const containerForImagesName = "container-restaurant-info"

document.addEventListener("DOMContentLoaded", () => {

    setupImageUploadListener('imageTopInput', apiUrlForImages, containerForImagesName, 'imageTop', 'ImagePathHomepage');
    setupImageUploadListener('imageLocationInput', apiUrlForImages, containerForImagesName, 'imageLocation', 'ImagePathLocation');
    setupImageUploadListener('imageChefInput', apiUrlForImages, containerForImagesName, 'imageChef', 'ImagePathChef');

    initializeCuisineTypes();
    addCuisine();

    editRestaurant();
    saveSession();
    deleteSession();
    deleteReview();
    createSession();
    createReview();
    impageUploadGallery();
    deleteRestaurant();

    document.querySelectorAll('.delete-cuisine-btn').forEach(button => {
        button.addEventListener('click', function () {
            const type = this.previousElementSibling.textContent;
            deleteCuisineType(type);
        });
    });

    document.querySelectorAll('.delete-image-btn').forEach(button => {
        button.addEventListener('click', deleteImageFunction);
    });

});



function editRestaurant() {
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
}

function deleteRestaurant() {
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

}



