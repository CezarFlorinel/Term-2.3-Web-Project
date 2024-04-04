<?php
namespace App\Models\Tickets;

class UserQrTicket implements \JsonSerializable
{
    public string $ticketID;
    public ?int $userId;
    public ?int $orderItem_FK;
    public string $date;
    public bool $scanned;

    public function __construct(string $id, ?int $userId, ?int $orderItemId, string $dateTime, bool $scanned)
    {
        $this->ticketID = $id;
        $this->userId = $userId;
        $this->orderItem_FK = $orderItemId;
        $this->date = $dateTime;
        $this->scanned = $scanned;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}