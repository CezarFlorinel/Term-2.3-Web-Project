<!DOCTYPE html>
<html lang="en">
<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">
        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6">
            <h1 class="text-3xl text-center mb-6">Add a new user</h1>
            <div class="bg-white shadow-md rounded-lg p-6">

                <!-- Add user form -->
                <div class="relative overflow-x-auto">
                <form id="addUserForm" class="max-w-md mx-auto mt-8">
                        <div class="mb-4">
                            <label for="addName" class="block">Name:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="editName" placeholder="Enter name" required>
                        </div>

                        <div class="mb-4">
                            <label for="addEmail" class="block">Email:</label>
                            <input type="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="editEmail" placeholder="Enter email" required>
                        </div>

                        <div class="mb-4">
                            <label for="addRole" class="block">Role:</label>
                            <select
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="editRole" required>
                                <option value="1">Member</option>
                                <option value="2">Admin</option>
                                <option value="3">Employee</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="addPassword" class="block">Password:</label>
                            <input type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="addPassword" placeholder="Enter password" required>
                        </div>

                        <div class="mb-4">
                            <label for="addRepeatPassword" class="block">Repeat Password:</label>
                            <input type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="addRepeatPassword" placeholder="Repeat Password" required>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add
                            User</button>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <script src="javascript/User/user.js"></script>
</body>

</html>