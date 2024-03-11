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
            flex-direction: row-reverse;
        }

        .centered-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-rectangle {
            padding: 20px;
            background-color: lightcoral;
            border-radius: 10px;
        }

        .image-container img {
            width: 250;
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

        <section class="test">
            <div class="text-rectangle">
                <p>At the age of 12, he produced his first song in the field of electro, while performing as a hip-hop DJ. Through his participation in various competitions, <br> he became known in Breda’s DJ scene. As hip-hop became an underground scene, Hardwell changed his genre to commercial electronic dance music. <br> At the age of 14 in 2002, he was offered a record deal with a Dutch record label.</p>
            </div>
            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-pp.png" style="max-width: 100%; height: auto;" alt="Hardwell">
            </div>
        </section>

        <section class="test-reverse">
            <div class="image-container">
                <img class="w-auto h-auto object-cover rounded" src="assets/images/dance_event/hardwell-pp.png" alt="Descriptive Alt Text">
            </div>
            <div class="text-rectangle">
                <p>After releasing numerous albums and tracks, in 2010 he founded his own record label, Revealed Recordings. In 2011, he launched his own podcast, Hardwell On <br> Air, and was ranked in the Top 100 DJs. In 2013 he was first crowned World’s #1 DJ. Between 2014-2016 he completed 2 world tours. He was the <br> first DJ to play on the podium at Formula 1 at the Mexican Grand Prix. Moreover, he utilized his position for philanthropic causes. With his “United We Are Foundation”, the project achieved social change through 2 aid events that raised enough to school around 122 thousand children from the slums of Mumbai.</p>
            </div>
        </section>

    </main>

    <footer>

    </footer>
    <!-- JavaScript Files -->
</body>

</html>

<?php include __DIR__ . '/../footer.php'; ?>