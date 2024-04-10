

export function deleteReview() {
    document.querySelectorAll('.delete-review-btn').forEach(button => {
        button.addEventListener('click', function () {
            const review = this.closest('.review-container');
            const reviewId = review.getAttribute('data-id');
            const confirmation = confirm('Are you sure you want to delete this review?');

            if (confirmation) {
                fetch('/api/restaurantIndividualAdmin/deleteReview', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: reviewId }),
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Review deleted successfully.');
                        console.log('Delete successful:', data);
                        this.closest('.review-container').remove();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('There was an error deleting the Review');
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
            .then(response => response.json())
            .then(data => {
                alert('Review created successfully.');
                console.log('Success:', data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error creating the review');
            });
    });
}