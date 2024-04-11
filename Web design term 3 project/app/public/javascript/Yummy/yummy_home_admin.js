import { setupImageUploadListener } from './../Reusables/update_image.js';
import { saveReservation, createNewReservation } from './modules_yummy_home_admin/reservation.js';
import { displaySession, updateSessionTime } from './modules_yummy_home_admin/session.js';

const apiUrlForImages = "/api/YummyHomeAdmin/updateHomePageImages";
const getTheIdForTopPart = "getTheIdForTopPart";

document.addEventListener("DOMContentLoaded", () => {

    const sessionDropdowns = document.querySelectorAll('.sessionDropdown');
    sessionDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function () {
            updateSessionTime(this); // Pass the current dropdown to the function
        });
        updateSessionTime(dropdown); // Update session time on page load
    });

    sessionDropdowns.forEach(dropdown => updateSessionTime(dropdown)); // Update session time on page load

    setupImageUploadListener('imageTopInput', apiUrlForImages, getTheIdForTopPart, 'imageTop', 'ImagePath');
    setupImageUploadListener('imageLocationsInput', apiUrlForImages, getTheIdForTopPart, 'imageLocation', 'ImagePathHomepage');

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
            // Currently in edit mode, switch to view mode and save changes
            descriptionEl.contentEditable = 'false';
            subheaderEl.contentEditable = 'false';
            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // Collect data and send it to the server
            const id = container.getAttribute('data-id');
            const description = descriptionEl.innerText;
            const subheader = subheaderEl.innerText;

            fetch('/api/YummyHomeAdmin/updateTopPartInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    pageID: id,
                    description: description,
                    subheader: subheader
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
                    alert('An error occurred while updating the top part');
                });
        } else {
            // Currently in view mode, switch to edit mode
            descriptionEl.contentEditable = 'true';
            subheaderEl.contentEditable = 'true';
            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });
}





