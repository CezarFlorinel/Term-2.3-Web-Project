import { handleApiResponse } from '../../Utilities/handle_data_checks.js';
import ErrorHandler from '../../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();


const deleteOrderItemAPI = '/api/PersonalProgramListView/deleteOrderItem';
const deleteReservationAPI = '/api/PersonalProgramListView/deleteReservation';
const deletePaidResText = 'Are you sure you want to delete this reservation ? You will NOT receive a refund, and the ticket will become useless (if applicable) ! You cannot reverse this changes.';
const deleteUnpaidResText = 'Are you sure you want to delete this reservation?';
const theDataTypeOrderItem = "data-type-order-item-id";
const theDataTypeReservation = "data-type-reservation-item-id";

export function configureDeleteIcon() {
    var deleteIcons = document.querySelectorAll('.js_delete-icon');
    deleteIcons.forEach(function (icon) {
        var typeOfReservation = icon.dataset.typeOfReservation;
        if (typeOfReservation === 'res_paid') {
            showConfirmationPopupForDeletion(icon, deleteOrderItemAPI, deletePaidResText, theDataTypeOrderItem);
        }
        else if (typeOfReservation === 'res_unpaid') {
            showConfirmationPopupForDeletion(icon, deleteOrderItemAPI, deleteUnpaidResText, theDataTypeOrderItem);
        }
        else if (typeOfReservation === 'restaurant_res') {
            showConfirmationPopupForDeletion(icon, deleteReservationAPI, deletePaidResText, theDataTypeReservation);
        }
    });
}

function deleteItem(itemId, API) {
    fetch(`${API}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ID: itemId
        })

    }).then(handleApiResponse)
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            errorHandler.logError(error, 'deleteItem', 'deletion.js');
            errorHandler.showAlert('An error occurred while deleting the item, please try again later!');
        });
}

function showConfirmationPopupForDeletion(icon, API, text, dataType) {
    icon.addEventListener('click', function (event) {
        var itemId = this.closest(`[${dataType}]`).getAttribute(`${dataType}`);
        Swal.fire({
            title: 'Are you sure?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteItem(itemId, API);
            }
        });
    });
}