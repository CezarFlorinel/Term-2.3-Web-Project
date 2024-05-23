<?php
namespace App\Models\Home_page;

class HomeFestivalLocation implements \JsonSerializable
{
    public int $ID;
    public int $FK_Page_Home;
    public string $description;
    public string $imagePathLocation;

    public function __construct(int $ID, int $FK_Page_Home, string $description, string $imagePathLocation)
    {
        $this->ID = $ID;
        $this->FK_Page_Home = $FK_Page_Home;
        $this->description = $description;
        $this->imagePathLocation = $imagePathLocation;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}