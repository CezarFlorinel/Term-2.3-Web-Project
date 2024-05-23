<!-- Festival Location -->
<?php if ($festivalLocation !== null): ?>
    <div style="height: 60px;"></div>
    <title>Festival Location</title>
    </div>

    <div>
        <div class="right-aligned-text">
            WHERE IS <br> THE FESTIVAL?
        </div>

        <div class="festival-location-section flex-col-reverse md:flex-row ">
            <div class="info-box md:w-2/3 pr-14 text-center">
                <p><?php echo $festivalLocation->description ?></p>
                <a href="/personalProgramListView" class="btn"
                    style="padding: 0.5rem 1rem; width: 50%; margin-left: auto; margin-right: auto; display: block; font-size: 0.9rem; text-align: center;">
                    Check festival schedule
                </a>
            </div>
            <div class="md:w-1/3 h-80 rounded-lg overflow-hidden">
                <img src="<?php echo $festivalLocation->imagePathLocation ?>" class="h-full object-cover">
                <input id="js_" type="file" class="hidden">
            </div>
        </div>
    </div>
<?php endif; ?>