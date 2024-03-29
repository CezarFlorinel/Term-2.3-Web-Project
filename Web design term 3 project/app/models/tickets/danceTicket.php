<?php
namespace App\Models\Tickets;

class DanceTicket implements \JsonSerializable
{
    public int $D_TicketID;
    public string $dateAndTime;
    public string $location;
    public float $price;
    public string $singer;
    public int $totalQuantityOfAvailableTickets;
    public string $sessionType;
    public string $startTime;
    public string $endTime;

    public function __construct(int $id, string $dateTime, string $location, float $price, string $singer, int $totalQuantityOfAvailableTickets, string $sessionType, string $startTime, string $endTime)
    {
        $this->D_TicketID = $id;
        $this->dateAndTime = $dateTime;
        $this->location = $location;
        $this->price = $price;
        $this->singer = $singer;
        $this->totalQuantityOfAvailableTickets = $totalQuantityOfAvailableTickets;
        $this->sessionType = $sessionType;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}