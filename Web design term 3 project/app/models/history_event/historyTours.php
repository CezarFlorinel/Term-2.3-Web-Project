<?php
namespace App\Models\History_event;

class HistoryTours implements \JsonSerializable
{
    public int $informationID;
    public int $departure;
    public string $startTime; // PHP does not have a time type, so this is also a string.
    public int $englishTour;
    public int $dutchTour;
    public int $chineseTour;
    public int $maxTicketsEnglish;
    public int $maxTicketsDutch;
    public int $maxTicketsChinese;


    public function __construct(int $informationID, int $departure, string $startTime, int $englishTour, int $dutchTour, int $chineseTour, int $maxTicketsEnglish, int $maxTicketsDutch, int $maxTicketsChinese)
    {
        $this->informationID = $informationID;
        $this->departure = $departure;
        $this->startTime = $startTime;
        $this->englishTour = $englishTour;
        $this->dutchTour = $dutchTour;
        $this->chineseTour = $chineseTour;
        $this->maxTicketsEnglish = $maxTicketsEnglish;
        $this->maxTicketsDutch = $maxTicketsDutch;
        $this->maxTicketsChinese = $maxTicketsChinese;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

}