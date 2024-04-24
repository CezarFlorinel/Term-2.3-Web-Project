import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function runImageCarousel() {
    try {
        let currentImageIndex = 0;
        const carousel = document.getElementById('carousel');
        const updateImage = (index) => {
            carousel.style.backgroundImage = `url('${images[index]}')`;
        };

        updateImage(currentImageIndex);

        const nextImage = () => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateImage(currentImageIndex);
        };

        const prevImage = () => {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateImage(currentImageIndex);
        };

        document.getElementById('arrow-right').addEventListener('click', nextImage);
        document.getElementById('arrow-left').addEventListener('click', prevImage);

        setInterval(nextImage, 5000);
    }
    catch (error) {
        errorHandler.showAlert('An error occurred while trying to run the image carousel!');
        errorHandler.logError(error, 'runImageCarousel', 'image_carousel.js');
    }
}
