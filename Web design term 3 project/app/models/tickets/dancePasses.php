<?php
namespace App\Models\Tickets;

class DancePasses implements \JsonSerializable
{
    public int $passesID;
    public float $price;
    public ?string $date;
    public bool $allDayPass;
    public ?int $maxOneDayPasses;
    public ?int $maxAllDayPasses;


    public function __construct(int $id, float $price, ?string $date, bool $allDayPass, ?int $maxOneDayPasses, ?int $maxAllDayPasses)
    {
        $this->passesID = $id;
        $this->price = $price;
        $this->date = $date;
        $this->allDayPass = $allDayPass;
        $this->maxOneDayPasses = $maxOneDayPasses;
        $this->maxAllDayPasses = $maxAllDayPasses;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}