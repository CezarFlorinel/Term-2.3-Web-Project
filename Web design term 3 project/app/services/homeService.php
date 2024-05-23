<?php

namespace App\Services;

use App\Repositories\HomeRepository;
use App\Models\Home_page\HomeEvents;
use App\Models\Home_page\HomeFestivalLocation;
use App\Models\Home_page\HomePageDetails;
use App\Models\Home_page\HomeGameEventDetails;

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

    public function getEventById(int $id): HomeEvents
    {
        return $this->repository->getEventById($id);
    }


    public function updateEvent(int $id, string $description, ?string $link, string $subtitle): void
    {
        $this->repository->updateEvent($id, $description, $link, $subtitle);
    }
    public function updateEventImage(int $id, string $imagePath): void
    {
        $this->repository->updateEventImage($id, $imagePath);
    }

    public function getHomeFestivalLocation(): HomeFestivalLocation
    {
        return $this->repository->getHomeFestivalLocation();
    }

    public function updateHomeFestivalLocation(int $id, string $description): void
    {
        $this->repository->updateHomeFestivalLocation($id, $description);
    }

    public function updateHomeFestivalLocationImage(int $id, string $imagePath): void
    {
        $this->repository->updateHomeFestivalLocationImage($id, $imagePath);
    }

    public function getHomePageDetails(): HomePageDetails
    {
        return $this->repository->getHomePageDetails();
    }

    public function updateHomePageDetails(int $id, string $title, string $description): void
    {
        $this->repository->updateHomePageDetails($id, $title, $description);
    }

    public function updateHomePageDetailsImage(int $id, string $imagePath): void
    {
        $this->repository->updateHomePageDetailsImage($id, $imagePath);
    }

    public function getHomeGameEventDetails(): HomeGameEventDetails
    {
        return $this->repository->getHomeGameEventDetails();
    }

    public function updateHomeGameEventDetails(int $id, string $description, string $title, string $subtitle): void
    {
        $this->repository->updateHomeGameEventDetails($id, $description, $title, $subtitle);
    }

    public function updateHomeGameEventDetailsImage(int $id, string $imagePath, string $column): void
    {
        $this->repository->updateHomeGameEventDetailsImage($id, $imagePath, $column);
    }
}