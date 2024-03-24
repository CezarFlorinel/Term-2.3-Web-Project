<?php
namespace App\Models\History_event;

class HistoryTicketPrices implements \JsonSerializable
{
    public int $informationID;
    public string $imagePath;
    public string $ticketType;
    public float $price;
    public string $description;

    public function __construct(int $informationID, string $imagePath, string $ticketType, float $price, string $description)
    {
        $this->informationID = $informationID;
        $this->imagePath = $imagePath;
        $this->ticketType = $ticketType;
        $this->price = $price;
        $this->description = $description;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}