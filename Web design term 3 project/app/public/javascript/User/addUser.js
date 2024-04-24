import {
  handleApiResponse,
  checkText,
} from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
  const addUserForm = document.getElementById("addUserForm");

  window.validateCaptcha = function () {
    grecaptcha.ready(function () {
      grecaptcha
        .execute("6LfbGsEpAAAAAJ2RLoJCUfirLF4BxU7B8lR0xtWX", {
          action: "submit",
        })
        .then(function (token) {
          onSubmit(token); // Now call onSubmit directly with the token
        });
    });
  };

  function onSubmit(token) {
    const name = document.getElementById("addName").value;
    const email = document.getElementById("addEmail").value;
    const role = document.getElementById("addRole").value;
    const password = document.getElementById("addPassword").value;
    const passwordConfirm = document.getElementById("addRepeatPassword").value;

    if (!checkText({ name, email, role, password, passwordConfirm })) {
        errorHandler.showAlert("Please fill in all fields.");
        return;
    }

    if (password.length < 8) {
      errorHandler.showAlert("Password must be at least 8 characters long.");
      return;
    }

    if (password !== passwordConfirm) {
      errorHandler.showAlert("Passwords do not match.");
      return;
    }

    const formData = {
      name: name,
      email: email,
      role: role,
      password: password,
      passwordConfirm: passwordConfirm,
      recaptchaToken: token
    };

    fetch("/api/user/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then(handleApiResponse)
      .then((data) => {
        if (data.success) {
          window.location.href = "/userAdmin";
        } else {
          errorHandler.logError("Error adding a new user:", data.message);
        }
      })
      .catch((error) => {
        errorHandler.logError(error, "addUserForm", "addUser.js");
        errorHandler.showAlert(
          "An error occurred while trying to add a new user. Please try again later!"
        );
      });
    }
});
