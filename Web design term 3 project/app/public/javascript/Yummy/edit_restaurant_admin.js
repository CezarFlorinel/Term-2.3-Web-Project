
document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("edit-restaurant-btn").addEventListener("click", function () {
        const container = document.getElementById("container-restaurant-info");
        const nameEl = container.querySelector('[data-type="name"]');
        const locationEl = container.querySelector('[data-type="location"]');
        const descriptionEl = container.querySelector('[data-type="description"]');
        const descriptionSideOneEl = container.querySelector('[data-type="descriptionSideOne"]');
        const descriptionSideTwoEl = container.querySelector('[data-type="descriptionSideTwo"]');
        const numberSeatsEl = document.getElementById("numberSeats");
        const numberStarsEl = document.getElementById("numberStars");

        // Check if we are currently editing
        const isEditing = container.hasAttribute('data-editing');

        if (isEditing) {
            // Currently in edit mode, switch to view mode and save changes
            nameEl.contentEditable = 'false';
            locationEl.contentEditable = 'false';
            descriptionEl.contentEditable = 'false';
            descriptionSideOneEl.contentEditable = 'false';
            descriptionSideTwoEl.contentEditable = 'false';
            numberSeatsEl.readOnly = true;
            numberStarsEl.readOnly = true;

            this.textContent = 'Edit';
            container.removeAttribute('data-editing');

            // Collect data and send it to the server
            const id = container.getAttribute('data-id');
            const name = nameEl.innerText;
            const location = locationEl.innerText;
            const description = descriptionEl.innerText;
            const descriptionSideOne = descriptionSideOneEl.innerText;
            const descriptionSideTwo = descriptionSideTwoEl.innerText;
            const numberOfSeats = numberSeatsEl.value;
            const rating = numberStarsEl.value;

            fetch('/api/restaurantIndividualAdmin/updateRestaurantInformation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    restaurantID: id,
                    name: name,
                    location: location,
                    descriptionTopPart: description,
                    descriptionSideOne: descriptionSideOne,
                    descriptionSideTwo: descriptionSideTwo,
                    numberOfSeats: numberOfSeats,
                    rating: rating
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
                    alert('An error occurred while updating the restaurant information');
                });
        } else {
            // Currently in view mode, switch to edit mode
            nameEl.contentEditable = 'true';
            locationEl.contentEditable = 'true';
            descriptionEl.contentEditable = 'true';
            descriptionSideOneEl.contentEditable = 'true';
            descriptionSideTwoEl.contentEditable = 'true';
            numberSeatsEl.readOnly = false;
            numberStarsEl.readOnly = false;

            this.textContent = 'Save';
            container.setAttribute('data-editing', 'true');
        }
    });

    // document.getElementById('imageTopInput').addEventListener('change', function () {
    //     if (this.files && this.files[0]) {
    //         const formData = new FormData();
    //         formData.append('image', this.files[0]);
    //         const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
    //         formData.append('id', id);
    //         formData.append('columnName', 'ImagePath'); // Add this line

    //         fetch("/api/YummyHomeAdmin/updateHomePageImages", {
    //             method: "POST",
    //             body: formData,
    //         })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     document.getElementById("imageTop").src = data.imageUrl;
    //                     alert("Image updated successfully.");
    //                 } else {
    //                     alert("Image upload failed: " + data.error);
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error("Error:", error);
    //                 alert("There was an error uploading the image");
    //             });
    //     }
    // });

    // document.getElementById('imageLocationsInput').addEventListener('change', function () {
    //     if (this.files && this.files[0]) {
    //         const formData = new FormData();
    //         formData.append('image', this.files[0]);
    //         const id = document.getElementById('getTheIdForTopPart').getAttribute('data-id');
    //         formData.append('id', id);
    //         formData.append('columnName', 'LocaionsImagePathHomepage');

    //         fetch("/api/YummyHomeAdmin/updateHomePageImages", {
    //             method: "POST",
    //             body: formData,
    //         })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     document.getElementById("imageLocation").src = data.imageUrl;
    //                     alert("Image updated successfully.");
    //                 } else {
    //                     alert("Image upload failed: " + data.error);
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error("Error:", error);
    //                 alert("There was an error uploading the image");
    //             });
    //     }
    // });




});