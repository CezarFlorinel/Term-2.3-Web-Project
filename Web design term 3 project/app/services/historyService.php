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

    // get methods for all history related queries ---------------------------------------

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

    public function getCurrentImagePathTourStartingPoint($id, $columnName)
    {
        $repository = new HistoryRepository();
        return $repository->getCurrentImagePathTourStartingPoint($id, $columnName);
    }

    public function getCurrentImagePathTicketPrices($id)
    {
        $repository = new HistoryRepository();
        return $repository->getCurrentImagePathTicketPrices($id);
    }

    public function getCurrentImagePathRoute($id)
    {
        $repository = new HistoryRepository();
        return $repository->getCurrentImagePathRoute($id);
    }

    //edit methods for all history related queries -------------------------------

    public function editImagePathsTourStartingPoint($id, $imagePath, $columnName)
    {
        $repository = new HistoryRepository();
        $repository->editImagePathsTourStartingPoint($id, $imagePath, $columnName);
    }

    public function editHistoryPracticalInformation($id, $question, $answer)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryPracticalInformation($id, $question, $answer);
    }

    public function editHistoryTopPart($id, $imagePath, $subheader, $description)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryTopPart($id, $imagePath, $subheader, $description);
    }

    public function editHistoryRoute($id, $mainImagePath, $locationName, $locationDespcription, $locationImagePath, $wheelchairSupport)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryRoute($id, $mainImagePath, $locationName, $locationDespcription, $locationImagePath, $wheelchairSupport);
    }

    public function editHistoryTicketPrices($id, $ticketType, $price, $description)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryTicketPrices($id, $ticketType, $price, $description);
    }

    public function editImagePathHistoryTicketPrices($id, $imagePath)
    {
        $repository = new HistoryRepository();
        $repository->editImagePathHistoryTicketPrices($id, $imagePath);
    }

    public function editHistoryTourStartingPoint($id, $description)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryTourStartingPoint($id, $description);
    }

    public function editHistoryTourDeparturesTimetables($id, $date)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryTourDeparturesTimetables($id, $date);
    }

    public function editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chinesTour)
    {
        $repository = new HistoryRepository();
        $repository->editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chinesTour);
    }


    // create methods for all history related queries

    public function addHistoryPracticalInformation($parentPage, $question, $answer)
    {
        $repository = new HistoryRepository();
        $repository->addHistoryPracticalInformation($parentPage, $question, $answer);
    }

    // delete methods for all history related queries

    public function deleteHistoryPracticalInformation($id)
    {
        $repository = new HistoryRepository();
        $repository->deleteHistoryPracticalInformation($id);
    }
}