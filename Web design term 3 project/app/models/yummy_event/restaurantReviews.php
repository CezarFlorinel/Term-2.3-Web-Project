<?php
namespace App\Models;

class RestaurantReviews implements \JsonSerializable
{
    public int $id;
    public int $restaurantID;
    public int $numberOfStars;
    public string $description;

    public function __construct(int $id, int $restaurantID, int $numberOfStars, string $description)
    {
        $this->id = $id;
        $this->restaurantID = $restaurantID;
        $this->numberOfStars = $numberOfStars;
        $this->description = $description;
    }


    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}