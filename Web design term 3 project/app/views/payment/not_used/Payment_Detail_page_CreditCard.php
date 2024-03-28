<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Form</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS_files/payment.css">
</head>
<body class="creditcard-page">
<?php include __DIR__ . '/../header.php'; ?>
<div class="scale-container">
    <div class="flex flex-col justify-center items-center min-h-screen bg-black text-white">
    <!-- Payment Method Header -->
    <div class="payment-method-container w-full max-w-4xl p-4">
        <div class="payment-method-header flex justify-center mb-8">
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Details Icon" class="mr-4">
            <h2 class="text-xl font-semibold">Payment Details:</h2>
        </div>
    </div>

    <div class="w-full max-w-4xl mx-auto p-4">
    <!-- Card Container with responsive grid and increased gap -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-20 mb-8 justify-items-center">
        <!-- Card Front -->
        <div class="card card-front p-4 rounded-lg shadow-lg bg-blue-600 max-w-sm md:max-w-none">
            <!-- Card Number -->
            <label for="cardNumber" class="block mb-2">Card number</label>
            <input type="text" id="cardNumber" placeholder="Card number" class="mb-4 p-2 rounded bg-blue-700 w-full">
            <!-- Cardholder's Name -->
            <label for="cardName" class="block mb-2">Cardholder's name</label>
            <input type="text" id="cardName" placeholder="Cardholder's name" class="mb-4 p-2 rounded bg-blue-700 w-full">
            <!-- Expiration Date -->
            <label for="expiryDate" class="block mb-2">Expiration date</label>
            <input type="text" id="expiryDate" placeholder="MM/YY" class="mb-4 p-2 rounded bg-blue-700 w-full">
        </div>
        <!-- Card Back -->
        <div class="card card-back p-4 rounded-lg shadow-lg bg-blue-600 max-w-sm md:max-w-none">
            <!-- CVC Box -->
            <div class="cvv-box mb-4">
                <span class="cvv-title block mb-2">CVC</span>
                <input type="text" id="cvv" maxlength="3" placeholder="CVV" class="p-2 rounded bg-blue-700 w-full">
            </div>
        <!-- CVV Detail -->
        <div class="cvv-detail text-xs">
            *CVV are the 3 digits on the back of the card
        </div>
    </div>
</div>
</div>
        <!-- Next Step Button -->
        <button type="submit" class="next-button w-full bg-blue-500 hover:bg-blue-700 text-white py-3 px-6 rounded transition duration-300">
            NEXT STEP →
        </button>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>