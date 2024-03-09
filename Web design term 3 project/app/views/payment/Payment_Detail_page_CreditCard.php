<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Form</title>
    <style>
        body {
            font-family: 'Arial', 'Playfair Display', sans-serif;
            background-color: #000;
            /* Black background */
            margin: 0;
            padding: 0;
            color: #ffffff;
            /* White text for visibility */
        }

        .card-container {
            display: flex;
            /* Place card forms next to each other */
            align-items: flex-start;
            /* Align cards to the top */
            justify-content: center;
            gap: 20px;
            /* Space between cards */
        }

        .card {
            background-color: #005792;
            /* Dark blue background */
            border-radius: 10px;
            /* Rounded corners for the card */
            color: #ffffff;
            /* White text for visibility */
            padding: 20px;
            width: 300px;
            /* Equal width for both cards */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
            position: relative;
            /* For absolute positioning inside */
        }

        .card input {
            background: transparent;
            border: none;
            border-bottom: 2px solid #ffffff;
            /* White bottom border */
            color: #ffffff;
            font-size: 1em;
            width: 100%;
            margin-bottom: 20px;
            padding: 5px 0;
        }

        .card label {
            display: block;
            margin-bottom: 10px;
            font-size: 0.8em;
        }

        .card-back {
            height: 223px;
            /* Larger height for the back card */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .card-back::before {
            content: '';
            display: block;
            width: 100%;
            /* Full width of the card */
            height: 60px;
            /* Height of the black line */
            background-color: #000;
            /* Black color for the line */
            position: absolute;
            top: 20px;
            /* Position the line at the top of the card-back */
            left: 0;
        }

        .cvv-box {
            border-radius: 5px;
            color: #ffffff;
            padding: 5px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .cvv-box input {
            width: 60px;
            /* Fixed width for CVV input */
            border-bottom: 2px solid #ffffff;
            /* White bottom border */
            text-align: center;
        }

        .cvv-box .cvv-title {
            font-size: 1em;
        }

        .cvv-detail {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-size: 0.8em;
        }

        .next-button {
            background-color: #ccc;
            border: none;
            padding: 10px 80px;
            margin-top: 30px;
            margin-bottom: 30px;
            /* Add bottom margin if needed */
            cursor: pointer;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1em;
            color: white;
            display: block;
            /* Set to block to allow margins to center the element */
            margin-left: auto;
            margin-right: auto;
            /* Auto margins center the block-level element */
            width: fit-content;
            /* Set width to the content of the button */
        }

        main {
            flex: 1 0 auto;
            width: 100%;
            /* Match header/footer width */
            padding: 20px;
            box-sizing: border-box;
            /* Include padding in width calculation */
            overflow-y: auto;
            /* Enable vertical scrolling */
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

        .payment-method-container {
            width: 600px;
            text-align: center;
            margin: auto;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <div style="height: 100px;"></div>
    <div class="payment-method-container" style="width: 50%; margin-left: auto; margin-right: auto">
        <div class="payment-method-header" style="color: white ; font-size: 2em; text-decoration: underline">
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
        <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>