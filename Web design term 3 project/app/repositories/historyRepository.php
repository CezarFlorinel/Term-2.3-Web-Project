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



}