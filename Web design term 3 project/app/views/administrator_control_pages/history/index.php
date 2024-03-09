<?php require __DIR__ . '/../../../components/general/getHistoryData.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>
        <!-- Starting Point Of The Tour Section ------------------------------------------------------- -->
        <div class="flex-grow p-6">
            <h1 class="text-3xl text-center mb-6">Starting Point Of The Tour</h1>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="p-4 border-b border-gray-200 flex justify-between items-start"
                    data-id="<?php echo htmlspecialchars($historyTourStartingPoints->informationID); ?>">
                    <div>
                        <p>Description:</p>
                        <p class="text-lg font-semibold editable" contenteditable="false">
                            <?php echo htmlspecialchars($historyTourStartingPoints->description); ?>
                        </p>
                        <div>
                            <img id="image1"
                                src="<?php echo htmlspecialchars($historyTourStartingPoints->mainImagePath); ?>"
                                alt="Image 1" class="mt-2" style="width: 200px; height: auto;">
                            <input type="file" id="image1Input" class="hidden" accept="image/*">
                            <button onclick="document.getElementById('image1Input').click();"
                                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                Image 1</button>
                        </div>
                        <div>
                            <img id="image2"
                                src="<?php echo htmlspecialchars($historyTourStartingPoints->secondaryImagePath); ?>"
                                alt="Image 2" class="mt-2" style="width: 200px; height: auto;">
                            <input type="file" id="image2Input" class="hidden" accept="image/*">
                            <button onclick="document.getElementById('image2Input').click();"
                                class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150 mt-2">Change
                                Image 2</button>
                        </div>
                    </div>
                    <button
                        class="edit-tour-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                </div>
            </div>

            <!-- Practical Information Section ------------------------------------------------------- -->
            <h1 class="text-3xl text-center mb-6">Practical Information Section</h1>
            <div class="bg-white shadow-md rounded-lg p-6">
                <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
                    <div class="p-4 border-b border-gray-200 flex justify-between items-start"
                        data-id="<?php echo htmlspecialchars($practicalInformation->informationID); ?>">
                        <div>
                            <p>Q:</p>
                            <p class="text-lg font-semibold editable" contenteditable="false">
                                <?php echo htmlspecialchars($practicalInformation->question); ?>
                            </p>
                            <p>A:</p>
                            <p class="mt-2 editable" contenteditable="false">
                                <?php echo htmlspecialchars($practicalInformation->answer); ?>
                            </p>
                        </div>
                        <div class="flex items-start">
                            <!-- Edit Button -->
                            <button
                                class="edit-practical-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                            <!-- Delete Button -->
                            <button
                                class="delete-practical-btn ml-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div id="addForm" class="hidden p-4 bg-gray-100 border border-gray-200 rounded-lg">
                    <h2 class="text-lg mb-2">Add New Practical Information:</h2>
                    <div>
                        <label for="newQuestion">Question:</label>
                        <input type="text" id="newQuestion" class="block w-full p-2 mt-1 mb-2">
                        <label for="newAnswer">Answer:</label>
                        <textarea id="newAnswer" class="block w-full p-2 mt-1 mb-2"></textarea>
                        <button id="submitNewInfo"
                            class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Submit</button>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="p-4">
                    <button
                        class="add-practical-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add
                        +</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        const parentPage = 1; // Fixed for now, to be changed later

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-practical-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    handleEditableFields(this, updateHistoryPracticalInformation);
                });
            });

            // Tour Starting Point Edit button
            document.querySelectorAll('.edit-tour-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    handleEditableFields(this, updateHistoryStartingPointDescription);
                });
            });

            document.getElementById('image1Input').addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    uploadAndUpdateImage(this.files[0], 'image1', '<?php echo $historyTourStartingPoints->informationID; ?>');
                }
            });

            document.getElementById('image2Input').addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    uploadAndUpdateImage(this.files[0], 'image2', '<?php echo $historyTourStartingPoints->informationID; ?>');
                }
            });

            // Show add form
            document.querySelector('.add-practical-btn').addEventListener('click', function () {
                document.getElementById('addForm').classList.toggle('hidden');
            });

            // Add new question and answer
            document.getElementById('submitNewInfo').addEventListener('click', function () {
                const question = document.getElementById('newQuestion').value;
                const answer = document.getElementById('newAnswer').value;
                if (question && answer) {
                    addHistoryPracticalInformation(parentPage, question, answer);
                } else {
                    alert('Please fill in both question and answer');
                }
            });

            document.querySelectorAll('.delete-practical-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const container = this.closest('div[data-id]');
                    const id = container.getAttribute('data-id');

                    if (confirm('Are you sure you want to delete this item?')) {
                        deleteHistoryPracticalInformation(id);
                    }
                });
            });
        });

        function handleEditableFields(button, updateFunction) {
            const container = button.closest('div[data-id]');
            const editableElements = container.querySelectorAll('.editable');
            const isEditing = container.getAttribute('data-editing');
            const id = container.getAttribute('data-id');

            if (isEditing === 'true') {
                // Switch off editing and update information
                editableElements.forEach(el => { el.contentEditable = false; });
                button.textContent = 'Edit';
                container.removeAttribute('data-editing');
                const content = editableElements[0].innerText; // Assuming first element is always the target
                updateFunction(id, content);
            } else {
                // Enable editing
                editableElements.forEach(el => { el.contentEditable = true; });
                button.textContent = 'Save';
                container.setAttribute('data-editing', 'true');
            }
        }

        function uploadAndUpdateImage(file, imageId, tourId) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('id', tourId); // Your tour starting point's ID
            formData.append('imageId', imageId);

            fetch('/api/historyadmin/uploadAndUpdateImageForTourStartingPoint', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(imageId).src = data.imageUrl; // Update the displayed image
                    } else {
                        alert('Image upload failed: ' + data.error);
                    }
                })
                .catch(error => console.error('Error uploading image:', error));
        }

        function updateHistoryStartingPointDescription(id, description) {
            console.log(id, description);
            fetch('/api/historyadmin/updateHistoryTourStartingPointDescription', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    informationID: id,
                    description: description
                })
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }

        function deleteHistoryPracticalInformation(id) {
            console.log('Deleting:', id);
            fetch('/api/historyadmin/deleteHistoryPracticalInformation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    informationID: id
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    location.reload(); // Reload the page to remove the deleted item
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error deleting the information');
                });
        }

        function updateHistoryPracticalInformation(id, question, answer) {
            console.log(id, question, answer);
            fetch('/api/historyadmin/updateHistoryPracticalInformation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Correct content-type for JSON
                },
                body: JSON.stringify({
                    informationID: id,
                    question: question,
                    answer: answer
                })
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }

        function addHistoryPracticalInformation(parentPage, question, answer) {
            console.log(parentPage, question, answer);
            fetch('/api/historyadmin/createHistoryPracticalInformation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    parentPage: parentPage,
                    question: question,
                    answer: answer
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    location.reload(); // Reload the page to see the new entry
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error adding the information');
                });
        }
    </script>
</body>


</html>