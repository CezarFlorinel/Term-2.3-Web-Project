$(document).ready(function () {
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
            ['insert', ['link']],  // Removed 'picture' from insert options
            ['view', ['codeview', 'help']]
        ]
    });

    $('.save-button').on('click', function () {
        let container = $(this).closest('.event-container');
        let eventID = container.data('id-event');
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
});