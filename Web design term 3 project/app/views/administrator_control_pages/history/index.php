<?php require __DIR__ . '/../../../components/general/getHistoryData.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<head>
    <link rel="stylesheet" href="CSS_files/Admin/history_admin.css">
</head>

<body class="bg-gray-200">
    <div class="flex min-h-screen overflow-hidden">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">
            <?php include __DIR__ . '/../../../components/admin/history/main_page/topPartDescriptionAndCarousel.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/history/main_page/route.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/history/main_page/ticketPrices.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/history/main_page/tourDeparturesTimetable.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/history/main_page/startingPointOfTour.php'; ?>
            <?php include __DIR__ . '/../../../components/admin/history/main_page/practicalInformation.php'; ?>
        </div>

        <script type="module" src="javascript/History/admin_part.js"></script>

</body>


</html>