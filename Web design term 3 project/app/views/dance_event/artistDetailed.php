<?php
use App\Services\DanceService;
use App\Services\TicketsService;

$ticketService = new TicketsService();
$danceService = new DanceService();


$artistId = 1;
// $artistID = $_GET['artistID'];
$artist = $danceService->getArtistById($artistId);
$careerHighlights = $danceService->getCareerHighlightsByArtistID($artistId);
$spotifyLinks = $danceService->getArtistSpotifyLinks($artistId);

$displayMore = false;

$concertsAll = $danceService->getConcertsByArtistName($artist->name);
$concertsWithTripleArtist = [];

foreach ($concertsAll as $concert) {
    if ($concert->sessionType == "Triple Artist") {
        $concertsWithTripleArtist[] = $concert;
    }
}

if (count($concertsWithTripleArtist) > 0) {
    $displayMore = true;
}



?>

<html>

<head>
    <?php include __DIR__ . '/../header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
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
        body {
            font-family: 'Playfair Display', serif;
        }

        .day {
            background-color: black;
        }

        .event {
            background-color: #4C4C4C;
        }
    </style>
</head>

<body>
    <main>
        <section>
            <div class="start-image-container"
                style="background-image: url('../<?php echo htmlspecialchars($artist->imageTopPath) ?>'); background-size: cover; background-position: center; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="start-image-text">
                    <h1 class="text-1-h"><?php echo htmlspecialchars($artist->name); ?></h1>
                </div>
                <a href="/danceevent">
                    <button
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded absolute bottom-0 mb-4 left-0 ml-4 playfair-display">
                        Get Your ticket now
                    </button>
                </a>
            </div>
        </section>
        <!-- Career Highlights Section -->
        <section class="mb-8">
            <div class="Union-restaurant">
                <div class="text-container">
                    <p class="info-h">Career Highlights</p>
                </div>
            </div>
        </section>

        <?php
        $colors = ['bg-white', 'bg-pink-300', 'bg-blue-300', 'bg-green-300', 'bg-yellow-300', 'bg-red-300'];
        $index = 0;
        foreach ($careerHighlights as $careerHighlight):
            $color = $colors[$index % count($colors)]; // use modulus to cycle through colors
            $flexDirection = $index % 2 === 0 ? 'flex-row' : 'flex-row-reverse';
            ?>
            <section>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col md:<?php echo $flexDirection; ?> items-center p-6">
                        <div class="flex flex-col w-full md:w-2/3 items-start md:items-center md:ml-6">
                            <h2 class="text-3xl font-bold mb-3 text-left md:text-left">
                                <?php echo htmlspecialchars($careerHighlight->titleYearPeriod); ?>
                            </h2>
                            <div class="<?php echo $color; ?> p-6 rounded-lg shadow-lg w-full md:max-w-3xl mb-2">
                                <p class="text-lg text-center md:text-left text-black">
                                    <?php echo htmlspecialchars($careerHighlight->Text); ?>
                                </p>
                            </div>
                        </div>
                        <div class="md:ml-6">
                            <img src="<?php echo htmlspecialchars($careerHighlight->imagePath); ?>" alt="Highlighted Image"
                                class="rounded-lg shadow-lg" width="300" height="300">
                        </div>
                    </div>
                </div>
            </section>
            <?php
            $index++;
        endforeach;
        ?>

        <section class="flex items-center justify-center pt-8 px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4 w-full max-w-4xl">
                <?php foreach ($spotifyLinks as $spotifyLink) {
                    echo $spotifyLink->spotifyLink;
                }
                ?>
            </div>
        </section>

        <?php include __DIR__ . '/../../components/festival/dance_event/artist_page/appearencesInFestival.php'; ?>

    </main>

</body>
<footer>
    <?php include __DIR__ . '/../footer.php'; ?>
</footer>
</body>

</html>