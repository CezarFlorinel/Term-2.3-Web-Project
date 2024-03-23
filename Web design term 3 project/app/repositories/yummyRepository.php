<?php
namespace App\Repositories;

use PDO;

use App\Models\Yummy_event\HomepageDataRestaurant;
use App\Models\Yummy_event\RestaurantReviews;
use App\Models\Yummy_event\Restaurant;
use App\Models\Yummy_event\ImagePathGalleryRestaurant;
use App\Models\Yummy_event\Session;


class YummyRepository extends Repository  //methods for getting, updating and deleting information for the yummy related tables
{

    //-------------------- GET METHODS --------------------------------------------------------
    //-------------------- Home Part ------------------

    public function getHomepageDataRestaurant()
    {
        $stmt = $this->connection->prepare('SELECT * FROM HOMEPAGE_DATA_RESTAURANT');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty ($result)) {
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
        // Get the last sessionID and increment it
        $lastIdStmt = $this->connection->prepare('SELECT MAX(sessionID) AS lastID FROM SESSION');
        $lastIdStmt->execute();
        $lastIdResult = $lastIdStmt->fetch();
        $newId = $lastIdResult['lastID'] + 1;

        $stmt = $this->connection->prepare('INSERT INTO SESSION (SessionID, RestaurantID, AvailableSeats, PricesForAdults, PricesForChildren, ReservationFee, StartTime, EndTime) VALUES (:sessionID, :restaurantID, :availableSeats, :pricesForAdults, :pricesForChildren, :reservationFee, :startTime, :endTime)');
        $stmt->bindParam(':sessionID', $newId);
        $stmt->bindParam(':restaurantID', $restaurantID);
        $stmt->bindParam(':availableSeats', $availableSeats);
        $stmt->bindParam(':pricesForAdults', $pricesForAdults);
        $stmt->bindParam(':pricesForChildren', $pricesForChildren);
        $stmt->bindParam(':reservationFee', $reservationFee);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':endTime', $endTime);
        $stmt->execute();
    }

}
