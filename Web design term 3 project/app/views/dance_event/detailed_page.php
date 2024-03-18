<?php include __DIR__ . '/../header.php'; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
    <link rel="stylesheet" href="CSS_files/yummy_event.css">
    <link rel="stylesheet" href="CSS_files/dance_event.css">
    <style>
        /* Ensure the rounded corners are visible on overflow content */
        .rounded-overflow {
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .centered-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        /* Adjust the width and max-width to allow more width for the content */
        .centered-content>section {
            width: 100%;
            /* This allows the section to expand to the full width of its container */
            max-width: 1600px;
            /* Increase the max-width to allow content to be wider, adjust as needed */
            margin: auto;
            /* This ensures the content remains centered */
        }

        /* Since the content is wider, you might want to adjust the internal flex containers to better utilize the space */
        .centered-content .flex>div {
            flex-basis: auto;
            /* Adjust this value */
            width: 100%;
            /* Allows the div to expand */
            max-width: none;
            /* Removes any max-width restriction, adjust as needed */
        }

        .playfair-display {
            font-family: 'Playfair Display', serif;
        }

        .light-red-background {
            background-color: #ffcccc;
        }

        .white-background {
            background-color: white;
        }

        .blue-background {
            background-color: #8FADC6;
        }

        .black-font-color {
            color: black;
        }

        .play-circle::before {
            content: '\f144';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }
    </style>
</head>

<body>
    <main>
        <div class="start-image-container">
            <div class="start-image-text">
                <h1 class="text-1-h">Hardwell</h1>
            </div>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded absolute bottom-0 mb-4 left-0 ml-4 playfair-display">
                Get Your ticket now
            </button>
        </div>

        <!-- Career Highlights Section -->
        <section class="mb-8">
            <div class="Union-restaurant">
                <div class="text-container">
                    <p class="info-h">Career Highlights</p>
                </div>
            </div>
        </section>

        <section class="centered-content">
            <section class="mb-8">
                <div style="margin-left: 30px; max-width: 1600px; width: 100%;">
                    <h1 class="text-4xl font-bold mb-4 playfair-display white-font-color">Musical beginnings (2002-2009)</h1>
                    <div class="flex justify-start items-start">
                        <div class="light-red-background p-8 rounded-overflow playfair-display black-font-color" style="flex-basis: 50%; max-width: 50%; margin-right: 20px;">
                            <p class="text-lg">
                                At the age of 12, he produced his first song in the field of electro, while performing as a hip-hop DJ. Through his participation in various competitions, he became known in Breda’s DJ scene. As hip-hop became an underground scene, Hardwell changed his genre to commercial electronic dance music. At the age of 14 in 2002, he was offered a record deal with a Dutch record label.
                            </p>
                        </div>
                        <div class="artist-container" style="flex-basis: 50%; max-width: 50%;">
                            <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-pp.png" style="max-width: 100%; height: auto;" alt="Hardwell">
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-8">
                <div style="margin-right: 30px;">
                    <h1 class="text-4xl font-bold mb-4 playfair-display white-font-color" style="text-align: right;">Awards and Recognitions (2010-2017)</h1>
                    <div class="flex justify-end items-start">
                        <div class="artist-container" style="flex-basis: 50%; max-width: 50%;">
                            <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-pp.png" style="max-width: 100%; height: auto;" alt="Hardwell">
                        </div>
                        <div class="white-background p-8 rounded-overflow playfair-display black-font-color" style="flex: 3;">
                            <p class="text-lg">
                                After getting nominated 2 times World No.1 DJ and winning numerous awards, in 2018, after more than a decade of playing on the most significant stages on the planet, Hardwell announced he would be taking a sabbatical from touring. Although out of the spotlight, studio singles kept coming. </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-20">
                <div style="margin-left: 30px;">
                    <h1 class="text-4xl font-bold mb-4 playfair-display white-font-color">Exploring new horizons (2018-2021)</h1>
                    <div class="flex justify-start items-start">
                        <div class="blue-background p-8 rounded-overflow playfair-display black-font-color" style="flex: 3; margin-right: 20px;">
                            <p class="text-lg">
                                After getting nominated 2 times World No.1 DJ and winning numerous awards, in 2018, after more than a decade of playing on the most significant stages on the planet, Hardwell announced he would be taking a sabbatical from touring. Although out of the spotlight, studio singles kept coming.
                        </div>
                        <div style="flex: 2; border: 2px solid white; border-radius: 0.5rem;">
                            <img src="URL_OF_YOUR_IMAGE_HERE" alt="Descriptive text of the image" style="width: 100%; height: auto; display: block; border-radius: 0.5rem;">
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-20">
                <div style="margin-right: 30px;">
                    <h1 class="text-4xl font-bold mb-4 playfair-display white-font-color" style="text-align: right;">Musical Resistance (2022-now)</h1>
                    <div class="flex justify-end items-start">
                        <div style="flex: 2; border: 2px solid white; border-radius: 0.5rem; margin-right: 20px;">
                            <img src="URL_OF_YOUR_IMAGE_HERE" alt="Descriptive text of the image" style="width: 100%; height: auto; display: block; border-radius: 0.5rem;">
                        </div>
                        <div class="white-background p-8 rounded-overflow playfair-display black-font-color" style="flex: 3;">
                            <p class="text-lg">
                                In 2022, Hardwell returned to Miami’s Ultra Music Festival to perform a surprise closing set, officially returning to the dance scene with a new style of music, which has been described as Future Rave or Future Techno. At the same time, his website was rebooted with new tour dates for his forthcoming album titled “Rebels Never Die”.
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-gray-900 text-white">
                <div class="container mx-auto px-4">
                    <div class="text-center my-10">
                        <h2 class="text-3xl font-bold text-red-500 uppercase">Most famous albums</h2>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <div class="bg-black rounded overflow-hidden shadow-lg">
                            <img class="w-full" src="https://placehold.co/200x300" alt="Album cover for United We Are">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">United We Are</div>
                                <p class="text-gray-400 text-base">
                                    2015 • Hardwell
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-green-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-900 mr-2 mb-2 play-circle"></span>
                            </div>
                        </div>
                    </div>
            </section>
        </section>

        <section>
            -
        </section>

    </main>

    <footer>

    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>