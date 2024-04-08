<?php
namespace App\Models\Order_And_Invoice;

class Order implements \JsonSerializable
{
    public int $orderID;
    public int $userId;
    public string $paymentStatus;
    public float $totalAmount;
    public string $paymentMethod;
    public string $paymentDate;

    public function __construct(int $id, int $userId, string $paymentStatus, float $totalAmount, string $paymentMethod, string $paymentDate)
    {
        $this->orderID = $id;
        $this->userId = $userId;
        $this->paymentStatus = $paymentStatus;
        $this->totalAmount = $totalAmount;
        $this->paymentMethod = $paymentMethod;
        $this->paymentDate = $paymentDate;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}