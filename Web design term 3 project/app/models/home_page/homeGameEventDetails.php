<?php
namespace App\Models\Home_page;

class HomeGameEventDetails implements \JsonSerializable
{
    public int $ID;
    public int $FK_Page_Home;
    public string $description;
    public string $title;
    public string $subTitle;
    public string $imagePathQRcode;
    public string $imagePathDecorationLeft;

    public function __construct(int $ID, int $FK_Page_Home, string $description, string $title, string $subTitle, string $imagePathQRcode, string $imagePathDecorationLeft)
    {
        $this->ID = $ID;
        $this->FK_Page_Home = $FK_Page_Home;
        $this->description = $description;
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->imagePathQRcode = $imagePathQRcode;
        $this->imagePathDecorationLeft = $imagePathDecorationLeft;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}