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

    public function updateOrderStatus($orderID, $paymentStatus, $paymentMethod)
    {
        $this->repository->updateOrderStatus($orderID, $paymentStatus, $paymentMethod);
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

}