import { handleApiResponse, checkText, checkImageSizeAndFileType } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

const apiUpdateHomePageDetailsImage = '/api/homeManagement/updateHomePageDetailsImage';

function updateTopImage() {
    const input = document.getElementById('js_imageTopInput');
    const container = document.getElementById('js_containerTopPart');

    container.addEventListener('click', function () {
        input.click();
    });

    input.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const id = container.getAttribute('data-id');

            const formData = new FormData();
            formData.append('image', this.files[0]);
            formData.append('id', id);

            if (!checkImageSizeAndFileType(this.files[0])) {
                return;
            }

            fetch(apiUpdateHomePageDetailsImage, {
                method: "POST",
                body: formData,
            })
                .then(handleApiResponse)
                .then(data => {
                    if (data.success) {
                        container.style.backgroundImage = `url(${data.imageUrl})`;
                    }
                })
                .catch(error => {
                    errorHandler.logError(error, "updateTopImage", "update_top_details.js");
                    errorHandler.showError("An error occurred while updating the top image. Please try again later.");
                });
        }
    });


}

function updateHomePageDetailsTopPartInformation() {
    $('#js_saveTopPartBtn').on('click', function () {
        let title = $('#js_titleTopInput').val();
        let description = $('#js_descriptionTopInput').val();
        const container = document.getElementById('js_containerTopPart');
        const id = container.getAttribute('data-id');

        let data = {
            title: title,
            description: description,
            id: id
        };

        if (!checkText({ title, description })) {
            return;
        }

        fetch('/api/homeManagement/updateHomePageDetails', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, "updateHomePageDetailsTopPartInformation", "update_top_details.js");
                errorHandler.showError("An error occurred while updating the home page details. Please try again later.");
            });
    });
}

export { updateTopImage, updateHomePageDetailsTopPartInformation };