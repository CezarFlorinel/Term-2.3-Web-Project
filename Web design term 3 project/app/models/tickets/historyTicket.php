<?php
namespace App\Models\Tickets;

class HistoryTicket implements \JsonSerializable
{
    public int $H_TicketID;
    public string $dateAndTime;
    public string $language;
    public string $typeOfTicket;
    public int $routeID;
    public ?int $tourID;

    public function __construct(int $id, string $dateTime, string $language, string $typeOfTicket, int $routeID, int $tourID)
    {
        $this->H_TicketID = $id;
        $this->dateAndTime = $dateTime;
        $this->language = $language;
        $this->typeOfTicket = $typeOfTicket;
        $this->routeID = $routeID;
        $this->tourID = $tourID;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}