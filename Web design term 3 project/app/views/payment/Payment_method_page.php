<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS_files/payment.css">
</head>

<body class="method-page">
<?php include __DIR__ . '/../header.php'; ?>
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