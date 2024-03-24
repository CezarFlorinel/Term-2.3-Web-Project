<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History Tour Ticket Booking</title>
<link href="https://cdn.tailwindcss.com" rel="stylesheet">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: black;
        color: white;
        display: flex;
        flex-direction: column; /* Stack content vertically */
        align-items: center;
        min-height: 130vh;
    }
    .header-text {
        margin-top: 20px; /* Add space at the top */
        text-align: center;
        max-width: 1200px; /* Or width of your content area */
    }
    .header-text h1 {
        font-family: "Playfair Display";
        font-size: 2em; /* Adjust as needed */
        margin-bottom: 0.5em; /* Space between the h1 and paragraph */
    }
    .header-text p {
        font-family: "Imprima";
        font-size: 1em; /* Adjust as needed */
        margin-bottom: 1em; /* Space below the paragraph */
    }
    .content {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        max-width: 1200px;
        width: 100%; /* To control the width of the content area */
        margin-top: 20px; /* Added space between header text and content */
    }
    /* .image-section {
        margin-right: 20px;
    }
    .image-section img {
        height: 85.5vh;
        min-width: 100%;
        width: auto;
        display: block;
        max-width: none;
    } */
    .booking-form {
        width: 500px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-family: "Imprima";
        font-size: 1.4em;
        /* font-weight: bold; */
        color: black;
        display: block;
        margin-bottom: 5px;
    }
    .button-group {
        border: 2px solid black; /* Black border for the container */
        border-radius: 20px;
        display: inline-flex;
        justify-content: center;
        overflow: hidden;
    }

    .button-group button {
        padding: 10px 30px; /* Wider buttons */
        border: none;
        background-color: #f8f9fa;
        cursor: pointer;
        outline: none;
        font-size: 1em;
        transition: background-color 0.2s ease;
        flex: 1; /* Equal width for all buttons */
    }

    .button-group button:not(:last-child) {
        border-right: 2px solid black; /* Black divider between buttons */
    }
    .button-group button.active {
        background-color: #e7e7e7;
    }
    .number-input {
        display: flex;
        align-items: center;
    }
    .number-input button {
        padding: 10px;
        border: 2px solid black;
        background-color: #f8f9fa;
        cursor: pointer;
        margin-left: 10px; /* Left margin added here */
    }

    .number-input button:first-child {
        margin-left: 0; /* No left margin for the first button */
    }
    .number-input input {
        border: 1px solid black;
        text-align: center;
        margin: 0 5px;
        max-width: 50px;
    }
    .submit-btn {
        background-color: red;
        color: white;
        padding: 10px 30px;
        border: none;
        cursor: pointer;
        font-family: 'Comic Sans MS';
        font-size: 16px;
        border-radius: 20px;
        transition: background-color 0.3s ease;
        margin: 20px auto 30px;
        display: block;
        width: 60%;
    }
    .submit-btn:hover {
        background-color: darkred;
    }
    .flag-icons img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }
    .ticket-btn {
        padding: 15px 30px; /* Larger padding for bigger buttons */
        margin: 5px; /* Add some space around buttons */
        border: 2px solid black;
        background-color: white; /* Set background to white */
        cursor: pointer;
        border-radius: 20px; /* Rounded corners */
        font-size: 1em; /* Adjust font size as needed */
        outline: none;
        transition: background-color 0.2s ease;
    }
    .ticket-btn.active,
    .ticket-btn:hover {
        background-color: #e7e7e7; /* Light grey background for active/hover state */
    }
    .total-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #ccc;
        padding: 15px 10px;
        margin: 20px 0;
    }
    .total-container label {
        font-family: 'Imprima';
        font-size: 1.6em;
        font-weight: bold;
        color: black;
    }
    .total-container span {
        font-family: 'Imprima';
        font-size: 1.6em;
        color: black;
    }
