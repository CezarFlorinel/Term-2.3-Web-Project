<?php
namespace App\Models\Home_page;

class HomeEvents implements \JsonSerializable
{
    public int $eventID;
    public int $FK_PageID;
    public string $imagePath;
    public string $eventDescription;
    public ?string $linkToRedirect;
    public string $eventTitle;


    public function __construct(int $eventID, int $FK_PageID, string $imagePath, string $eventDescription, ?string $linkToRedirect, string $eventTitle)
    {
        $this->eventID = $eventID;
        $this->FK_PageID = $FK_PageID;
        $this->imagePath = $imagePath;
        $this->eventDescription = $eventDescription;
        $this->linkToRedirect = $linkToRedirect;
        $this->eventTitle = $eventTitle;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}