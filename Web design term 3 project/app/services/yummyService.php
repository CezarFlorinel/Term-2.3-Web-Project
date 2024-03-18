<?php
namespace App\Services;

use App\Repositories\YummyRepository;
use App\Models\Yummy_event\Restaurant;

class YummyService
{
    private $yummyRepository;

    public function __construct()
    {
        $this->yummyRepository = new YummyRepository();
    }

    //-------------------- GET METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------
    public function getHomepageDataRestaurant()
    {
        return $this->yummyRepository->getHomepageDataRestaurant();
    }

    public function getCurrentHomepageDataRestaurantImagePath($id, $columnName)
    {
        return $this->yummyRepository->getCurrentHomepageDataRestaurantImagePath($id, $columnName);
    }

    public function getRestaurantsNameAndId()
    {
        return $this->yummyRepository->getRestaurantsNameAndId();
    }

    //--------------------Restaurant Part ------------------
    public function getRestaurantById($id): Restaurant
    {
        return $this->yummyRepository->getRestaurantById($id);
    }

    public function getRestaurantReviews($id): array
    {
        return $this->yummyRepository->getRestaurantReviews($id);
    }

    public function getRestaurantImagePathGallery($id): array
    {
        return $this->yummyRepository->getRestaurantImagePathGallery($id);
    }

    public function getRestaurantSession($id): array
    {
        return $this->yummyRepository->getRestaurantSession($id);
    }

    public function getCurrentRestaurantImagePath($id, $columnName)
    {
        return $this->yummyRepository->getCurrentRestaurantImagePath($id, $columnName);
    }

    //-------------------- EDIT METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------
    public function editHomepageDataRestaurant($id, $subheader, $description)
    {
        $this->yummyRepository->editHomepageDataRestaurant($id, $subheader, $description);
    }

    public function editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl)
    {
        $this->yummyRepository->editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl);
    }

    //--------------------Restaurant Part ------------------

    public function editRestaurant($id, $name, $location, $numberOfSeats, $rating, $descriptionTopPart, $descriptionSideOne, $descriptionSideTwo)
    {
        $this->yummyRepository->editRestaurant($id, $name, $location, $numberOfSeats, $rating, $descriptionTopPart, $descriptionSideOne, $descriptionSideTwo);
    }

    public function editRestaurantImagePath($id, $columnName, $imageUrl)
    {
        $this->yummyRepository->editRestaurantImagePath($id, $columnName, $imageUrl);
    }

    public function editRestaurantTypeOfCuisine($id, $cuisineTypes)
    {
        $this->yummyRepository->editRestaurantTypeOfCuisine($id, $cuisineTypes);
    }

    public function editRestaurantSession($id, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime)
    {
        $this->yummyRepository->editRestaurantSession($id, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime);
    }


    //-------------------- DELETE METHODS --------------------------------------------------------
    //--------------------  Restaurant Part ------------------

    public function deleteRestaurantSession($id)
    {
        $this->yummyRepository->deleteRestaurantSession($id);
    }


    //-------------------- ADD METHODS --------------------------------------------------------

    //--------------------  Restaurant Part ------------------
    public function addRestaurantSession($restaurantid, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime)
    {
        $this->yummyRepository->addRestaurantSession($restaurantid, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime);
    }





}
