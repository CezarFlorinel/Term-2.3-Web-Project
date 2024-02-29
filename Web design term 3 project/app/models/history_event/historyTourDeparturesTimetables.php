<?php
namespace App\Models\History_event;

class HistoryTourDeparturesTimetables {
    public int $informationID;
    public int $parentPage;
    public string $date; // Note: PHP does not have a native date type, so we use string here and expect it to be in a standard format.

    public function __construct(int $informationID, int $parentPage, string $date) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->date = $date;
    }
}