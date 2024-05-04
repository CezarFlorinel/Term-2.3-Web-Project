<?php

namespace App\Models\Dance_event;

class Artist implements \JsonSerializable
{
    public int $artistID;
    public string $name;
    public string $imageTopPath;
    public string $imageAristLineupPath;

    public function __construct($artistID, $name, $imageTopPath, $imageAristLineupPath)
    {
        $this->artistID = $artistID;
        $this->name = $name;
        $this->imageTopPath = $imageTopPath;
        $this->imageAristLineupPath = $imageAristLineupPath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
