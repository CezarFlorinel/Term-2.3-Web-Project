<?php
require __DIR__ . '/../../components/festival/dance_event/home_page/getData.php';
?>
<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="CSS_files/dance_event.css">


    <style>
        .rating-star {
            color: #ffd700;
            /* gold color */
        }

        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
    <main>
        <div class="start-image-container"
            style="background-image: url('../<?php echo htmlspecialchars($imagePathTop) ?>'); background-size: cover; background-position: center; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
            <div class="start-image-text">
                <h1 class="text-1-h">HAARLEM</h1>
                <h1 class="text-2-h">Festival</h1>
                <h1 class="text-3-h">Dance Event</h1>
            </div>
        </div>

        <div class="bg-black py-8 ">
            <div class="max-w-6xl mx-auto px-4">

                <?php include __DIR__ . '/../../components/festival/dance_event/home_page/artistLineup.php'; ?>

                <div class="bg-black text-white py-8">
                    <?php include __DIR__ . '/../../components/festival/dance_event/home_page/clubLocations.php'; ?>
                    <?php include __DIR__ . '/../../components/festival/dance_event/home_page/schedule.php'; ?>
                </div>

                <?php include __DIR__ . '/../../components/festival/dance_event/home_page/passes.php'; ?>

                <!-- Ticket Section -->
                <div id="ticket-section" class="flex justify-between items-center mb-2 mt-12">
                    <h2 class="text-3xl font-bold">Select Your Ticket:</h2>
                </div>
                <?php require __DIR__ . '/../../components/festival/dance_event/home_page/tickets.php'; ?>

            </div>

        </div>
    </main>

    <script type="text/javascript">
        const clubLocations = <?php echo json_encode($clubLocations); ?>;
        const artists = <?php echo json_encode($artists); ?>;
        const danceTickets = <?php echo json_encode($danceTickets); ?>;
    </script>

    <script type="module" src="javascript/Dance/festival_general_page.js"></script>
    <script type="module" src="javascript/Dance/order_tickets_dance_home.js"></script>

</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>