<?php
namespace App\Models\Yummy_event;

class Reservation implements \JsonSerializable
{
    public int $ID;
    public ?int $restaurantID;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phoneNumber;
    public ?int $session;
    public string $date;
    public int $numberOfAdults;
    public int $numberOfChildren;
    public string $comment;
    public bool $isActive;
    public ?int $UserID;

    public function __construct($ID, $restaurantID, $firstName, $lastName, $email, $phone, $session, $date, $numberOfAdults, $numberOfChildren, $comment, $isActive, $UserID)
    {
        $this->ID = $ID;
        $this->restaurantID = $restaurantID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phone;
        $this->session = $session;
        $this->date = $date;
        $this->numberOfAdults = $numberOfAdults;
        $this->numberOfChildren = $numberOfChildren;
        $this->comment = $comment;
        $this->isActive = $isActive;
        $this->UserID = $UserID;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
