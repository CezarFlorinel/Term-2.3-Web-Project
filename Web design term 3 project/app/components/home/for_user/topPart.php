<?php if ($homePageDetails !== null): ?>

    <div class="start-image-container"
        style="background-image: url('<?php echo $homePageDetails->imagePathTop ?>'); background-size: cover; background-position: center; min-height: 110vh; display: flex; flex-direction: column; justify-content: space-between;">
        <div class="start-image-text">
            <div class="word-vertical haarlem absolute" style="margin-left: 120px; margin-top: 30px;">
                <div>H</div>
                <div>A</div>
                <div>A</div>
                <div>R</div>
                <div>L</div>
                <div>E</div>
                <div>M</div>
            </div>
            <div class="word-vertical festival absolute" style="margin-left: 60px; margin-top: 30px;">
                <div>F</div>
                <div>E</div>
                <div>S</div>
                <div>T</div>
                <div>I</div>
                <div>V</div>
                <div>A</div>
                <div>L</div>
            </div>
        </div>
    </div>

    <div>
        <section class="section-bg py-10 px-10">
            <div class="text-center mb-8 text-white">
                <h2 class="text-6xl font-bold"><?php echo $homePageDetails->title ?></h2>
                <div class="flex items-center justify-center bg-no-repeat bg-center bg-contain h-72 md:h-96 
        lg:min-h-[300px] px-12 py-10 lg:bg-[url('assets/images/elements/Union.png')]">
                    <p class="text-base font-normal text-white rounded-lg lg:text-black">
                        <?php echo $homePageDetails->description ?>
                    </p>
                </div>
                <div class="container mx-auto grid grid-cols-1 gap-4"></div>
        </section>
    </div>

<?php endif; ?>