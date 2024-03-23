<?php
namespace App\Models\History_event;

class HistoryRoute implements \JsonSerializable
{
    public int $informationID;
    public string $mainImagePath;
    public string $locationName;
    public string $locationDescription;
    public string $locationImagePath;
    public bool $wheelchairSupport;

    public function __construct(int $informationID, string $mainImagePath, string $locationName, string $locationDescription, string $locationImagePath, bool $wheelchairSupport)
    {
        $this->informationID = $informationID;
        $this->mainImagePath = $mainImagePath;
        $this->locationName = $locationName;
        $this->locationDescription = $locationDescription;
        $this->locationImagePath = $locationImagePath;
        $this->wheelchairSupport = $wheelchairSupport;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }


}