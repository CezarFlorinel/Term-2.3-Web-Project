import { setupImageUploadListener } from '../Reusables/update_image.js';
import { deleteReview, createReview } from './modules_edit_restaurant/review.js';
import { initializeCuisineTypes, addCuisine, deleteCuisineType } from './modules_edit_restaurant/cusine_types.js';
import { saveSession, deleteSession, createSession } from './modules_edit_restaurant/sessions.js';
import { deleteImageFunction, impageUploadGallery } from './modules_edit_restaurant/image_restaurant.js';
import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

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
            nameEl.contentEditable = 'false';
            locationEl.contentEditable = 'false';
            descriptionEl.contentEditable = 'false';
            descriptionSideOneEl.contentEditable = 'false';
            descriptionSideTwoEl.contentEditable = 'false';
            numberSeatsEl.readOnly = true;
            numberStarsEl.readOnly = true;

            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // collect data and send it to the server
            const id = container.getAttribute('data-id');
            const name = nameEl.innerText;
            const location = locationEl.innerText;
            const description = descriptionEl.innerText;
            const descriptionSideOne = descriptionSideOneEl.innerText;
            const descriptionSideTwo = descriptionSideTwoEl.innerText;
            const numberOfSeats = numberSeatsEl.value;
            const rating = numberStarsEl.value;

            runChecksBeforeSendingData(id, name, location, description, descriptionSideOne, descriptionSideTwo, numberOfSeats, rating);

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

function runChecksBeforeSendingData(id, name, location, description, descriptionSideOne, descriptionSideTwo, numberOfSeats, rating) {
    if (!checkText({ name, location, description, descriptionSideOne, descriptionSideTwo })) {
        return;
    }
    else if (!checkNumber(numberOfSeats) || !checkNumber(rating)) {
        return;
    }
    else if (!checkReviewStarNumber(rating)) {
        return;
    }
    else {
        fetchRestaurantData(id, name, location, description, descriptionSideOne, descriptionSideTwo, numberOfSeats, rating);
    }

}

function fetchRestaurantData(id, name, location, description, descriptionSideOne, descriptionSideTwo, numberOfSeats, rating) {
    fetch('/api/restaurantIndividualAdmin/updateRestaurantInformation', {
        method: 'PATCH',
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
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, 'fetchRestaurantData', 'edit_restaurant_admin.js');
            errorHandler.showAlert('An error occurred while updating the restaurant information, please try again later!');
        });

}


function deleteRestaurant() {
    document.getElementById('delete-restaurant-btn').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete this restaurant?')) {
            const container = document.getElementById("container-restaurant-info");
            const id = container.getAttribute('data-id');

            fetch('/api/restaurantIndividualAdmin/deleteRestaurant', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id }),
            })
                .then(handleApiResponse)
                .then(data => {
                    if (data.success) {
                        window.location.href = '/yummyHomeAdmin';
                    }
                })
                .catch(error => {
                    errorHandler.logError(error, 'deleteRestaurant', 'edit_restaurant_admin.js');
                    errorHandler.showAlert('An error occurred while deleting the restaurant, please try again later!');
                });
        }
    });

}



