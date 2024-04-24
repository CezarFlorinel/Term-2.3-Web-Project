import { setupImageUploadListener } from './../Reusables/update_image.js';
import { handleEditableFieldsForQandA, addNewQuestionAndAnswer, updateHistoryPracticalInformation, deletePracticalInformation } from './modules_home_admin/history_practical_information.js';
import { handleEditableFieldsForTicketPrices, updateHistoryTicketPrices } from './modules_home_admin/ticket_prices.js';
import { editDeparture, editTour, editTourPlace, handleEditableFields, updateHistoryStartingPointDescription } from './modules_home_admin/history_tour.js';
import { deleteImageFromCarousel, editTopPart } from './modules_home_admin/top_part_of_page.js';

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







