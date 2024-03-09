<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History Tour Ticket Booking</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 40px;
        background-color: black;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100vh;
    }
    .header-text {
        text-align: center;
        position: absolute;
        top: 40px; /* Distance from the top */
        width: 100%;
    }
    .content {
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Align the tops of the image and form */
        max-width: 1200px;
        margin-top: 120px; /* Space for the header text */
    }
    .image-section {
        margin-right: 20px; /* Space between image and form */
    }
    .image-section img {
    height: 86.5vh;
    min-width: 100%; /* Ensure it scales up to at least the width of its container */
    width: auto;
    display: block;
    max-width: none;
}
    .text-section {
        padding: 10px;
    }
    .text-overlay {
        position: absolute;
        top: 20px; /* Adjust as needed */
        left: 20px; /* Adjust as needed */
        right: 20px; /* Adjust as needed */
        color: white;
    }
    .booking-form {
        width: 500px; /* Width of the form */
        padding: 20px;
        padding-bottom: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    .booking-form h2 {
        margin-top: 0;
        color: #333;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-family: 'Imprima';
        font-size: 1.4em;
        color: black;
        display: block;
        margin-bottom: 5px;
    }
    .form-group input,
    .form-group select {
    width: 100%;
    padding: 10px;
    margin-top: 5px; /* Reduced top margin */
    margin-bottom: 5px; /* Add bottom margin if needed */
    border-radius: 4px;
    border: 1px solid #ccc;
    }
    .form-group {
    margin-right: 10px; /* Reduced from 15px to bring form groups closer */
    }
    .number-input {
        display: flex;
        align-items: center;
    }
    .number-input button {
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .number-input input {
        text-align: center;
        margin: 0 5px;
        max-width: 50px;
    }
    .submit-btn {
    background-color: red;
    color: white;
    padding: 10px 30px; /* Increase horizontal padding for wider button */
    border: none;
    cursor: pointer;
    font-family: 'Comic Sans MS';
    font-size: 16px;
    border-radius: 20px; /* Increase border-radius for rounder borders */
    transition: background-color 0.3s ease;
    margin: 20px auto 30px; /* Add bottom margin */
    display: block; /* Ensures that 'margin: auto' works for horizontal centering */
    width: 60%; /* Set a width or use 'max-width' for a maximum width */
}
    .submit-btn:hover {
        background-color: red;
    }
    .flag-icons img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }
    .total-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #ccc; /* This adds the grey line */
    padding: 15px 10px; /* Increased vertical padding and decreased horizontal padding */
    margin: 20px 0; /* Increased margin to add space above and below */
}

.total-container label {
    margin-top: 10px;
    font-family: 'Imprima';
    font-size: 1.6em;
    margin-left: 300px; /* Adds space between the label and the value */
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
<div style="height: 100px;"></div>
<!-- <div class="container">
    <div class="header-text" style="text-align: center; position: absolute; top: 40px; width: 100%;">
        <h1 style="margin-left: 20px;">Book Ticket - History Tour</h1>
        <p style="margin-left: 20px; margin-bottom: 20px;">Embark on a captivating journey through Haarlem's rich tapestry of history! Join our immersive tour, where tales of the past come alive in English, Dutch, and Chinese, offering a truly multilingual exploration of this enchanting city.</p>
    </div>
</div> -->

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
                <label for="date">Date</label>
                <select id="date">
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                </select>
            </div>
            <div class="form-group">
                <label for="time">Starting Time</label>
                <select id="time">
                    <option value="10:00">10:00</option>
                    <option value="13:00">13:00</option>
                    <option value="16:00">16:00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ticket-type">Type of Ticket</label>
                <select id="ticket-type">
                    <option value="family">Family Ticket (x4) - 60€</option>
                    <option value="regular">Regular Ticket - 17.50€</option>
                </select>
            </div>
            <div class="form-group number-input">
                <label for="number-of-tickets">Number of Tickets</label>
                <button>-</button>
                <input type="number" id="number-of-tickets" value="4">
                <button>+</button>
            </div>
            <div class="total-container">
                <label>Total:</label>
                <span>70.00€</span> <!-- Changed input to plain text -->
            </div>
            <button class="submit-btn">Add to Cart</button>
        </div>
    </div>
</div>
<div style="height: 100px;"></div>
</body>
</html>