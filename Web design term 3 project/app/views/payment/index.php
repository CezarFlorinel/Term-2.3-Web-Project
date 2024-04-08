<!DOCTYPE html>
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

    <div class="scale-container">
        <!-- Form Title -->
        <div class="mb-6 flex items-center">
            <img src="assets/images/Payment_event_images/Payment_info.png" alt="Payment Information"
                class="icon-image w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16">
            <!-- Use responsive font sizing to ensure text fits and doesn't touch each other -->
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-semibold form-header ml-2 sm:ml-4 md:ml-6">
                Payment Information</h2>
        </div>
        <p class="form-subtitle mt-[-20px] ml-20 text-red-500">*All fields are mandatory to complete a purchase</p>
    </div>


    <!-- Form Fields -->
    <form action="/payment/storeCustomerData" method="POST" class="space-y-5">
        <!-- Country/Region Input -->
        <div>
            <label class="block form-label">Country/Region:</label>
            <input type="text" name="country" class="w-full px-3 py-2 rounded-lg form-input" required>
        </div>

        <!-- Full Name Input -->
        <div>
            <label class="block form-label">Full Name (First & Last name):</label>
            <input type="text" name="name" class="w-full px-3 py-2 rounded-lg form-input" required>
        </div>

        <!-- Phone Number Input -->
        <div>
            <label class="block form-label">Phone Number:</label>
            <input type="tel" name="phoneNumber" class="w-full px-3 py-2 rounded-lg form-input" required>
            <p class="text-xs sm:text-sm md:text-base info-text">We need your phone number to contact you in case
                something goes wrong</p>
        </div>

        <!-- Email Address Input -->
        <div>
            <label class="block form-label">Email Address:</label>
            <input type="email" name="email" class="w-full px-3 py-2 rounded-lg form-input" required>
            <p class="text-xs sm:text-sm md:text-base info-text">We need your email address to send you all information
                related to the tickets</p>
        </div>

        <!-- Street Address Input -->
        <div>
            <label class="block form-label">Street Address:</label>
            <input type="text" name="address" placeholder="Street Name"
                class="w-full px-3 py-2 rounded-lg form-input mb-2" required>
            <input type="text" name="extraAddress" placeholder="Extra Information"
                class="w-full px-3 py-2 rounded-lg form-input" required>
        </div>

        <!-- City and County Input -->
        <div class="flex flex-col space-y-2">
            <div>
                <label class="block form-label">City:</label>
                <input type="text" name="city" class="w-full px-3 py-2 rounded-lg form-input" required>
            </div>
            <div>
                <label class="block form-label">County:</label>
                <input type="text" name="county" class="w-full px-3 py-2 rounded-lg form-input" required>
            </div>
        </div>

        <!-- ZIP Code Input -->
        <div>
            <label class="block form-label">ZIP code:</label>
            <input type="text" name="zip" class="w-full px-3 py-2 rounded-lg form-input" required>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <a href="/">
                <button type="button" class="button-back">&larr; Back to Shopping Cart</button>
            </a>
            <button type="submit" class="button-next">NEXT STEP &rarr;</button>
        </div>
    </form>
</body>
<?php
include __DIR__ . '/../footer.php';
?>

</html>