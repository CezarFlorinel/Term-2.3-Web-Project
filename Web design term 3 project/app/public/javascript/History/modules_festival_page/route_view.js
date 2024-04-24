import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();
let activeRoute = null; // used to keep track of the currently active route

function handleClickOutsideRouteView() {
    // To handle clicking outside of routes to close the overlay
    document.addEventListener('click', function (e) {
        if (activeRoute && !activeRoute.contains(e.target) && !overlayInfo.contains(e.target)) {
            overlayInfo.style.display = 'none';
            activeRoute.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
            activeRoute = null; // Clear the active route
        }
    });
}

function handleRouteView() {
    try {
        const routes = document.querySelectorAll('.route-text-info');
        routes.forEach(route => {
            route.addEventListener('click', function () {
                const overlayInfo = document.getElementById('overlayInfo');

                // Check if the clicked route is already active
                if (activeRoute === this) {
                    // Toggle the overlay visibility
                    overlayInfo.style.display = (overlayInfo.style.display === 'none' || overlayInfo.style.display === '') ? 'flex' : 'none';
                    // Reset the arrow to the original state
                    this.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
                    // Clear the active route
                    activeRoute = null;
                } else {
                    // Update the overlay info if a new route is clicked
                    document.getElementById('overlayImage').src = this.getAttribute('data-image-url');
                    document.getElementById('overlayText').textContent = this.getAttribute('data-info-text');
                    overlayInfo.style.display = 'flex'; // Show the overlay info

                    // Change the arrow of the newly clicked route
                    this.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route red.png';

                    // If there was a previously active route, reset its arrow
                    if (activeRoute) {
                        activeRoute.querySelector('.route-text-sign-arrow').src = 'assets/images/elements/arrow-route .png';
                    }

                    // Set the new active route
                    activeRoute = this;
                }
            });
        });
    }
    catch (error) {
        errorHandler.showAlert('An error occurred while trying to handle the route view!');
        errorHandler.logError(error, 'handleRouteView', 'route_view.js');
    }
}

export { handleRouteView, handleClickOutsideRouteView };