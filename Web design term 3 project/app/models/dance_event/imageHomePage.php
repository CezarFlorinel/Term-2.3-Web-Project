<?php

namespace App\Models\Dance_event;

class ImageHomePage implements \JsonSerializable
{
    public int $imageHomePageID;
    public string $imagePath;

    public function __construct($imageHomePageID, $imagePath)
    {
        $this->imageHomePageID = $imageHomePageID;
        $this->imagePath = $imagePath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}