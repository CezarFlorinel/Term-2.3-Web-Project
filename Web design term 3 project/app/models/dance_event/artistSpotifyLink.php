<?php

namespace App\Models\Dance_event;

class ArtistSpotifyLink implements \JsonSerializable
{
    public int $ID;
    public string $spotifyLink;
    public int $FK_artistID;

    public function __construct($ID, $spotifyLink, $FK_artistID)
    {
        $this->ID = $ID;
        $this->spotifyLink = $spotifyLink;
        $this->FK_artistID = $FK_artistID;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}