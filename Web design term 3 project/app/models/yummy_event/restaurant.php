<?php
namespace App\Models;

class Restaurant implements \JsonSerializable
{
    public int $restaurantID;
    public string $name;
    public string $location;
    public string $cuisineTyes;
    public int $numberOfSeats;
    public int $rating;
    public string $imagePathHomepage;
    public string $descriptionTopPart;
    public string $imagePathLocation;
    public string $descriptionSideOne;
    public string $descriptionSideTwo;
    public string $imagePathChef;

    public function __construct($restaurantID, $name, $location, $cuisineTyes, $numberOfSeats, $rating, $imagePathHomepage, $descriptionTopPart, $imagePathLocation, $descriptionSideOne, $descriptionSideTwo, $imagePathChef)
    {
        $this->restaurantID = $restaurantID;
        $this->name = $name;
        $this->location = $location;
        $this->cuisineTyes = $cuisineTyes;
        $this->numberOfSeats = $numberOfSeats;
        $this->rating = $rating;
        $this->imagePathHomepage = $imagePathHomepage;
        $this->descriptionTopPart = $descriptionTopPart;
        $this->imagePathLocation = $imagePathLocation;
        $this->descriptionSideOne = $descriptionSideOne;
        $this->descriptionSideTwo = $descriptionSideTwo;
        $this->imagePathChef = $imagePathChef;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
