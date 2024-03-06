<?php

namespace App\Services;

use App\Models\History_event\HistoryPracticalInformation;
use App\Repositories\HistoryRepository;

class HistoryService // manages all the history service
{
    public function returnImagePathsForCarousel(): array
    {
        $repository = new HistoryRepository();
        $item = $repository->getHistoryTopParts();
        $unprocessedPaths = $item->imagePath;
        $paths = explode(" ; ", $unprocessedPaths);

        return $paths;
    }

    // get methods for all history related queries

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

    //edit methods for all history related queries

    public function editHistoryPracticalInformation($id, $question, $answer)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryPracticalInformation($id, $question, $answer);
    }


}