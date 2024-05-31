import { setupImageUploadListener } from './../Reusables/update_image.js';
import { saveReservation, createNewReservation } from './modules_yummy_home_admin/reservation.js';
import { displaySession, updateSessionTime } from './modules_yummy_home_admin/session.js';
import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

const apiUrlForImages = "/api/YummyHomeAdmin/updateHomePageImages";
const getTheIdForTopPart = "getTheIdForTopPart";
const columnNameTopImage = "ImagePath";
const columnNameLocationImage = "LocaionsImagePathHomepage";

document.addEventListener("DOMContentLoaded", () => {

    const sessionDropdowns = document.querySelectorAll('.sessionDropdown');
    sessionDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function () {
            updateSessionTime(this); // Pass the current dropdown to the function
        });
        updateSessionTime(dropdown); // Update session time on page load
    });

    setupImageUploadListener('imageTopInput', apiUrlForImages, getTheIdForTopPart, 'imageTop', columnNameTopImage);
    setupImageUploadListener('imageLocationsInput', apiUrlForImages, getTheIdForTopPart, 'imageLocation', columnNameLocationImage);

    saveReservation();
    editTopPart();
    displaySession();
    createNewReservation();


});

function editTopPart() {
    document.getElementById("edit-top-part-btn").addEventListener("click", function () {
        const container = document.getElementById("getTheIdForTopPart");
        const descriptionEl = container.querySelector('[data-type="descriptionTop"]');
        const subheaderEl = container.querySelector('[data-type="subheaderTop"]');

        // Check if we are currently editing
        const isEditing = container.hasAttribute('data-editing');

        if (isEditing) {
            descriptionEl.contentEditable = 'false';
            subheaderEl.contentEditable = 'false';
            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // Collect data and send it to the server
            const id = container.getAttribute('data-id');
            const description = descriptionEl.innerText;
            const subheader = subheaderEl.innerText;

            if (!checkText({ description, subheader })) {
                location.reload();
                return;
            }
            editTopPartFetch(id, description, subheader);

        } else {
            // Currently in view mode, switch to edit mode
            descriptionEl.contentEditable = 'true';
            subheaderEl.contentEditable = 'true';
            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });

    function editTopPartFetch(id, description, subheader) {
        fetch('/api/YummyHomeAdmin/updateTopPartInformation', {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                pageID: id,
                description: description,
                subheader: subheader
            })
        }).then(handleApiResponse)
            .catch((error) => {
                errorHandler.logError(error, 'editTopPart', 'yummy_home_admin.js');
                errorHandler.showAlert('An error occured, please try again later!');
            });
    }
}





