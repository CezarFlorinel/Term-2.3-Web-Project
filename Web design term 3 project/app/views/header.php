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
</head>

<?php include "../components/general/modalSet.php" ?>

<body>

    <?php include "../components/general/modalBoxCreate.php" ?>

    <main>
        <header class="header">
            <a href="/" class="logoLink">
                <img class="logo" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
            </a>

            <nav class="navigation">

                <a href="/mainpageadmin" class="nav-link">Admin</a>
                <a href="/" class="nav-link">Home</a>
                <a href="/yummyevent" class="nav-link">Yummy</a>
                <a href="/danceevent" class="nav-link">Dance!</a>
                <a href="/historyevent" class="nav-link">History Tour</a>
                <a href="/payment">
                    <img class="icon0" src="assets/images/elements/Shopping cart.png" alt="Logo">
                </a>
                <a href="/personalProgramListView">
                    <img class="icon1" src="assets/images/elements/Wishlist.png" alt="Logo">
                </a>
                <a href="/login">
                    <img class="icon2" src="assets/images/elements/login.png" alt="Logo">
                </a>
                <a href="/">
                    <img class="language-switcher" src="assets/images/elements/UK-Flag.png" alt="Logo">
                </a>
            </nav>
        </header>
    </main>
</body>

</html>