<?php
namespace App\Models\History_event;

class HistoryTours {
    public int $informationID;
    public int $parentPage;
    public int $departure;
    public string $startTime; // PHP does not have a time type, so this is also a string.
    public int $englishTour;
    public int $dutchTour;
    public int $chineseTour;

    public function __construct(int $informationID, int $parentPage, int $departure, string $startTime, int $englishTour, int $dutchTour, int $chineseTour) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->departure = $departure;
        $this->startTime = $startTime;
        $this->englishTour = $englishTour;
        $this->dutchTour = $dutchTour;
        $this->chineseTour = $chineseTour;
    }
}