<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            /* Set body background to black */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            /* Stack items vertically */
            min-height: 100vh;
            /* Full height */
            color: white;
            /* Set text color to white */
            font-family: 'Playfair Display';
            font-size: 2em;
        }

        .payment-method-container {
            flex: 1;
            /* Fill available space */
            width: 600px;
            text-align: center;
            margin: auto 0;
            /* Center in the available space */
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

    .container {
        font-family: 'Open Sans', sans-serif;
        max-width: 100%;
        margin: 20px auto;
        background-color: #000;
        color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .steps {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        position: relative;
        padding: 20px 0;
    }
    .step {
        text-align: center;
        flex-grow: 1;
        flex-basis: 20%; /* Adjust this value to control the minimum width of each step */
    }
    .step-circle {
        width: 40px;
        height: 40px;
        line-height: 38px;
        border: 2px solid #fff;
        border-radius: 50%;
        display: inline-block;
        color: #fff;
        background-color: #444;
        position: relative;
        z-index: 1;
    }
    .step-text {
        display: block;
        margin-bottom: 15px;
        font-weight: 500;
    }
    .active-step {
        background-color: green;
    }
    .step-line {
        display: none; /* Hide step-lines on smaller screens for better responsiveness */
    }
    @media (min-width: 768px) {
        .step-line {
            height: 2px;
            background-color: #fff;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0;
            right: 0;
            z-index: 0;
            display: block;
        }
    }
    /* Adjustments for first and last step-circle positioning on smaller screens */
    .step:first-child .step-circle {
        margin-left: 0; /* Adjust as needed */
    }
    .step:last-child .step-circle {
        margin-right: 0; /* Adjust as needed */
    }

    </style>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>

    <div class="container">
  <!-- Steps Indicator -->
  <div class="steps">
    <div class="step-line"></div>
    <div class="step">
      <span class="step-text">Payment Information</span>
      <div class="step-circle active-step">1</div>
    </div>
    <div class="step">
      <span class="step-text">Payment Method</span>
      <div class="step-circle">2</div>
    </div>
    <div class="step">
      <span class="step-text">Payment Details</span>
      <div class="step-circle">3</div>
    </div>
    <div class="step">
      <span class="step-text">Overview</span>
      <div class="step-circle">4</div>
    </div>
    <div class="step">
      <span class="step-text">Finish</span>
      <div class="step-circle">5</div>
    </div>
  </div>
</div>

    <div style="height: 150px;"></div>
    <div class="payment-method-container" style="width: 50%; margin-left: auto; margin-right: auto">
        <div class="payment-method-header" style="color: white ; text-decoration: underline">
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Method Icon">
            <h2>Payment Method:</h2>
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentMethod('ideal')">
            <span>IDeal</span>
            <img src="assets/images/Payment_event_images/IDEAL_Logo.png" alt="IDEAL Logo">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentMethod('paypal')">
            <span>PayPal</span>
            <img src="assets/images/Payment_event_images/Paypal-logo.png" alt="PayPal Logo">
        </div>
        <div class="payment-option" style="color: black" onclick="selectPaymentMethod('creditcard')">
            <span>Credit Card</span>
            <img src="assets/images/Payment_event_images/Group_Credit_Card.png" alt="Credit Card Logos">
        </div>
        <button class="next-button">NEXT STEP →</button>
    </div>
    <div style="height: 150px;"></div>
    <?php include __DIR__ . '/../footer.php'; ?>
    <script>
        function selectPaymentMethod(method) {
            // Placeholder function for handling click event on payment options
            console.log('Selected payment method:', method);
            // Implement further logic as required
        }
    </script>
</body>

</html>