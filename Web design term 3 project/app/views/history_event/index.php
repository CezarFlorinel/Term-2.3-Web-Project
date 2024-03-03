<?php
use App\Services\HistoryService;

$historyService = new HistoryService();

$historyTopPart = $historyService->getHistoryTopParts();
$historyRoutes = $historyService->getHistoryRoutes();
$historyTourStartingPoints = $historyService->getHistoryTourStartingPoints();
$firstHistoryRoute = $historyRoutes[0];
$historyTickets = $historyService->getHistoryTicketPrices();
$firstHistoryTicket = $historyTickets[0];
$secondHistoryTicket = $historyTickets[1];
$historyTourDeparturesTimetables = $historyService->getHistoryTourDeparturesTimetables();
$historyTours = $historyService->getHistoryTours();
$historyPracticalInformation = $historyService->getHistoryPracticalInformation();

?>

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

    <div class="start-image-container">
        <div class="start-image-text">
            <h1 class="text-1-h">HAARLEM</h1>
            <h1 class="text-2-h">Festival</h1>
            <h1 class="text-3-h">A Stroll Through History</h1>
        </div>
        <div class="arrows-images-container">
            <img class="start-image-arrow" src="assets/images/elements/arrow-left 1.png" alt="History Event">
            <img class="start-image-arrow" src="assets/images/elements/arrow-right 1.png" alt="History Event">
        </div>
    </div> <!-- also do this -->

    <?php
    if ($historyTopPart !== null): ?>
        <div class="event-info-container">
            <h1 class="event-info-header">
                <?php echo $historyTopPart->subheader; ?>
            </h1>
            <img class="sound-icon" src="assets/images/elements/Vector.png" alt="History Event">
        </div>

        <div class="Image">
            <div class="event-info-text-container">
                <p class="event-info-h">
                    <?php echo $historyTopPart->description; ?>
                </p>
            </div>
        </div>
    <?php endif; ?>



    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Route</h1>
    </div>


    <div class="container-route">
        <img class="route-image" src="<?php echo htmlspecialchars($firstHistoryRoute->mainImagePath); ?>"
            alt="History Event">

        <div class="route-info-container">
            <h1 class="route-info-header">LOCATIONS WE ARE EXPLORING:</h1>

            <?php foreach ($historyRoutes as $historyRoute): ?>
                <div class="route-text-info">
                    <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                    <p class="route-text">
                        <?php echo htmlspecialchars($historyRoute->locationName); ?>
                    </p>
                    <?php if ($historyRoute->wheelchairSupport): ?>
                        <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                            alt="History Event">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <div class="The-button">
        <button type="button" class="btn1">Check Festival Schedule</button>
    </div>

    <!-- ------------------------------- -->

    <div class="event-info-container">
        <h1 class="event-info-header">Ticket Prices</h1>
    </div>

    <div class="ticket-price-container">

        <div class="ticket-price-info">
            <img class="ticket-price-image" src="<?php echo htmlspecialchars($firstHistoryTicket->imagePath); ?>"
                alt="History Event">
            <div class="ticket-price-info-text">
                <h1 class="ticket-price-header">
                    <?php echo htmlspecialchars($firstHistoryTicket->ticketType); ?>
                </h1>
                <p class="ticket-price-text">
                    <?php echo htmlspecialchars(number_format($firstHistoryTicket->price, 2, '.', '')) . ' €'; ?>
                </p>
                <p class="ticket-price-text">
                    <?php echo htmlspecialchars($firstHistoryTicket->description); ?>
                </p>

                <button type="button" class="btn2">Buy Now</button>
            </div>
        </div>

        <div class="ticket-price-info-2">
            <div class="ticket-price-info-text-2">
                <h1 class="ticket-price-header-2">
                    <?php echo htmlspecialchars($secondHistoryTicket->ticketType); ?>
                </h1>
                <p class="ticket-price-text-2">
                    <?php echo htmlspecialchars(number_format($secondHistoryTicket->price, 2, '.', '')) . ' €'; ?>
                </p>
                <p class="ticket-price-text-2">
                    <?php echo htmlspecialchars($secondHistoryTicket->description); ?>
                </p>

                <button type="button" class="btn2">Buy Now</button>
            </div>
            <img class="ticket-price-image-2" src="<?php echo htmlspecialchars($secondHistoryTicket->imagePath); ?>"
                alt="History Event">
        </div>
    </div>

    <!-- ------------------------------- -->

    <div class="event-info-container">
        <h1 class="event-info-header">Tour Departures Timetable</h1>
    </div>

    <div class="timetables-grid-container">

        <?php foreach ($historyTourDeparturesTimetables as $timetable): ?>
            <?php
            // Convert string date to PHP DateTime object
            $dateObject = new DateTime($timetable->date);

            $day = $dateObject->format('d'); // Day of the month
            $month = $dateObject->format('M'); // Month as three letters
            $dayOfWeek = $dateObject->format('l'); // Full name of the day of the week
            ?>
            <div class="timetable-day">
                <h1 class="timetable-day-header">
                    <?php echo htmlspecialchars($day); ?>
                </h1>
                <p class="timetable-day-text1">
                    <?php echo htmlspecialchars($month); ?>
                </p>
                <p class="timetable-day-text2">
                    <?php echo htmlspecialchars($dayOfWeek); ?>
                </p>
            </div>
        <?php endforeach; ?>



        <?php foreach ($historyTours as $tour): ?>
            <div class="timetable-booking-item">
                <?php
                // Parse and format the start time
                $time = new DateTime($tour->startTime);
                $formattedTime = $time->format('H:i'); // Formats to hour:minute
                ?>
                <p class="timetable-booking-text">Time:
                    <?php echo htmlspecialchars($formattedTime); ?>
                </p>

                <?php if ($tour->englishTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">English Tours</p>
                        <?php for ($i = 0; $i < $tour->englishTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="English Tour">
                        <?php endfor; ?>

                    </div>
                <?php endif; ?>

                <?php if ($tour->dutchTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">Dutch Tours</p>
                        <?php for ($i = 0; $i < $tour->dutchTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/download 3.png" alt="Dutch Tour">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <?php if ($tour->chineseTour > 0): ?>
                    <div class="booking-item-flagAndText">
                        <p class="timetable-booking-text">Chinese Tours</p>
                        <?php for ($i = 0; $i < $tour->chineseTour; $i++): ?>
                            <img class="timetable-booking-image" src="assets/images/elements/download 5.png" alt="Chinese Tour">
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

                <button type="button" class="btn3">Book</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Starting Point Of The Tour</h1>
    </div>

    <div class="map-container">
        <img class="starting-point-image"
            src="<?php echo htmlspecialchars($historyTourStartingPoints->mainImagePath); ?>" alt="History Event">
        <div class="map-info-container">
            <p class="map-info-text">
                <?php echo htmlspecialchars($historyTourStartingPoints->description); ?>
            </p>
            <img class="map-info-image"
                src="<?php echo htmlspecialchars($historyTourStartingPoints->secondaryImagePath); ?>"
                alt="History Event">
        </div>
    </div>


    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Practical Information</h1>
    </div>

    <div class="practical-info-container">
        <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
            <div class="practical-info-item">
                <img class="practical-info-sign" src="assets/images/elements/+ sign.png" alt="History Event">
                <p class="practical-info-text">
                    <?php echo htmlspecialchars($practicalInformation->question) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Do you want to re-live the moments spent during the tour, you can do it in our
            immersive audio page</h1>
    </div>

    <div class="Audio-page-button-container">
        <button type="button" class="btn4">Check Out Our Webpage</button>
    </div>

</body>

</html>

<?php
include __DIR__ . '/../footer.php';
?>