<?php
require __DIR__ . '/../../components/personal_program/getListViewData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require __DIR__ . '/../../components/general/commonDataHeaderTailwind.php'; ?>
</head>

<body class="bg-black text-white flex flex-col min-h-screen">
    <?php require __DIR__ . '/../../components/general/topBar.php'; ?>

    <div class="flex flex-col flex-grow">
        <div class="flex justify-center items-center">
            <div class="w-full max-w-4xl mx-auto p-8">

                <?php require __DIR__ . '/../../components/personal_program/shareLinks.php'; ?>

                <?php require __DIR__ . '/../../components/personal_program/displayUnpurchasedReservations.php'; ?>

                <?php if (!empty($orderItems)): ?>
                    <div class="mt-10 flex justify-end gap-4">
                        <a href="/payment">
                            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Purchase All Tickets
                            </button>
                        </a>

                        <a href="/payment">
                            <button id="js_purchase-selected-tickets"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Purchase Selected Tickets
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php require __DIR__ . '/../../components/personal_program/displayPurchasedReservations.php'; ?>

            </div>
        </div>
        <?php include __DIR__ . '/../../components/general/footer.php'; ?>
    </div>

    <script type="text/javascript">
        const userID = <?php echo json_encode($userId); ?>;
    </script>

    <script type="module" src="javascript/Personal_Program/personal_program_listview.js"></script>

</body>

</html>