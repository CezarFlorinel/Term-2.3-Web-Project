<div class="email_container w-1/2 container mx-auto mb-20 mt-20 p-6 bg-white shadow-lg rounded-lg">
    <div class="flex justify-center">
        <div class="w-1/2">

            <div class="mb-4 mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-15 w-auto" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
            </div>

            <h1 class="text-2xl font-bold text-gray-800">Change Password</h1>
            <h2 class="text-2x4 mb-2 mt-2 font-bold text-green-800">Phase:1</h2>
            <form action="/changePassword/checkIfEmailExists" method="POST">
                <div class="mb-6">
                    <label for="newPassword" class="block text-gray-800 text-lm font-bold mb-2">Insert your email
                        address</label>
                    <input required type="email" name="email" id="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <p class="mb-2 text-red-400">After you insert your email, you will receive an email with a key to change
                    your password and a link,
                    which you need to access.</p>


                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Send
                    Information</button>
            </form>

        </div>
    </div>
</div>