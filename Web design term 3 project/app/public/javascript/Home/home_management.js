import { setupImageUploadListener } from './../Reusables/update_image.js';

//const api's for image uploading
const apiUpdateEventImage = '/api/homeManagement/updateEventImage';
const apiUpdateHomeFestivalLocationImage = '/api/homeManagement/updateHomeFestivalLocationImage';
const apiUpdateHomePageDetailsImage = '/api/homeManagement/updateHomePageDetailsImage';
const apiUpdateHomeGameEventDetailsImage = '/api/homeManagement/updateHomeGameEventDetailsImage';

$(document).ready(function () {

    setSummerNote();
    updateEventInformation();
    setupImageUploadListener("js_imageEventInput", apiUpdateEventImage, "js_containerEvent", "js_imageEvent");
    updateTopImage();
    updateHomePageDetailsTopPartInformation();



});

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

    $('.event-image').on('click', function () {
        $(this).siblings('.event-image-input').click();
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

}

function updateBottomEventsInformation() {

}

function updateMobileEventInformation() {

}


