<?php
namespace App\Models\Tickets;

class UserQrTicket implements \JsonSerializable
{
    public int $id;
    public ?int $userId;
    public ?int $orderItemId;
    public string $dateTime;
    public string $qrCode;
    public bool $scanned;

    public function __construct(int $id, ?int $userId, ?int $orderItemId, string $dateTime, string $qrCode, bool $scanned)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->orderItemId = $orderItemId;
        $this->dateTime = $dateTime;
        $this->qrCode = $qrCode;
        $this->scanned = $scanned;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}