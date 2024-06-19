import { updateDanceTicket, deleteDanceTicket, addNewTicket } from './admin_modules/tickets_management/normal_ticket.js';
import { updateOneDayPass, deleteOneDayPass, addOneDayPass } from './admin_modules/tickets_management/one_day_pass.js';
import { updateMultipleDaysPass } from './admin_modules/tickets_management/multiple_day_pass.js';

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('.js_buttonSave').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2]; // splitting to get the ID part from the button's ID
            updateDanceTicket(id);
        });
    });

    document.querySelectorAll('.js_buttonDelete').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2];
            if (confirm("Are you sure you want to delete this ticket?")) {
                deleteDanceTicket(id);
            }
        });
    });

    document.getElementById('js_buttonAddTicket').addEventListener('click', function () {
        event.preventDefault();
        addNewTicket();
    });

    document.querySelectorAll('.js_buttonSaveOneDayPass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2];
            updateOneDayPass(id);
        });
    });

    document.querySelectorAll('.js_buttonDeleteOneDayPass').forEach(button => { // lol
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2];
            if (confirm("Are you sure you want to delete this One Day Pass?")) {
                deleteOneDayPass(id);
            }
        });
    });

    document.querySelectorAll('.js_buttonSaveMultipleDaysPass').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.id.split('_')[2];
            updateMultipleDaysPass(id);
        });
    });

    document.getElementById('js_buttonAddOneDayPass').addEventListener('click', function () {
        event.preventDefault();
        addOneDayPass();
    });

});



