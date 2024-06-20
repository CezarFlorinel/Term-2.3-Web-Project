import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import { uploadImage, deleteImage } from './modules/manage_images.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


document.addEventListener('DOMContentLoaded', (event) => {

    if (isAdmin) { // is admin is taken from the main php file
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    for (let file of files) {
                        uploadImage(file);
                    }
                },
                onMediaDelete: function (target) {
                    const imageID = $(target).data('image-id');
                    if (imageID) {
                        deleteImage(imageID);
                    }
                }
            }
        });

        document.getElementById('saveContent').addEventListener('click', () => {
            const content = $('#summernote').val();
            const title = document.getElementById('title').value;
            saveContent(content, title);
        });
    }
});


function saveContent(content, title) {

    if (!checkText({ content, title })) {
        return;
    }

    fetch('/api/CustomPages/updateCustomPage', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            content: content,
            title: title,
            id: customPageId
        })
    })
        .then(handleApiResponse)
        .catch(error => {
            errorHandler.logError(error, "saveContent", "custom_page.js");
            errorHandler.showError("An error occurred while saving the content. Please try again later.");
        });
}