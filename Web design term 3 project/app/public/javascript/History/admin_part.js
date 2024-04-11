import { setupImageUploadListener } from './../Reusables/update_image.js';
import { handleEditableFieldsForQandA, addNewQuestionAndAnswer, updateHistoryPracticalInformation, deletePracticalInformation } from './modules_home_admin/history_practical_information.js';
import { handleEditableFieldsForTicketPrices, updateHistoryTicketPrices } from './modules_home_admin/ticket_prices.js';
import { editTour, editTourPlace, handleEditableFields, updateHistoryStartingPointDescription, updateHistoryTourDeparturesTimetable } from './modules_home_admin/history_tour.js';

// !!! if you do changes to HTML, some issues might occur, because of the names used in here to connect to the divs and the rest of the stuff. !!!
// check for such issues if you do changes to the HTML

const apiUrlForImagesTourStart = "/api/historyadmin/uploadAndUpdateImageForTourStartingPoint";
const containerForImagesNameTourStart = "getTheIdForTourStart";
const apiUrlForImagesTicketPrices = "/api/historyadmin/updateHistoryTicketPricesImages";
const apiUrlForImagesTourPlace = "/api/historyadmin/updateHistoryToursImages";
const apiUrlForNewImageCarousel = "/api/historyadmin/uploadNewImageCarousel";
const containerForNewImageCarousel = "getTheIdForTopPart";

document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('addImageBtnTopPart').addEventListener('click', function () {
        // Trigger the hidden file input
        document.getElementById('imageUploadInputTopPart').click();
    });

    document.querySelectorAll("#imageTourPlaceInput").forEach(input => {
        const container = input.closest('div[data-id]');
        setupImageUploadListener(input, apiUrlForImagesTourPlace, container, 'imageTourPlace');
    });

    document.querySelectorAll("#imageTicketPriceInput").forEach(input => {
        const container = input.closest('div[data-id]');
        setupImageUploadListener(input, apiUrlForImagesTicketPrices, container, 'imageTicketPrice');
    });
    // Tour Starting Point Edit button 
    document.querySelectorAll('.edit-tour-starting-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            handleEditableFields(this, updateHistoryStartingPointDescription);
        });
    });
    // Show add form
    document.querySelector(".add-practical-btn").addEventListener("click", function () {
        document.getElementById("addForm").classList.toggle("hidden");
    });

    document.querySelectorAll(".edit-practical-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            handleEditableFieldsForQandA(this, updateHistoryPracticalInformation);
        });
    });

    document.querySelectorAll(".edit-ticket-prices-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            handleEditableFieldsForTicketPrices(this, updateHistoryTicketPrices);
        });

    });

    setupImageUploadListener('imageUploadInputTopPart', apiUrlForNewImageCarousel, containerForNewImageCarousel);
    setupImageUploadListener('image1Input', apiUrlForImagesTourStart, containerForImagesNameTourStart, 'image1', 'MainImagePath');
    setupImageUploadListener('image2Input', apiUrlForImagesTourStart, containerForImagesNameTourStart, 'image2', 'SecondaryImagePath');

    deleteImageFromCarousel();
    editTopPart();
    editTourPlace();
    addNewQuestionAndAnswer();
    deletePracticalInformation();
    editDeparture();
    editTour();

});

function deleteImageFromCarousel() {
    document.querySelectorAll('.grid .relative button').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.relative');
            const imagePath = container.querySelector('img').src.split('/').slice(-3).join('/'); // adjusted according to the image src structure
            const id = document.getElementById("getTheIdForTopPart").getAttribute('data-id');
            console.log(id, "aaand", imagePath);

            if (confirm('Are you sure you want to delete this image?')) {
                fetch('/api/historyadmin/deleteImageFromCarousel', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, imagePath: imagePath })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            container.remove(); // Remove the image element
                            alert(data.message);
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the image');
                    });
            }
        });
    });

}

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

            fetch('/api/historyadmin/updateTopPartInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    informationID: id,
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

function editDeparture() {  // what is this for ?
    document.querySelectorAll(".edit-departure-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let container = this.closest("div[data-id]");
            let dateInput = container.querySelector(".date-editable");
            let isEditing = container.hasAttribute("data-editing");

            if (isEditing) {
                // Save changes
                dateInput.setAttribute("readonly", true);
                this.textContent = "Edit";
                container.removeAttribute("data-editing");
                let id = container.getAttribute("data-id");
                let date = dateInput.value;
                updateHistoryTourDeparturesTimetable(id, date);
            } else {
                // Enable editing
                dateInput.removeAttribute("readonly");
                this.textContent = "Save";
                container.setAttribute("data-editing", "true");
            }
        });
    });
}






