<?php
$customerData = $_SESSION['customerData'];
$customerEmail = $customerData['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link rel="stylesheet" href="CSS_files/payment.css">
</head>

<body class="flex flex-col min-h-screen bg-black text-black">
    <div class="flex-grow">
        <?php require __DIR__ . '/../../components/general/topBar.php'; ?>
        <div class="flex-grow flex justify-center items-center mt-8 mb-6">
            <!-- Adjust the mt- and mb- values as needed -->
            <div class="w-full max-w-lg p-10 bg-white border border-gray-700 rounded-lg text-center">
                <img src="assets/images/Payment_event_images/success-green-check-mark-icon 1.png" alt="Success"
                    class="mx-auto mb-6">
                <h1 class="text-2xl font-bold mb-2">Thanks for your purchase!</h1>
                <p class="mb-4">The tickets for your festival have been successfully purchased!</p>
                <p class="mb-4">Get ready for an unforgettable experience!</p>
                <p class="mb-4">Confirmation details and related information have been sent to your email address
                    <?php echo htmlspecialchars($customerEmail) ?>.
                </p>
                <p class="mb-6">More information can be found in your personal program.</p>
                <a href="/personalProgramAgendaView"
                    class="inline-block bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                    BACK TO PERSONAL PROGRAM
                </a>
            </div>
        </div>
        <?php include __DIR__ . '/../../components/general/footer.php'; ?>
</body>

</html>