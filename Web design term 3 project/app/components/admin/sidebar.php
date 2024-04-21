<?php include '../../components/general/modalSet.php'; ?>
<?php include '../../components/general/modalBoxCreate.php'; ?>


<div class="w-64 bg-gray-700 text-white">
    <div class="p-5 bg-gray-900">Administrator</div>
    <ul class="space-y-2">
        <li><a href="/mainpageadmin" class="block p-5 hover:bg-gray-800">Home</a></li>
        <li><a href="/userAdmin" class="block p-5 hover:bg-gray-800">Users</a></li>
        <li><a href="/historyadmin" class="block p-5 hover:bg-gray-800">History</a></li>
        <li><a href="#" class="block p-5 hover:bg-gray-800">Dance</a></li>
        <li><a href="/yummyHomeAdmin" class="block p-5 hover:bg-gray-800">Yummy</a></li>
        <li><a href="/home" class="block p-5 hover:bg-gray-800">Go Back To Website</a></li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Get current page URL path
        const path = window.location.pathname;
        // Query all anchor tags from the navigation menu
        const links = document.querySelectorAll('.w-64 a');
        // Iterate through each link in the navigation
        links.forEach(link => {
            // Remove 'active' class from all links initially
            link.classList.remove('active');
            // Add 'active' class to the link that matches the current URL path
            if (link.getAttribute('href') === path) {
                link.classList.add('active');
            }
        });
    });
</script>

<style>
    .active {
        background-color: #2d3748;
    }
</style>