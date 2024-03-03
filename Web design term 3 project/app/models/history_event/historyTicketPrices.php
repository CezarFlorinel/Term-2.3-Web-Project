<?php
namespace App\Models\History_event;

class HistoryTicketPrices {
    public int $informationID;
    public int $parentPage;
    public string $imagePath;
    public string $ticketType;
    public float $price;
    public string $description;

    public function __construct(int $informationID, int $parentPage, string $imagePath, string $ticketType, float $price, string $description) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->imagePath = $imagePath;
        $this->ticketType = $ticketType;
        $this->price = $price;
        $this->description = $description;
    }
}