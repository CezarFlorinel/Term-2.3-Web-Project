<?php
namespace App\Models\Tickets;

class DancePasses implements \JsonSerializable
{
    public int $id;
    public float $price;
    public ?string $date;
    public bool $allDayPass;

    public function __construct(int $id, float $price, ?string $date, bool $allDayPass)
    {
        $this->id = $id;
        $this->price = $price;
        $this->date = $date;
        $this->allDayPass = $allDayPass;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}