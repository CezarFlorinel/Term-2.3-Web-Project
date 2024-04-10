import { setupImageUploadListener } from './../Reusables/update_image.js';

// !!! if you do changes to HTML, some issues might occur, because of the names used in here to connect to the divs and the rest of the stuff. !!!
// check fo such issues if you do changes to the HTML

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

    setupImageUploadListener('imageUploadInputTopPart', apiUrlForNewImageCarousel, containerForNewImageCarousel);

    document.querySelectorAll("#imageTourPlaceInput").forEach(input => {
        const container = input.closest('div[data-id]');
        setupImageUploadListener(input, apiUrlForImagesTourPlace, container, 'imageTourPlace');
    });

    document.querySelectorAll("#imageTicketPriceInput").forEach(input => {
        const container = input.closest('div[data-id]');
        setupImageUploadListener(input, apiUrlForImagesTicketPrices, container, 'imageTicketPrice');
    });

    setupImageUploadListener('image1Input', apiUrlForImagesTourStart, containerForImagesNameTourStart, 'image1', 'MainImagePath');
    setupImageUploadListener('image2Input', apiUrlForImagesTourStart, containerForImagesNameTourStart, 'image2', 'SecondaryImagePath');

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

    deleteImageFromCarousel();
    editTopPart();
    editTourPlace();
    addNewQuestionAndAnswer();
    deletePracticalInformation();
    editDeparture();
    editTour();

});

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

function editTourPlace() {
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
}

function addNewQuestionAndAnswer() {
    document.getElementById("submitNewInfo").addEventListener("click", function () {
        const question = document.getElementById("newQuestion").value;
        const answer = document.getElementById("newAnswer").value;
        if (question && answer) {
            addHistoryPracticalInformation(question, answer);
        } else {
            alert("Please fill in both question and answer");
        }
    });
}

function deletePracticalInformation() {
    document.querySelectorAll(".delete-practical-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = this.closest("div[data-id]");
            const id = container.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this item?")) {
                deleteHistoryPracticalInformation(id);
            }
        });
    });
}

function editDeparture() {
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
}

function editTour() {
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

}

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

function updateHistoryTour(id, startTime, englishTour, dutchTour, chineseTour) {
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
            if (index === 0) question = el.innerText;
            else if (index === 1) answer = el.innerText;
        });
        button.textContent = "Edit";
        container.removeAttribute("data-editing");
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

function updateHistoryStartingPointDescription(id, description) {
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

function addHistoryPracticalInformation(question, answer) {
    fetch("/api/historyadmin/createHistoryPracticalInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
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
