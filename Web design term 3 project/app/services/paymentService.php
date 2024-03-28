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
}