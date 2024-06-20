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

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
</head>

<body>
    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>
    <br>
    <?php if ($isSecondPhase): ?>
        <?php require __DIR__ . '/../../components/manage_user_account/passwordsContainer.php'; ?>

    <?php else: ?>
        <?php require __DIR__ . '/../../components/manage_user_account/emailInsertContainer.php'; ?>

    <?php endif; ?>
    <br>

    <?php include __DIR__ . '/../../components/general/footer.php'; ?>
</body>

</html>