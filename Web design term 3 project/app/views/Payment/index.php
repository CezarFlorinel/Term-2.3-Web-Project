
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000; /* Set body background to black */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            min-height: 100vh; /* Full height */
            color: white; /* Set text color to white */
            font-family: 'Playfair Display';
            font-size: 2em;
        }
        .payment-method-container {
            flex: 1; /* Fill available space */
            width: 600px;
            text-align: center;
            margin: auto 0; /* Center in the available space */
        }
        .payment-method-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .payment-method-header img {
            height: 50px; /* Adjust size as necessary */
            margin-right: 10px;
        }
        .payment-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 20px; /* Rounded edges */
            padding: 10px 20px;
            cursor: pointer; /* Make it clickable */
        }
        .payment-option img {
            height: 30px; /* Adjust size as necessary */
        }
        .payment-option:hover {
            background-color: #f2f2f2; /* Hover effect */
        }
        .next-button {
            background-color: #ccc;
            border: none;
            padding: 10px 80px; /* Slightly longer button */
            margin-top: 20px;
            cursor: pointer;
            border-radius: 20px; /* Rounded button */
            font-weight: bold;
        }
        .next-button:hover {
            background-color: #b3b3b3; /* Hover effect */
        }
    </style>
</head>
<body>
    <div class="payment-method-container">
        <div class="payment-method-header" style = "color: white ; text-decoration: underline">
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Method Icon">
            <h2>Payment Method:</h2>
        </div>
        <div class="payment-option" onclick="selectPaymentMethod('ideal')">
            <span>IDeal</span>
            <img src="assets/images/Payment_event_images/IDEAL_Logo.png" alt="IDEAL Logo">
        </div>
        <div class="payment-option" onclick="selectPaymentMethod('paypal')">
            <span>PayPal</span>
            <img src="assets/images/Payment_event_images/Paypal-logo.png" alt="PayPal Logo">
        </div>
        <div class="payment-option" onclick="selectPaymentMethod('creditcard')">
            <span>Credit Card</span>
            <img src="assets/images/Payment_event_images/Group_Credit_Card.png" alt="Credit Card Logos">
        </div>
        <button class="next-button">NEXT STEP →</button>
    </div>

    <script>
        function selectPaymentMethod(method) {
            // Placeholder function for handling click event on payment options
            console.log('Selected payment method:', method);
            // Implement further logic as required
        }
    </script>
</body>
</html>