import { handleApiResponse, checkText, checkNumber } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();


function deleteImageFromCarousel() {
    document.querySelectorAll('.grid .relative button').forEach(button => {  // change this to an id or something
        button.addEventListener('click', function () {
            const container = this.closest('.relative');
            // Decode the URL-encoded src path
            const imagePath = decodeURIComponent(container.querySelector('img').src).split('/').slice(-3).join('/');
            const id = document.getElementById("getTheIdForTopPart").getAttribute('data-id');

            if (confirm('Are you sure you want to delete this image?')) {
                fetch('/api/historyadmin/deleteImageFromCarousel', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, imagePath: imagePath })
                })
                    .then(handleApiResponse)
                    .then(data => {
                        if (data.success) {
                            container.remove(); // Remove the image element
                        }
                    })
                    .catch(error => {
                        errorHandler.logError(error, 'deleteImageFromCarousel', 'top_part_of_page.js');
                        errorHandler.showError('An error occurred while deleting the image');
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

            fetchEditTopPart(id, description, subheader);

        } else {
            // Currently in view mode, switch to edit mode
            descriptionEl.contentEditable = 'true';
            subheaderEl.contentEditable = 'true';
            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });
}

function fetchEditTopPart(id, description, subheader) {

    fetch('/api/historyadmin/updateTopPartInformation', {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            informationID: id,
            description: description,
            subheader: subheader
        })
    })
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, 'fetchEditTopPart', 'top_part_of_page.js');
            errorHandler.showError('An error occurred while updating the top part information');
        });
}

export { deleteImageFromCarousel, editTopPart };