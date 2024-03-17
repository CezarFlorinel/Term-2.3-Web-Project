<?php
namespace App\Repositories;

use PDO;

use App\Models\Yummy_event\HomepageDataRestaurant;
use App\Models\Yummy_event\RestaurantReviews;
use App\Models\Yummy_event\User;
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



}
