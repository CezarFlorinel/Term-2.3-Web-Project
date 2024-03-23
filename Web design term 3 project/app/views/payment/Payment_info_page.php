<html lang="en">
<?php
include __DIR__ . '/../header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS_files/payment.css">
</head>

<body class="payment-info-page">
<div class="container">
            <!-- Form Title -->
            <div class="mb-6 flex items-center">
                <img src="assets/images/Payment_event_images/Payment_info.png" alt="Payment Information"
                    class="icon-image">
                <h2 class="text-2xl font-semibold form-header ml-4">Payment Information</h2>
            </div>

            <p class="text-red-500 form-subtitle">*All fields are mandatory to complete a purchase</p>

            <!-- Form Fields -->
            <form>
                <div style="height: 20px;"></div>
                <!-- Country/Region Input -->
                <div class="mb-4">
                    <label class="block form-label">Country/Region:</label>
                    <input type="text" class="w-full px-3 py-2 rounded-lg form-input" required>
                </div>

                <div style="height: 20px;"></div>

                <!-- Full Name Input -->
                <div class="mb-4">
                    <label class="block form-label">Full Name (First & Last name):</label>
                    <input type="text" class="w-full px-3 py-2 rounded-lg form-input" required>
                </div>

                <div style="height: 20px;"></div>

                <!-- Phone Number Input -->
                <div class="mb-4">
                    <label class="block form-label">Phone Number:</label>
                    <input type="tel" class="w-full px-3 py-2 rounded-lg form-input" required>
                    <p class="info-text">We need your phone number to contact you in case something goes
                        wrong</p>
                </div>

                <div style="height: 20px;"></div>

                <!-- Email Address Input -->
                <div class="mb-4">
                    <label class="block form-label">Email Address:</label>
                    <input type="email" class="w-full px-3 py-2 rounded-lg form-input" required>
                    <p class="info-text">We need your email address to send you all information related to
                        the tickets</p>
                </div>

                <div style="height: 20px;"></div>

                <!-- Street Address Input -->
                <div class="mb-4">
                    <label class="block form-label">Street Address:</label>
                    <input type="text" placeholder="Street Name" class="w-full px-3 py-2 rounded-lg form-input mb-2"
                        required>
                    <input type="text" placeholder="Extra Information" class="w-full px-3 py-2 rounded-lg form-input"
                        required>
                </div>

                <div style="height: 20px;"></div>

                <!-- City and County Input -->
                <div class="flex mb-4">
                    <div class="w-1/2 pr-2">
                        <label class="block form-label">City:</label>
                        <input type="text" class="w-full px-3 py-2 rounded-lg form-input" required>
                    </div>
                    <div class="w-1/2 pl-2" style="margin-left: -250px;">
                        <label class="block form-label">County:</label>
                        <input type="text" class="w-full px-3 py-2 rounded-lg form-input" required>
                    </div>
                </div>

                <div style="height: 20px;"></div>

                <!-- ZIP Code Input -->
                <div class="mb-4">
                    <label class="block form-label">ZIP code:</label>
                    <input type="text" class="w-full px-3 py-2 rounded-lg form-input" required>
                </div>

                <div style="height: 20px;"></div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button type="button" class="button-back">&larr; Back to Shopping Cart</button>
                    <button type="submit" class="button-next">NEXT STEP &rarr;</button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php
include __DIR__ . '/../footer.php';
?>
</html>