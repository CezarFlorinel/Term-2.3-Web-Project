<?php
$isSecondPhase = false;

$userID = null;
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
}

if (isset($_GET['secondPhase'])) {
    $isSecondPhase = true;
}

?>

<?php include __DIR__ . '/../header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <br>
    <?php if ($isSecondPhase): ?>
        <?php require __DIR__ . '/../../components/manage_user_account/passwordsContainer.php'; ?>

    <?php else: ?>
        <?php require __DIR__ . '/../../components/manage_user_account/emailInsertContainer.php'; ?>

    <?php endif; ?>
    <br>

</body>

</html>



<?php include __DIR__ . '/../footer.php'; ?>