<?php include __DIR__ . '/../../config/recaptchaKeys.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,500,900|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script
        src="https://www.google.com/recaptcha/enterprise.js?render=6LfbGsEpAAAAAJ2RLoJCUfirLF4BxU7B8lR0xtWX"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfbGsEpAAAAAJ2RLoJCUfirLF4BxU7B8lR0xtWX"></script>

</head>

<body>

    <?php include __DIR__ . '/../header.php'; ?>

    <section class="flex justify-center items-center h-screen bg-black">
        <div class="max-w-md w-full bg-white rounded p-6 space-y-4">
            <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-auto h-10 w-auto" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register
                    </h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" id="registrationForm" role="form"
                        onsubmit="event.preventDefault(); validateCaptcha();">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="name" autocomplete="name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Confirm
                                    password</label>
                            </div>
                            <div class="mt-2">

                                <input id="confirmPassword" name="confirmPassword" type="password"
                                    autocomplete="current-password" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="flex justify-start">
                            <label class="block text-gray-500 font-bold my-4 flex items-center">
                                <input class="leading-loose text-pink-600 top-0" type="checkbox" required />
                                <span class="ml-2 text-sm py-2 text-gray-600 text-left">Accept the
                                    <a href="#"
                                        class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                        Terms and Conditions of the site
                                    </a>and
                                    <a href="#"
                                        class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                        the information data policy.</a>
                                </span>
                            </label>
                        </div>

                        <div>
                            <!-- Existing Input Fields -->
                            <button
                                class="g-recaptcha flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"" data-sitekey="
                                6LfbGsEpAAAAAJ2RLoJCUfirLF4BxU7B8lR0xtWX" data-callback='onSubmit' data-action='submit'>
                                Sign up
                            </button>
                        </div>

                        <!-- <div>
                            <button type="submit" id="registerButton"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Sign up
                            </button>
                        </div> -->
                    </form>

                    <p class="mt-10 text-center text-sm text-gray-500">
                        You already have an account?
                        <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign
                            in</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function onSubmit(token) {
            console.log('token:', token);
            document.getElementById("registrationForm").submit();
        }
    </script>

</body>

<script type="module" src="javascript/User/register.js"></script>

</html>
<?php include __DIR__ . '/../footer.php'; ?>