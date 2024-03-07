<?php
include __DIR__ . '/../header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History Tour Ticket Booking</title>
<style>
    .container {
        display: flex;
        width: 100%;
    }
    .image-section {
        flex: 1;
    }
    .booking-section {
        flex: 1;
        padding: 20px;
    }
    .flag-icons img {
        width: 50px;
        height: auto;
    }
    .date-time-section {
        display: flex;
        justify-content: space-between;
    }
    .button {
        background-color: #000; /* You can change the color */
        color: #fff; /* And the text color */
        padding: 10px;
        text-align: center;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
    }
    /* Add more styles as required */
</style>
</head>
<body>

<div class="container">
    <div class="image-section">
        <img src="assets/images/history_event/Saint bavo (3).jpg" alt="Saint Bavo">
        <!-- Arrows inside the image -->
        <img src="assets/images/elements/arrow-left 1.png" alt="Previous">
        <img src="assets/images/elements/arrow-right 1.png" alt="Next">
    </div>
    
    <div class="booking-section">
        <h1>Book Ticket - History Tour</h1>
        <p>Embark on a captivating journey through Haarlem's rich tapestry of history!...</p>
        
        <!-- Language Selection -->
        <div class="flag-icons">
            <img src="assets/images/elements/UK-flag-small.png" alt="English">
            <img src="assets/images/elements/download 3.png" alt="Dutch">
            <img src="assets/images/elements/download 5.png" alt="Chinese">
        </div>
        
        <!-- Date and Time Selection -->
        <div class="date-time-section">
            <div class="date-section">
                <!-- Date selection inputs -->
            </div>
            <div class="time-section">
                <!-- Time selection inputs -->
            </div>
        </div>
        
        <!-- Ticket Options -->
        <div class="ticket-options">
            <label for="ticket-type">Type of Ticket</label>
            <select id="ticket-type">
                <option value="family">Family Ticket (x4)</option>
                <option value="regular">Regular Ticket</option>
            </select>
            <!-- Number of tickets and Total -->
        </div>
        
        <!-- Add to Cart Button -->
        <button class="button">Add to Cart</button>
    </div>
</div>

</body>
</html>



<?php
include __DIR__ . '/../footer.php';
?>