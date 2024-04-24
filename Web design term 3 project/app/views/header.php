<!DOCTYPE html>
<html lang="en">

<head>
    <title>Festival Project</title>
    <link rel="icon" type="image/png" href="assets/images/logos/H.png">
    <link rel="stylesheet" href="CSS_files/header.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:500|Zen+Antique|Allerta+Stencil&display=swap" rel="stylesheet">
</head>

<body>
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
                <a href="/" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/') echo 'active'; ?>">Home</a>
                <a href="/yummyevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/yummyevent') echo 'active'; ?>">Yummy</a>
                <a href="/danceevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/danceevent') echo 'active'; ?>">Dance</a>
                <a href="/historyevent" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/historyevent') echo 'active'; ?>">Stroll Through History</a>
                <a href="/mainpageadmin" class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/mainpageadmin') echo 'active'; ?>">Admin</a>
            </nav>
            <div class="icons">
                <a href="/payment">
                    <img class="icon" src="assets/images/elements/Shopping cart.png" alt="Shopping Cart">
                </a>
                <a href="/">
                    <img class="icon" src="assets/images/elements/Wishlist.png" alt="Wishlist">
                </a>
                <a href="/login">
                    <img class="icon" src="assets/images/elements/login.png" alt="Login">
                </a>
            </div>
        </header>

    </main>
</body>

</html>