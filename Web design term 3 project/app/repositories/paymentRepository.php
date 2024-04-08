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

    public function updateOrderStatus($orderID, $paymentStatus, $paymentMethod)
    {
        $stmt = $this->connection->prepare('UPDATE [ORDER] SET PaymentStatus = :payment_status, PaymentMethod = :payment_method WHERE OrderID = :order_id');
        $stmt->bindParam(':order_id', $orderID, PDO::PARAM_INT);
        $stmt->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':payment_method', $paymentMethod, PDO::PARAM_STR);
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

}