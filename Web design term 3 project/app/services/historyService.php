<?php

namespace App\Services;

use App\Models\History_event\HistoryPracticalInformation;
use App\Repositories\HistoryRepository;
use App\Models\History_event\HistoryRoute;
use App\Models\History_event\HistoryTours;

class HistoryService // manages all the history service
{
    private $repository;

    public function __construct()
    {
        $this->repository = new HistoryRepository();
    }

    public function returnImagePathsForCarousel(): array
    {
        $item = $this->repository->getHistoryTopParts();
        $unprocessedPaths = $item->imagePath;
        $paths = explode(" ; ", $unprocessedPaths);

        return $paths;
    }

    // get methods for all history related queries ---------------------------------------

    public function getHistoryPracticalInformation(): array
    {
        return $this->repository->getHistoryPracticalInformation();
    }

    public function getHistoryTourByID($id): HistoryTours
    {
        return $this->repository->getHistoryTourByID($id);
    }

    public function getHistoryTopParts()
    {

        return $this->repository->getHistoryTopParts();
    }

    public function getHistoryRoutes(): array
    {

        return $this->repository->getHistoryRoutes();
    }

    public function getHistoryTours(): array
    {

        return $this->repository->getHistoryTours();
    }

    public function getHistoryTourStartingPoints()
    {
        return $this->repository->getHistoryTourStartingPoints();
    }

    public function getHistoryTourDeparturesTimetables(): array
    {
        return $this->repository->getHistoryTourDeparturesTimetables();
    }

    public function getHistoryTicketPrices(): array
    {
        return $this->repository->getHistoryTicketPrices();
    }

    public function getCurrentImagePathTourStartingPoint($id, $columnName)
    {

        return $this->repository->getCurrentImagePathTourStartingPoint($id, $columnName);
    }

    public function getCurrentImagePathTicketPrices($id)
    {
        return $this->repository->getCurrentImagePathTicketPrices($id);
    }

    public function getCurrentImagePathRoute($id)
    {
        return $this->repository->getCurrentImagePathRoute($id);
    }

    public function getFirstHistoryRoute(): HistoryRoute
    {
        return $this->repository->getFirstHistoryRoute();
    }

    //edit methods for all history related queries -------------------------------

    public function editImagePathsTourStartingPoint($id, $imagePath, $columnName)
    {
        $this->repository->editImagePathsTourStartingPoint($id, $imagePath, $columnName);
    }

    public function editHistoryPracticalInformation($id, $question, $answer)
    {
        $this->repository->editHistoryPracticalInformation($id, $question, $answer);
    }

    public function editHistoryTopPart($id, $subheader, $description)
    {
        $this->repository->editHistoryTopPart($id, $subheader, $description);
    }

    public function editImagePathHistoryTopPart($id, $imagePath)
    {
        $this->repository->editImagePathHistoryTopPart($id, $imagePath);
    }

    public function editImagePathHistoryDelete($id, $imageToDelete)
    {
        $this->repository->editImagePathHistoryDelete($id, $imageToDelete);
    }

    public function editHistoryRoute($id, $locationName, $locationDespcription, $wheelchairSupport)
    {
        $this->repository->editHistoryRoute($id, $locationName, $locationDespcription, $wheelchairSupport);
    }

    public function editImagePathHistoryRoute($id, $imagePath)
    {
        $this->repository->editImagePathHistoryRoute($id, $imagePath);
    }

    public function editHistoryTicketPrices($id, $ticketType, $price, $description)
    {
        $this->repository->editHistoryTicketPrices($id, $ticketType, $price, $description);
    }

    public function editImagePathHistoryTicketPrices($id, $imagePath)
    {
        $this->repository->editImagePathHistoryTicketPrices($id, $imagePath);
    }

    public function editHistoryTourStartingPoint($id, $description)
    {
        $this->repository->editHistoryTourStartingPoint($id, $description);
    }

    public function editHistoryTourDeparturesTimetables($id, $date)
    {
        $this->repository->editHistoryTourDeparturesTimetables($id, $date);
    }

    public function editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chinesTour)
    {
        $this->repository->editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chinesTour);
    }


    // create methods for all history related queries

    public function addHistoryPracticalInformation($question, $answer)
    {
        $this->repository->addHistoryPracticalInformation($question, $answer);
    }

    // delete methods for all history related queries

    public function deleteHistoryPracticalInformation($id)
    {
        $this->repository->deleteHistoryPracticalInformation($id);
    }
}