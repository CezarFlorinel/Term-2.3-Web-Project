<?php
use App\Services\CustomPageService;

$customPageService = new CustomPageService();
$customPages = $customPageService->getAllCustomPages();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Festival Project</title>
    <link rel="icon" type="image/png" href="assets/images/logos/H.png">
    <link rel="stylesheet" href="CSS_files/header.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:500|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2/dist/purify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="/CSS_files/js_custome_alert.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:500|Zen+Antique|Allerta+Stencil&display=swap"
        rel="stylesheet">
</head>

<?php include "../components/general/modalSet.php" ?>

<body>

    <?php include "../components/general/modalBoxCreate.php" ?>

    <main>
        <header class="header">
            <a href="/" class="logoLink">
                <img class="logo" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
            </a>
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="menu-icon" id="menu-icon">
                <img src="assets/images/elements/hamburger_Icon.jpg" alt="Menu">
            </label>
            <nav class="navigation">
                <a href="/" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/')
                    echo 'active'; ?>">Home</a>
                <a href="/yummyevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/yummyevent')
                    echo 'active'; ?>">Yummy</a>
                <a href="/danceevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/danceevent')
                    echo 'active'; ?>">Dance</a>
                <a href="/historyevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/historyevent')
                    echo 'active'; ?>">Stroll
                    Through History</a>
                <a href="/mainpageadmin" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/mainpageadmin')
                    echo 'active'; ?>">Admin</a>
                <div class="relative dropdown">
                    <button id="dropdownButton" class="nav-link">More</button>
                    <div id="dropdownContent" class="dropdown-content">
                        <?php foreach ($customPages as $customPage): ?>
                            <a href="/CustomPages?id=<?php echo htmlspecialchars($customPage->customPageID); ?>">
                                <?php echo $customPage->title; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>
            <div class="icons">
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
        document.getElementById('dropdownButton').addEventListener('click', function () {
            var dropdownContent = document.getElementById('dropdownContent');
            if (dropdownContent.style.display === 'none' || dropdownContent.style.display === '') {
                dropdownContent.style.display = 'block';
            } else {
                dropdownContent.style.display = 'none';
            }
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function (event) {
            if (!event.target.matches('#dropdownButton')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        });
    </script>
</body>

</html>