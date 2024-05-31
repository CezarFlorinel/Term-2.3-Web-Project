<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
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
            <form class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">*Name:</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="First Name">
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2"
                        id="surname" type="text" placeholder="Last Name">
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">*Email:</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" placeholder="customer@email.com">
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number:</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="phone" type="tel" placeholder="### ### ###">
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="session">*Select Session:</label>
                        <div class="flex justify-between">
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">1</button>
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">2</button>
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">3</button>
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">*Select date:</label>
                        <div class="grid grid-cols-4 gap-1">
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">25-07</button>
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">26-07</button>
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">27-07</button>
                            <button type="button" class="bg-blue-200 rounded py-2 px-4">28-07</button>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="adults">*Adults</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="adults" type="number" placeholder="−">
                    </div>
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kids">Kids (12 y/o and
                            under)</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="kids" type="number" placeholder="−">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">Comment:</label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="comment" placeholder=""></textarea>
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