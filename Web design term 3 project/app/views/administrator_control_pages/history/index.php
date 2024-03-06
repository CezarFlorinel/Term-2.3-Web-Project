<?php require __DIR__ . '/../../../components/general/getHistoryData.php'; ?>



<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>



<body class="bg-gray-200">
    <div class="flex min-h-screen">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div>
            <h1 class="text-3xl text-center">Practical Information Section</h1>
            <div>
                <?php foreach ($historyPracticalInformation as $practicalInformation): ?>
                    <div>
                        <p>
                            <?php echo htmlspecialchars($practicalInformation->question); ?>
                            <br>
                            <?php echo htmlspecialchars($practicalInformation->answer); ?>
                        </p>
                        <br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>