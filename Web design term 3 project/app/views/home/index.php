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

<p>
To move two children of a Flexbox container to the next row, you have a couple of options depending on the overall layout and design you're aiming for. Flexbox automatically places items in a row or column based on the flex-direction property, but it treats the container as a single row or column. To explicitly move items to a new row within the same Flexbox container, you can use a combination of the flex-wrap property and manipulate the width, flex-basis, or use a pseudo-element as a workaround.

Option 1: Using flex-wrap and adjusting widths
If you want some items to wrap onto the next line, you can set flex-wrap: wrap; on the container and then control the width of the children so that they naturally wrap to the next line when there's not enough space in the container to fit them in a single line.
</p>
<p>
To move two children of a Flexbox container to the next row, you have a couple of options depending on the overall layout and design you're aiming for. Flexbox automatically places items in a row or column based on the flex-direction property, but it treats the container as a single row or column. To explicitly move items to a new row within the same Flexbox container, you can use a combination of the flex-wrap property and manipulate the width, flex-basis, or use a pseudo-element as a workaround.

Option 1: Using flex-wrap and adjusting widths
If you want some items to wrap onto the next line, you can set flex-wrap: wrap; on the container and then control the width of the children so that they naturally wrap to the next line when there's not enough space in the container to fit them in a single line.
</p>

<p>
To move two children of a Flexbox container to the next row, you have a couple of options depending on the overall layout and design you're aiming for. Flexbox automatically places items in a row or column based on the flex-direction property, but it treats the container as a single row or column. To explicitly move items to a new row within the same Flexbox container, you can use a combination of the flex-wrap property and manipulate the width, flex-basis, or use a pseudo-element as a workaround.

Option 1: Using flex-wrap and adjusting widths
If you want some items to wrap onto the next line, you can set flex-wrap: wrap; on the container and then control the width of the children so that they naturally wrap to the next line when there's not enough space in the container to fit them in a single line.
</p>


<?php
include __DIR__ . '/../footer.php';
?>
