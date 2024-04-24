import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
  const registrationForm = document.getElementById("registrationForm");

  window.validateCaptcha = function () {
    grecaptcha.ready(function () {
      grecaptcha.execute('6LfbGsEpAAAAAJ2RLoJCUfirLF4BxU7B8lR0xtWX', { action: 'submit' }).then(function (token) {
        onSubmit(token);  // Now call onSubmit directly with the token
      });
    });
  };

  function onSubmit(token) {
    // Now we have the token, we can include it in the submission data
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const passwordConfirm = document.getElementById("confirmPassword").value;

    if (!checkText({ name, email, password, passwordConfirm })) {
      errorHandler.showAlert("Please fill in all fields.");
      return;
    }

    if (password !== passwordConfirm) {
      errorHandler.showAlert("Passwords do not match.");
      return;
    }

    const formData = {
      name: name,
      email: email,
      password: password,
      passwordConfirm: passwordConfirm,
      recaptchaToken: token  // Include the token
    };

    fetch('api/user/create', {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    })
      .then(handleApiResponse)
      .then((data) => {
        if (data.success) {
          window.location.href = "/login";
        } else if (data.error) {
          errorHandler.showAlert(data.error);
        }
      })
      .catch((error) => {
        errorHandler.logError(error, "registrationForm", "register.js");
        errorHandler.showAlert("An error occurred while registering, please try again later!");
      });
  }
});

