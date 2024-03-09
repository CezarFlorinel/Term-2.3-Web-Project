<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <style>
        body {
            font-family: 'Arial', 'Playfair Display', sans-serif;
            background-color: #000;
            /* Set body background to black */
            margin: 0;
            padding: 0;
            display: block;
            /* Change to block or keep flex but adjust usage */
            color: white;
            /* Set text color to white */
            font-size: 2em;
        }

        .payment-method-container {
            width: 600px;
            text-align: center;
            margin: auto;
        }

        .payment-method-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .payment-method-header img {
            height: 50px;
            /* Adjust size as necessary */
            margin-right: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            background-color: #fff;
            border-radius: 20px;
            /* Rounded edges */
            padding: 10px 20px;
            cursor: pointer;
            /* Make it clickable */
        }

        .payment-option img {
            height: 30px;
            /* Adjust size as necessary */
        }

        .payment-option:hover {
            background-color: #f2f2f2;
            /* Hover effect */
        }

        .next-button {
            background-color: #ccc;
            border: none;
            padding: 10px 80px;
            /* Slightly longer button */
            margin-top: 20px;
            cursor: pointer;
            border-radius: 20px;
            /* Rounded button */
            font-weight: bold;
        }

        .next-button:hover {
            background-color: #b3b3b3;
            /* Hover effect */
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>

    <div style="height: 150px;"></div>
    <div class="payment-method-container" style="width: 50%; margin-left: auto; margin-right: auto">
        <div class="payment-method-header" style="color: white ; text-decoration: underline">
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Details Icon">
            <h2>Payment Details:</h2>
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('AMRO')">
            <span>IDeal</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\ABN AMRO.png" alt="AMRO">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('ING')">
            <span>PayPal</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\ING.png" alt="ING">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('N26')">
            <span>Credit Card</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\N26.png" alt="N26">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('RaboBank')">
            <span>IDeal</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\Rabobank.png" alt="RaboBank">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('SNS')">
            <span>PayPal</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\SNS.png" alt="SNS">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentDetails('Triodos Bank')">
            <span>Credit Card</span>
            <img src="assets\images\Payment_event_images\IDEAL_banks\Triodos_Bank.png" alt="Triodos Bank">
        </div>
        <button class="next-button">NEXT STEP →</button>
    </div>
    <div style="height: 150px;"></div>
    <?php include __DIR__ . '/../footer.php'; ?>
    <script>
        function selectPaymentDetails(method) {
            // Placeholder function for handling click event on payment options
            console.log('Selected payment detail:', method);
            // Implement further logic as required
        }
    </script>
</body>

</html>