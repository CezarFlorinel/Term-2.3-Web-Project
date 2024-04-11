function deleteImageFromCarousel() {
    document.querySelectorAll('.grid .relative button').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.relative');
            const imagePath = container.querySelector('img').src.split('/').slice(-3).join('/'); // adjusted according to the image src structure
            const id = document.getElementById("getTheIdForTopPart").getAttribute('data-id');
            console.log(id, "aaand", imagePath);

            if (confirm('Are you sure you want to delete this image?')) {
                fetch('/api/historyadmin/deleteImageFromCarousel', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, imagePath: imagePath })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            container.remove(); // Remove the image element
                            alert(data.message);
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the image');
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

            fetch('/api/historyadmin/updateTopPartInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    informationID: id,
                    description: description,
                    subheader: subheader
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the top part');
                });
        } else {
            // Currently in view mode, switch to edit mode
            descriptionEl.contentEditable = 'true';
            subheaderEl.contentEditable = 'true';
            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });
}

export { deleteImageFromCarousel, editTopPart };