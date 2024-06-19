import { setupImageUploadListener } from '../Reusables/update_image.js';
import { createClubLocation, deleteClubLocation, toggleEditSave } from './admin_modules/club_location.js';
import { addArtist } from './admin_modules/artist_create.js';

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
            const id = this.id.split('_')[1]; // assumes the button's ID format is 'editSaveBtn_123'
            toggleEditSave(this, id);
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[1];
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


    document.getElementById('js_addArtistButton').addEventListener('click', function () {
        addArtist();
    });



});

