<?php
namespace App\Models\Order_And_Invoice;

class Invoice implements \JsonSerializable
{
    public int $invoiceID;
    public int $orderId;
    public string $invoiceDate;
    public string $clientName;
    public string $address;
    public string $phoneNumber;
    public string $email;
    public float $VATamount;
    public float $totalAmount;
    public string $paymentDate;

    public function __construct(int $id, int $orderId, string $invoiceDate, string $clientName, string $clientAddress, string $phoneNumber, string $email, float $VATamount, float $totalAmount, string $paymentDate)
    {
        $this->invoiceID = $id;
        $this->orderId = $orderId;
        $this->invoiceDate = $invoiceDate;
        $this->clientName = $clientName;
        $this->address = $clientAddress;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->VATamount = $VATamount;
        $this->totalAmount = $totalAmount;
        $this->paymentDate = $paymentDate;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}