import { configureDeleteIcon } from './modules_pp_listview/deletion.js';
import { handleApiResponse } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


document.addEventListener('DOMContentLoaded', function () {
    storeSelectedOrderItemsInSession();
    configureDeleteIcon();
    setIncrementAndDecrementButtons();
    setAgendaLink();
});

function setAgendaLink() {
    document.getElementById('js_copyLink').addEventListener('click', function (event) {
        event.preventDefault();
        const link = `http://localhost/PersonalProgramAgendaView?userID=${userID}`;

        navigator.clipboard.writeText(link).then(function () {
            errorHandler.showAlert('Link copied to clipboard!', { icon: 'success', title: 'Success' });
        }, function (err) {
            errorHandler.showAlert('Failed to copy the link to clipboard!');
        });
    });
}

function storeSelectedOrderItemsInSession() {
    const purchaseSelectedTicketsButton = document.getElementById('js_purchase-selected-tickets');
    if (!purchaseSelectedTicketsButton) return;
    purchaseSelectedTicketsButton.addEventListener('click', function () {
        const selectedCheckboxes = document.querySelectorAll('.js_form-checkbox:checked');
        const selectedOrderItemIDs = Array.from(selectedCheckboxes).map(checkbox => {
            return checkbox.closest('[data-type-order-item-id]').getAttribute('data-type-order-item-id');
        });

        if (selectedOrderItemIDs.length === 0) {
            errorHandler.showAlert('Please select at least one item to purchase!');
            return;
        }

        fetch('/api/PersonalProgramListView/storeSelectedOrderItemsInSession', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                orderItemIDs: selectedOrderItemIDs
            })
        })
            .then(handleApiResponse)
            .catch(error => {
                errorHandler.logError(error, 'storeSelectedOrderItemsInSession', 'personal_program_listview.js');
                errorHandler.showAlert('An error occurred while storing selected order items in session, please try again later!');

            });
    });
}

function setIncrementAndDecrementButtons() {
    document.querySelectorAll('.increment, .decrement').forEach(button => {
        button.addEventListener('click', function (e) {
            const itemId = this.dataset.itemId;
            const isIncrement = this.classList.contains('increment');
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            let currentQuantity = parseInt(input.value);
            currentQuantity = isIncrement ? currentQuantity + 1 : (currentQuantity > 1 ? currentQuantity - 1 : 1);
            input.value = currentQuantity;  // Update the input field

            fetch('/api/PersonalProgramListView/updateQuantityAndTotals', {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    quantity: currentQuantity,
                    orderItemID: itemId
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById(`subtotal-${itemId}`).textContent = `${data.subtotal}€`;
                    document.getElementById('js_total-price').textContent = `Total ${data.totalPrice}€`;
                    document.getElementById('js_total-items').textContent = `You have ${data.totalItems} items in total`;
                })
                .catch(error => {
                    errorHandler.logError(error, 'setIncrementAndDecrementButtons', 'personal_program_listview.js');
                    errorHandler.showAlert('An error occurred while updating the quantity, please try again later!');
                });
        });
    });

}

