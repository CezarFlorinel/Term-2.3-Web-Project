import { handleApiResponse, checkText, checkReviewStarNumber } from "../../Utilities/handle_data_checks.js";
import ErrorHandler from "../../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

export function deleteReview() {
    document.querySelectorAll('.delete-review-btn').forEach(button => {
        button.addEventListener('click', function () {
            const review = this.closest('.review-container');
            const reviewId = review.getAttribute('data-id');
            const confirmation = confirm('Are you sure you want to delete this review?');

            if (confirmation) {
                fetch('/api/restaurantIndividualAdmin/deleteReview', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: reviewId }),
                })
                    .then(handleApiResponse)
                    .then(data => {
                        if (data.success) {
                            errorHandler.showAlert('Review deleted successfully', { title: 'Success', icon: 'success' });
                            this.closest('.review-container').remove();
                        }
                    })
                    .catch(error => {
                        errorHandler.logError(error, 'deleteReview', 'review.js');
                        errorHandler.showAlert('An error occurred while deleting the review, please try again later!');
                    });
            }
        });
    });
}

export function createReview() {
    const createReviewBtn = document.querySelector('.create-review-btn');
    createReviewBtn.addEventListener('click', function () {
        const container = this.closest('.add-review-container');
        const reviewText = container.querySelector('[data-field="reviewText"]').value;
        const reviewRating = container.querySelector('[data-field="rating"]').value;
        const restaurantContainer = document.getElementById("container-restaurant-info");
        const restaurantID = restaurantContainer.getAttribute('data-id');

        if (!checkText({ reviewText })) {
            return;
        }
        else if (!checkReviewStarNumber(reviewRating)) {
            return;
        }

        const payload = {
            restaurantID: restaurantID,
            reviewText: reviewText,
            rating: reviewRating,
        };

        fetch('/api/restaurantIndividualAdmin/addReview', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload),
        })
            .then(handleApiResponse)
            .then(data => {
                if (data.success) {
                    location.reload();
                    errorHandler.showAlert('Review created successfully', { title: 'Success', icon: 'success' });
                }
            })
            .catch(error => {
                errorHandler.logError(error, 'createReview', 'review.js');
                errorHandler.showAlert('An error occurred while creating the review, please try again later!');
            });
    });
}