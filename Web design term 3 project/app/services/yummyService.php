<?php
namespace App\Services;

use App\Repositories\YummyRepository;
use App\Models\Yummy_event\Restaurant;
use App\Models\Yummy_event\Session;

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


    public function getAllRestaurants(): array
    {
        return $this->yummyRepository->getAllRestaurants();
    }

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

    public function getRestaurantIdByName($restaurantName): int
    {
        return $this->yummyRepository->getRestaurantIdByName($restaurantName);
    }

    public function getCurrentRestaurantImagePath($id, $columnName): string
    {
        return $this->yummyRepository->getCurrentRestaurantImagePath($id, $columnName);
    }

    public function getLastImageGalleryInsertedId(): int
    {
        return $this->yummyRepository->getLastImageGalleryInsertedId();
    }

    public function getSessionsByRestaurantName($restaurantName): array
    {
        return $this->yummyRepository->getSessionsByRestaurantName($restaurantName);
    }

    public function getSessionByRestaurantName($restaurantName): Session
    {
        return $this->yummyRepository->getSessionByRestaurantName($restaurantName);
    }

    //-------------------- Reservation Part ------------------
    public function getAllReservations(): array
    {
        return $this->yummyRepository->getAllReservations();
    }

    public function getReservationsByUserId($id)
    {
        return $this->yummyRepository->getReservationsByUserId($id);
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

    //-------------------- Reservation Part ------------------

    public function editReservation($id, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive)
    {
        $this->yummyRepository->editReservation($id, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive);
    }

    //-------------------- DELETE METHODS --------------------------------------------------------
    //--------------------  Restaurant Part ------------------

    public function deleteRestaurantSession($id)
    {
        $this->yummyRepository->deleteRestaurantSession($id);
    }

    public function deleteRestaurantReview($id)
    {
        $this->yummyRepository->deleteRestaurantReview($id);
    }

    public function deleteRestaurantImagePathGallery($id)
    {
        $this->yummyRepository->deleteRestaurantImagePathGallery($id);
    }

    public function deleteRestaurant($id)
    {
        $this->yummyRepository->deleteRestaurant($id);
    }

    //-------------------- ADD METHODS --------------------------------------------------------

    //--------------------  Restaurant Part ------------------
    public function addRestaurantSession($restaurantid, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime)
    {
        $this->yummyRepository->addRestaurantSession($restaurantid, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime);
    }

    public function addRestaurantReview($restaurantid, $rating, $review, )
    {
        $this->yummyRepository->addRestaurantReview($restaurantid, $rating, $review);
    }

    public function addRestaurantImagePathGallery($restaurantid, $imagePath)
    {
        $this->yummyRepository->addRestaurantImagePathGallery($restaurantid, $imagePath);
    }

    //-------------------- Create New Restaurant Part ------------------

    public function createNewRestaurant($name, $location, $description, $descriptionSideOne, $descriptionSideTwo, $numberOfSeats, $numberOfStars, $cuisineType, $imagePathTop, $imagePathLocation, $imagePathChef)
    {
        $this->yummyRepository->createNewRestaurant($name, $location, $description, $descriptionSideOne, $descriptionSideTwo, $numberOfSeats, $numberOfStars, $cuisineType, $imagePathTop, $imagePathLocation, $imagePathChef);
    }

    //-------------------- Reservation Part ------------------

    public function addReservation($restaurantID, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive, $userID = null)
    {
        $this->yummyRepository->addReservation($restaurantID, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive, $userID);
    }



}
