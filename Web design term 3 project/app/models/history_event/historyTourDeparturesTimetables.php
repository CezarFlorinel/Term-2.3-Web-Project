<?php
namespace App\Models\History_event;

class HistoryTourDeparturesTimetables implements \JsonSerializable
{
    public int $informationID;
    public int $parentPage;
    public string $date;

    public function __construct(int $informationID, int $parentPage, string $date)
    {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->date = $date;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}