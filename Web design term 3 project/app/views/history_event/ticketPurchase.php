<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History Tour Ticket Booking</title>
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
        font-size: 3em; /* Adjust as needed */
        margin-bottom: 0.5em; /* Space between the h1 and paragraph */
    }
    .header-text p {
        font-family: "Imprima";
        font-size: 1.5em; /* Adjust as needed */
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
    .image-section {
        margin-right: 20px;
    }
    .image-section img {
        height: 85.5vh;
        min-width: 100%;
        width: auto;
        display: block;
        max-width: none;
    }
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
<div class="content">
    <div class="image-section">
        <img src="assets/images/history_event/Chruch-Order-Ticket-Image.png" alt="Saint Bavo">
    </div>
    <div class="booking-form">
        <div class="form-group flag-icons">
            <label>Selected Language</label>
            <img src="assets/images/elements/UK-flag-small.png" alt="English">
            <img src="assets/images/elements/download 3.png" alt="Dutch">
            <img src="assets/images/elements/download 5.png" alt="Chinese">
        </div>
        <div class="form-group">
            <label>Date</label>
            <div class="button-group" id="date-group">
                <button onclick="selectDate('25')">25</button>
                <button onclick="selectDate('26')">26</button>
                <button onclick="selectDate('27')">27</button>
                <button onclick="selectDate('28')">28</button>
            </div>
        </div>
        <div class="form-group">
            <label>Starting Time</label>
            <div class="button-group" id="time-group">
                <button onclick="selectTime('10:00')">10:00</button>
                <button onclick="selectTime('13:00')">13:00</button>
                <button onclick="selectTime('16:00')">16:00</button>
            </div>
        </div>
        <div class="form-group">
            <label>Type of Ticket</label>
            <button class="ticket-btn" onclick="selectTicketType('family')">Family Ticket (x4) - 60€</button>
            <button class="ticket-btn" onclick="selectTicketType('regular')">Regular Ticket - 17.50€</button>
        </div>
        <div class="form-group number-input">
            <label for="number-of-tickets">Number of Tickets</label>
            <button type="button" onclick="changeNumberOfTickets(-1)">-</button>
            <input type="number" id="number-of-tickets" value="4">
            <button type="button" onclick="changeNumberOfTickets(1)">+</button>
        </div>
        <div class="total-container">
            <label>Total:</label>
            <span id="total-price">70.00€</span>
        </div>
        <button class="submit-btn">Add to Cart</button>
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

