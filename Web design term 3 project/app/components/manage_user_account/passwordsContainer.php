<div class="passwords_container w-1/2 container mx-auto mb-20 mt-20 p-6 bg-white shadow-lg rounded-lg">
    <div class="flex justify-center">
        <div class="w-1/2">

            <div class="mb-4 mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-15 w-auto" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
            </div>

            <h1 class="text-2xl font-bold text-gray-800">Change Password</h1>
            <h2 class="text-2x4 mb-2 mt-2 font-bold text-green-800">Phase:2</h2>
            <form action="/changePassword/changePassword" method="POST">

                <div class="mb-6">
                    <label for="key" class="block text-gray-800 text-sm font-bold mb-2">Insert Key</label>
                    <input required max="999999" type="number" name="key" id="key"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="newPassword" class="block text-gray-800 text-sm font-bold mb-2">New Password</label>
                    <input required type="password" name="newPassword" id="newPassword"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="confirmPassword" class="block text-gray-800 text-sm font-bold mb-2">Confirm
                        Password</label>
                    <input required type="password" name="confirmPassword" id="confirmPassword"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <input type="hidden" name="userID" value="<?php echo $userID; ?>">

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Change
                    Password</button>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('key').addEventListener('input', function () {
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6);
        }
    });
</script>