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