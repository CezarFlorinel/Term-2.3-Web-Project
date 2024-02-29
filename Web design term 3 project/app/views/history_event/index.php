<?php
use App\Services\HistoryService;

$historyService = new HistoryService();
$historyTopPart = $historyService->getHistoryTopParts();

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
    </div>

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
        <img class="route-image" src="assets/images/history_event/Group 39596.png" alt="History Event">

        <div class="route-info-container">
            <h1 class="route-info-header">LOCATIONS WE ARE EXPLORING:</h1>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">1. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">2. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">3. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">4. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">5. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">6. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">7. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">8. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>
            <div class="route-text-info">
                <img class="route-text-sign-arrow" src="assets/images/elements/arrow-route .png" alt="History Event">
                <p class="route-text">9. The Grote Markt</p>
                <img class="route-text-sign-wheelchair" src="assets/images/elements/MUTCD_D9-6 1.png"
                    alt="History Event">
            </div>


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
            <img class="ticket-price-image" src="assets/images/history_event/8.webp" alt="History Event">
            <div class="ticket-price-info-text">
                <h1 class="ticket-price-header">Regular Participant</h1>
                <p class="ticket-price-text">Price: 17.50 €</p>
                <p class="ticket-price-text">1 x Drink</p>

                <button type="button" class="btn2">Buy Now</button>
            </div>
        </div>

        <div class="ticket-price-info-2">
            <div class="ticket-price-info-text-2">
                <h1 class="ticket-price-header-2">Family Ticket</h1>
                <p class="ticket-price-text-2">Price: 60.00 €</p>
                <p class="ticket-price-text-2">4 x Drinks (1 per member)</p>
                <p class="ticket-price-text-2">Maximum 4 members</p>

                <button type="button" class="btn2">Buy Now</button>
            </div>
            <img class="ticket-price-image-2" src="assets/images/history_event/family.png" alt="History Event">
        </div>
    </div>

    <!-- ------------------------------- -->

    <div class="event-info-container">
        <h1 class="event-info-header">Tour Departures Timetable</h1>
    </div>

    <div class="timetables-grid-container">

        <div class="timetable-day">
            <h1 class="timetable-day-header">25</h1>
            <p class="timetable-day-text1">Jul</p>
            <p class="timetable-day-text2">Thursday</p>
        </div>
        <div class="timetable-day">
            <h1 class="timetable-day-header">25</h1>
            <p class="timetable-day-text1">Jul</p>
            <p class="timetable-day-text2">Thursday</p>
        </div>
        <div class="timetable-day">
            <h1 class="timetable-day-header">25</h1>
            <p class="timetable-day-text1">Jul</p>
            <p class="timetable-day-text2">Thursday</p>
        </div>
        <div class="timetable-day">
            <h1 class="timetable-day-header">25</h1>
            <p class="timetable-day-text1">Jul</p>
            <p class="timetable-day-text2">Thursday</p>
        </div>



        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>

        <div class="timetable-booking-item">
            <p class="timetable-booking-text">Time: 10:00</p>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">English Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Dutch Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <div class="booking-item-flagAndText">
                <p class="timetable-booking-text">Chinese Tours</p>
                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png" alt="History Event">
            </div>
            <button type="button" class="btn3">Book</button>

        </div>
    </div>

    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Starting Point Of The Tour</h1>
    </div>

    <div class="map-container">
        <img class="starting-point-image" src="assets/images/history_event/location-starting-point.png"
            alt="History Event">
        <div class="map-info-container">
            <p class="map-info-text">The tour begins in close proximity to the Church of Saint Bavo, easily identified
                by a prominent flag marking the location. Your guide will be awaiting your arrival here. The tour will
                start once all participants have assembled or at the scheduled time.</p>
            <img class="map-info-image" src="assets/images/history_event/map-starting-point.png" alt="History Event">
        </div>
    </div>


    <!-- ------------------------------- -->
    <div class="event-info-container">
        <h1 class="event-info-header">Practical Information</h1>
    </div>

    <div class="practical-info-container">
        <div class="practical-info-item">
            <img class="practical-info-sign" src="assets/images/elements/+ sign.png" alt="History Event">
            <p class="practical-info-text">What is the duration of each tour?</p>
        </div>
        <div class="practical-info-item">
            <img class="practical-info-sign" src="assets/images/elements/+ sign.png" alt="History Event">
            <p class="practical-info-text">What is the duration of each tour?</p>
        </div>
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