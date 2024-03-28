<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new PaymentRepository();
    }
    public function getOrderByUserId($userId)
    {
        return $this->repository->getOrderByUserId($userId);
    }
    public function getOrdersItemsByOrderId($orderId)
    {
        return $this->repository->getOrdersItemsByOrderId($orderId);
    }
}