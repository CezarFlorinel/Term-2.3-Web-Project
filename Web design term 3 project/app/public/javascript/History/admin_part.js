
// !!! if you do changes to HTML, some issues might occur, because of the names used in here to connect to the divs and the rest of the stuff. !!!
// check fo such issues if you do changes to the HTML
// --- remove this problems, used id's instead of classes, so it should be fine now


const parentPage = 1; // Fixated for now, to be changed later

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('.grid .relative button').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.relative');
            const imagePath = container.querySelector('img').src.split('/').slice(-3).join('/'); // Adjust according to your image src structure
            const id = document.getElementById("getTheIdForTopPart").getAttribute('data-id');
            console.log(id, "aaand", imagePath);

            if (confirm('Are you sure you want to delete this image?')) {
                fetch('/api/historyadmin/deleteImageFromCarousel', { // Adjust the endpoint as necessary
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

    document.getElementById('addImageBtnTopPart').addEventListener('click', function () {
        // Trigger the hidden file input
        document.getElementById('imageUploadInputTopPart').click();
    });

    document.getElementById('imageUploadInputTopPart').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const formData = new FormData();
            formData.append('image', this.files[0]);

            // Get the ID from the container of the top part
            const topPartContainer = document.getElementById("getTheIdForTopPart");
            const id = topPartContainer.getAttribute('data-id');
            formData.append('id', id);

            // API endpoint
            const apiEndpoint = '/api/historyadmin/uploadNewImageCarousel'; // Adjust if necessary

            fetch(apiEndpoint, {
                method: 'POST',
                body: formData, // FormData handles the multipart/form-data headers
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Directly access the carousel since it's not a child of 'getTheIdForTopPart'
                        const gallery = document.getElementById("carouselImages");
                        const newImgDiv = document.createElement('div');
                        newImgDiv.className = 'relative';
                        newImgDiv.innerHTML = `
                        <img src="${data.imageUrl}" alt="Uploaded Image" class="w-full h-auto">
                        <button class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1">Delete</button>
                    `;
                        gallery.appendChild(newImgDiv); // Add new image to the gallery
                        alert('Image added successfully.');
                    } else {
                        alert(`Failed to upload image: ${data.error}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while uploading the image');
                });

            // Clear the input after upload for potential subsequent uploads
            this.value = '';
        }
    });

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

    document.querySelectorAll(".edit-tour-place-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = this.closest('div[data-id]');
            const id = container.getAttribute('data-id');
            const locationNameElement = container.querySelector('.editable[data-type="locationName"]');
            const locationDescriptionElement = container.querySelector('.editable[data-type="locationDescription"]');
            const wheelchairSupportCheckbox = container.querySelector('.wheelchair-support-checkbox');

            const isEditing = container.hasAttribute('data-editing');

            if (isEditing) {
                // Save the data
                const locationName = locationNameElement.innerText;
                const locationDescription = locationDescriptionElement.innerText;
                const wheelchairSupport = wheelchairSupportCheckbox.checked;

                // Send data to server
                fetch('/api/historyadmin/updateHistoryRouteInformation', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        informationID: id,
                        locationName: locationName,
                        locationDescription: locationDescription,
                        wheelchairSupport: wheelchairSupport
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating the route');
                    });

                // Toggle editing mode off
                this.textContent = 'Edit';
                locationNameElement.contentEditable = 'false';
                locationDescriptionElement.contentEditable = 'false';
                wheelchairSupportCheckbox.disabled = true;
                container.removeAttribute('data-editing');
            } else {
                // Toggle editing mode on
                this.textContent = 'Save';
                locationNameElement.contentEditable = 'true';
                locationDescriptionElement.contentEditable = 'true';
                wheelchairSupportCheckbox.disabled = false;
                container.setAttribute('data-editing', 'true');
            }
        });
    });

    document.querySelectorAll("#imageTourPlaceInput").forEach(input => {
        input.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append('image', this.files[0]); // Assuming 'image' is the field expected by your backend.
                const id = this.closest('div[data-id]').getAttribute('data-id');
                formData.append('id', id);

                fetch("/api/historyadmin/updateHistoryToursImages", {
                    method: "POST",
                    body: formData, // No headers needed, FormData sets correct multipart headers.
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById("imageTourPlace").src = data.imageUrl;
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

    // Tour Starting Point Edit button 
    document.querySelectorAll('.edit-tour-starting-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            handleEditableFields(this, updateHistoryStartingPointDescription);
        });
    });

    document.querySelectorAll("#imageTicketPriceInput").forEach(input => {
        input.addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append('image', this.files[0]); // Assuming 'image' is the field expected by your backend.
                const id = this.closest('div[data-id]').getAttribute('data-id');
                formData.append('id', id);

                fetch("/api/historyadmin/updateHistoryTicketPricesImages", {
                    method: "POST",
                    body: formData, // No headers needed, FormData sets correct multipart headers.
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById("imageTicketPrice").src = data.imageUrl;
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

    document
        .getElementById("image1Input")
        .addEventListener("change", function () {
            if (this.files && this.files[0]) {
                // Retrieve the tour ID from the data attribute
                const divElement = document.getElementById('getTheIdForTourStart');
                const dataId = divElement.getAttribute('data-id');
                uploadAndUpdateImage(
                    this.files[0],
                    "image1",
                    dataId
                );
            }
        });


    document
        .getElementById("image2Input")
        .addEventListener("change", function () {
            if (this.files && this.files[0]) {
                const divElement = document.getElementById('getTheIdForTourStart');
                const dataId = divElement.getAttribute('data-id');
                uploadAndUpdateImage(
                    this.files[0],
                    "image2",
                    dataId
                );
            }
        });

    // Show add form
    document
        .querySelector(".add-practical-btn")
        .addEventListener("click", function () {
            document.getElementById("addForm").classList.toggle("hidden");
        });

    // Add new question and answer
    document
        .getElementById("submitNewInfo")
        .addEventListener("click", function () {
            const question = document.getElementById("newQuestion").value;
            const answer = document.getElementById("newAnswer").value;
            if (question && answer) {
                addHistoryPracticalInformation(parentPage, question, answer);
            } else {
                alert("Please fill in both question and answer");
            }
        });

    document.querySelectorAll(".delete-practical-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = this.closest("div[data-id]");
            const id = container.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this item?")) {
                deleteHistoryPracticalInformation(id);
            }
        });
    });

    document.querySelectorAll(".edit-departure-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let container = this.closest("div[data-id]");
            let dateInput = container.querySelector(".date-editable");
            let isEditing = container.hasAttribute("data-editing");

            if (isEditing) {
                // Save changes
                dateInput.setAttribute("readonly", true);
                this.textContent = "Edit";
                container.removeAttribute("data-editing");
                let id = container.getAttribute("data-id");
                let date = dateInput.value;
                updateHistoryTourDeparturesTimetable(id, date);
            } else {
                // Enable editing
                dateInput.removeAttribute("readonly");
                this.textContent = "Save";
                container.setAttribute("data-editing", "true");
            }
        });
    });

    document.querySelectorAll('.edit-tour-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const container = this.closest('div[data-id]');
            const editableTextElements = container.querySelectorAll('.editable');
            const editableInputElements = container.querySelectorAll('.tour-editable, .editable-time'); // Added .editable-time for time inputs
            const isEditing = container.getAttribute('data-editing');
            const id = container.getAttribute('data-id');

            if (isEditing === 'true') {
                // Switch off editing and update information
                editableTextElements.forEach(el => {
                    el.contentEditable = 'false';
                });
                editableInputElements.forEach(el => {
                    el.readOnly = true; // Use readOnly for input elements
                });
                this.textContent = 'Edit';
                container.removeAttribute('data-editing');

                // Collecting all updated fields
                let startTime = container.querySelector('input[type="time"]').value; // Corrected for time input
                let englishTour = container.querySelector('input[name="englishTour"]').value;
                let dutchTour = container.querySelector('input[name="dutchTour"]').value;
                let chineseTour = container.querySelector('input[name="chineseTour"]').value;

                // Update tour information
                updateHistoryTour(id, startTime, englishTour, dutchTour, chineseTour);
            } else {
                // Enable editing
                editableTextElements.forEach(el => {
                    el.contentEditable = 'true';
                });
                editableInputElements.forEach(el => {
                    el.readOnly = false; // Allow editing of input fields
                });
                this.textContent = 'Save';
                container.setAttribute('data-editing', 'true');
            }
        });
    });

});

function handleEditableFieldsForTicketPrices(button, updateFunction) {
    const container = button.closest("div[data-id]");
    const editableTextElements = container.querySelectorAll(".editable");
    const editableInputElements = container.querySelectorAll(".editable-price"); // Selecting price inputs
    const isEditing = container.getAttribute("data-editing");
    const id = container.getAttribute("data-id");

    if (isEditing === "true") {
        // Switch off editing and update information
        editableTextElements.forEach(el => {
            el.contentEditable = 'false';
        });
        editableInputElements.forEach(input => {
            input.readOnly = true; // Make inputs read-only
        });

        let ticketType = editableTextElements[0].innerText; // Assuming the first editable is the type
        let price = editableInputElements[0].value; // Assuming the first input is the price
        let description = editableTextElements[1].innerText; // Assuming the second editable is the description

        button.textContent = "Edit";
        container.removeAttribute("data-editing");
        // Update ticket information
        updateFunction(id, price, ticketType, description);
    } else {
        // Enable editing
        editableTextElements.forEach(el => {
            el.contentEditable = 'true';
        });
        editableInputElements.forEach(input => {
            input.readOnly = false; // Allow inputs to be edited
        });
        button.textContent = "Save";
        container.setAttribute("data-editing", "true");
    }
}

function updateHistoryTicketPrices(id, price, type, description) {
    console.log(id, price, type, description);
    fetch("/api/historyadmin/updateHistoryTicketPricesInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            price: price,
            type: type,
            description: description,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // You can handle success or failure here, e.g., by showing a message to the user
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error updating the ticket price");
        });

}

function updateHistoryTourDeparturesTimetable(id, date) {
    fetch("/api/historyadmin/updateHistoryTourDeparturesTimetable", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            date: date,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // You can handle success or failure here, e.g., by showing a message to the user
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error updating the timetable");
        });
}

function updateHistoryTour(
    id,
    startTime,
    englishTour,
    dutchTour,
    chineseTour
) {
    fetch("/api/historyadmin/updateHistoryTour", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            startTime: startTime,
            englishTour: englishTour,
            dutchTour: dutchTour,
            chineseTour: chineseTour,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // You can handle success or failure here, e.g., by showing a message to the user
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error updating the tour");
        });
}

function handleEditableFieldsForQandA(button, updateFunction) {
    const container = button.closest("div[data-id]");
    const editableElements = container.querySelectorAll(".editable");
    const isEditing = container.getAttribute("data-editing");
    const id = container.getAttribute("data-id");

    if (isEditing === "true") {
        // Switch off editing and update information
        let question, answer;
        editableElements.forEach((el, index) => {
            el.contentEditable = false;
            // Assuming the first editable element is the question and the second is the answer
            if (index === 0) question = el.innerText;
            else if (index === 1) answer = el.innerText;
        });
        button.textContent = "Edit";
        container.removeAttribute("data-editing");
        // Call the update function with both question and answer
        updateFunction(id, question, answer);
    } else {
        // Enable editing
        editableElements.forEach((el) => {
            el.contentEditable = true;
        });
        button.textContent = "Save";
        container.setAttribute("data-editing", "true");
    }
}

function handleEditableFields(button, updateFunction) {
    const container = button.closest("div[data-id]");
    const editableElements = container.querySelectorAll(".editable");
    const isEditing = container.getAttribute("data-editing");
    const id = container.getAttribute("data-id");

    if (isEditing === "true") {
        // Switch off editing and update information
        editableElements.forEach((el) => {
            el.contentEditable = false;
        });
        button.textContent = "Edit";
        container.removeAttribute("data-editing");
        const content = editableElements[0].innerText; // Assuming first element is always the target
        updateFunction(id, content);
    } else {
        // Enable editing
        editableElements.forEach((el) => {
            el.contentEditable = true;
        });
        button.textContent = "Save";
        container.setAttribute("data-editing", "true");
    }
}

function uploadAndUpdateImage(file, imageId, tourId) {
    const formData = new FormData();
    formData.append("image", file);
    formData.append("id", tourId); // Your tour starting point's ID
    formData.append("imageId", imageId);

    fetch("/api/historyadmin/uploadAndUpdateImageForTourStartingPoint", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                document.getElementById(imageId).src = data.imageUrl; // Update the displayed image
            } else {
                alert("Image upload failed: " + data.error);
            }
        })
        .catch((error) => console.error("Error uploading image:", error));
}

function updateHistoryStartingPointDescription(id, description) {
    console.log(id, description);
    fetch("/api/historyadmin/updateHistoryTourStartingPointDescription", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            description: description,
        }),
    })
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
}

function deleteHistoryPracticalInformation(id) {
    console.log("Deleting:", id);
    fetch("/api/historyadmin/deleteHistoryPracticalInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            location.reload(); // Reload the page to remove the deleted item
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error deleting the information");
        });
}

function updateHistoryPracticalInformation(id, question, answer) {
    fetch("/api/historyadmin/updateHistoryPracticalInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json", // Correct content-type for JSON
        },
        body: JSON.stringify({
            informationID: id,
            question: question,
            answer: answer,
        }),
    })
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
}

function addHistoryPracticalInformation(parentPage, question, answer) {
    console.log(parentPage, question, answer);
    fetch("/api/historyadmin/createHistoryPracticalInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            parentPage: parentPage,
            question: question,
            answer: answer,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            location.reload(); // Reload the page to see the new entry
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error adding the information");
        });
}
