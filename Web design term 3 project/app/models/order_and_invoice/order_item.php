<?php
namespace App\Models\Order_And_Invoice;

class OrderItem implements \JsonSerializable
{
    public int $id;
    public int $quantity;
    public string $typeOfFestival;
    public ?int $orderFK;
    public ?int $dancePassFK;
    public ?int $danceTicketFK;
    public ?int $historyTicketFK;

    public function __construct(int $id, int $quantity, string $typeOfFestival, ?int $orderFK, ?int $dancePassFK, ?int $danceTicketFK, ?int $historyTicketFK)
    {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->typeOfFestival = $typeOfFestival;
        $this->orderFK = $orderFK;
        $this->dancePassFK = $dancePassFK;
        $this->danceTicketFK = $danceTicketFK;
        $this->historyTicketFK = $historyTicketFK;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}