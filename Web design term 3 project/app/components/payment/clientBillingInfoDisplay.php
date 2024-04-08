<div class="flex justify-between mb-6">
    <!-- Client Details -->
    <div class="w-1/2 pr-4">
        <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Client Details:</h3>
        <p>Full Name:
            <?php echo htmlspecialchars($customerData['name']) ?>
        </p>
        <p>Email:
            <?php echo htmlspecialchars($customerData['email']) ?>
        </p>
        <p>Phone Number:
            <?php echo htmlspecialchars($customerData['phoneNumber']) ?>
        </p>
    </div>

    <!-- Billing Information -->
    <div class="w-1/2 pl-4">
        <h3 class="text-lg font-bold mb-2 border-b border-gray-200 pb-2">Billing Information:</h3>
        <p>Country:
            <?php echo htmlspecialchars($customerData['country']) ?>
        </p>
        <p>Street:
            <?php echo htmlspecialchars($customerData['address']) ?>
        </p>
        <p>Extra Address:
            <?php echo htmlspecialchars($customerData['extraAddress']) ?>
        <p>City:
            <?php echo htmlspecialchars($customerData['city']) ?>
        </p>
        <p>County:
            <?php echo htmlspecialchars($customerData['county']) ?>
        </p>
        <p>Zip Code:
            <?php echo htmlspecialchars($customerData['zip']) ?>
        </p>
    </div>
</div>