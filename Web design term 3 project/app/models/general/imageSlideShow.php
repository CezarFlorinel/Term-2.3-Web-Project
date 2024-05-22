<?php
namespace App\Models\Home_page;

class HomeEvents implements \JsonSerializable
{
    public int $ID;
    public ?int $FK_Page_Home;
    public ?int $FK_Page_History;
    public string $imagePath;

    public function __construct(int $ID, ?int $FK_Page_Home, ?int $FK_Page_History, string $imagePath)
    {
        $this->ID = $ID;
        $this->FK_Page_Home = $FK_Page_Home;
        $this->FK_Page_History = $FK_Page_History;
        $this->imagePath = $imagePath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}