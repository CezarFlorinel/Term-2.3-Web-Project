<?php
namespace App\Models\Yummy_event;

class Session implements \JsonSerializable
{
    public int $sessionID;
    public int $restaurantID;
    public int $availableSeats;
    public float $pricesForAdults;
    public float $pricesForChildren;
    public float $reservationFee;
    public string $startTime;
    public string $endTime;


    public function __construct(int $sessionID, int $restaurantID, int $availableSeats, float $pricesForAdults, float $pricesForChildren, float $reservationFee, string $startTime, string $endTime)
    {
        $this->sessionID = $sessionID;
        $this->restaurantID = $restaurantID;
        $this->availableSeats = $availableSeats;
        $this->pricesForAdults = $pricesForAdults;
        $this->pricesForChildren = $pricesForChildren;
        $this->reservationFee = $reservationFee;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}

