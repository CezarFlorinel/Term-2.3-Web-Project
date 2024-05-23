import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function changeCellForBuyingTicketInTheTimeTable() {
    try {
        const bookingButtons = document.querySelectorAll('.btn3');
        bookingButtons.forEach(button => {
            button.addEventListener('click', function () {
                const bookingId = this.getAttribute('data-booking-id');
                const bookingItem = document.getElementById(`booking-item-${bookingId}`);
                // Extract the time from the original booking item
                const timeText = bookingItem.querySelector('.timetable-booking-text').textContent.trim();

                // Build the flags section based on the original booking item
                let flagsHTML = '';
                const hasEnglishTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="English Tour"]').length > 0;
                const hasDutchTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="Dutch Tour"]').length > 0;
                const hasChineseTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="Chinese Tour"]').length > 0;

                if (hasEnglishTour) {
                    flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/Uk-flag-small.png" alt="English Tour">';
                }
                if (hasDutchTour) {
                    flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/download 3.png" alt="Dutch Tour">';
                }
                if (hasChineseTour) {
                    flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/download 5.png" alt="Chinese Tour">';
                }

                // Define the new content structure
                const newContent = `
                    <div class="timetable-booking-item-type-2">
                        <p class="timetable-booking-text-type-2">${timeText}</p>
                        <p class="timetable-booking-text-type-2">Select Language</p>
                        <div class="booking-item-flags-type-2">
                            ${flagsHTML}
                        </div>
                        <button type="button" class="btn3" data-booking-id="${bookingId}">Book</button>
                    </div>
                `;

                // Replace the innerHTML of the booking item
                bookingItem.innerHTML = newContent;

                // Add click event listener to new flag images for navigation
                bookingItem.querySelectorAll('.timetable-booking-image-type-2').forEach(image => {
                    image.addEventListener('click', function () {
                        const language = this.alt.split(' ')[0]; // Assuming format 'Language Tour'
                        window.location.href = `/tickethistory?language=${language}&tourId=${bookingId}&type=regular`; // Change URL accordingly
                    });
                });
            });
        });
    }
    catch (error) {
        errorHandler.showAlert('An error occurred while trying to change the cell for buying a ticket in the timetable!');
        errorHandler.logError(error, 'changeCellForBuyingTicketInTheTimeTable', 'change_cell_timetable.js');
    }
}