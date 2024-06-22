<?php
require __DIR__ . '/../../components/festival/dance_event/artist_page/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS_files/yummy_event.css">
    <link rel="stylesheet" href="CSS_files/dance_event.css">
</head>

<body>
    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

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
    <br>

    <?php if ($allowOrder): ?>
        <?php include __DIR__ . '/../../components/festival/dance_event/artist_page/appearencesInFestival.php'; ?>
    <?php endif; ?>

    <script type="module" src="javascript/Dance/order_tickets_dance_artist.js"></script>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>

</body>


</html>