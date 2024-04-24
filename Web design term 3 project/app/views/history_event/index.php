<?php require __DIR__ . '/../../components/general/getHistoryData.php'; ?>

<?php
include __DIR__ . '/../header.php';
?>
<html>

<head>
    <title>History Event</title>
    <!-- move some of this in the header -->
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS_files/history_event.css">
</head>

<body>

    <?php include __DIR__ . '/../../components/festival/history_event/topDescriptionAndCarousel.php'; ?>
    <?php include __DIR__ . '/../../components/festival/history_event/route.php'; ?>
    <?php include __DIR__ . '/../../components/festival/history_event/ticketPrices.php'; ?>
    <?php include __DIR__ . '/../../components/festival/history_event/tourDeparturesTimetable.php'; ?>
    <?php include __DIR__ . '/../../components/festival/history_event/startingPoint.php'; ?>
    <?php include __DIR__ . '/../../components/festival/history_event/practicalInformation.php'; ?>

    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Do you want to re-live the moments spent during the tour, you can do it in our
            immersive audio page</h1>
    </div>

    <div class="Audio-page-button-container">
        <button type="button" class="btn4">Check Out Our Webpage</button>
    </div>

    <script type="module" src="javascript/History/festival_part.js"></script>

    <script> // image array for carousel
        const images = [
            <?php foreach ($arrayWithImagePathsCarousel as $imagePath): ?>
                '<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>',
            <?php endforeach; ?>
        ];
    </script>

</body>

</html>

<?php
include __DIR__ . '/../footer.php';
?>