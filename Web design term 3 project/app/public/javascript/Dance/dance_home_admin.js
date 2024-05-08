import { setupImageUploadListener } from '../Reusables/update_image.js';
import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

const apiUrlForHomePageImage = "/api/danceHomeAdmin/updateImageHomePage";
const containerForHomePageImageID = "js_dance-info-id"
const apiURLForClubLocationImage = "/api/danceHomeAdmin/changeClubImage";

document.addEventListener("DOMContentLoaded", () => {

    setupImageUploadListener('imageTopInput', apiUrlForHomePageImage, containerForHomePageImageID, 'imageTop');

    document.querySelectorAll('.js_clubLocationContainerClass').forEach(container => {
        const containerID = container.id;
        const imageInputID = containerID.replace('Container', 'ImageInput');
        const imageID = containerID.replace('Container', 'Image');

        setupImageUploadListener(imageInputID, apiURLForClubLocationImage, containerID, imageID);
    });

    document.querySelectorAll('.edit-save-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1]; // Assumes the button's ID format is 'editSaveBtn_123'
            toggleEditSave(this, id);
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1]; // Assumes the button's ID format is 'deleteBtn_123'
            if (confirm("Are you sure you want to delete this club location?")) {
                deleteClubLocation(id);
            }
        });
    });

    const addButton = document.getElementById('js_addClub');
    addButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission
        createClubLocation();
    });


});

function toggleEditSave(button, id) {
    const container = document.getElementById(`js_clubLocationContainer_${id}`);
    const inputs = container.querySelectorAll('.js_input_text ');
    const views = container.querySelectorAll('.view');

    if (button.textContent === "Edit") {
        // Switch to edit mode
        inputs.forEach(input => input.classList.remove('hidden'));
        views.forEach(view => view.classList.add('hidden'));
        button.textContent = "Save";
    } else {
        let currentName = document.getElementById(`js_club_current_name_${id}`).textContent;
        currentName = currentName.trim();
        const newName = inputs[0].value;
        const location = inputs[1].value;

        fetch('/api/danceHomeAdmin/updateClubLocation', {
            method: 'PUT',
            body: JSON.stringify({ clubLocationID: id, name: newName, location: location, currentName: currentName }),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the view
                    views[0].textContent = newName;
                    document.getElementById(`js_club_current_name_${id}`).textContent = newName;
                    views[1].textContent = location;
                    inputs.forEach(input => input.classList.add('hidden'));
                    views.forEach(view => view.classList.remove('hidden'));
                    button.textContent = "Edit";
                } else {
                    console.error('Failed to update club location:', data.error);
                }
            })
            .catch(error => console.error('Error updating club location:', error));
    }
}

function deleteClubLocation(id) {
    fetch('/api/danceHomeAdmin/deleteClubLocation', {
        method: 'DELETE',
        body: JSON.stringify({ id: id })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optionally, remove the club location from the DOM or update the UI accordingly
                document.getElementById(`js_clubLocationContainer_${id}`).remove();
                console.log('Club deleted successfully');
            } else {
                console.error('Failed to delete club location:', data.error);
            }
        })
        .catch(error => console.error('Error deleting club location:', error));
}

function createClubLocation() {
    const form = document.querySelector('.js_add-club-form'); // Assuming you add a class to identify the form
    const formData = new FormData(form);

    // Handle file input separately if needed
    const fileInput = document.getElementById('js_inputNewClubImage');
    if (fileInput.files[0]) {
        formData.append('image', fileInput.files[0]);
    }


    fetch('/api/danceHomeAdmin/addClubLocation', {
        method: 'POST',
        body: formData, // FormData will be sent as multipart/form-data
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Club added successfully:', data.message);
                // Refresh or update your club locations display here
                location.reload(); // Simplest approach is to reload the page
            } else {
                console.error('Failed to add club location:', data.error);
            }
        })
        .catch(error => {
            console.error('Error adding club location:', error);
        });

    return false; // Prevent traditional form submission
}