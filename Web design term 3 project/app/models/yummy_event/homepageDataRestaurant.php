<?php
namespace App\Models;

class HomepageDataRestaurant implements \JsonSerializable
{
    public int $pageID;
    public string $imagePath;
    public string $subheader;
    public string $description;
    public string $locationsImagePath;

    public function __construct(int $pageID, string $imagePath, string $subheader, string $description, string $locationsImagePath)
    {
        $this->pageID = $pageID;
        $this->imagePath = $imagePath;
        $this->subheader = $subheader;
        $this->description = $description;
        $this->locationsImagePath = $locationsImagePath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}