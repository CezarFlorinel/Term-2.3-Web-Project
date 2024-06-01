<!-- Restaurant Gallery section below the introductory content -->
<div class="mt-12">
    <div class="text-5xl font-bold pt-12 pb-8 text-left">
        <h1 style="font-size: 45px; font-family: 'Playfair Display', serif; text-align: Left; font-weight: bold">
            Restaurant Gallery</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <?php foreach ($restaurantGallery as $image): ?>
            <img src="<?= $image->imagePath ?>" alt="Restaurant Gallery Image" class="w-full h-auto rounded-lg">
        <?php endforeach; ?>
    </div>
</div>