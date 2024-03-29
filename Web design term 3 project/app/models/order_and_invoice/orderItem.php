<?php
namespace App\Models\Order_And_Invoice;

class OrderItem implements \JsonSerializable
{
    public int $orderItemID;
    public int $quantity;
    public string $typeOfFestival;
    public ?int $order_FK;
    public ?int $pass_FK;
    public ?int $danceTicket_FK;
    public ?int $historyTicket_FK;

    public function __construct(int $id, int $quantity, string $typeOfFestival, ?int $orderFK, ?int $dancePassFK, ?int $danceTicketFK, ?int $historyTicketFK)
    {
        $this->orderItemID = $id;
        $this->quantity = $quantity;
        $this->typeOfFestival = $typeOfFestival;
        $this->order_FK = $orderFK;
        $this->pass_FK = $dancePassFK;
        $this->danceTicket_FK = $danceTicketFK;
        $this->historyTicket_FK = $historyTicketFK;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}