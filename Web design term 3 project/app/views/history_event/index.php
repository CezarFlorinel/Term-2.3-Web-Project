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

            // Set initial image immediately on page load
            updateImage(currentImageIndex);

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