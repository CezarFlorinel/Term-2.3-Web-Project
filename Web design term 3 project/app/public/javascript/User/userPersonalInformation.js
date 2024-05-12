import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

//Logout

document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("logout");

    logoutButton.addEventListener("click", function (event) {
        event.preventDefault();
        logout();
    });
});

function logout() {

    // Use fetch to send the request to the server
    fetch('/api/user/Logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to log out.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Logout successful:', data);
            window.location.href = data.redirectTo;
        })
        .catch(error => {
            errorHandler.showAlert('Something unexpected happened while trying to log out. Please get in contact with the administrator or try again later.')
            errorHandler.logError('Cannot log out right now: ', error);
            errorMessageElement.textContent = error.message;
        });
}
