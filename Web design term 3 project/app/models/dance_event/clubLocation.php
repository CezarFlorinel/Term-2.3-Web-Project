<?php

namespace App\Models\Dance_event;

class ClubLocation implements \JsonSerializable
{
    public int $clubLocationID;
    public string $name;
    public string $location;

    public function __construct($clubLocationID, $name, $location)
    {
        $this->clubLocationID = $clubLocationID;
        $this->name = $name;
        $this->location = $location;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}