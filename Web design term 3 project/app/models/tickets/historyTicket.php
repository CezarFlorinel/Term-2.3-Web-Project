<?php
namespace App\Models\Order_And_Invoice;

class HistoryTicket implements \JsonSerializable
{
    public int $id;
    public string $dateTime;
    public string $language;
    public string $typeOfTicket;

    public function __construct(int $id, string $dateTime, string $language, string $typeOfTicket)
    {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->language = $language;
        $this->typeOfTicket = $typeOfTicket;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}