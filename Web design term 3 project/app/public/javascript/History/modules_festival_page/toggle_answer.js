import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function toggleAnswerDisplay() {
    try {
        document.querySelectorAll('.toggle-sign').forEach(item => {
            item.addEventListener('click', function () {
                // Toggle the answer display.
                const answer = this.parentElement.nextElementSibling;
                if (answer.style.display === 'none' || answer.style.display === '') {
                    answer.style.display = 'block';
                    this.src = 'assets/images/elements/- sign.png';
                    this.setAttribute('data-toggle', 'open');
                } else {
                    answer.style.display = 'none';
                    this.src = 'assets/images/elements/+ sign.png';
                    this.setAttribute('data-toggle', 'closed');
                }
            });
        });
    }
    catch (error) {
        errorHandler.showAlert('An error occurred while trying to toggle the answer display!', 'danger');
        errorHandler.logError(error, 'toggleAnswerDisplay', 'toggle_answer.js');
    }
}