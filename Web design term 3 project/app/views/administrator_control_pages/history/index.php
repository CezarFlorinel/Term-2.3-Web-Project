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
                                class="ml-2 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 transition duration-150">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Add Button -->
                <div class="p-4">
                    <button
                        class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 transition duration-150">Add
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
        });

        function updateHistoryPracticalInformation(id, question, answer) {
            // Update to send JSON data
            console.log(id, question, answer);
            fetch('/api/historyadmin/updateHistoryPracticalInformation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Correct content-type for JSON
                },
                body: JSON.stringify({ // Ensure the body is JSON stringified
                    informationID: id, // Ensure this matches with PHP side expecting 'informationID'
                    question: question,
                    answer: answer
                })
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
        }

    </script>

</body>


</html>