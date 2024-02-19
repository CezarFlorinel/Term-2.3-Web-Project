<?php
include __DIR__ . '/../header.php';


// Initialize the repository
$repository = new App\Repositories\userRepository();

// Fetch users
$users = $repository->getUsers();
?>

<h1>Welcome to the MVC Blog!</h1>

<h2>Our Users</h2>
<?php if (!empty($users)): ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= htmlspecialchars($user['Username']) ?> - <?= htmlspecialchars($user['Email']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

<?php
include __DIR__ . '/../footer.php';
?>
