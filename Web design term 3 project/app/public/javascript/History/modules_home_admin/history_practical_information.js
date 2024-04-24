import { handleApiResponse, checkText } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

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
        if (!checkText({ question, answer })) {
            addHistoryPracticalInformation(question, answer);
        }
    });
}

function deleteHistoryPracticalInformation(id) {
    fetch("/api/historyadmin/deleteHistoryPracticalInformation", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
        }),
    })
        .then(handleApiResponse)
        .then((data) => {
            if (data.success) {
                location.reload();
            }
        })
        .catch((error) => {
            errorHandler.logError(error, "deleteHistoryPracticalInformation", "history_practical_information.js");
            errorHandler.showAlert("An error occurred while deleting the information, please try again later!");
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
    if (!checkText({ question, answer })) {
        return;
    }
    fetch("/api/historyadmin/updateHistoryPracticalInformation", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json", // Correct content-type for JSON
        },
        body: JSON.stringify({
            informationID: id,
            question: question,
            answer: answer,
        }),
    })
        .then(handleApiResponse)
        .catch((error) => {
            errorHandler.logError(error, "updateHistoryPracticalInformation", "history_practical_information.js");
            errorHandler.showAlert("An error occurred while updating the information, please try again later!");
        });
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
        .then(handleApiResponse)
        .then((data) => {
            if (data.success) {
                location.reload();
            }
        })
        .catch((error) => {
            errorHandler.logError(error, "addHistoryPracticalInformation", "history_practical_information.js");
            errorHandler.showAlert("An error occurred while adding the information, please try again later!");
        });
}


export { handleEditableFieldsForQandA, addNewQuestionAndAnswer, updateHistoryPracticalInformation, deletePracticalInformation };