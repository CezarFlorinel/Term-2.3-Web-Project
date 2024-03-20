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

<body class="ideal-page">
<div class="scale-container">
    <?php include __DIR__ . '/../header.php'; ?>

    <div class="py-10"> <!-- Spacing at the top replaced with Tailwind padding -->
    <div class="payment-method-container max-w-lg mx-auto"> <!-- Centered container with a max-width -->
        <div class="payment-method-header flex items-center space-x-4 mb-6"> <!-- Header with spacing and margin -->
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Details Icon" class="flex-shrink-0">
            <h2 class="text-xl font-semibold">Payment Details:</h2>
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('AMRO')">
            <span>ABN AMRO</span>
            <img src="assets\images\Payment_event_images\ABN-Amro-logo.png" alt="AMRO" class="flex-shrink-0">
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('ING')">
            <span>ING</span>
            <img src="assets/images/Payment_event_images/IDEAL_banks/ING.png" alt="ING" class="flex-shrink-0">
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('N26')">
            <span>N26</span>
            <img src="assets/images/Payment_event_images/IDEAL_banks/N26.png" alt="N26" class="flex-shrink-0">
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('RaboBank')">
            <span>RaboBank</span>
            <img src="assets/images/Payment_event_images/IDEAL_banks/Rabobank.png" alt="RaboBank" class="flex-shrink-0">
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('SNS')">
            <span>SNS</span>
            <img src="assets/images/Payment_event_images/IDEAL_banks/SNS.png" alt="SNS" class="flex-shrink-0">
        </div>
        <div class="payment-option flex items-center justify-between mb-4 p-2 cursor-pointer" onclick="selectPaymentDetails('Triodos Bank')">
            <span>Triodos Bank</span>
            <img src="assets/images/Payment_event_images/IDEAL_banks/Triodos_Bank.png" alt="Triodos Bank" class="flex-shrink-0 w-12 h-12">
        </div>
        <button class="next-button w-full bg-blue-500 text-white py-3 px-6 rounded hover:bg-blue-600 transition duration-300">NEXT STEP →</button>
    </div>
</div>
<div class="py-10"> <!-- Spacing at the bottom replaced with Tailwind padding -->
</div>

    <?php include __DIR__ . '/../footer.php'; ?>
    <script>
        function selectPaymentDetails(method) {
            // Placeholder function for handling click event on payment options
            console.log('Selected payment detail:', method);
            // Implement further logic as required
        }
    </script>
    </div>
</body>

</html>