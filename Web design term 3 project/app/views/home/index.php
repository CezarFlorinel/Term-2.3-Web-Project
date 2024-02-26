<?php
include __DIR__ . '/../header.php';


// Initialize the repository
$repository = new App\Repositories\userRepository();

// Fetch users
$users = $repository->getUsers();
?>

<h1>Welcome to the MVC Blog!</h1>

<h2>Our Users</h2>
<?php if (!empty($users)): ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= htmlspecialchars($user['Username']) ?> - <?= htmlspecialchars($user['Email']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>
===================

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harlem Festival</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .fest-bg { background-color: #333; }
        .section-bg { background-color: #EEE8AA; }
        .schedule-bg { background-color: #222; }
        .event-bg { background-color: #fff; }
        .text-gold { color: #DAA520; }
        .text-dim-white { color: rgba(255, 255, 255, 0.7); }
    </style>
</head>

<body class="antialiased font-'Open Sans'">
    <!-- Header -->
    <header class="fest-bg text-white py-8">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div>
                <h1 class="text-6xl font-bold">HARLEM FESTIVAL</h1>
                <p class="text-lg mt-2">Let The Fun Begin</p>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li>Home</li>
                    <li>Theatre</li>
                    <li>Music</li>
                    <li>Museums</li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Section -->
    <main>
        <!-- What to do section -->
        <section class="section-bg py-10 px-4">
            <h2 class="text-4xl font-bold text-center mb-8">WHAT IS THERE TO DO?</h2>

            <!-- Cards -->
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Dance -->
                <div class="event-bg rounded-lg p-6">
                    <img src="https://placehold.co/300x200" alt="A vibrant dance event with people enjoying music and performances" class="rounded-lg">
                    <h3 class="text-gold text-2xl font-bold mt-4">Dance!</h3>
                    <p class="text-gray-600 mt-2">With tons of bars and live venues playing soul and gospel singers' concerts, Harlem is the place to be.</p>
                    <a href="#" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block">Learn More</a>
                </div>

                <!-- Food -->
                <div class="event-bg rounded-lg p-6">
                    <img src="https://placehold.co/300x200" alt="Delicious food offerings from various Harlem restaurants" class="rounded-lg">
                    <h3 class="text-gold text-2xl font-bold mt-4">Yummy!</h3>
                    <p class="text-gray-600 mt-2">Discover the hidden gems of Harlem's vibrant culinary scene as we bring you a taste of the best.</p>
                    <a href="#" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block">Learn More</a>
                </div>

                <!-- History -->
                <div class="event-bg rounded-lg p-6">
                    <img src="https://placehold.co/300x200" alt="Historical sites and museums offering a walk through Harlem's history" class="rounded-lg">
                    <h3 class="text-gold text-2xl font-bold mt-4">A Stroll Through History</h3>
                    <p class="text-gray-600 mt-2">Harlem is rich in history and we invite you to immerse yourself in it during the festival.</p>
                    <a href="#" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block">Learn More</a>
                </div>
            </div>

===================
<?php
include __DIR__ . '/../footer.php';
?>
