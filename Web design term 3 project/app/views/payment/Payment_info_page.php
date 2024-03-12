<?php
include __DIR__ . '/../header.php';
?>
<<<<<<< HEAD

<head>
=======
>>>>>>> Diego

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Information</title>
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
            font-family: 'Open Sans', sans-serif;
            background-color: #000; /* Changed to black */
        }
        .container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #000;
    color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
  }
  .steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    padding: 20px 0;
  }
  .step {
    text-align: center;
    flex-grow: 1;
  }
  .step-circle {
    width: 40px;
    height: 40px;
    line-height: 38px;
    border: 2px solid #fff;
    border-radius: 50%;
    display: inline-block;
    color: #fff;
    background-color: #444;
    position: relative;
    z-index: 1;
  }
  .step-text {
    display: block;
    margin-bottom: 15px;
    font-weight: 500;
  }
  .active-step {
    background-color: green;
  }
  .step-line {
    height: 2px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    z-index: 0;
  }
  .step:first-child .step-circle {
    margin-left: -20px;
  }
  .step:last-child .step-circle {
    margin-right: -20px;
  }
        

            .icon-image {
                height: 80px;
                /* Set the height to control the size of the image */
                width: auto;
                /* Maintain the aspect ratio */
                margin-right: 5px;
                /* Add some space between the image and the title */
                margin-left: 30px;
            }

            .form-header {
                color: white;
                /* Text color */
                margin-left: 40px;
                font-size: 2.5em;
            }

            .form-subtitle {
                color: red;
                /* Tailwind Blue-500 */
                margin-left: 180px;
            }

            .form-input {
                background: white;
                /* Tailwind Gray-900 */
                color: black;
                /* Input text color */
                border: none;
                width: 60%;
            }

            .form-label {
                color: white;
                /* Label color */
                font-family: 'Playfair Display';
                font-size: 1.6em;
                text-decoration: underline;
            }

            .button-back {
                background: blue;
                /* Tailwind Gray-800 */
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 0.375rem;
                /* Tailwind rounded-md */
                cursor: pointer;
            }

            .button-next {
                background: green;
                /* Tailwind Gray-800 */
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 0.375rem;
                /* Tailwind rounded-md */
                cursor: pointer;
            }

            .button-back:hover,
            .button-next:hover {
                background: #374151;
                /* Tailwind Gray-700 */
            }
        </style>
    </head>

<body>
<div class="container">
  <!-- Steps Indicator -->
  <div class="steps">
    <div class="step-line"></div>
    <div class="step">
      <span class="step-text">Payment Information</span>
      <div class="step-circle active-step">1</div>
    </div>
    <div class="step">
      <span class="step-text">Payment Method</span>
      <div class="step-circle">2</div>
    </div>
    <div class="step">
      <span class="step-text">Payment Details</span>
      <div class="step-circle">3</div>
    </div>
    <div class="step">
      <span class="step-text">Overview</span>
      <div class="step-circle">4</div>
    </div>
    <div class="step">
      <span class="step-text">Finish</span>
      <div class="step-circle">5</div>
    </div>
  </div>

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
                    <p class="text-xs text-gray-400">We need your phone number to contact you in case something goes
                        wrong</p>
                </div>

                <div style="height: 20px;"></div>

                <!-- Email Address Input -->
                <div class="mb-4">
                    <label class="block form-label">Email Address:</label>
                    <input type="email" class="w-full px-3 py-2 rounded-lg form-input" required>
                    <p class="text-xs text-gray-400">We need your email address to send you all information related to
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

</html>

<?php
include __DIR__ . '/../footer.php';
?>