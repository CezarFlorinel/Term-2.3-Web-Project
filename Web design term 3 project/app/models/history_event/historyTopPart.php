<?php
namespace App\Models\History_event;

class HistoryTopPart implements \JsonSerializable
{
    public int $informationID;
    public string $imagePath;
    public string $subheader;
    public string $description;

    public function __construct(int $informationID, string $imagePath, string $subheader, string $description)
    {
        $this->informationID = $informationID;
        $this->imagePath = $imagePath;
        $this->subheader = $subheader;
        $this->description = $description;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}