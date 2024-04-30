<?php
namespace App\Repositories;

use PDO;

use App\Models\Yummy_event\HomepageDataRestaurant;
use App\Models\Yummy_event\RestaurantReviews;
use App\Models\Yummy_event\Restaurant;
use App\Models\Yummy_event\ImagePathGalleryRestaurant;
use App\Models\Yummy_event\Session;
use App\Models\Yummy_event\Reservation;


class YummyRepository extends Repository  //methods for getting, updating and deleting information for the yummy related tables
{

    //-------------------- GET METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------

    public function getHomepageDataRestaurant()
    {
        $stmt = $this->connection->prepare('SELECT * FROM HOMEPAGE_DATA_RESTAURANT');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $firstItem = $result[0];
            return new HomepageDataRestaurant(
                $firstItem['PageID'],
                $firstItem['ImagePath'],
                $firstItem['Subheader'],
                $firstItem['Description'],
                $firstItem['LocaionsImagePathHomepage']
            );
        }
        return null;
    }

    public function getCurrentHomepageDataRestaurantImagePath($id, $columnName): string
    {
        $stmt = $this->connection->prepare('SELECT ' . $columnName . ' FROM HOMEPAGE_DATA_RESTAURANT WHERE PageID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[$columnName];
    }

    public function getRestaurantsNameAndId(): array
    {
        $stmt = $this->connection->prepare('SELECT RestaurantID, Name FROM RESTAURANT');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //--------------------  Restaurant Part ------------------


    public function getAllRestaurants(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM RESTAURANT');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $restaurants = [];
        foreach ($results as $result) {
            $restaurants[] = new Restaurant(
                $result['RestaurantID'],
                $result['Name'],
                $result['Location'],
                $result['CuisineTypes'],
                $result['NumberofSeats'],
                $result['Rating'],
                $result['ImagePathHomepage'],
                $result['DescriptionTopPart'],
                $result['ImagePathLocation'],
                $result['DescriptionSideOne'],
                $result['DescriptionSideTwo'],
                $result['ImagePathChef']
            );
        }
        return $restaurants;

    }

    public function getRestaurantById($id): Restaurant
    {
        $stmt = $this->connection->prepare('SELECT * FROM RESTAURANT WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Restaurant(
            $result['RestaurantID'],
            $result['Name'],
            $result['Location'],
            $result['CuisineTypes'],
            $result['NumberofSeats'],
            $result['Rating'],
            $result['ImagePathHomepage'],
            $result['DescriptionTopPart'],
            $result['ImagePathLocation'],
            $result['DescriptionSideOne'],
            $result['DescriptionSideTwo'],
            $result['ImagePathChef']
        );
    }

    public function getRestaurantReviews($id): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM RESTAURANT_REVIEWS WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reviews = [];
        foreach ($results as $result) {
            $reviews[] = new RestaurantReviews(
                $result['ID'],
                $result['RestaurantID'],
                $result['NumberOfStars'],
                $result['Description']
            );
        }
        return $reviews;
    }

    public function getRestaurantImagePathGallery($id): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM IMAGE_PATH_GALLERY_RESTAURANT WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $imagePaths = [];
        foreach ($results as $result) {
            $imagePaths[] = new ImagePathGalleryRestaurant(
                $result['ID'],
                $result['RestaurantID'],
                $result['ImagePath']
            );
        }
        return $imagePaths;
    }

    public function getRestaurantSession($id): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM SESSION WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = [];
        foreach ($results as $result) {
            $sessions[] = new Session(
                $result['SessionID'],
                $result['RestaurantID'],
                $result['AvailableSeats'],
                $result['PricesForAdults'],
                $result['PricesForChildren'],
                $result['ReservationFee'],
                $result['StartTime'],
                $result['EndTime']
            );
        }
        return $sessions;

    }

    public function getCurrentRestaurantImagePath($id, $columnName): string
    {
        $stmt = $this->connection->prepare('SELECT ' . $columnName . ' FROM RESTAURANT WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[$columnName];
    }

    public function getLastImageGalleryInsertedId(): int
    {
        $stmt = $this->connection->prepare('SELECT MAX(ID) AS MaxId FROM IMAGE_PATH_GALLERY_RESTAURANT');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['MaxId'] : 0;
    }

    public function getSessionsByRestaurantName($restaurantName): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM SESSION WHERE RestaurantID = (SELECT RestaurantID FROM RESTAURANT WHERE Name = :name)');
        $stmt->bindParam(':name', $restaurantName);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = [];
        foreach ($results as $result) {
            $sessions[] = new Session(
                $result['SessionID'],
                $result['RestaurantID'],
                $result['AvailableSeats'],
                $result['PricesForAdults'],
                $result['PricesForChildren'],
                $result['ReservationFee'],
                $result['StartTime'],
                $result['EndTime']
            );
        }
        return $sessions;
    }

    public function getSessionByRestaurantName($restaurantName): Session
    {
        $stmt = $this->connection->prepare('SELECT * FROM SESSION WHERE RestaurantID = (SELECT RestaurantID FROM RESTAURANT WHERE Name = :name)');
        $stmt->bindParam(':name', $restaurantName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Session(
            $result['SessionID'],
            $result['RestaurantID'],
            $result['AvailableSeats'],
            $result['PricesForAdults'],
            $result['PricesForChildren'],
            $result['ReservationFee'],
            $result['StartTime'],
            $result['EndTime']
        );
    }


    public function getRestaurantIdByName($restaurantName): int
    {
        $stmt = $this->connection->prepare('SELECT RestaurantID FROM RESTAURANT WHERE Name = :name');
        $stmt->bindParam(':name', $restaurantName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['RestaurantID'] : 0;
    }

    //-------------------- Reservation Part ------------------

    public function getAllReservations(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM RESTAURANT_RESERVATIONS');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reservations = [];
        foreach ($results as $result) {
            $reservations[] = new Reservation(
                $result['ID'],
                $result['RestaurantID'],
                $result['FirstName'],
                $result['LastName'],
                $result['Email'],
                $result['PhoneNumber'],
                $result['Session'],
                $result['Date'],
                $result['NumberOfAdults'],
                $result['NumberOfChildren'],
                $result['Comment'],
                $result['Active'],
                $result['UserId']
            );
        }
        return $reservations;
    }

    public function getReservationsByUserId($userID): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM RESTAURANT_RESERVATIONS WHERE UserID = :userID');
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reservations = [];
        foreach ($results as $result) {
            $reservations[] = new Reservation(
                $result['ID'],
                $result['RestaurantID'],
                $result['FirstName'],
                $result['LastName'],
                $result['Email'],
                $result['PhoneNumber'],
                $result['Session'],
                $result['Date'],
                $result['NumberOfAdults'],
                $result['NumberOfChildren'],
                $result['Comment'],
                $result['Active'],
                $result['UserId']
            );
        }
        return $reservations;

    }

    //-------------------- EDIT METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------
    public function editHomepageDataRestaurant($id, $subheader, $description)
    {
        $stmt = $this->connection->prepare('UPDATE HOMEPAGE_DATA_RESTAURANT SET Subheader = :subheader, Description = :description WHERE PageID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':subheader', $subheader);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public function editImagePathHomepageDataRestaurant($id, $columnName, $imageUrl)
    {
        $stmt = $this->connection->prepare('UPDATE HOMEPAGE_DATA_RESTAURANT SET ' . $columnName . ' = :imageUrl WHERE PageID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imageUrl', $imageUrl);
        $stmt->execute();
    }

    //--------------------  Restaurant Part ------------------

    public function editRestaurant($id, $name, $location, $numberOfSeats, $rating, $descriptionTopPart, $descriptionSideOne, $descriptionSideTwo)
    {
        $stmt = $this->connection->prepare('UPDATE RESTAURANT SET Name = :name, Location = :location, NumberofSeats = :numberOfSeats, Rating = :rating, DescriptionTopPart = :descriptionTopPart, DescriptionSideOne = :descriptionSideOne, DescriptionSideTwo = :descriptionSideTwo WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':numberOfSeats', $numberOfSeats);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':descriptionTopPart', $descriptionTopPart);
        $stmt->bindParam(':descriptionSideOne', $descriptionSideOne);
        $stmt->bindParam(':descriptionSideTwo', $descriptionSideTwo);
        $stmt->execute();
    }

    public function editRestaurantImagePath($id, $columnName, $imageUrl)
    {
        $stmt = $this->connection->prepare('UPDATE RESTAURANT SET ' . $columnName . ' = :imageUrl WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':imageUrl', $imageUrl);
        $stmt->execute();
    }

    public function editRestaurantTypeOfCuisine($id, $cuisineTypes)
    {
        $stmt = $this->connection->prepare('UPDATE RESTAURANT SET CuisineTypes = :cuisineTypes WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cuisineTypes', $cuisineTypes);
        $stmt->execute();
    }

    public function editRestaurantSession($id, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime)
    {
        $stmt = $this->connection->prepare('UPDATE SESSION SET AvailableSeats = :availableSeats, PricesForAdults = :pricesForAdults, PricesForChildren = :pricesForChildren, ReservationFee = :reservationFee, StartTime = :startTime, EndTime = :endTime WHERE SessionID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':availableSeats', $availableSeats);
        $stmt->bindParam(':pricesForAdults', $pricesForAdults);
        $stmt->bindParam(':pricesForChildren', $pricesForChildren);
        $stmt->bindParam(':reservationFee', $reservationFee);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':endTime', $endTime);
        $stmt->execute();
    }

    //-------------------- Reservation Part ------------------

    public function editReservation($id, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $active)
    {
        $stmt = $this->connection->prepare('UPDATE RESTAURANT_RESERVATIONS SET FirstName = :firstName, LastName = :lastName, Email = :email, PhoneNumber = :phoneNumber, Session = :session, Date = :date, NumberOfAdults = :numberOfAdults, NumberOfChildren = :numberOfChildren, Comment = :comment, Active = :active WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':session', $session);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':numberOfAdults', $numberOfAdults);
        $stmt->bindParam(':numberOfChildren', $numberOfChildren);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':active', $active);
        $stmt->execute();
    }

    //-------------------- DELETE METHODS --------------------------------------------------------
    //--------------------  Restaurant Part ------------------

    public function deleteRestaurantSession($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM SESSION WHERE SessionID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteRestaurantReview($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM RESTAURANT_REVIEWS WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteRestaurantImagePathGallery($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM IMAGE_PATH_GALLERY_RESTAURANT WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteRestaurant($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM RESTAURANT WHERE RestaurantID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


    //-------------------- ADD METHODS --------------------------------------------------------

    //--------------------  Restaurant Part ------------------

    public function addRestaurantReview($restaurantID, $numberOfStars, $description)
    {
        $stmt = $this->connection->prepare('INSERT INTO RESTAURANT_REVIEWS (RestaurantID, NumberOfStars, Description) VALUES (:restaurantID, :numberOfStars, :description)');
        $stmt->bindParam(':restaurantID', $restaurantID);
        $stmt->bindParam(':numberOfStars', $numberOfStars);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public function addRestaurantImagePathGallery($restaurantID, $imagePath)
    {
        $stmt = $this->connection->prepare('INSERT INTO IMAGE_PATH_GALLERY_RESTAURANT (RestaurantID, ImagePath) VALUES (:restaurantID, :imagePath)');
        $stmt->bindParam(':restaurantID', $restaurantID);
        $stmt->bindParam(':imagePath', $imagePath);
        $stmt->execute();
    }

    public function addRestaurantSession($restaurantID, $availableSeats, $pricesForAdults, $pricesForChildren, $reservationFee, $startTime, $endTime)
    {
        $stmt = $this->connection->prepare('INSERT INTO SESSION (RestaurantID, AvailableSeats, PricesForAdults, PricesForChildren, ReservationFee, StartTime, EndTime) VALUES (:restaurantID, :availableSeats, :pricesForAdults, :pricesForChildren, :reservationFee, :startTime, :endTime)');
        $stmt->bindParam(':restaurantID', $restaurantID);
        $stmt->bindParam(':availableSeats', $availableSeats);
        $stmt->bindParam(':pricesForAdults', $pricesForAdults);
        $stmt->bindParam(':pricesForChildren', $pricesForChildren);
        $stmt->bindParam(':reservationFee', $reservationFee);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':endTime', $endTime);
        $stmt->execute();
    }

    //-------------------- Create New Restaurant Part ------------------

    public function createNewRestaurant($name, $location, $description, $descriptionSideOne, $descriptionSideTwo, $numberOfSeats, $numberOfStars, $cuisineType, $imagePathTop, $imagePathLocation, $imagePathChef)
    {

        $stmt = $this->connection->prepare('INSERT INTO RESTAURANT (Name, Location, DescriptionTopPart, DescriptionSideOne, DescriptionSideTwo, NumberofSeats, Rating, CuisineTypes, ImagePathHomepage, ImagePathLocation, ImagePathChef) VALUES (:name, :location, :description, :descriptionSideOne, :descriptionSideTwo, :numberOfSeats, :numberOfStars, :cuisineType, :imagePathTop, :imagePathLocation, :imagePathChef)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':descriptionSideOne', $descriptionSideOne);
        $stmt->bindParam(':descriptionSideTwo', $descriptionSideTwo);
        $stmt->bindParam(':numberOfSeats', $numberOfSeats);
        $stmt->bindParam(':numberOfStars', $numberOfStars);
        $stmt->bindParam(':cuisineType', $cuisineType);
        $stmt->bindParam(':imagePathTop', $imagePathTop);
        $stmt->bindParam(':imagePathLocation', $imagePathLocation);
        $stmt->bindParam(':imagePathChef', $imagePathChef);
        $stmt->execute();

    }

    //-------------------- Reservation Part ------------------

    public function addReservation($restaurantID, $firstName, $lastName, $email, $phoneNumber, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $active, $userID)
    {
        $stmt = $this->connection->prepare('INSERT INTO RESTAURANT_RESERVATIONS (RestaurantID, FirstName, LastName, Email, PhoneNumber, Session, Date, NumberOfAdults, NumberOfChildren, Comment, Active) VALUES (:restaurantID, :firstName, :lastName, :email, :phoneNumber, :session, :date, :numberOfAdults, :numberOfChildren, :comment, :active, :userID)');
        $stmt->bindParam(':restaurantID', $restaurantID);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':session', $session);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':numberOfAdults', $numberOfAdults);
        $stmt->bindParam(':numberOfChildren', $numberOfChildren);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':active', $active);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
    }



}
