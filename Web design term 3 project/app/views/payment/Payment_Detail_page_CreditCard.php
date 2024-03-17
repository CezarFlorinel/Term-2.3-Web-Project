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
<div class="scale-container">
    <div style="height: 100px;"></div>
    <div class="payment-method-container">
        <div class="payment-method-header">
            <img src="assets/images/Payment_event_images/PaymentMethodIcon.png" alt="Payment Details Icon">
            <h2>Payment Details:</h2>
        </div>
        <div class="card-container">
            <div class="card card-front">
                <label for="cardNumber">Card number</label>
                <input type="text" id="cardNumber" placeholder="Card number">

                <label for="cardName">Cardholder's name</label>
                <input type="text" id="cardName" placeholder="Cardholder's name">

                <label for="expiryDate">Expiration date</label>
                <input type="text" id="expiryDate" placeholder="MM/YY">
            </div>

            <div class="card card-back">
                <div class="cvv-box">
                    <span class="cvv-title">CVC</span>
                    <input type="text" id="cvv" maxlength="3" placeholder="CVV">
                </div>
                <div class="cvv-detail">
                    *CVV are the 3 digits on the back of the card
                </div>
            </div>
        </div>

        <button type="submit" class="next-button">NEXT STEP →</button>
        <div style="height: 100px;"></div>
        </div>
</body>
</html>