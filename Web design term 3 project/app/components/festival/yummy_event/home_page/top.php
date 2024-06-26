<div class="start-image-container">
    <div class="start-image-text">
        <h1 class="text-1-h">HAARLEM</h1>
        <h1 class="text-2-h">Festival</h1>
        <h1 class="text-3-h">Yummy Event</h1>
    </div>
</div>

<div class="event-info-container">
    <h1 class="event-info-header"><?= nl2br(htmlspecialchars($homepageyummy->subheader)) ?></h1>
</div>

<section class="section-bg py-10 px-10">
    <div class="text-center mb-8 text-white">
        <div class="flex items-center justify-center bg-no-repeat bg-center bg-contain h-72 md:h-96 
                            lg:min-h-[300px] px-12 py-10 lg:bg-[url('assets/images/elements/Union.png')]">
            <p class="text-base font-normal text-white rounded-lg lg:text-black">
                <?= nl2br(htmlspecialchars($homepageyummy->description)) ?>
            </p>
        </div>
    </div>
</section>