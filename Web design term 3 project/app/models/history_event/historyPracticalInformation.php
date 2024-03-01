<?php
namespace App\Models\History_event;

class HistoryPracticalInformation {
    public int $informationID;
    public int $parentPage;
    public string $question;
    public string $answer;

    public function __construct(int $informationID, int $parentPage, string $question, string $answer) {
        $this->informationID = $informationID;
        $this->parentPage = $parentPage;
        $this->question = $question;
        $this->answer = $answer;
    }


}