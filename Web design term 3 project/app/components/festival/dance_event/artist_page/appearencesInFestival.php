<section class="bg-black py-8 sm:py-12 items-center">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center my-8 sm:my-12">Appearances In The Festival
    </h1>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 rounded-lg border-4">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <?php if ($displayMore == false): ?>

                <?php
                $passedTicket = $simpleConcert[0];
                include __DIR__ . '/simpleArtistPane.php';
                ?>

                <?php include __DIR__ . '/tripleArtistPane.php'; ?>

                <?php
                $passedTicket = $simpleConcert[1];
                include __DIR__ . '/simpleArtistPane.php';
                ?>

            <?php else: ?>

                <?php foreach ($simpleConcert as $concert):
                    $passedTicket = $concert;
                    ?>
                    <?php include __DIR__ . '/simpleArtistPane.php'; ?>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
        <div class="flex justify-center my-8 sm:my-12">

            <button class="bg-red-600 text-white px-4 py-2 mr-4 rounded-lg">Buy tickets</button>


            <a href="/danceevent">
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg">Check festival schedule</button>
            </a>
        </div>
    </div>
</section>