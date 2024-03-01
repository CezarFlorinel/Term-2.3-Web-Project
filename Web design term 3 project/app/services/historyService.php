<?php

namespace App\Services;

use App\Repositories\HistoryRepository;

class HistoryService // manages all the history service
{
    public function getHistoryPracticalInformation(): array
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryPracticalInformation();
    }

    public function getHistoryTopParts()
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryTopParts();
    }

    public function getHistoryRoutes(): array
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryRoutes();
    }

    public function getHistoryTours(): array
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryTours();
    }

    public function getHistoryTourStartingPoints()
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryTourStartingPoints();
    }

    public function getHistoryTourDeparturesTimetables(): array
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryTourDeparturesTimetables();
    }

    public function getHistoryTicketPrices(): array
    {
        $repository = new HistoryRepository();
        return $repository->getHistoryTicketPrices();
    }

}