import { checkNumber } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.addEventListener("DOMContentLoaded", function () {
    // Find all ticket containers
    const ticketContainers = document.querySelectorAll("[id^=js_ticketDanceContainer_]");
    addEventListenersToContainer(ticketContainers);
});

function addEventListenersToContainer(ticketContainers) {
    ticketContainers.forEach(container => {
        // Find the relevant elements within the container
        const decreaseButton = container.querySelector(".js_decreaseTicketQuantityButton");
        const increaseButton = container.querySelector(".js_increaseTicketQuantityButton");
        const quantityDisplay = container.querySelector(".js_ticketQuantity");
        const addTicketButton = container.querySelector(".js_addTicketToCartButton");

        addEventListenerForQuantityChange(decreaseButton, increaseButton, quantityDisplay, container, addTicketButton);
    });
}

function addEventListenerForQuantityChange(decreaseButton, increaseButton, quantityDisplay, container, addTicketButton) {
    if (decreaseButton && increaseButton && quantityDisplay && addTicketButton) {
        // Initialize the quantity value
        let quantity = parseInt(quantityDisplay.textContent);

        // Event listener for decrease button
        decreaseButton.addEventListener("click", function () {
            if (quantity > 1) {
                quantity--;
                quantityDisplay.textContent = quantity;
            }
        });

        // Event listener for increase button
        increaseButton.addEventListener("click", function () {
            quantity++;
            quantityDisplay.textContent = quantity;
        });

        addEventListenerForOrderTicketButton(addTicketButton, quantityDisplay);
    } else {
        errorHandler.showError("Failed to find all required elements in the ticket container");
    }
}

function addEventListenerForOrderTicketButton(addTicketButton, quantityDisplay) {
    // Event listener for add ticket to cart button
    addTicketButton.addEventListener("click", function () {
        const orderID = addTicketButton.getAttribute("data-order-id");
        const ticketID = addTicketButton.getAttribute("data-ticket-id");
        const quantity = parseInt(quantityDisplay.textContent); // Fetch the current quantity

        const data = new FormData();
        data.append("orderID", orderID);
        data.append("ticketID", ticketID);
        data.append("quantity", quantity);

        if (!checkNumber(quantity)) {
            return;
        }

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
                errorHandler.logError(error, 'addEventListenerForOrderTicketButton', 'order_ticket_dance_home.js');
                errorHandler.showAlert('An error occurred while ordering the ticket, please try again later!');
            });
    });
}
