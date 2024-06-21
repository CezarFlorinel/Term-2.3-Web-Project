
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.getElementById('exportButton').addEventListener('click', function () {
    let selectedOrders = [];
    let columns = [];

    document.querySelectorAll('.orderCheckbox:checked').forEach(checkbox => {
        selectedOrders.push(checkbox.closest('tr'));
    });

    if (selectedOrders.length === 0) {
        errorHandler.showAlert('Please select at least one order.');
        return;
    }

    document.querySelectorAll('.columnCheckbox:checked').forEach(checkbox => {
        columns.push(checkbox.dataset.column);
    });

    if (columns.length === 0) {
        errorHandler.showAlert('Please select at least one column.');
        return;
    }

    let csvContent = 'data:text/csv;charset=utf-8,';
    csvContent += columns.join(',') + '\n';

    selectedOrders.forEach(orderRow => {
        let row = [];
        columns.forEach(column => {
            let cell = orderRow.querySelector(`[data-column="${column}"]`);
            if (cell) {
                let cellText = cell.textContent.trim();
                if (cellText.includes(',') || cellText.includes('"')) {
                    cellText = '"' + cellText.replace(/"/g, '""') + '"';
                }
                row.push(cellText);
            } else {
                row.push(''); // Add an empty string if the column is not found
            }
        });
        csvContent += row.join(',') + '\n';
    });

    let encodedUri = encodeURI(csvContent);
    let link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'orders.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

document.getElementById('searchButton').addEventListener('click', function () {
    const searchTerm = document.getElementById('searchOrder').value.toLowerCase();

    if (searchTerm === '') {
        errorHandler.showAlert('Please enter a customer name to search for.');
        return;
    }

    const foundOrders = orders.filter(order => order.clientName.toLowerCase().includes(searchTerm));
    const orderListContainer = document.getElementById('orderListContainer');
    orderListContainer.innerHTML = '';

    if (foundOrders.length > 0) {
        document.getElementById('orderList').classList.remove('hidden');
        document.getElementById('orderDetails').classList.add('hidden');

        foundOrders.forEach((order, index) => {
            const listItem = document.createElement('li');
            listItem.textContent = `${order.clientName} - ${order.orderId}`;
            listItem.dataset.index = index;
            listItem.classList.add('cursor-pointer', 'text-blue-500', 'hover:underline');
            listItem.addEventListener('click', function () {
                displayOrderDetails(foundOrders[this.dataset.index]);
            });
            orderListContainer.appendChild(listItem);
        });
    } else {
        errorHandler.showAlert('No orders found for the given customer name.');
        document.getElementById('orderList').classList.add('hidden');
        document.getElementById('orderDetails').classList.add('hidden');
    }
});

document.getElementById('exportButtonSearch').addEventListener('click', function () {
    const searchTerm = document.getElementById('searchOrder').value.toLowerCase();

    const foundOrders = orders.filter(order => order.clientName.toLowerCase().includes(searchTerm));

    if (searchTerm === '') {
        errorHandler.showAlert('Please enter a customer name to search for.');
        return;
    }

    if (foundOrders.length > 0) {
        const columns = ['orderId', 'paymentDate', 'clientName', 'phoneNumber', 'address', 'email', 'VATamount', 'totalAmount'];
        let csvContent = 'data:text/csv;charset=utf-8,';
        csvContent += columns.join(',') + '\n';

        foundOrders.forEach(order => {
            let row = [];
            columns.forEach(column => {
                let cellText = order[column].toString().trim();
                if (cellText.includes(',') || cellText.includes('"')) {
                    cellText = '"' + cellText.replace(/"/g, '""') + '"';
                }
                row.push(cellText);
            });
            csvContent += row.join(',') + '\n';
        });

        let encodedUri = encodeURI(csvContent);
        let link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'orders.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } else {
        errorHandler.showAlert('No orders found for the given customer name.');
    }
});

function displayOrderDetails(order) {
    document.getElementById('js_orderID').textContent = `Order ID: ${order.orderId}`;
    document.getElementById('js_paymentDate').textContent = `Payment Date: ${order.paymentDate}`;
    document.getElementById('js_customerName').textContent = `Customer Name: ${order.clientName}`;
    document.getElementById('js_phoneNumber').textContent = `Phone Number: ${order.phoneNumber}`;
    document.getElementById('js_Address').textContent = `Address: ${order.address}`;
    document.getElementById('js_Email').textContent = `Email: ${order.email}`;
    document.getElementById('js_VAT').textContent = `VAT: ${order.VATamount.toFixed(2)}`;
    document.getElementById('js_TotalAmount').textContent = `Total Amount: ${order.totalAmount.toFixed(2)}`;
    document.getElementById('orderDetails').classList.remove('hidden');
}