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
        .test,
        .test-reverse {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            max-width: 80%;
            margin: auto;
        }

        .test-reverse {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 20px;
            max-width: 90%;
            margin: auto;
        }

        .centered-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-rectangle-red {
            padding: 20px;
            background-color: lightcoral;
            border-radius: 10px;
        }

        .text-rectangle-white {
            padding: 20px;
            background-color: whitesmoke;
            border-radius: 10px;
        }

        .text-rectangle-blue {
            padding: 20px;
            background-color: lightsteelblue;
            border-radius: 10px;
        }

        .image-container {
            width: 150;
            height: auto;
            object-fit: cover;
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

        <section class="test" style="position: relative;">
            <h1 style="position: absolute; top: 30px; left: 0; font-family: 'Playfair Display', serif; font-size: 26px;">Musical Beginnings (2002-2009)</h1>
            <div class="text-rectangle-red">
                <p style="color: black;">At the age of 12, he produced his first song in the field of electro, while performing as a hip-hop DJ. Through his participation in various competitions, he became known in Breda’s DJ scene. As hip-hop became an underground scene, Hardwell changed his genre to commercial electronic dance music. At the age of 14 in 2002, he was offered a record deal with a Dutch record label.</p>
            </div>
            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/profile-hardwell.png" style="max-width: 100%; height: auto;" alt="Hardwell">
            </div>
        </section>


        <section class="test-reverse" style="position: relative;">
            <h1 style="position: absolute; top: 40px; right: 100px; font-family: 'Playfair Display', serif; font-size: 26px;">Awards and recognitions (2010-2017)</h1>
            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-award.png" alt="Descriptive Alt Text">
            </div>
            <div class="text-rectangle-white">
                <p style="color: black;">After releasing numerous albums and tracks, in 2010 he founded his own record label, Revealed Recordings. In 2011, he launched his own podcast<br>, Hardwell On Air, and was ranked in the Top 100 DJs. In 2013 he was first crowned World’s #1 DJ. Between 2014-2016 he completed 2 world tours.<br> He was the first DJ to play on the podium at Formula 1 at the Mexican Grand Prix. Moreover, he utilized his position for philanthropic causes. With his<br> “United We Are Foundation”, the project achieved social change through 2 aid events that raised enough to school around 122 thousand children from the slums of Mumbai.</p>
            </div>
        </section>

        <section class="test" style="position: relative;">
            <h1 style="position: absolute; top: 50px; left: 130px; font-family: 'Playfair Display', serif; font-size: 26px;">Exploring new horizons (2018-2021)</h1>
            <div class="text-rectangle-blue">
                <p style="color: black;"> After getting nominated 2 times World No.1 DJ and winning numerous awards, in 2018, after more than a decade of playing on the most<br> significant stages on the planet, Hardwell announced he would be taking a sabbatical from touring. Although out of the spotlight, studio<br> singles kept coming.</p>
            </div>
            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-horizons.png" style="max-width: 100%; height: auto;" alt="Hardwell">
            </div>
        </section>

        <section class="test-reverse" style="position: relative;">
            <h1 style="position: absolute; top: 50px; right: 210px; font-family: 'Playfair Display', serif; font-size: 26px;">Musical Renaissance (2022-now)</h1>

            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-event.png" alt="Descriptive Alt Text">
            </div>
            <div class="text-rectangle-white">
                <p style="color: black;">In 2022, Hardwell returned to Miami’s Ultra Music Festival to perform a surprise closing set, officially returning to the dance scene with a new<br> style of music, which has been described as Future Rave or Future Techno. At the same time, his website was rebooted with new tour dates<br> for his forthcoming album titled “Rebels Never Die”.</p>
            </div>
        </section>

    </main>

    <footer>

    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>