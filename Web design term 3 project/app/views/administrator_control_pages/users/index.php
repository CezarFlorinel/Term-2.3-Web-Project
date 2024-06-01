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
            <h1 class="text-3xl text-center mb-6">Users</h1>
            <div class="bg-white shadow-md rounded-lg p-6">

                <!-- search -->
                <div class="mb-2 pt-2 relative mx-auto text-gray-600">
                    <input
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="text" name="search" placeholder="Search name" id="search" title="Type in a name">
                </div>

                <!-- users table -->
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        id="userTable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Registration date
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <a href="/userAddAdmin"><button type="button"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add
                        new user</button></a>

            </div>
        </div>
    </div>

    <script type="module" src="javascript/User/user.js"></script>
</body>

</html>