



document.addEventListener("DOMContentLoaded", () => {

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

            fetch('/api/YummyHomeAdmin/updateTopPartInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    pageID: id,
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

    document.getElementById('imageTopInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'ImagePath'); // Add this line

            fetch("/api/YummyHomeAdmin/updateHomePageImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageTop").src = data.imageUrl;
                        alert("Image updated successfully.");
                    } else {
                        alert("Image upload failed: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error uploading the image");
                });
        }
    });

    document.getElementById('imageLocationsInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);
            const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
            formData.append('id', id);
            formData.append('columnName', 'LocaionsImagePathHomepage');

            fetch("/api/YummyHomeAdmin/updateHomePageImages", {
                method: "POST",
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("imageLocation").src = data.imageUrl;
                        alert("Image updated successfully.");
                    } else {
                        alert("Image upload failed: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("There was an error uploading the image");
                });
        }
    });




});




