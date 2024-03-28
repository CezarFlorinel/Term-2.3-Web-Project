<?php
namespace App\Models\Tickets;

class HistoryTicket implements \JsonSerializable
{
    public int $id;
    public string $dateTime;
    public string $language;
    public string $typeOfTicket;
    public int $routeID;

    public function __construct(int $id, string $dateTime, string $language, string $typeOfTicket, int $routeID)
    {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->language = $language;
        $this->typeOfTicket = $typeOfTicket;
        $this->routeID = $routeID;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}