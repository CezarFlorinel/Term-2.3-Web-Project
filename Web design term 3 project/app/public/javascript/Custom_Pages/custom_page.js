document.addEventListener('DOMContentLoaded', (event) => {

    if (isAdmin) {
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
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

function uploadImage(image) {
    let formData = new FormData();
    formData.append('image', image);
    formData.append('customPageId', customPageId);

    fetch('/api/CustomPages/addImageToCustomPage', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const imgNode = document.createElement('img');
                imgNode.src = data.imageUrl;
                imgNode.setAttribute('data-image-id', data.imageId); // Store image ID as data attribute
                $('#summernote').summernote('insertNode', imgNode);
                let content = $('#summernote').val();
                let title = document.getElementById('title').value;
                saveContent(content, title);
            } else {
                alert('Failed to upload image.');
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
        });
}

function deleteImage(imageID) {
    fetch('/api/CustomPages/deleteImageFromCustomPage', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: imageID
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Image deleted');
                let content = $('#summernote').val();
                let title = document.getElementById('title').value;
                saveContent(content, title);
            } else {
                alert('Failed to delete image.');
            }
        })
        .catch(error => {
            console.error('Error deleting image:', error);
        });
}

function saveContent(content, title) {
    console.log('title:', title);
    console.log('content:', content);
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Content saved successfully');
            } else {
                alert('Failed to save content.');
            }
        })
        .catch(error => {
            console.error('Error saving content:', error);
        });
}