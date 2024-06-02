import {
  handleApiResponse,
  checkText,
} from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.getElementById("logout");
  const editProfileButton = document.getElementById("editProfile");
  const saveButton = document.getElementById("save");
  const changePassword = document.getElementById("changePassword");

  //Logout

  logoutButton.addEventListener("click", function (event) {
    event.preventDefault();
    document.cookie =
      "PHPSESSID=; expires=Thu, 1 Jan 1970 00:00:00 UTC; path=/;";
    logout();
  });

  //Edit

  editProfileButton.addEventListener("click", function (event) {
    const nameParagraph = document.getElementById("name");
    const nameSpan = nameParagraph.querySelector(".name-value");
    const emailParagraph = document.getElementById("email");
    const emailSpan = emailParagraph.querySelector(".email-value");
    const strongElementName = document
      .getElementById("name")
      .querySelector("strong");
    const strongElementEmail = document
      .getElementById("email")
      .querySelector("strong");
    const nameInput = document.createElement("input");

    nameInput.type = "text";
    nameInput.classList.add(
      "shadow",
      "appearance-none",
      "border",
      "rounded",
      "w-full",
      "py-2",
      "px-3",
      "text-gray-600",
      "leading-tight",
      "focus:outline-none",
      "focus:shadow-outline",
      "mb-2"
    );
    nameInput.value = nameSpan.textContent.trim();

    const emailInput = document.createElement("input");
    emailInput.type = "text";
    emailInput.classList.add(
      "shadow",
      "appearance-none",
      "border",
      "rounded",
      "w-full",
      "py-2",
      "px-3",
      "text-gray-600",
      "leading-tight",
      "focus:outline-none",
      "focus:shadow-outline",
      "mb-2"
    );
    emailInput.value = emailSpan.textContent.trim();

    // Insert input fields between the paragraphs
    nameParagraph.insertAdjacentElement("afterend", nameInput);
    emailParagraph.insertAdjacentElement("afterend", emailInput);

    nameSpan.textContent = "";
    strongElementName.textContent = "Name: ";

    emailSpan.textContent = "";
    strongElementEmail.textContent = "Email: ";
    //createInputFields();
    saveButton.style.display = "block";
    editProfileButton.style.display = "none";
    saveButton.addEventListener("click", function (event) {
      event.preventDefault();

      const name = nameInput.value;
      const email = emailInput.value;

      const updatedData = {
        name: name,
        email: email,
      };

      fetch(`/api/user?id=${userId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(updatedData),
      })
        .then(handleApiResponse)
        .then((data) => {
          if (data.success) {
            window.location.href = "/userAccount";
          } else {
            errorHandler.logError("Error updating user:", data.message);
          }
        })
        .catch((error) => {
          errorHandler.logError(error, "editUserForm", "user.js");
          errorHandler.showAlert(
            "An error occurred while trying to edit the user. Please try again later!"
          );
        });
      
    });
  });

  //Change password

  changePassword.addEventListener("click", function (event) {});
});

function logout() {
  // Use fetch to send the request to the server
  fetch("/api/user/Logout", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to log out.");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Logout successful:", data);
      window.location.href = data.redirectTo;
    })
    .catch((error) => {
      errorHandler.showAlert(
        "Something unexpected happened while trying to log out. Please get in contact with the administrator or try again later."
      );
      errorHandler.logError("Cannot log out right now: ", error);
      errorMessageElement.textContent = error.message;
    });
}
