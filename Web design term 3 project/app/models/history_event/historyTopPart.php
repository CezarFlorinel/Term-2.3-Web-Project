<?php
namespace App\Models\History_event;

class HistoryTopPart implements \JsonSerializable
{
    public int $informationID;
    public int $parentPage;
    public string $imagePath;
    public string $subheader;
    public string $description;

    public function __construct(int $informationID, int $parentPage, string $imagePath, string $subheader, string $description)
    {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->imagePath = $imagePath;
        $this->subheader = $subheader;
        $this->description = $description;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}