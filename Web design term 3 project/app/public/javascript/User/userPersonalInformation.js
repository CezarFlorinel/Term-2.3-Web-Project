import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

//Getting the user personal information

document.addEventListener("DOMContentLoaded", function () {
   
    const userName = sessionStorage.getItem("userName");
    const userEmail = sessionStorage.getItem("userEmail");

console.log(userEmail);
console.log("this is not working");

    const userInfoContainer = document.querySelector("#userInfo");
    const editButton = document.querySelector("#editButton");

    if (userName && userEmail) {
        // Display user information
        userInfoContainer.innerHTML = `
            <p class="text-gray-600 mb-2><strong>Name:</strong> ${DOMPurify.sanitize(userName)}</p>
            <p class="text-gray-600 mb-2><strong>Email:</strong> ${DOMPurify.sanitize(userEmail)}</p>
        `;
    } else {
        // Handle case where user data is not available in session
        console.error("User data not found in session.");
    }

    editButton.addEventListener("click", function () {
        // Replace user information with input fields for editing
        userInfoContainer.innerHTML = `
            <input type="text" id="editName" value="${DOMPurify.sanitize(userName)}">
            <input type="email" id="editEmail" value="${DOMPurify.sanitize(userEmail)}">
            <button id="saveButton">Save</button>
        `;

        // Add event listener to the save button
        const saveButton = document.querySelector("#saveButton");
        saveButton.addEventListener("click", function () {
            // Get the updated name and email from the input fields
            const updatedName = document.querySelector("#editName").value;
            const updatedEmail = document.querySelector("#editEmail").value;

            // Update the session variables
            sessionStorage.setItem("userName", updatedName);
            sessionStorage.setItem("userEmail", updatedEmail);

            // Display the updated user information
            userInfoContainer.innerHTML = `
                <p><strong>Name:</strong> ${DOMPurify.sanitize(updatedName)}</p>
                <p><strong>Email:</strong> ${DOMPurify.sanitize(updatedEmail)}</p>
            `;
        });
    });
});

