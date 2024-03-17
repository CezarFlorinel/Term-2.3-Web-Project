<?php
namespace App\Models;

class ImagePathGalleryRestaurant implements \JsonSerializable
{
    public int $id;
    public int $restaurantID;
    public string $imagePath;

    public function __construct(int $id, int $restaurantID, string $imagePath)
    {
        $this->id = $id;
        $this->restaurantID = $restaurantID;
        $this->imagePath = $imagePath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}