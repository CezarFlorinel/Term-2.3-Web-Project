<?php
use App\Services\CustomPageService;
use App\Services\PaymentService;

$customPageService = new CustomPageService();
$paymentService = new PaymentService();
$customPages = $customPageService->getAllCustomPages();
$orders = $paymentService->getAllInvoices();

?>


<!DOCTYPE html>
<html lang="en">

<?php require __DIR__ . '/../../../components/admin/header.php'; ?>

<body class="bg-gray-200">
    <div class="flex min-h-screen">

        <?php require __DIR__ . '/../../../components/admin/sidebar.php'; ?>

        <div class="flex-grow p-6 ml-36">
            <h1 class="text-3xl text-center py-5">Welcome to the admin control panel</h1>

            <?php require __DIR__ . '/../../../components/admin/main_page/customPagesSection.php'; ?>

            <h2 class="text-2xl text-center py-5">Orders Section</h2>

            <div class="bg-white p-6 rounded-lg shadow-md w-full">
                <h3 class="text-2xl text-left py-5">Search Order By Customer Name</h3>
                <div class="flex justify-center mb-4">
                    <input type="text" id="searchOrder" placeholder="Search Order By Customer Name"
                        class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                </div>
                <div class="mb-4">
                    <button id="searchButton"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Search
                    </button>
                    <button id="exportButtonSearch"
                        class="bg-green-500 hover:bg-green-700 ml-2 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Export
                        Order
                    </button>
                </div>
                <div id="orderList" class="hidden">
                    <h4 class="text-xl text-left py-2">Select an Order</h4>
                    <ul id="orderListContainer" class="list-disc list-inside"></ul>
                </div>
                <div id="orderDetails" class="hidden">
                    <h4 class="text-xl text-left py-2">Order Details</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <span id="js_orderID"></span>
                        <span id="js_paymentDate"></span>
                        <span id="js_customerName"></span>
                        <span id="js_phoneNumber"></span>
                        <span id="js_Address"></span>
                        <span id="js_Email"></span>
                        <span id="js_VAT"></span>
                        <span id="js_TotalAmount"></span>
                    </div>
                </div>
            </div>
            <br>


            <?php require __DIR__ . '/../../../components/admin/main_page/createTableWithOrders.php'; ?>



        </div>
    </div>

    <script type="text/javascript">
        const orders = <?php echo json_encode($orders); ?>;
    </script>

    <script type="module" src="javascript/Orders/orders_export.js"></script>

</body>

</html>