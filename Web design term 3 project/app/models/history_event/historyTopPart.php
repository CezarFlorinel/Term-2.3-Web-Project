<?php
namespace App\Models\History_event;

class HistoryTopPart {
    public int $informationID;
    public int $parentPage;
    public string $imagePath;
    public string $subheader;
    public string $description;

    public function __construct(int $informationID, int $parentPage, string $imagePath, string $subheader, string $description) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->imagePath = $imagePath;
        $this->subheader = $subheader;
        $this->description = $description;
    }
}