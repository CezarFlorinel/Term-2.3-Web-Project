const parentPage = 1; // Fixed for now, to be changed later

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".edit-practical-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            handleEditableFieldsForQandA(this, updateHistoryPracticalInformation);
        });
    });

    // Tour Starting Point Edit button 
    document.querySelectorAll('.edit-tour-starting-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            handleEditableFields(this, updateHistoryStartingPointDescription);
        });
    });

    document
        .getElementById("image1Input")
        .addEventListener("change", function () {
            if (this.files && this.files[0]) {
                uploadAndUpdateImage(
                    this.files[0],
                    "image1",
                    "<?php echo $historyTourStartingPoints->informationID; ?>"
                );
            }
        });

    document
        .getElementById("image2Input")
        .addEventListener("change", function () {
            if (this.files && this.files[0]) {
                uploadAndUpdateImage(
                    this.files[0],
                    "image2",
                    "<?php echo $historyTourStartingPoints->informationID; ?>"
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

    // document.querySelectorAll('.edit-tour-btn').forEach(btn => {
    //     btn.addEventListener('click', function () {
    //         const container = this.closest('div[data-id]');
    //         const editableElements = container.querySelectorAll('.editable, .tour-editable');
    //         const isEditing = container.getAttribute('data-editing');
    //         const id = container.getAttribute('data-id');

    //         if (isEditing === 'true') {
    //             // Switch off editing and update information
    //             editableElements.forEach(el => {
    //                 el.contentEditable = el.classList.contains('editable') ? 'false' : el.contentEditable;
    //                 el.readOnly = el.classList.contains('tour-editable') ? true : el.readOnly;
    //             });
    //             this.textContent = 'Edit';
    //             container.removeAttribute('data-editing');

    //             // Collecting all updated fields
    //             let startTime = container.querySelector('.editable').innerText;
    //             let englishTour = container.querySelector('input[name="englishTour"]').value;
    //             let dutchTour = container.querySelector('input[name="dutchTour"]').value;
    //             let chineseTour = container.querySelector('input[name="chineseTour"]').value;

    //             // Update tour information
    //             updateHistoryTour(id, container.dataset.departure, startTime, englishTour, dutchTour, chineseTour);
    //         } else {
    //             // Enable editing
    //             editableElements.forEach(el => {
    //                 el.contentEditable = el.classList.contains('editable') ? 'true' : el.contentEditable;
    //                 el.readOnly = el.classList.contains('tour-editable') ? false : el.readOnly;
    //             });
    //             this.textContent = 'Save';
    //             container.setAttribute('data-editing', 'true');
    //         }
    //     });
    // });
});

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
    departure,
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
            departure: departure,
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
