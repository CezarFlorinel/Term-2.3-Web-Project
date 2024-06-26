<?php

namespace App\Repositories;

use PDO;
use App\Models\Home_page\HomeEvents;
use App\Models\Home_page\HomeFestivalLocation;
use App\Models\Home_page\HomePageDetails;
use App\Models\Home_page\HomeGameEventDetails;

class HomeRepository extends Repository
{
    public function getEvents(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM HOME_EVENTS");
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($event) {
            return new HomeEvents(
                $event['ID'],
                $event['FK_Page_Home'],
                $event['ImagePath'],
                $event['Description'],
                $event['Link'],
                $event['Subtitle']
            );
        }, $events);
    }

    public function getEventById(int $id): HomeEvents
    {
        $stmt = $this->connection->prepare("SELECT * FROM HOME_EVENTS WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        return new HomeEvents(
            $event['ID'],
            $event['FK_Page_Home'],
            $event['ImagePath'],
            $event['Description'],
            $event['Link'],
            $event['Subtitle']
        );
    }

    public function updateEvent(int $id, string $description, ?string $link, string $subtitle): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_EVENTS SET [Description] = :description, Link = :link, Subtitle = :subtitle WHERE ID = :id");
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':subtitle', $subtitle);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateEventImage(int $id, string $imagePath): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_EVENTS SET ImagePath = :imagePath WHERE ID = :id");
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getHomeFestivalLocation(): HomeFestivalLocation
    {
        $stmt = $this->connection->prepare("SELECT * FROM HOME_FESTIVAL_LOCATION");
        $stmt->execute();
        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        return new HomeFestivalLocation(
            $location['ID'],
            $location['FK_Page_Home'],
            $location['DescriptionLocationFestival'],
            $location['ImageLocationFestivalPath']
        );
    }

    public function updateHomeFestivalLocation(int $id, string $description): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_FESTIVAL_LOCATION SET DescriptionLocationFestival = :description WHERE ID = :id");
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateHomeFestivalLocationImage(int $id, string $imagePath): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_FESTIVAL_LOCATION SET ImageLocationFestivalPath = :imagePath WHERE ID = :id");
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getHomePageDetails(): HomePageDetails
    {
        $stmt = $this->connection->prepare("SELECT * FROM HOME_PAGE_DETAILS");
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_ASSOC);

        return new HomePageDetails(
            $details['ID'],
            $details['Title'],
            $details['DescriptionYellowSection'],
            $details['ImagePathTop']
        );
    }

    public function updateHomePageDetails(int $id, string $title, string $description): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_PAGE_DETAILS SET Title = :title, DescriptionYellowSection = :description WHERE ID = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateHomePageDetailsImage(int $id, string $imagePath): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_PAGE_DETAILS SET ImagePathTop = :imagePath WHERE ID = :id");
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getHomeGameEventDetails(): HomeGameEventDetails
    {
        $stmt = $this->connection->prepare("SELECT * FROM HOME_GAME_EVENT_DETAILS");
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_ASSOC);

        return new HomeGameEventDetails(
            $details['ID'],
            $details['FK_Page_Home'],
            $details['DescriptionGame'],
            $details['TitleGame'],
            $details['Subtitle'],
            $details['ImageQRcodePath'],
            $details['ImageDexterPath']
        );
    }

    public function updateHomeGameEventDetails(int $id, string $description, string $title, string $subtitle): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_GAME_EVENT_DETAILS SET DescriptionGame = :description, TitleGame = :title, Subtitle = :subtitle WHERE ID = :id");
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':subtitle', $subtitle);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateHomeGameEventDetailsImage(int $id, string $imagePath, string $column): void
    {
        $stmt = $this->connection->prepare("UPDATE HOME_GAME_EVENT_DETAILS SET $column = :imagePath WHERE ID = :id");
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}
