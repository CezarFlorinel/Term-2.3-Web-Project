<?php
namespace App\Models\Custom_Pages;

class CustomPageImage implements \JsonSerializable
{
    public int $ID;

    public int $customPageID;
    public string $imagePath;

    public function __construct(int $ID, int $customPageID, string $imagePath)
    {
        $this->ID = $ID;
        $this->customPageID = $customPageID;
        $this->imagePath = $imagePath;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}