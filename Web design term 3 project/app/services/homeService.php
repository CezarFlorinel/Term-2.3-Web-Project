<?php

namespace App\Services;

use App\Repositories\HomeRepository;

class HomeService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new HomeRepository();
    }

    public function getEvents(): array
    {
        return $this->repository->getEvents();
    }

    public function updateEvent(int $id, string $imagePath, string $description, string $link, string $subtitle): void
    {
        $this->repository->updateEvent($id, $imagePath, $description, $link, $subtitle);
    }
}