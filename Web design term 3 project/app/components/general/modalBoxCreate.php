<!-- Error Modal -->
<?php if (isset($errorModal)): ?>
    <?php $errorModal->render(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = document.getElementById('errorModal');

            // Function to show the modal
            const showModal = () => {
                errorModal.classList.remove('hidden');
            };

            // Function to hide the modal
            const hideModal = () => {
                errorModal.classList.add('hidden');
            };

            // Initially show the modal
            showModal();

            // Add event listeners to buttons to close the modal
            document.querySelectorAll('.btn-success, .close').forEach(element => {
                element.addEventListener('click', hideModal);
            });
        });
    </script>
<?php endif; ?>

<!-- Success Modal -->
<?php if (isset($successModal)): ?>
    <?php $successModal->render(true); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = document.getElementById('successModal');

            // Function to show the modal
            const showModal = () => {
                successModal.classList.remove('hidden');
            };

            // Function to hide the modal
            const hideModal = () => {
                successModal.classList.add('hidden');
            };

            // Initially show the modal
            showModal();

            // Add event listeners to buttons to close the modal
            document.querySelectorAll('.btn-success, .close').forEach(element => {
                element.addEventListener('click', hideModal);
            });
        });
    </script>
<?php endif; ?>