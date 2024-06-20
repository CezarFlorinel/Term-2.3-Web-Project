import { setupImageUploadListener } from '../../Reusables/update_image.js';

const apiUpdateEventImage = '/api/homeManagement/updateEventImage';

function attachClickEventToImageForInputOfImage() {
    $('.event-container').each(function () { // for the middle part of the page events
        const container = $(this);
        const eventID = container.data('id');
        const img = container.find(`#js_imageEvent_${eventID}`);
        const input = container.find(`#js_imageEventInput_${eventID}`);

        img.on('click', function () {
            input.click();
        });
    });

    $('#js_imageLocation').on('click', function () {
        $('#js_imageLocationInput').click();
    });

    $('#js_QrCodeImage').on('click', function () {
        $('#js_QrCodeImageInput').click();
    });

    $('#js_DecorationImage').on('click', function () {
        $('#js_DecorationImageInput').click();
    });
}

function setupImageUploadListeners() {
    $('.event-container').each(function () {
        const container = $(this);
        const eventID = container.data('id');
        setupImageUploadListener(`js_imageEventInput_${eventID}`, apiUpdateEventImage, `js_containerEvent_${eventID}`, `js_imageEvent_${eventID}`);
    });
}

function setupBottomEventListeners() {
    $('.js_bottomEventContainer').each(function () {
        const container = $(this);
        const eventID = container.data('id');
        const img = container.find(`#js_bottomEventImage_${eventID}`);
        const input = container.find(`#js_bottomEventImageInput_${eventID}`);
        setupImageUploadListener(`js_bottomEventImageInput_${eventID}`, apiUpdateEventImage, `js_bottomEventContainer_${eventID}`, `js_bottomEventImage_${eventID}`);

        img.on('click', function () {
            input.click();
        });
    });
}

function setSummerNote() {
    $('.summernote').summernote({
        height: 200,
        minHeight: null,
        maxHeight: null,
        focus: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
        ]
    });
}


export { setSummerNote, setupImageUploadListeners, setupBottomEventListeners, attachClickEventToImageForInputOfImage };