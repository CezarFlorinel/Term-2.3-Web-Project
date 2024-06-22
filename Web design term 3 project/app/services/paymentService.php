<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Models\Order_And_Invoice\Order;
use App\Models\Order_And_Invoice\Invoice;
use App\Models\Order_And_Invoice\OrderItem;

class PaymentService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PaymentRepository();
    }
    public function getOrderByUserId($userId): Order
    {
        return $this->repository->getOrderByUserId($userId);
    }
    public function getOrdersItemsByOrderId($orderId)
    {
        return $this->repository->getOrdersItemsByOrderId($orderId);
    }
    public function getOrderByOrderItem($orderItemID): Order
    {
        return $this->repository->getOrderByOrderItem($orderItemID);
    }

    public function getPaidOrdersByUserId($userId): array
    {
        return $this->repository->getPaidOrdersByUserId($userId);
    }

    public function getAllInvoices(): array
    {
        return $this->repository->getAllInvoices();
    }

    public function updateOrderStatus($orderID, $paymentStatus, $paymentMethod, $totalAmount)
    {
        $this->repository->updateOrderStatus($orderID, $paymentStatus, $paymentMethod, $totalAmount);
    }

    public function updateOrderItemQuantity($orderItemID, $quantity)
    {
        $this->repository->updateOrderItemQuantity($orderItemID, $quantity);
    }

    public function addInvoiceInDB($orderID, $invoiceDate, $clientName, $phoneNumber, $address, $email, $VAT, $total, $paymentDate)
    {
        $this->repository->addInvoiceInDB($orderID, $invoiceDate, $clientName, $phoneNumber, $address, $email, $VAT, $total, $paymentDate);
    }

    public function getInvoiceByOrderId($orderId): Invoice
    {
        return $this->repository->getInvoiceByOrderId($orderId);
    }

    public function getOrderItemByID($orderItemID): OrderItem
    {
        return $this->repository->getOrderItemByID($orderItemID);
    }

    public function deleteReservationByID($reservationID): void
    {
        $this->repository->deleteReservationByID($reservationID);
    }

    public function deleteOrderItemByID($orderItemID): void
    {
        $this->repository->deleteOrderItemByID($orderItemID);
    }

    public function setTheNewOrderForUnpaidOrderItems($orderItemIDs, $userID, $currentOrderID): void
    {
        $this->repository->setTheNewOrderForUnpaidOrderItems($orderItemIDs, $userID, $currentOrderID);
    }

    public function createNewOrderItem($quantity, $typeOfFestival, $orderFK, $passFK = null, $danceTicketFK = null, $historyTicketFK = null): void
    {
        $this->repository->createNewOrderItem($quantity, $typeOfFestival, $orderFK, $passFK, $danceTicketFK, $historyTicketFK);
    }

    public function createNewOrderInDBbyUserID($userID): void
    {
        $this->repository->createNewOrder($userID);
    }
}