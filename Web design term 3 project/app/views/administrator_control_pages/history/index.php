<?php require __DIR__ . '/../../../components/general/getHistoryData.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
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
                                class="edit-btn py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-150">Edit</button>
                            <!-- Delete Button -->
                            <button
                                class="delete-btn ml-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
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
                        class="add-btn py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add
                        +</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const container = this.closest('div[data-id]');
                    const editableElements = container.querySelectorAll('.editable');
                    const isEditing = container.getAttribute('data-editing');

                    if (isEditing === 'true') {
                        // Switch off editing
                        editableElements.forEach(el => el.contentEditable = false);
                        btn.textContent = 'Edit';
                        container.removeAttribute('data-editing');

                        // Send data to server
                        const id = container.getAttribute('data-id');
                        const question = editableElements[0].innerText;
                        const answer = editableElements[1].innerText;

                        // Assuming you have a method to send data
                        updateHistoryPracticalInformation(id, question, answer);
                    } else {
                        // Switch on editing
                        editableElements.forEach(el => el.contentEditable = true);
                        btn.textContent = 'Save';
                        container.setAttribute('data-editing', 'true');
                    }
                });
            });

            // Show add form
            document.querySelector('.add-btn').addEventListener('click', function () {
                document.getElementById('addForm').classList.toggle('hidden');
            });

            // Add new question and answer
            document.getElementById('submitNewInfo').addEventListener('click', function () {
                const question = document.getElementById('newQuestion').value;
                const answer = document.getElementById('newAnswer').value;
                if (question && answer) { // Simple validation
                    addHistoryPracticalInformation(1, question, answer); // '1' as the fixed parentPage for now, to be changed later
                } else {
                    alert('Please fill in both question and answer');
                }
            });

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const container = this.closest('div[data-id]');
                    const id = container.getAttribute('data-id');

                    if (confirm('Are you sure you want to delete this item?')) { // Confirm deletion
                        deleteHistoryPracticalInformation(id);
                    }
                });
            });
        });

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