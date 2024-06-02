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

    public function getOrderByOrderItem($orderItemID): Order
    {
        $stmt = $this->connection->prepare('SELECT * FROM [ORDER] WHERE OrderID = (SELECT Order_FK FROM ORDER_ITEM WHERE OrderItemID = :order_item_id)');
        $stmt->bindParam(':order_item_id', $orderItemID, PDO::PARAM_INT);
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

    public function getPaidOrdersByUserId($userId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [ORDER] WHERE UserID = :user_id AND PaymentStatus = :payment_status');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $paymentStatus = "Complete"; // ------------------------- maybe to be made in enum
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($result) {
            return new Order(
                $result['OrderID'],
                $result['UserID'],
                $result['PaymentStatus'],
                $result['TotalAmount'],
                $result['PaymentMethod'],
                $result['PaymentDate']
            );
        }, $results);
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
    public function updateOrderStatus($orderID, $paymentStatus, $paymentMethod, $totalAmount)
    {
        date_default_timezone_set('Europe/Amsterdam');
        $currentDate = date("Y-m-d H:i:s");

        $stmt = $this->connection->prepare('UPDATE [ORDER] SET PaymentStatus = :payment_status, PaymentMethod = :payment_method, TotalAmount = :total_amount, PaymentDate= :date WHERE OrderID = :order_id');
        $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':payment_method', $paymentMethod, PDO::PARAM_STR);
        $stmt->bindParam(':total_amount', $totalAmount, PDO::PARAM_INT);
        $stmt->bindParam(':date', $currentDate, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateOrderItemQuantity($orderItemID, $quantity)
    {
        $stmt = $this->connection->prepare('UPDATE ORDER_ITEM SET Quantity = :quantity WHERE OrderItemID = :order_item_id');
        $stmt->bindParam(':order_item_id', $orderItemID, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addInvoiceInDB($orderID, $invoiceDate, $clientName, $phoneNumber, $address, $email, $VAT, $total, $paymentDate)
    {
        $stmt = $this->connection->prepare('INSERT INTO INVOICE (OrderID, InvoiceDate, ClientName, PhoneNumber, Address, Email, VATAmount, TotalAmount, PaymentDate) VALUES (:order_id, :invoice_date, :client_name, :phone_number, :address, :email, :vat, :total, :payment_date)');
        $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
        $stmt->bindParam(':invoice_date', $invoiceDate, PDO::PARAM_STR);
        $stmt->bindParam(':client_name', $clientName, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':vat', $VAT);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':payment_date', $paymentDate, PDO::PARAM_STR);
        $stmt->execute();

    }
    public function getInvoiceByOrderId($orderId): Invoice
    {
        $stmt = $this->connection->prepare('SELECT * FROM INVOICE WHERE OrderID = :order_id');
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Invoice(
            $result['InvoiceID'],
            $result['OrderID'],
            $result['InvoiceDate'],
            $result['ClientName'],
            $result['PhoneNumber'],
            $result['Address'],
            $result['Email'],
            $result['VATAmount'],
            $result['TotalAmount'],
            $result['PaymentDate']
        );
    }

    public function getOrderItemByID($orderItemID): OrderItem
    {
        $stmt = $this->connection->prepare('SELECT * FROM ORDER_ITEM WHERE OrderItemID = :order_item_id');
        $stmt->bindParam(':order_item_id', $orderItemID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new OrderItem(
            $result['OrderItemID'],
            $result['Quantity'],
            $result['TypeOfFestival'],
            $result['Order_FK'],
            $result['Pass_FK'],
            $result['DanceTicket_FK'],
            $result['HistoryTicket_FK']
        );
    }

    public function deleteOrderItemByID($orderItemID): void
    {
        $stmt = $this->connection->prepare('DELETE FROM ORDER_ITEM WHERE OrderItemID = :order_item_id');
        $stmt->bindParam(':order_item_id', $orderItemID, PDO::PARAM_INT);
        $stmt->execute();

    }

    public function deleteReservationByID($reservationID): void
    {

        $stmt = $this->connection->prepare('DELETE FROM [RESTAURANT_RESERVATIONS] WHERE ID = :reservation_id');
        $stmt->bindParam(':reservation_id', $reservationID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function setTheNewOrderForUnpaidOrderItems($orderItemIDs, $userID, $currentOrderID): void
    {
        $orderID = $this->createNewOrder($userID);
        $selectedOrderItems = [];
        $allOrderItems = $this->getOrdersItemsByOrderId($currentOrderID);

        foreach ($orderItemIDs as $orderItemID) {
            $selectedOrderItems[] = $this->getOrderItemByID($orderItemID);
        }

        foreach ($allOrderItems as $orderItem) {
            if (!in_array($orderItem, $selectedOrderItems)) {
                $stmt = $this->connection->prepare('UPDATE ORDER_ITEM SET Order_FK = :order_id WHERE OrderItemID = :order_item_id');
                $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
                $stmt->bindParam(':order_item_id', $orderItem->orderItemID, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }

    public function createNewOrder($userID): int
    {
        $paymentMethod = "-";
        $paymentStatus = "Incomplete"; // ------------------------- maybe to be made in enum
        $totalAmount = 0;
        $paymentDate = date("Y-m-d H:i:s");

        $stmt = $this->connection->prepare('INSERT INTO [ORDER] (UserID, PaymentStatus, TotalAmount, PaymentMethod, PaymentDate) VALUES (:user_id, :payment_status, :total_amount, :payment_method, :payment_date)');
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':total_amount', $totalAmount, PDO::PARAM_INT);
        $stmt->bindParam(':payment_method', $paymentMethod, PDO::PARAM_STR);
        $stmt->bindParam(':payment_date', $paymentDate, PDO::PARAM_STR);
        $stmt->execute();

        return $this->connection->lastInsertId();
    }

    public function createNewOrderItem($quantity, $typeOfFestival, $orderFK, $passFK = null, $danceTicketFK = null, $historyTicketFK = null): void
    {
        $stmt = $this->connection->prepare('INSERT INTO ORDER_ITEM (Quantity, TypeOfFestival, Order_FK, Pass_FK, DanceTicket_FK, HistoryTicket_FK) VALUES (:quantity, :type_of_festival, :order_fk, :pass_fk, :dance_ticket_fk, :history_ticket_fk)');
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':type_of_festival', $typeOfFestival, PDO::PARAM_STR);
        $stmt->bindParam(':order_fk', $orderFK, PDO::PARAM_INT);
        $stmt->bindParam(':pass_fk', $passFK, PDO::PARAM_INT);
        $stmt->bindParam(':dance_ticket_fk', $danceTicketFK, PDO::PARAM_INT);
        $stmt->bindParam(':history_ticket_fk', $historyTicketFK, PDO::PARAM_INT);
        $stmt->execute();

    }

}