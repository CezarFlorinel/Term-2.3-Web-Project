<div class="ratatouille-image-container">
    <img src="<?php echo $yummyDetailPageData->imagePathHomepage ?>">
</div>

<div class="container mx-auto py-8 px-10">

    <div class="event-info-container">
        <h1 class="event-info-header">
            <?= nl2br(htmlspecialchars($yummyDetailPageData->name)) ?>
        </h1>
    </div>

    <section class="section-bg">
        <div class="text-center mb-8 text-white">
            <div class="flex items-center justify-center bg-no-repeat bg-center bg-contain h-72 md:h-96 
                            lg:min-h-[300px] px-12 py-10 lg:bg-[url('assets/images/elements/Union.png')]">
                <p class="text-base font-normal text-white rounded-lg lg:text-black">
                    <?= nl2br(htmlspecialchars($yummyDetailPageData->descriptionTopPart)) ?>
                </p>
            </div>
        </div>
    </section>