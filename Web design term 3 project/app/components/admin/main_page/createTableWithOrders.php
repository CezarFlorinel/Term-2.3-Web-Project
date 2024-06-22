<div>
    <div class="flex mb-4">
        <button id="exportButton" class="px-4 py-2 bg-blue-500 text-white">Export Selected</button>
    </div>
    <div class="overflow-x-auto max-w-[1060px]">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="userTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" id="selectAllOrders" />
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Order_Id" /> Order ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Payment_Date" /> Payment
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Client_Name" /> Customer
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Phone_Number" /> Phone
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Address" /> Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Email" /> Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="VAT" /> VAT (&#8364;)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" class="columnCheckbox" data-column="Total_Amount" /> Total
                        (&#8364;)
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr class="bg-white dark:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="orderCheckbox" data-orderid="<?= $order->orderId ?>" />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Order_Id"><?= $order->orderId ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Payment_Date">
                            <?= $order->paymentDate ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Client_Name">
                            <?= $order->clientName ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Phone_Number">
                            <?= $order->phoneNumber ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Address"><?= $order->address ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Email"><?= $order->email ?></td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="VAT">
                            <?= number_format($order->VATamount, 2) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-column="Total_Amount">
                            <?= number_format($order->totalAmount, 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>