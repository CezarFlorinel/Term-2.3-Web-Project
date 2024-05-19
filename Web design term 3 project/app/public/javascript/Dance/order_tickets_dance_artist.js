import { handleApiResponse, checkText, checkNumber, checkReviewStarNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

const defaultQuantity = 1;

document.addEventListener("DOMContentLoaded", function () {
    const buyTicketsButton = document.getElementById("js_addSelectedTicketsToCartButton");

    if (buyTicketsButton) {
        buyTicketsButton.addEventListener("click", function () {
            const selectedTicket = document.querySelector('input[name="price"]:checked');

            if (selectedTicket) {
                const ticketID = selectedTicket.value;
                const orderID = buyTicketsButton.getAttribute("data-order-id");

                const data = new FormData();
                data.append("orderID", orderID);
                data.append("ticketID", ticketID);
                data.append("quantity", defaultQuantity);


                fetch('/api/danceManageTickets/orderTicket', {
                    method: 'POST',
                    body: data
                })
                    .then(response => response.json())
                    .then(responseData => {
                        if (responseData.success) {
                            window.location.href = "/personalProgramListView";
                        } else {
                            errorHandler.showError(responseData.error || "Failed to order ticket");
                        }
                    })
                    .catch(error => {
                        errorHandler.showError("An error occurred: " + error.message);
                    });
            } else {
                errorHandler.showError("Please select a ticket to purchase.");
            }
        });
    }
});
