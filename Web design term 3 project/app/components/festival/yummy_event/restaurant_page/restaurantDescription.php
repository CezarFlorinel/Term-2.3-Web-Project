<section class="md:flex md:items-start md:justify-between gap-8">
    <!-- First paragraph -->
    <div class="md:w-1/3 space-y-6 mb-5 mt-5">
        <p class="text-xl">
            <?php echo htmlspecialchars($yummyDetailPageData->descriptionSideOne); ?>
        </p>
    </div>

    <div class="md:w-1/3 flex justify-center md:justify-start md:px-4">
        <img src="<?php echo $yummyDetailPageData->imagePathChef ?>" alt="Chef Image" class="rounded-lg">
    </div>

    <div class="md:w-1/3 space-y-6 mt-5 mb-5">
        <p class="text-xl">
            <?php echo htmlspecialchars($yummyDetailPageData->descriptionSideTwo) ?>
        </p>
    </div>
</section>