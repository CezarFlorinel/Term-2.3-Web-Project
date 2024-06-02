<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival Project</title>
    <link rel="icon" type="image/png" href="assets/images/logos/H.png">
    <link rel="stylesheet" href="CSS_files/header.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:500|Zen+Antique|Allerta+Stencil&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2/dist/purify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="/CSS_files/js_custome_alert.css">
    <style>
        /* Add this CSS class for removing border-radius */
        .header-square {
            border-radius: 0 !important;
        }
    </style>
</head>

<?php include_once "../components/general/modalSet.php"; ?>

<body>

    <?php include_once "../components/general/modalBoxCreate.php"; ?>

    <main>
        <header class="header flex justify-between items-center px-4 py-2 bg-white shadow-md">
            <a href="/" class="logoLink">
                <img class="logo" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
            </a>
            <input type="checkbox" id="menu-toggle" class="menu-toggle hidden">
            <label for="menu-toggle" class="menu-icon" id="menu-icon">
                <img src="assets/images/elements/hamburger_Icon.jpg" alt="Menu">
            </label>
            <nav class="navigation flex-grow hidden lg:flex justify-end">
                <a href="/" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/') ? 'active' : ''; ?>">Home</a>
                <a href="/yummyevent" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/yummyevent') ? 'active' : ''; ?>">Yummy</a>
                <a href="/danceevent" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/danceevent') ? 'active' : ''; ?>">Dance</a>
                <a href="/historyevent" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/historyevent') ? 'active' : ''; ?>">Stroll Through History</a>
                <a href="/mainpageadmin" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/mainpageadmin') ? 'active' : ''; ?>">Admin</a>
                <div class="relative dropdown">
                    <button id="dropdownButton" class="nav-link">More</button>
                    <div id="dropdownContent" class="dropdown-content hidden absolute bg-white shadow-md rounded-lg mt-2">
                        <?php foreach ($customPages as $customPage) : ?>
                            <a href="/CustomPages?id=<?php echo htmlspecialchars($customPage->customPageID); ?>" class="block px-4 py-2">
                                <?php echo htmlspecialchars($customPage->title); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>
            <div class="icons flex space-x-4">
                <a href="/personalProgramAgendaView">
                    <img class="icon" src="assets/images/elements/Shopping cart.png" alt="Shopping Cart">
                </a>
                <a href="/personalProgramListView">
                    <img class="icon" src="assets/images/elements/Wishlist.png" alt="Wishlist">
                </a>
                <a href="/login">
                    <img class="icon" src="assets/images/elements/login.png" alt="Login">
                </a>
            </div>
        </header>
    </main>
    <script>
        document.getElementById('menu-toggle').addEventListener('change', function() {
            var header = document.querySelector('.header');
            if (window.innerWidth <= 768) { // Assuming 768px is the breakpoint for small devices
                if (this.checked) {
                    header.classList.add('header-square');
                } else {
                    header.classList.remove('header-square');
                }
            }
        });

        document.getElementById('dropdownButton').addEventListener('click', function() {
            var dropdownContent = document.getElementById('dropdownContent');
            dropdownContent.classList.toggle('hidden');
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('#dropdownButton')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                Array.prototype.forEach.call(dropdowns, function(openDropdown) {
                    openDropdown.classList.add('hidden');
                });
            }
        });
    </script>
</body>

</html>