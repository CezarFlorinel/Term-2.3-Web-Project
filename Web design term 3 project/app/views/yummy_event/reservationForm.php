<?php include __DIR__ . '/../header.php'; ?>

<?php


if (!isset($_GET['restaurantID'])) {
    header('Location: /');
    exit;
}
$restaurantID = $_GET['restaurantID'];

use App\Services\YummyService;

$yummyService = new YummyService();

$sessions = $yummyService->getRestaurantSession($restaurantID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body>
    <main class="bg-gray-800 flex justify-center items-center min-h-screen px-4 py-2 sm:px-6 lg:px-8"
        style="font-family: 'Playfair Display', serif;">
        <div class="bg-white p-10 rounded-lg shadow-lg mx-auto">
            <h1 class="text-4xl text-center font-semibold mb-6 text-gray-800">Reservation</h1>
            <!-- Adjust the action URL to controller's handling method route -->
            <form class="space-y-4" action="/ReservationFormYummy/handleReservation" method="POST">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">*Name:</label>
                    <input name="firstName"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="First Name" required>
                    <input name="lastName"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2"
                        id="surname" type="text" placeholder="Last Name" required>
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">*Email:</label>
                        <input name="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" placeholder="customer@email.com" required>
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number:</label>
                        <input name="phoneNumber"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="phone" type="tel" placeholder="### ### ###">
                    </div>
                    <!-- Hidden input field to store the restaurant ID -->
                    <input type="hidden" name="restaurantID" value="<?= $restaurantID ?>">
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="session">*Select Session:</label>
                        <select name="session" id="session" class="bg-blue-200 rounded py-2 px-4">
                            <?php $count = 1;
                            foreach ($sessions as $session): ?>
                                <option value="<?= $session->sessionID ?>"><?php echo $count;
                                  $count++; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">*Select date:</label>
                        <select name="date" id="date" class="bg-blue-200 rounded py-2 px-4">
                            <!-- Make them dynamic ?? -->
                            <option value="2024-07-26">26-07</option>
                            <option value="2024-07-27">27-07</option>
                            <option value="2024-07-28">28-07</option>
                            <option value="2024-07-29">29-07</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="adults">*Adults</label>
                        <input name="numberOfAdults"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="adults" type="number" placeholder="1" required>
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kids">Kids (12 y/o and
                            under)</label>
                        <input name="numberOfChildren"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="kids" type="number" placeholder="0">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">Comment:</label>
                    <textarea name="comment"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="comment" placeholder="Optional"></textarea>
                </div>
                <div class="flex justify-center">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Submit Reservation
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>