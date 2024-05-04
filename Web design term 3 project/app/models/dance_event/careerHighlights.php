<?php

namespace App\Models\Dance_event;


class CareerHighlights implements \JsonSerializable
{
    public int $careerHighlightsID;
    public string $titleYearPeriod;
    public int $FK_artistID;
    public string $Text;
    public string $imagePath;

    public function __construct($careerHighlightsID, $titleYearPeriod, $FK_artistID, $Text, $imagePath)
    {
        $this->careerHighlightsID = $careerHighlightsID;
        $this->titleYearPeriod = $titleYearPeriod;
        $this->FK_artistID = $FK_artistID;
        $this->Text = $Text;
        $this->imagePath = $imagePath;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}