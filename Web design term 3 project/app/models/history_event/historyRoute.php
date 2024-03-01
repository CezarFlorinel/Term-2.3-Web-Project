<?php
namespace App\Models\History_event;

class HistoryRoute {
    public int $informationID;
    public int $parentPage;
    public string $mainImagePath;
    public string $locationName;
    public string $locationDescription;
    public string $locationImagePath;
    public bool $wheelchairSupport;

    public function __construct(int $informationID, int $parentPage, string $mainImagePath, string $locationName, string $locationDescription, string $locationImagePath, bool $wheelchairSupport) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->mainImagePath = $mainImagePath;
        $this->locationName = $locationName;
        $this->locationDescription = $locationDescription;
        $this->locationImagePath = $locationImagePath;
        $this->wheelchairSupport = $wheelchairSupport;
    }


}