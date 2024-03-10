<?php

namespace App\Repositories;

use PDO;
use App\Models\History_event\HistoryRoute;
use App\Models\History_event\HistoryPracticalInformation;
use App\Models\History_event\HistoryTours;
use App\Models\History_event\HistoryTourStartingPoint;
use App\Models\History_event\HistoryTopPart;
use App\Models\History_event\HistoryTourDeparturesTimetables;
use App\Models\History_event\HistoryTicketPrices;

class HistoryRepository extends Repository     // methods for all history related queries
{

    // get the information methods
    public function getHistoryPracticalInformation(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_PRACTICAL_INFORMATION]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($item) {
            return new HistoryPracticalInformation(
                $item['InformationID'],
                $item['ParentPage'],
                $item['Question'],
                $item['Answer']
            );
        }, $results);
    }

    public function getHistoryTopParts()
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_TOP_PART]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $firstItem = $results[0];
            return new HistoryTopPart(
                $firstItem['InformationID'],
                $firstItem['ParentPage'],
                $firstItem['ImagePath'],
                $firstItem['Subheader'],
                $firstItem['Description']
            );
        }
        return null;
    }

    public function getHistoryRoutes(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_ROUTE]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($item) {
            return new HistoryRoute(
                $item['InformationID'],
                $item['ParentPage'],
                $item['MainImagePath'],
                $item['LocationName'],
                $item['LocationDespcription'],
                $item['LocationImagePath'],
                $item['WheelchairSupport']
            );
        }, $results);
    }

    public function getHistoryTicketPrices(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_TICKET_PRICES]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($item) {
            return new HistoryTicketPrices(
                $item['InformationID'],
                $item['ParentPage'],
                $item['ImagePath'],
                $item['TicketType'],
                $item['Price'],
                $item['Description']
            );
        }, $results);
    }

    public function getHistoryTourStartingPoints()
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_TOUR_STARTING_POINT]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $firstItem = $results[0];
            return new HistoryTourStartingPoint(
                $firstItem['InformationID'],
                $firstItem['ParentPage'],
                $firstItem['MainImagePath'],
                $firstItem['SecondaryImagePath'],
                $firstItem['Description']
            );
        }
        return null;
    }

    public function getHistoryTourDeparturesTimetables(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_TOUR_DEPARTURES_TIMETABLES]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($item) {
            return new HistoryTourDeparturesTimetables(
                $item['InformationID'],
                $item['ParentPage'],
                $item['Date']
            );
        }, $results);
    }

    public function getHistoryTours(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM [HISTORY_TOURS]');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($item) {
            return new HistoryTours(
                $item['InformationID'],
                $item['ParentPage'],
                $item['Departure'],
                $item['StartTime'],
                $item['EnglishTour'],
                $item['DutchTour'],
                $item['ChinesTour']
            );
        }, $results);
    }

    public function getCurrentImagePathTourStartingPoint($id, $columnName)
    {
        $stmt = $this->connection->prepare("SELECT $columnName FROM [HISTORY_TOUR_STARTING_POINT] WHERE InformationID = :id");
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetchColumn();
    }

    public function getCurrentImagePathTicketPrices($id)
    {
        $stmt = $this->connection->prepare('SELECT ImagePath FROM [HISTORY_TICKET_PRICES] WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetchColumn();
    }

    public function getCurrentImagePathRoute($id)
    {
        $stmt = $this->connection->prepare('SELECT LocationImagePath FROM [HISTORY_ROUTE] WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetchColumn();
    }

    // edit the information methods

    public function editImagePathsTourStartingPoint($id, $imagePath, $columnName)
    {
        $stmt = $this->connection->prepare("UPDATE [HISTORY_TOUR_STARTING_POINT] SET $columnName = :imagePath WHERE InformationID = :id");
        return $stmt->execute([
            'id' => $id,
            'imagePath' => $imagePath
        ]);
    }

    public function editHistoryPracticalInformation($id, $question, $answer)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_PRACTICAL_INFORMATION] SET Question = :question, Answer = :answer WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'question' => $question,
            'answer' => $answer
        ]);
    }

    public function editHistoryTopPart($id, $imagePath, $subheader, $description)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TOP_PART] SET ImagePath = :imagePath, Subheader = :subheader, Description = :description WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'imagePath' => $imagePath,
            'subheader' => $subheader,
            'description' => $description
        ]);
    }

    public function editHistoryRoute($id, $locationName, $locationDespcription, $wheelchairSupport)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_ROUTE] SET LocationName = :locationName, LocationDespcription = :locationDespcription, WheelchairSupport = :wheelchairSupport WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'locationName' => $locationName,
            'locationDespcription' => $locationDespcription,
            'wheelchairSupport' => $wheelchairSupport
        ]);
    }

    public function editImagePathHistoryRoute($id, $imagePath)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_ROUTE] SET LocationImagePath = :imagePath WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'imagePath' => $imagePath
        ]);
    }


    public function editHistoryTicketPrices($id, $ticketType, $price, $description)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TICKET_PRICES] SET TicketType = :ticketType, Price = :price, Description = :description WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'ticketType' => $ticketType,
            'price' => $price,
            'description' => $description
        ]);
    }

    public function editImagePathHistoryTicketPrices($id, $imagePath)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TICKET_PRICES] SET ImagePath = :imagePath WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'imagePath' => $imagePath
        ]);
    }

    public function editHistoryTourStartingPoint($id, $description)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TOUR_STARTING_POINT] SET Description = :description WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'description' => $description
        ]);
    }

    public function editHistoryTourDeparturesTimetables($id, $date)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TOUR_DEPARTURES_TIMETABLES] SET Date = :date WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'date' => $date
        ]);
    }

    public function editHistoryTours($id, $startTime, $englishTour, $dutchTour, $chinesTour)
    {
        $stmt = $this->connection->prepare('UPDATE [HISTORY_TOURS] SET StartTime = :startTime, EnglishTour = :englishTour, DutchTour = :dutchTour, ChinesTour = :chinesTour WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id,
            'startTime' => $startTime,
            'englishTour' => $englishTour,
            'dutchTour' => $dutchTour,
            'chinesTour' => $chinesTour
        ]);
    }

    // add the information methods
    public function addHistoryPracticalInformation($parentPage, $question, $answer)
    {
        $stmt = $this->connection->prepare('INSERT INTO [HISTORY_PRACTICAL_INFORMATION] (ParentPage, Question, Answer) VALUES (:parentPage, :question, :answer)');
        $stmt->execute([
            'parentPage' => $parentPage,
            'question' => $question,
            'answer' => $answer
        ]);
    }




    // delete the information methods

    public function deleteHistoryPracticalInformation($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM [HISTORY_PRACTICAL_INFORMATION] WHERE InformationID = :id');
        $stmt->execute([
            'id' => $id
        ]);
    }





}