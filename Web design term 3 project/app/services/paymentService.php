<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Models\Order_And_Invoice\Order;

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

}