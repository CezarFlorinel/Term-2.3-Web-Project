
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



export { handleEditableFieldsForQandA, addNewQuestionAndAnswer, updateHistoryPracticalInformation, deletePracticalInformation };