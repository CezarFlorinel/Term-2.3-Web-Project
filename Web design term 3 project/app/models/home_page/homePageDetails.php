<?php
namespace App\Models\Home_page;

class HomePageDetails implements \JsonSerializable
{
    public int $ID;
    public string $title;
    public string $description;

    public function __construct(int $ID, string $title, string $description)
    {
        $this->ID = $ID;
        $this->title = $title;
        $this->description = $description;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
