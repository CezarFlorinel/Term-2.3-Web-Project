<?php

namespace App\Repositories;

use PDO;
use App\Models\Order_And_Invoice\OrderItem;
use App\Models\Order_And_Invoice\Order;
use App\Models\Order_And_Invoice\Invoice;

class PaymentRepository extends Repository
{
    public function getOrderByUserId($userId): Order
    {
        $stmt = $this->connection->prepare('SELECT * FROM [ORDER] WHERE UserID = :user_id AND PaymentStatus = :payment_status');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $paymentStatus = "Incomplete"; // ------------------------- maybe to be made in enum
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Order(
            $result['OrderID'],
            $result['UserID'],
            $result['PaymentStatus'],
            $result['TotalAmount'],
            $result['PaymentMethod'],
            $result['PaymentDate']
        );

    }

    public function getOrdersItemsByOrderId($orderId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM ORDER_ITEM WHERE Order_FK = :order_id');
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($result) {
            return new OrderItem(
                $result['OrderItemID'],
                $result['Quantity'],
                $result['TypeOfFestival'],
                $result['Order_FK'],
                $result['Pass_FK'],
                $result['DanceTicket_FK'],
                $result['HistoryTicket_FK']
            );
        }, $results);
    }


}