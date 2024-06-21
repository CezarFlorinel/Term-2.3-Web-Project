<?php
use App\Services\CustomPageService;

$customPageService = new CustomPageService();
$customPages = $customPageService->getAllCustomPages();
?>

<?php include_once "../components/general/modalSet.php"; ?>
<?php include_once "../components/general/modalBoxCreate.php"; ?>

<main>
    <div class="header flex justify-between items-center px-4 py-2 bg-white shadow-md">
        <a href="/" class="logoLink">
            <img class="logo" src="assets/images/Logos/Logo-Festival.png" alt="Logo">
        </a>
        <input type="checkbox" id="menu-toggle" class="menu-toggle hidden">
        <label for="menu-toggle" class="menu-icon" id="menu-icon">
            <img src="assets/images/elements/hamburger_Icon.jpg" alt="Menu">
        </label>
        <nav class="navigation flex-grow hidden lg:flex justify-end">
            <a href="/" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/') ? 'active' : ''; ?>">Home</a>
            <a href="/yummyevent"
                class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/yummyevent') ? 'active' : ''; ?>">Yummy</a>
            <a href="/danceevent"
                class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/danceevent') ? 'active' : ''; ?>">Dance</a>
            <a href="/historyevent"
                class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/historyevent') ? 'active' : ''; ?>">Stroll
                Through History</a>
            <a href="/mainpageadmin"
                class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/mainpageadmin') ? 'active' : ''; ?>">Admin</a>
            <div class="relative dropdown">
                <button id="dropdownButton" class="nav-link">More</button>
                <div id="dropdownContent" class="dropdown-content">
                    <?php foreach ($customPages as $customPage): ?>
                        <a href="/CustomPages?id=<?php echo htmlspecialchars($customPage->customPageID); ?>">
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
    </div>
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

    document.getElementById('menu-toggle').addEventListener('change', function () {
        var header = document.querySelector('.header');
        if (window.innerWidth <= 768) { // Assuming 768px is the breakpoint for small devices
            if (this.checked) {
                header.classList.add('header-square');
            } else {
                header.classList.remove('header-square');
            }
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