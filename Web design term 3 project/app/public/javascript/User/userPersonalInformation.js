import {
  handleApiResponse,
  checkText, checkImageSizeAndFileType
} from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.getElementById("logout");
  const editProfileButton = document.getElementById("editProfile");
  const saveButton = document.getElementById("save");
  const changePassword = document.getElementById("changePassword");
  const personalInfoSection = document.getElementById("personalInformation");
  const container = document.querySelector(".max-w-6xl");
  const title = document.getElementById("title");
  const changePictureButton = document.getElementById("changePicture");
  const fileInput = document.getElementById("profilePicture");

  //Logout

  logoutButton.addEventListener("click", function (event) {
    event.preventDefault();
    document.cookie =
      "PHPSESSID=; expires=Thu, 1 Jan 1970 00:00:00 UTC; path=/;";
    logout();
  });

  //Change profile picture


  changePictureButton.addEventListener("click", function () {
    fileInput.click(); // Trigger the file input dialog
  });

  fileInput.addEventListener("change", function () {
    updateProfilePicture(); // Call the function when a file is selected
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
          errorHandler.logError(
            error,
            "editUserForm",
            "userPersonalInformation.js"
          );
          errorHandler.showAlert(
            "An error occurred while trying to modify your account information. Please try again later!"
          );
        });
    });
  });

  //Change password

  changePassword.addEventListener("click", function (event) {
    event.preventDefault();
    personalInfoSection.style.display = "none";
    logoutButton.style.display = "none";
    title.textContent = "Change your password";

    const passwordForm = document.createElement("div");
    passwordForm.id = "passwordForm";
    passwordForm.classList.add("bg-white", "shadow-md", "rounded-lg", "p-4");

    const oldPasswordInput = createPasswordInput(
      "Enter old password",
      "Old Password"
    );
    const newPasswordInput = createPasswordInput(
      "Enter new password",
      "New Password"
    );
    const confirmPasswordInput = createPasswordInput(
      "Confirm new password",
      "Confirm Password"
    );

    const savePasswordButton = document.createElement("button");
    savePasswordButton.type = "button";
    savePasswordButton.id = "savePassword";
    savePasswordButton.textContent = "Save Password";
    savePasswordButton.classList.add(
      "mt-2",
      "bg-blue-500",
      "text-white",
      "px-4",
      "py-2",
      "rounded-md",
      "hover:bg-blue-600",
      "focus:outline-none",
      "focus:bg-blue-600"
    );

    passwordForm.appendChild(oldPasswordInput);
    passwordForm.appendChild(newPasswordInput);
    passwordForm.appendChild(confirmPasswordInput);
    passwordForm.appendChild(savePasswordButton);
    container.appendChild(passwordForm);

    savePasswordButton.addEventListener("click", async function (event) {
      event.preventDefault();

      const oldPassword = oldPasswordInput.querySelector("input").value;
      const newPassword = newPasswordInput.querySelector("input").value;
      const confirmPassword = confirmPasswordInput.querySelector("input").value;

      if (!oldPassword || !newPassword || !confirmPassword) {
        errorHandler.showAlert("All fields are required.");
        return;
      }

      if (newPassword !== confirmPassword) {
        errorHandler.showAlert("The passwords do not match.");
        return;
      }

      const updatePassword = {
        oldPassword: oldPassword,
        newPassword: newPassword
      }

      fetch('/api/user/changePassword', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(updatePassword)
      })
        .then(handleApiResponse)
        .then((data) => {
          if (data.success) {
            window.location.href = "/userAccount";
          } else {
            errorHandler.logError("Error updating user's password: ", data.message);
          }
        })
        .catch((error) => {
          errorHandler.logError(
            error,
            "editUserForm",
            "userPersonalInformation.js"
          );
          errorHandler.showAlert("An error occurred while trying to edit your password. Please try again later!");
        });

    });
  });


});

function createPasswordInput(label, placeholder) {
  const passwordInputDiv = document.createElement("div");
  passwordInputDiv.classList.add("mb-4");

  const labelElement = document.createElement("p");
  const strongElement = document.createElement("strong");
  strongElement.textContent = label;
  labelElement.classList.add("text-gray-600", "mb-2");
  labelElement.appendChild(strongElement);
  passwordInputDiv.appendChild(labelElement);

  const passwordInput = document.createElement("input");
  passwordInput.type = "password";
  passwordInput.placeholder = placeholder;
  passwordInput.classList.add(
    "shadow",
    "appearance-none",
    "border",
    "rounded",
    "w-64",
    "py-2",
    "px-3",
    "text-gray-600",
    "leading-tight",
    "focus:outline-none",
    "focus:shadow-outline",
    "mb-2"
  );

  passwordInputDiv.appendChild(passwordInput);
  return passwordInputDiv;
}

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

function updateProfilePicture() {
  const fileInput = document.getElementById("profilePicture");
  const file = fileInput.files[0];
  const formData = new FormData();
  formData.append("profilePicture", file);

  if (!checkImageSizeAndFileType(file)) {
    return;
  }

  fetch("/api/user/updateProfilePicture", {
    method: "POST",
    body: formData,
  })
    .then(handleApiResponse)
    .then((data) => {
      if (data.success) {
        window.location.href = "/userAccount";
      }
    })
    .catch((error) => {
      errorHandler.logError(
        error,
        "editUserForm",
        "userPersonalInformation.js"
      );
      errorHandler.showAlert("An error occurred while trying to upload your profile picture. Please try again later!");
    });
}
