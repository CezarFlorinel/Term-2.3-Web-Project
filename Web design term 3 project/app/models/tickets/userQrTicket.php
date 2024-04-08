<?php
namespace App\Models\Tickets;

class UserQrTicket implements \JsonSerializable
{
    public int $ticketID;
    public ?int $userId;
    public ?int $orderItem_FK;
    public string $date;
    public string $qrCode;
    public bool $scanned;

    public function __construct(int $id, ?int $userId, ?int $orderItemId, string $dateTime, string $qrCode, bool $scanned)
    {
        $this->ticketID = $id;
        $this->userId = $userId;
        $this->orderItem_FK = $orderItemId;
        $this->date = $dateTime;
        $this->qrCode = $qrCode;
        $this->scanned = $scanned;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}