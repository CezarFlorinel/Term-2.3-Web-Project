import { setupImageUploadListener } from '../Reusables/update_image.js';
import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

const apiUrlForImages = "/api/danceIndividualAdmin/updateDanceImages";
const containerForImagesName = "container-dance-info"

document.addEventListener("DOMContentLoaded", () => {

    setupImageUploadListener('imageTopInput', apiUrlForImages, containerForImagesName, 'imageTop', 'ImagePathHomepage');

});



function editClubLocation() {

}

function deleteClubLocation() {

}

function createClubLocation() {
}