<?php
namespace App\Models\History_event;

class HistoryTourDeparturesTimetables implements \JsonSerializable
{
    public int $informationID;
    public string $date;

    public function __construct(int $informationID, string $date)
    {
        $this->informationID = $informationID;
        $this->date = $date;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}