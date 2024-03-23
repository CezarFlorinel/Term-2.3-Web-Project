<?php
namespace App\Models\History_event;

class HistoryTourStartingPoint implements \JsonSerializable
{
    public int $informationID;
    public string $mainImagePath;
    public string $secondaryImagePath;
    public string $description;

    public function __construct(int $informationID, string $mainImagePath, string $secondaryImagePath, string $description)
    {
        $this->informationID = $informationID;
        $this->mainImagePath = $mainImagePath;
        $this->secondaryImagePath = $secondaryImagePath;
        $this->description = $description;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}