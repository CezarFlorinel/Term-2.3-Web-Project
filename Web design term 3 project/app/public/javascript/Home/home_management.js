import { setupImageUploadListener } from './../Reusables/update_image.js';

//const api's for image uploading
const apiUpdateEventImage = '/api/homeManagement/updateEventImage';
const apiUpdateHomeFestivalLocationImage = '/api/homeManagement/updateHomeFestivalLocationImage';
const apiUpdateHomePageDetailsImage = '/api/homeManagement/updateHomePageDetailsImage';
const apiUpdateHomeGameEventDetailsImage = '/api/homeManagement/updateHomeGameEventDetailsImage';

const columnNameGameEventImageQRcode = 'ImageQRcodePath';
const columnNameGameEventImageDecoration = 'ImageDexterPath';

$(document).ready(function () {

    setSummerNote();
    updateEventInformation();

    setupImageUploadListeners();
    setupBottomEventListeners();
    setupImageUploadListener("js_imageLocationInput", apiUpdateHomeFestivalLocationImage, "js_containerLocation", "js_imageLocation");
    setupImageUploadListener("js_QrCodeImageInput", apiUpdateHomeGameEventDetailsImage, "js_containerGameEvent", "js_QrCodeImage", columnNameGameEventImageQRcode);
    setupImageUploadListener("js_DecorationImageInput", apiUpdateHomeGameEventDetailsImage, "js_containerGameEvent", "js_DecorationImage", columnNameGameEventImageDecoration);

    updateTopImage();
    updateHomePageDetailsTopPartInformation();
    attachClickEventToImageForInputOfImage()
    updateBottomEventInformation();
    updateLocationInformation();
    updateMobileEventInformation();

});
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

function updateEventInformation() {
    $('.save-button').on('click', function () {
        let container = $(this).closest('.event-container');
        let eventID = container.data('id'); // changed from data-id
        let title = container.find('.event-title').val();
        let description = container.find('.event-description').val();
        let link = container.find('.event-link').val();

        let data = {
            id: eventID,
            description: description,
            link: link,
            subtitle: title
        };

        fetch('/api/homeManagement/updateEventInformation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Event Information updated successfully');
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    });


}

function updateBottomEventInformation() {
    $('.js_saveButtonBottomPartEvents').on('click', function () {
        let container = $(this).closest('.js_bottomEventContainer');
        let eventID = container.data('id'); // changed from data-id
        let title = container.find('.js_bottomEventTitle').val();
        let description = container.find('.js_bottomEventDescription').val();

        let data = {
            id: eventID,
            description: description,
            subtitle: title
        };

        fetch('/api/homeManagement/updateEventInformation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Event Information updated successfully');
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    });


}

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

            fetch(apiUpdateHomePageDetailsImage, {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        container.style.backgroundImage = `url(${data.imageUrl})`;
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
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

        fetch('/api/homeManagement/updateHomePageDetails', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Home Page Details updated successfully');
                }
            })
            .catch(error => console.error('Error:', error));
    });
}

function updateLocationInformation() {
    $('#js_saveGameEventChangesBtn').on('click', function () {
        let title = $('#js_inputGameEventTitle').val();
        let subtitle = $('#js_inputGameEventSubtitle').val();
        let description = $('#js_inputGameEventDescription').val();
        const container = document.getElementById('js_containerGameEvent');
        const id = container.getAttribute('data-id');

        let data = {
            title: title,
            subtitle: subtitle,
            description: description,
            id: id
        };

        fetch('/api/homeManagement/updateHomeGameEventDetails', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(' Details updated successfully');
                }
            })
            .catch(error => console.error('Error:', error));
    });
}

function updateMobileEventInformation() {
    $('#js_saveLocationChanges').on('click', function () {

        let description = $('#js_inputLocationDescription').val();
        const container = document.getElementById('js_containerLocation');
        const id = container.getAttribute('data-id');

        let data = {
            description: description,
            id: id
        };

        fetch('/api/homeManagement/updateHomeFestivalLocation', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(' Details updated successfully');
                }
            })
            .catch(error => console.error('Error:', error));
    });
}


