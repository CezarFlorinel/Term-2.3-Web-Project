<?php

namespace App\Services;

use App\Repositories\TicketsRepository;

class TicketsService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new TicketsRepository();
    }
}