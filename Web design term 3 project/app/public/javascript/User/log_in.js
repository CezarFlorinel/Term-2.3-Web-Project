import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        logIn();
    });
});

function logIn() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMessageElement = document.getElementById('error-combination');

    // Validate inputs
    if (!email || !password) {
        errorMessageElement.textContent = 'Email and password are required.';
        return;
    }

    // Clear previous error messages
    errorMessageElement.textContent = '';

    // Build the request payload
    const payload = {
        email: email,
        password: password
    };

    // Use fetch to send the request to the server
    fetch('/api/user/logIn', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to log in. Please check your email and password.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Login successful:', data);
            window.location.href = data.redirectTo;
        })
        .catch(error => {
            errorHandler.showAlert('Something unexpected happened while trying to log in. Please get in contact with the administrator or try again later.')
            errorHandler.logError('Cannot log in right now: ', error);
            errorMessageElement.textContent = error.message;
        });
}
