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

    <div class="start-image-container" id="carousel">
        <div class="start-image-text">
            <h1 class="text-1-h">HAARLEM</h1>
            <h1 class="text-2-h">Festival</h1>
            <h1 class="text-3-h">A Stroll Through History</h1>
        </div>
        <div class="arrows-images-container">
            <img class="start-image-arrow" id="arrow-left" src="assets/images/elements/arrow-left 1.png" alt="Previous">
            <img class="start-image-arrow" id="arrow-right" src="assets/images/elements/arrow-right 1.png" alt="Next">
        </div>
    </div>

    <?php
    if ($historyTopPart !== null): ?>
        <div class="event-info-container">
            <h1 class="event-info-header">
                <?php echo htmlspecialchars($historyTopPart->subheader); ?>
            </h1>
            <img class="sound-icon" src="assets/images/elements/Vector.png" alt="Read Aloud" id="read-aloud-button">
        </div>

        <div class="back-image">
            <div class="event-info-text-container">
                <p class="event-info-h" id="text-to-read">
                    <?php echo htmlspecialchars($historyTopPart->description); ?>
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

        <div id="overlayInfo" class="overlay-info" style="display: none;">
            <img id="overlayImage" class="detail-image" src="assets/images/history_event/Saint bavo (1).jpg"
                alt="Detail Image">
            <p id="overlayText" class="detail-text">Some information about the location</p>
        </div>

        <div class="route-info-container">
            <h1 class="route-info-header">LOCATIONS WE ARE EXPLORING:</h1>

            <?php foreach ($historyRoutes as $historyRoute): ?>
                <div class="route-text-info"
                    data-image-url="<?php echo htmlspecialchars($historyRoute->locationImagePath); ?>"
                    data-info-text="<?php echo htmlspecialchars($historyRoute->locationDescription); ?>">

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
                <a href ="/tickethistory">
                <button type="button" class="btn2">Buy Now</button>
                    </a>
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



        <?php foreach ($historyTours as $index => $tour): ?>
            <div class="timetable-booking-item" id="booking-item-<?php echo $index; ?>">
                <div class="initial-content">
                    <p class="timetable-booking-text">Time:
                        <?php echo htmlspecialchars((new DateTime($tour->startTime))->format('H:i')); ?>
                    </p>
                    <?php if ($tour->englishTour > 0): ?>
                        <div class="booking-item-flagAndText">
                            <p class="timetable-booking-text">English Tours</p>
                            <?php for ($i = 0; $i < $tour->englishTour; $i++): ?>
                                <img class="timetable-booking-image" src="assets/images/elements/Uk-flag-small.png"
                                    alt="English Tour">
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
                </div>
                <button type="button" class="btn3" data-booking-id="<?php echo $index; ?>">Book</button>
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
                <img class="practical-info-sign toggle-sign" src="assets/images/elements/+ sign.png" alt="Toggle Answer"
                    data-toggle="closed">
                <p class="practical-info-text">
                    <?php echo htmlspecialchars($practicalInformation->question); ?>
                </p>
            </div>
            <div class="practical-info-answer" style="display:none;">
                <?php echo htmlspecialchars($practicalInformation->answer); ?>
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

    <!-- move the scripts in a separate file and folder -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const routes = document.querySelectorAll('.route-text-info');
            let activeRoute = null; // To keep track of the currently active route

            routes.forEach(route => {
                route.addEventListener('click', function () {
                    const overlayInfo = document.getElementById('overlayInfo');

                    // Check if the clicked route is already active
                    if (activeRoute === this) {
                        // Toggle the overlay visibility
                        overlayInfo.style.display = (overlayInfo.style.display === 'none' || overlayInfo.style.display === '') ? 'flex' : 'none';
                        // Reset the arrow to the original state
                        this.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
                        // Clear the active route
                        activeRoute = null;
                    } else {
                        // Update the overlay info if a new route is clicked
                        document.getElementById('overlayImage').src = this.getAttribute('data-image-url');
                        document.getElementById('overlayText').textContent = this.getAttribute('data-info-text');
                        overlayInfo.style.display = 'flex'; // Show the overlay info

                        // Change the arrow of the newly clicked route
                        this.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route red.png';

                        // If there was a previously active route, reset its arrow
                        if (activeRoute) {
                            activeRoute.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
                        }

                        // Set the new active route
                        activeRoute = this;
                    }
                });
            });

            // To handle clicking outside of routes to close the overlay
            document.addEventListener('click', function (e) {
                if (activeRoute && !activeRoute.contains(e.target) && !overlayInfo.contains(e.target)) {
                    overlayInfo.style.display = 'none';
                    activeRoute.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
                    activeRoute = null; // Clear the active route
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const images = [
                <?php foreach ($arrayWithImagePathsCarousel as $imagePath): ?>
                                                                                                                                                                                                                                                                                                                    '<?php echo htmlspecialchars($imagePath); ?>',
                <?php endforeach; ?>
            ];

            let currentImageIndex = 0;
            const carousel = document.getElementById('carousel');
            const updateImage = (index) => {
                carousel.style.backgroundImage = `url('${images[index]}')`;
            };

            const nextImage = () => {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                updateImage(currentImageIndex);
            };

            const prevImage = () => {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                updateImage(currentImageIndex);
            };

            document.getElementById('arrow-right').addEventListener('click', nextImage);
            document.getElementById('arrow-left').addEventListener('click', prevImage);

            // Change image every 5 seconds
            setInterval(nextImage, 5000);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.toggle-sign').forEach(item => {
                item.addEventListener('click', function () {
                    // Toggle the answer display. The answer is now the next sibling of the parent element.
                    const answer = this.parentElement.nextElementSibling;
                    if (answer.style.display === 'none' || answer.style.display === '') {
                        answer.style.display = 'block';
                        this.src = 'assets/images/elements/- sign.png'; // Change to your actual '-' image path
                        this.setAttribute('data-toggle', 'open');
                    } else {
                        answer.style.display = 'none';
                        this.src = 'assets/images/elements/+ sign.png'; // Change to your actual '+' image path
                        this.setAttribute('data-toggle', 'closed');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bookingButtons = document.querySelectorAll('.btn3');

            bookingButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bookingId = this.getAttribute('data-booking-id');
                    const bookingItem = document.getElementById(`booking-item-${bookingId}`);
                    // Extract the time from the original booking item
                    const timeText = bookingItem.querySelector('.timetable-booking-text').textContent.trim();

                    // Build the flags section based on the original booking item
                    let flagsHTML = '';
                    const hasEnglishTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="English Tour"]').length > 0;
                    const hasDutchTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="Dutch Tour"]').length > 0;
                    const hasChineseTour = bookingItem.querySelectorAll('.timetable-booking-image[alt="Chinese Tour"]').length > 0;

                    if (hasEnglishTour) {
                        flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/Uk-flag-small.png" alt="English Tour">';
                    }
                    if (hasDutchTour) {
                        flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/download 3.png" alt="Dutch Tour">';
                    }
                    if (hasChineseTour) {
                        flagsHTML += '<img class="timetable-booking-image-type-2" src="assets/images/elements/download 5.png" alt="Chinese Tour">';
                    }

                    // Define the new content structure
                    const newContent = `
                    <div class="timetable-booking-item-type-2">
                        <p class="timetable-booking-text-type-2">${timeText}</p>
                        <p class="timetable-booking-text-type-2">Select Language</p>
                        <div class="booking-item-flags-type-2">
                            ${flagsHTML}
                        </div>
                        <button type="button" class="btn3" data-booking-id="${bookingId}">Book</button>
                    </div>
                `;

                    // Replace the innerHTML of the booking item
                    bookingItem.innerHTML = newContent;

                    // Add click event listener to new flag images for navigation
                    bookingItem.querySelectorAll('.timetable-booking-image-type-2').forEach(image => {
                        image.addEventListener('click', function () {
                            const language = this.alt.split(' ')[0]; // Assuming format 'Language Tour'
                            window.location.href = `/book-tour?language=${language}&tourId=${bookingId}`; // Change URL accordingly
                        });
                    });
                });
            });
        });
    </script>

    <script>
        // Check if the Web Speech API is supported
        if ('speechSynthesis' in window) {
            // Function to start reading text aloud
            function speak(text) {
                const speechSynthesis = window.speechSynthesis;
                speechSynthesis.cancel(); // Stop any previous speech

                // Split text into segments
                const segments = text.match(/.{1,200}(\s|$)/g); // Split by max length or spaces

                segments.forEach(segment => {
                    const msg = new SpeechSynthesisUtterance(segment);
                    msg.lang = 'en-US';
                    msg.volume = 1;
                    msg.rate = 1;
                    msg.pitch = 1;
                    speechSynthesis.speak(msg);
                });
            }

            // Add an event listener to the button
            document.getElementById('read-aloud-button').addEventListener('click', () => {
                // Get the text you want to read
                var textToRead = document.getElementById('text-to-read').textContent;
                // Call the speak function with the text
                speak(textToRead);
            });
        } else {
            // Alert the user if their browser does not support the Web Speech API
            alert("Sorry, your browser doesn't support text to speech!");
        }
    </script>

</body>

</html>

<?php
include __DIR__ . '/../footer.php';
?>