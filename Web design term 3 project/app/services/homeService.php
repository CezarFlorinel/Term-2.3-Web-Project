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

    public function updateEvent(int $id, string $description, string $link, string $subtitle): void
    {
        $this->repository->updateEvent($id, $description, $link, $subtitle);
    }

    public function getHomeFestivalLocation(): HomeFestivalLocation
    {
        return $this->repository->getHomeFestivalLocation();
    }

    public function getHomePageDetails(): HomePageDetails
    {
        return $this->repository->getHomePageDetails();
    }

    public function getHomeGameEventDetails(): HomeGameEventDetails
    {
        return $this->repository->getHomeGameEventDetails();
    }

}