</style>
</head>
<body>
<div class="header-text">
        <h1>Book Ticket – History Tour</h1>
        <p>Embark on a captivating journey through Haarlem's rich tapestry of history! Join our immersive tour, where tales of the past come alive in English, Dutch, and Chinese, offering a truly multilingual exploration of this enchanting city.</p>
    </div>
    <div class="content mx-auto max-w-4xl p-4 flex flex-col md:flex-row items-center justify-center gap-4">
    <div class="image-section w-full md:w-1/2 flex justify-center items-center mb-4 md:mb-0">
        <img src="assets/images/history_event/history_ticket_purchase/Church-HistoryTicket.png" alt="Saint Bavo" class="max-w-full h-auto">
    </div>
    <div class="booking-form w-full md:w-1/2 grid gap-4">
        <div class="form-group flag-icons flex justify-center items-center gap-2">
            <label class="block text-sm font-medium text-gray-700">Selected Language</label>
            <div class="flex">
                <img src="assets/images/elements/UK-flag-small.png" alt="English" class="w-6 h-6">
                <img src="assets/images/elements/download 3.png" alt="Dutch" class="w-6 h-6">
                <img src="assets/images/elements/download 5.png" alt="Chinese" class="w-6 h-6">
            </div>
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <div class="button-group flex justify-center items-center gap-2" id="date-group">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="selectDate('25')">25</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="selectDate('26')">26</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="selectDate('27')">27</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="selectDate('28')">28</button>
            </div>
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700">Starting Time</label>
            <div class="button-group flex justify-center items-center gap-2" id="time-group">
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50" onclick="selectTime('10:00')">10:00</button>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50" onclick="selectTime('13:00')">13:00</button>
                <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50" onclick="selectTime('16:00')">16:00</button>
            </div>
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700">Type of Ticket</label>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-2">
                <button class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" onclick="selectTicketType('family')">Family Ticket (x4) - 60€</button>
                <button class="ticket-btn px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" onclick="selectTicketType('regular')">Regular Ticket - 17.50€</button>
            </div>
        </div>
        <div class="form-group number-input flex justify-center items-center gap-2">
            <label for="number-of-tickets" class="block text-sm font-medium text-gray-700">Number of Tickets</label>
            <button type="button" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none" onclick="changeNumberOfTickets(-1)">-</button>
            <input type="number" id="number-of-tickets" value="4" class="w-16 text-center rounded border-gray-300">
            <button type="button" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none" onclick="changeNumberOfTickets(1)">+</button>
        </div>
        <div class="total-container flex justify-center items-center">
            <label class="text-sm font-medium text-gray-700">Total:</label>
            <span id="total-price" class="ml-2 font-semibold">70.00€</span>
        </div>
        <button class="submit-btn mx-auto px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">Add to Cart</button>
    </div>
</div>


<script>
// Placeholder functions for button actions
function selectDate(date) {
    // Update selected date and reflect changes in UI
    var buttons = document.getElementById('date-group').getElementsByTagName('button');
    for (var button of buttons) {
        button.classList.remove('active');
    }
    document.querySelector("#date-group button[onclick='selectDate(\"" + date + "\")']").classList.add('active');
    // Additional logic to update the total and other elements if needed
}

function selectTime(time) {
    // Update selected time and reflect changes in UI
    var buttons = document.getElementById('time-group').getElementsByTagName('button');
    for (var button of buttons) {
        button.classList.remove('active');
    }
    document.querySelector("#time-group button[onclick='selectTime(\"" + time + "\")']").classList.add('active');
    // Additional logic to update the total and other elements if needed
}

function selectTicketType(type) {
    // Update selected ticket type and reflect changes in UI
    var buttons = document.querySelectorAll('.booking-form > .form-group > button');
    for (var button of buttons) {
        button.classList.remove('active');
    }
    document.querySelector(".booking-form > .form-group > button[onclick='selectTicketType(\"" + type + "\")']").classList.add('active');
    // Additional logic to update the total and other elements if needed
}

function changeNumberOfTickets(change) {
    // Function to increment or decrement the number of tickets
    var numberOfTicketsInput = document.getElementById('number-of-tickets');
    var currentTickets = parseInt(numberOfTicketsInput.value);
    var newTickets = currentTickets + change;
    if(newTickets >= 1) { // Assuming you want to limit the number to 1 or more
        numberOfTicketsInput.value = newTickets;
        // Additional logic to update the total and other elements if needed
    }
}
</script>
</body>
</html>

